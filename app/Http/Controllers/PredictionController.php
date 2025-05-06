<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\Feedback;
use Carbon\Carbon;
use App\Models\MealTracker;

class PredictionController extends Controller
{
    public function index(){
        return view('admin.predict.index');
    }
    public function predict(Request $request)
    {
        $weeklyMealPlan = [];
        $precautions = [];

        // Load CSV files
        $foodNutrition = $this->readCsv(storage_path('app/public/food_nutrition.csv'));
        $diseaseNutrition = $this->readCsv(storage_path('app/public/disease_nutrition.csv'));

        if ($request->isMethod('post')) {
            $diseaseName = strtolower(trim($request->input('disease')));

            // Find disease
            $diseaseData = collect($diseaseNutrition)->first(function ($item) use ($diseaseName) {
                return strtolower($item['disease']) == $diseaseName;
            });

            if (!$diseaseData) {
                return view('predict', ['weekly_meal_plan' => [], 'precautions' => []])
                    ->with('danger', 'Disease not found! Please enter a valid disease.');
            }

            $precautions = [
                $diseaseData['Precaution_1'] ?? '',
                $diseaseData['Precaution_2'] ?? '',
                $diseaseData['Precaution_3'] ?? '',
                $diseaseData['Precaution_4'] ?? '',
            ];

            $inefficientNutrients = explode(' ', $diseaseData['ineficient_nutritions'] ?? '');

            // Prepare food data
            $foodItems = [];

            foreach ($foodNutrition as $food) {
                $score = 0;
                foreach ($inefficientNutrients as $nutrient) {
                    if (isset($food[$nutrient])) {
                        $score += floatval($food[$nutrient]);
                    }
                }
                $food['score'] = $score;
                $foodItems[] = $food;
            }

            // Sort foods by score and pick top items
            usort($foodItems, function ($a, $b) {
                return $b['score'] <=> $a['score'];
            });

            $recommendedFoods = array_column(array_slice($foodItems, 0, 30), 'Description');

            // Shuffle for variety
            shuffle($recommendedFoods);

            $days = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
            $meals = ["Breakfast", "Lunch", "Dinner"];

            foreach ($days as $day) {
                foreach ($meals as $meal) {
                    $foodItem = count($recommendedFoods) ? array_shift($recommendedFoods) : "Balanced Meal";
                    $weeklyMealPlan[$day][$meal] = $foodItem;
                }
            }
        }

        return view('admin.predict.index', [
            'weekly_meal_plan' => $weeklyMealPlan,
            'precautions' => $precautions,
        ]);
    }

    private function readCsv($path)
    {
        $csv = array_map('str_getcsv', file($path));
        $header = array_map('trim', array_shift($csv));
        $data = [];

        foreach ($csv as $row) {
            // If columns missing, fill with empty strings
            if (count($row) < count($header)) {
                $row = array_pad($row, count($header), '');
            }
            // If extra columns, cut them
            if (count($row) > count($header)) {
                $row = array_slice($row, 0, count($header));
            }
            $data[] = array_combine($header, $row);
        }
        return $data;
    }

    public function weeklypredict(Request $request)
    {
        $weeklyMealPlan = [];
        $precautions = [];

        // Load CSV files
        $foodNutrition = $this->readCsv(storage_path('app/public/food_nutrition.csv'));
        $diseaseNutrition = $this->readCsv(storage_path('app/public/disease_nutrition.csv'));

        // Get the disease name from the logged-in user or from request
        $diseaseName = auth()->user()->disease_name ?? strtolower(trim($request->input('disease')));

        if ($diseaseName) {
            // Find disease
            $diseaseData = collect($diseaseNutrition)->first(function ($item) use ($diseaseName) {
                return strtolower($item['disease']) == $diseaseName;
            });

            if (!$diseaseData) {
                return view('predict', ['weekly_meal_plan' => [], 'precautions' => []])
                    ->with('danger', 'Disease not found! Please enter a valid disease.');
            }

            // Extract precautions
            $precautions = [
                $diseaseData['Precaution_1'] ?? '',
                $diseaseData['Precaution_2'] ?? '',
                $diseaseData['Precaution_3'] ?? '',
                $diseaseData['Precaution_4'] ?? '',
            ];

            // Get inefficient nutrients
            $inefficientNutrients = explode(' ', $diseaseData['ineficient_nutritions'] ?? '');

            // Prepare food data
            $foodItems = [];

            foreach ($foodNutrition as $food) {
                $score = 0;
                foreach ($inefficientNutrients as $nutrient) {
                    if (isset($food[$nutrient])) {
                        $score += floatval($food[$nutrient]);
                    }
                }
                $food['score'] = $score;
                $foodItems[] = $food;
            }

            // Sort foods by score and pick top items
            usort($foodItems, function ($a, $b) {
                return $b['score'] <=> $a['score'];
            });

            $recommendedFoods = array_column(array_slice($foodItems, 0, 30), 'Description');

            // Shuffle for variety
            shuffle($recommendedFoods);

            // Generate weekly meal plan
            $days = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
            $meals = ["Breakfast", "Lunch", "Dinner"];

            foreach ($days as $day) {
                foreach ($meals as $meal) {
                    $foodItem = count($recommendedFoods) ? array_shift($recommendedFoods) : "Balanced Meal";
                    $weeklyMealPlan[$day][$meal] = $foodItem;
                }
            }
        }

        return view('admin.predict.weeklypredict', [
            'weekly_meal_plan' => $weeklyMealPlan,
            'precautions' => $precautions,
        ]);
    }

    public function showCollaborationView(Request $request)
    {
        // Get the disease name of the logged-in user
        $diseaseName = auth()->user()->disease_name;

        // Fetch feedbacks related to the disease name of the logged-in user
        $feedbacks = Feedback::where('disease_name', $diseaseName)->get();

        // Return the view with feedbacks and disease name
        return view('admin.predict.collaboration', [
            'feedbacks' => $feedbacks,
            'diseaseName' => $diseaseName,
        ]);
    }

    public function submitFeedback(Request $request)
    {
        $request->validate([
            'feedback' => 'required|string', // Validate the feedback input
        ]);

        // Store feedback with the user's disease name
        Feedback::create([
            'user_id' => auth()->id(), // Store the logged-in user's ID
            'disease_name' => auth()->user()->disease_name, // Use the user's disease name
            'feedback' => $request->input('feedback'), // The feedback provided by the user
        ]);

        return back()->with('success', 'Your feedback has been submitted!');
    }

    public function tracker(Request $request)
    {
        $weeklyMealPlan = [];
        $precautions = [];

        // Load CSV files
        $foodNutrition = $this->readCsv(storage_path('app/public/food_nutrition.csv'));
        $diseaseNutrition = $this->readCsv(storage_path('app/public/disease_nutrition.csv'));

        // Get the disease name from the logged-in user or from request
        $diseaseName = auth()->user()->disease_name ?? strtolower(trim($request->input('disease')));

        if ($diseaseName) {
            // Find disease
            $diseaseData = collect($diseaseNutrition)->first(function ($item) use ($diseaseName) {
                return strtolower($item['disease']) == $diseaseName;
            });

            if (!$diseaseData) {
                return view('predict', ['weekly_meal_plan' => [], 'precautions' => []])
                    ->with('danger', 'Disease not found! Please enter a valid disease.');
            }

            // Extract precautions
            $precautions = [
                $diseaseData['Precaution_1'] ?? '',
                $diseaseData['Precaution_2'] ?? '',
                $diseaseData['Precaution_3'] ?? '',
                $diseaseData['Precaution_4'] ?? '',
            ];

            // Get inefficient nutrients
            $inefficientNutrients = explode(' ', $diseaseData['ineficient_nutritions'] ?? '');

            // Prepare food data
            $foodItems = [];

            foreach ($foodNutrition as $food) {
                $score = 0;
                foreach ($inefficientNutrients as $nutrient) {
                    if (isset($food[$nutrient])) {
                        $score += floatval($food[$nutrient]);
                    }
                }
                $food['score'] = $score;
                $foodItems[] = $food;
            }

            // Sort foods by score and pick top items
            usort($foodItems, function ($a, $b) {
                return $b['score'] <=> $a['score'];
            });

            $recommendedFoods = array_column(array_slice($foodItems, 0, 30), 'Description');
            shuffle($recommendedFoods);

            // Generate weekly meal plan (in-memory)
            $days = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
            $meals = ["Breakfast", "Lunch", "Dinner"];
            foreach ($days as $day) {
                foreach ($meals as $meal) {
                    $foodItem = count($recommendedFoods) ? array_shift($recommendedFoods) : "Balanced Meal";
                    $weeklyMealPlan[$day][$meal] = $foodItem;
                }
            }

            // Get today's data
            $today = Carbon::now()->format('l');

            // Check if today's meals already exist in DB
            $existingTodayMeals = MealTracker::where('user_id', auth()->id())
                ->where('day', $today)
                ->get();

            if ($existingTodayMeals->isEmpty()) {
                // If not exists, insert today's meals into DB
                foreach ($meals as $meal) {
                    MealTracker::create([
                        'user_id' => auth()->id(),
                        'day' => $today,
                        'meal_type' => $meal,
                        'food' => $weeklyMealPlan[$today][$meal] ?? "Balanced Meal",
                        'is_finished' => false,
                    ]);
                }

                // Reload inserted meals
                $existingTodayMeals = MealTracker::where('user_id', auth()->id())
                    ->where('day', $today)
                    ->get();
            }

            // Build today's meal plan from DB
            $todayMealPlan = [];
            foreach ($existingTodayMeals as $meal) {
                $todayMealPlan[$meal->meal_type] = $meal->food;
            }

            // Fallback in case anything is missing
            foreach ($meals as $meal) {
                if (!isset($todayMealPlan[$meal])) {
                    $todayMealPlan[$meal] = "Balanced Meal";
                }
            }

            // Count finished meals for chart
            $completedMeals = $existingTodayMeals->where('is_finished', true)->count();
            $totalMeals = count($meals);

            return view('admin.tracker.tracker', [
                'weekly_meal_plan' => $weeklyMealPlan,
                'precautions' => $precautions,
                'today_meal_plan' => $todayMealPlan,
                'completedMeals' => $completedMeals,
                'totalMeals' => $totalMeals,
            ]);
        }

        // Fallback view
        return view('admin.tracker.tracker', [
            'weekly_meal_plan' => [],
            'precautions' => [],
            'today_meal_plan' => [],
            'completedMeals' => 0,
            'totalMeals' => 0,
        ]);
    }

    public function update(Request $request, $meal)
    {
        $mealTracker = MealTracker::where('user_id', auth()->id())
            ->where('meal_type', $request->meal_type)
            ->where('food', $request->food)
            ->first();

        if ($mealTracker) {
            $mealTracker->is_finished = true;
            $mealTracker->save();
        }

        return redirect()->route('admin.tracker'); // Redirect to the meal tracker page
    }

    public function weeklyStats()
    {
        $userId = auth()->id();
        $days = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];

        $completed = [];
        $total = [];

        foreach ($days as $day) {
            $dayMeals = MealTracker::where('user_id', $userId)->where('day', $day)->get();
            $completed[] = $dayMeals->where('is_finished', true)->count();
            $total[] = $dayMeals->count();
        }

        return response()->json([
            'days' => $days,
            'completed' => $completed,
            'total' => $total,
        ]);
    }

    public function overallStats()
    {
        $meals = MealTracker::select('meal_type', 'food')
            ->groupBy('meal_type', 'food')
            ->get();

        $data = [];

        foreach ($meals as $meal) {
            $usersUsing = MealTracker::where('meal_type', $meal->meal_type)
                                ->where('food', $meal->food)
                                ->count();

            $usersCompleted = MealTracker::where('meal_type', $meal->meal_type)
                                ->where('food', $meal->food)
                                ->where('is_finished', true)
                                ->count();

            $data[] = [
                'meal_type' => $meal->meal_type,
                'food' => $meal->food,
                'users_using' => $usersUsing,
                'users_completed' => $usersCompleted,
            ];
        }

        return response()->json($data);
    }

}
