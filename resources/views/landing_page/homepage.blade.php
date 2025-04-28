<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nutrition Plans - Transform Your Health</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1e3a34',
                        secondary: '#e4c052',
                        light: '#f8f9fa',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-white">
    <!-- Navigation -->
    <nav class="bg-primary text-white py-4">
        <div class="container mx-auto px-4 md:px-8 flex justify-between items-center">
            <div class="text-xl font-bold">NUTRITECH</div>
            <div class="hidden md:flex space-x-6">
                <a href="#" class="hover:text-secondary">Home</a>
                <a href="#MealPlans" class="hover:text-secondary">Meal Plans</a>
                <a href="#HowItWorks" class="hover:text-secondary">How It Works</a>
            </div>
            <a href="{{ route('login') }}" class="inline-block px-6 py-3 bg-[#e4c052] text-white font-semibold rounded-lg shadow-md hover:bg-[#e4c052] transition duration-300">
                Get Started
            </a>            
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-primary text-white py-16">
        <div class="container mx-auto px-4 md:px-8 flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 mb-8 md:mb-0">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Transform your health with personalized nutrition plans</h1>
                <p class="text-lg mb-8 text-gray-200">Discover a healthier you with our expert-designed nutrition programs tailored to your unique needs.</p>
                <button class="btn-primary">Start Your Journey</button>
                
                <div class="mt-8 bg-secondary text-primary inline-block p-4 rounded-lg">
                    <div class="text-3xl font-bold">10+</div>
                    <div class="text-sm">Nutrition Programs</div>
                </div>
            </div>
            <div class="md:w-1/2">
                <img src="https://raw.githubusercontent.com/santhosh6565/calender/main/uploads/foodimage.png" alt="Woman with healthy food" class="rounded-lg">
            </div>
        </div>
    </section>

    <!-- Feature Cards -->
    <section id="MealPlans" class="py-16 bg-white">
        <div class="container mx-auto px-4 md:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-gray-50 p-6 rounded-lg shadow-sm text-center">
                    <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Custom Meal Plans</h3>
                    <p class="text-gray-600">Personalized nutrition plans tailored to your goals</p>
                </div>
                
                <div class="bg-gray-50 p-6 rounded-lg shadow-sm text-center">
                    <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Weekly Check-ins</h3>
                    <p class="text-gray-600">Regular progress tracking and adjustments</p>
                </div>
                
                <div class="bg-gray-50 p-6 rounded-lg shadow-sm text-center">
                    <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Expert Support</h3>
                    <p class="text-gray-600">Guidance from certified nutritionists</p>
                </div>
                
                <div class="bg-gray-50 p-6 rounded-lg shadow-sm text-center">
                    <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Quick Results</h3>
                    <p class="text-gray-600">See changes in your health within weeks</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section id="HowItWorks" class="py-16 bg-gray-50">
        <div class="container mx-auto px-4 md:px-8">
            <div class="flex flex-col md:flex-row">
                <div class="md:w-1/2 mb-8 md:mb-0">
                    <h2 class="text-3xl font-bold mb-6 text-primary">How It Works</h2>
                    
                    <div class="mb-8">
                        <h3 class="text-xl font-semibold mb-2 text-primary">What will I get?</h3>
                        <p class="text-gray-700">You'll receive a comprehensive nutrition plan tailored to your body type, goals, and dietary preferences. Our plans include meal suggestions, recipes, and shopping lists.</p>
                    </div>
                    
                    <div class="mb-8">
                        <h3 class="text-xl font-semibold mb-2 text-primary">What will it be like?</h3>
                        <p class="text-gray-700">Our approach focuses on sustainable habits rather than restrictive diets. You'll enjoy delicious, nutritious meals while learning how to make healthier choices.</p>
                    </div>
                    
                    <div>
                        <h3 class="text-xl font-semibold mb-2 text-primary">How much will it cost?</h3>
                        <p class="text-gray-700">We offer flexible pricing options starting from $49/month. Choose the plan that fits your needs and budget with no hidden fees.</p>
                    </div>
                </div>
                
                <div class="md:w-1/2">
                    <img src="https://raw.githubusercontent.com/santhosh6565/calender/main/uploads/planimage.png" alt="Woman preparing healthy food" class="rounded-lg">
                </div>
            </div>
        </div>
    </section>

    <!-- What is a nutrition plan -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4 md:px-8">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-8 md:mb-0">
                    <h2 class="text-3xl font-bold mb-4 text-primary">What is a nutrition plan?</h2>
                    <p class="text-gray-700 mb-6">A nutrition plan is a structured approach to eating that optimizes your nutrient intake based on your specific needs. Our plans consider your age, activity level, health conditions, and goals to create a balanced approach to eating.</p>
                    <p class="text-gray-700 mb-6">Unlike generic diets, our nutrition plans are sustainable and enjoyable, focusing on whole foods that nourish your body and support overall wellness.</p>
                    <button class="btn-primary">Learn More</button>
                </div>
                
                <div class="md:w-1/2 md:pl-12">
                    <img src="https://raw.githubusercontent.com/santhosh6565/calender/main/uploads/image2dietplan.png" alt="Healthy food assortment" class="rounded-lg">
                </div>
            </div>
        </div>
    </section>

    <!-- 90 Day Program -->
    <section class="py-16 bg-secondary">
        <div class="container mx-auto px-4 md:px-8">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-8 md:mb-0">
                    <h2 class="text-3xl font-bold mb-4 text-primary">90 Day Body & Mind Transformation Program</h2>
                    <p class="text-primary mb-6">Our comprehensive program combines nutrition planning, exercise guidance, and mindfulness practices to transform your health from the inside out.</p>
                    <ul class="mb-8 text-primary">
                        <li class="mb-2 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Weekly meal plans and shopping lists
                        </li>
                        <li class="mb-2 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Personalized workout routines
                        </li>
                        <li class="mb-2 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Stress management techniques
                        </li>
                    </ul>
                </div>
                
                <div class="md:w-1/2 md:pl-12">
                    <img src="https://raw.githubusercontent.com/santhosh6565/calender/main/uploads/imagebow.png" alt="Person with scale" class="rounded-lg">
                </div>
            </div>
        </div>
    </section>

    <!-- Nutritionist Bio -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4 md:px-8">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-8 md:mb-0">
                    <img src="https://raw.githubusercontent.com/santhosh6565/calender/main/uploads/imagedoctor.png" alt="Nutrition Experts" class="rounded-lg">
                </div>
    
                <div class="md:w-1/2 md:pl-12">
                    <h2 class="text-3xl font-bold mb-4 text-primary">Trusted by 1000+ Certified Nutritionists & Health Experts</h2>
                    <p class="text-gray-700 mb-6">Our platform connects you with a network of experienced nutritionists and doctors to help you reach your health and wellness goals.</p>
                    <p class="text-gray-700 mb-6">We believe in personalized, science-backed diet plans that are practical, sustainable, and tailored to your unique lifestyle and preferences.</p>
                </div>
            </div>
        </div>
    </section>
    

    <!-- How we work -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4 md:px-8">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-8 md:mb-0">
                    <h2 class="text-3xl font-bold mb-6 text-primary">How we work together</h2>
                    <p class="text-gray-700 mb-6">Our collaborative approach ensures that your nutrition plan is perfectly aligned with your goals and preferences.</p>
                    
                    <ol class="space-y-4">
                        <li class="flex">
                            <div class="bg-secondary text-primary rounded-full w-8 h-8 flex items-center justify-center mr-4 flex-shrink-0">1</div>
                            <div>
                                <h3 class="font-semibold text-primary">Initial Consultation</h3>
                                <p class="text-gray-600">We discuss your health history, goals, and dietary preferences</p>
                            </div>
                        </li>
                        
                        <li class="flex">
                            <div class="bg-secondary text-primary rounded-full w-8 h-8 flex items-center justify-center mr-4 flex-shrink-0">2</div>
                            <div>
                                <h3 class="font-semibold text-primary">Plan Development</h3>
                                <p class="text-gray-600">We create your personalized nutrition strategy</p>
                            </div>
                        </li>
                        
                        <li class="flex">
                            <div class="bg-secondary text-primary rounded-full w-8 h-8 flex items-center justify-center mr-4 flex-shrink-0">3</div>
                            <div>
                                <h3 class="font-semibold text-primary">Implementation</h3>
                                <p class="text-gray-600">You begin following your plan with our ongoing support</p>
                            </div>
                        </li>
                        
                        <li class="flex">
                            <div class="bg-secondary text-primary rounded-full w-8 h-8 flex items-center justify-center mr-4 flex-shrink-0">4</div>
                            <div>
                                <h3 class="font-semibold text-primary">Regular Check-ins</h3>
                                <p class="text-gray-600">We monitor progress and make adjustments as needed</p>
                            </div>
                        </li>
                    </ol>
                </div>
                
                <div class="md:w-1/2 md:pl-12">
                    <img src="https://raw.githubusercontent.com/santhosh6565/calender/main/uploads/team-386673_640.webp" alt="Consultation process" class="rounded-lg">
                </div>
            </div>
        </div>
    </section>

    <!-- Stats -->
    <section class="py-16 bg-primary text-white">
        <div class="container mx-auto px-4 md:px-8">
            <h2 class="text-3xl font-bold mb-12 text-center">Solution In Easy Steps Successful life</h2>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div>
                    <div class="text-4xl font-bold mb-2 text-secondary">3.5k</div>
                    <p>Happy Clients</p>
                </div>
                
                <div>
                    <div class="text-4xl font-bold mb-2 text-secondary">32k</div>
                    <p>Meal Plans Created</p>
                </div>
                
                <div>
                    <div class="text-4xl font-bold mb-2 text-secondary">12</div>
                    <p>Expert Nutritionists</p>
                </div>
                
                <div>
                    <div class="text-4xl font-bold mb-2 text-secondary">100%</div>
                    <p>Satisfaction Rate</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How to Cook Healthy -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4 md:px-8">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-8 md:mb-0">
                    <img src="https://raw.githubusercontent.com/santhosh6565/calender/main/uploads/1image.png" alt="Cooking healthy" class="rounded-lg">
                </div>
                
                <div class="md:w-1/2 md:pl-12">
                    <h2 class="text-3xl font-bold mb-6 text-primary">How to Cook Healthy</h2>
                    
                    <div class="bg-gray-50 p-6 rounded-lg mb-6">
                        <h3 class="font-semibold text-primary mb-2">Simple Techniques</h3>
                        <p class="text-gray-700">Learn basic cooking methods that preserve nutrients and enhance flavor without excess fat or salt.</p>
                    </div>
                    
                    <div class="bg-gray-50 p-6 rounded-lg mb-6">
                        <h3 class="font-semibold text-primary mb-2">Meal Prep Strategies</h3>
                        <p class="text-gray-700">Save time and stay on track with efficient meal preparation techniques for busy lifestyles.</p>
                    </div>
                    
                    <div class="bg-gray-50 p-6 rounded-lg mb-6">
                        <h3 class="font-semibold text-primary mb-2">Flavor Without Guilt</h3>
                        <p class="text-gray-700">Discover how to use herbs, spices, and healthy cooking methods to create delicious meals.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
<footer class="bg-primary text-white py-12">
    <div class="container mx-auto px-4 md:px-8 grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- About Section -->
        <div>
            <h2 class="text-xl font-bold mb-4">About Us</h2>
            <p class="text-gray-200">
                We offer personalized nutrition plans tailored to help you lead a healthier life. Join us on your journey to better health and wellness.
            </p>
        </div>

        <!-- Quick Links -->
        <div>
            <h2 class="text-xl font-bold mb-4">Quick Links</h2>
            <ul class="space-y-2 text-gray-200">
                <li><a href="#" class="hover:underline">Home</a></li>
                <li><a href="#" class="hover:underline">Programs</a></li>
                <li><a href="#" class="hover:underline">About</a></li>
                <li><a href="#" class="hover:underline">Contact</a></li>
            </ul>
        </div>

        <!-- Newsletter -->
        <div>
            <h2 class="text-xl font-bold mb-4">Stay Updated</h2>
            <p class="text-gray-200 mb-4">Subscribe to our newsletter to get the latest updates and offers.</p>
            <form class="flex flex-col sm:flex-row items-center gap-2">
                <input type="email" placeholder="Enter your email" class="w-full sm:w-auto px-4 py-2 rounded-lg text-primary" required>
                <button type="submit" class="btn-primary">Subscribe</button>
            </form>
        </div>
    </div>
</footer>