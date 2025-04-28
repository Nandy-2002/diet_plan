<?php

namespace App\Constants;

class PaymentConstants
{
    // Define income methods as constants
    public const INCOME_METHODS = [
        'Cash' => 'Cash',
        'UPI' => 'UPI',
        'Bank Transaction' => 'Bank Transaction',
        'Credit Card' => 'Credit Card',
        'Debit Card' => 'Debit Card',
        'Cheque' => 'Cheque',
        'Net Banking' => 'Net Banking',
    ];
}