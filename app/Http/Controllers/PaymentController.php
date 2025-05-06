<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $paymentData = session()->get('payment_data', []);
        $cart = $paymentData['cart'] ?? [];
        $totalPrice = $paymentData['totalPrice'] ?? 0;
        
        // Calculate additional fees
        $deliveryFee = 10000; // Rp. 10.000
        $adminFee = 4000;     // Rp. 4.000
        $grandTotal = $totalPrice + $deliveryFee + $adminFee;
        
        return view('payment', [
            'cart' => $cart,
            'totalPrice' => $totalPrice,
            'deliveryFee' => $deliveryFee,
            'adminFee' => $adminFee,
            'grandTotal' => $grandTotal
        ]);
    }

    public function processPayment(Request $request)
    {
        // Here you would typically process the payment with a payment gateway
        // For this example, we'll just redirect to the MenuDayController's paymentfinish method
        
        return app(MenuDayController::class)->paymentfinish();
    }
}   