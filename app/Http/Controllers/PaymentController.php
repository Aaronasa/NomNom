<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index()
    {
        $cart = session()->get('payment_cart', []);
        $totalPrice = session()->get('payment_total', 0);

        if (empty($cart)) {
            return redirect()->route('cart.show')->with('error', 'Cart is empty.');
        }

        // Calculate fees
        $subTotal = $totalPrice;
        $deliveryFee = 10000; // Example fee
        $adminFee = 2000; // Example fee
        $totalPrice = $subTotal + $deliveryFee + $adminFee;

        return view('payment', [
            'cart' => $cart,
            'subTotal' => $subTotal,
            'deliveryFee' => $deliveryFee,
            'adminFee' => $adminFee,
            'totalPrice' => $totalPrice,
        ]);
    }

    public function process(Request $request)
    {
        $cart = session()->get('payment_cart', []);
        $totalPrice = session()->get('payment_total', 0);

        if (empty($cart)) {
            return redirect()->route('cart.show')->with('error', 'Cart is empty.');
        }

        // Create order
        $order = new Order();
        $order->user_id = Auth::id();
        $order->orderDate = now();
        $order->totalPrice = $totalPrice;
        $order->paymentStatus = 1; // Paid
        $order->save();

        // Create order details
        foreach ($cart as $item) {
            $order->orderDetailInOrder()->create([
                'menuDay_id' => $item['menuDayId'],
                'price' => $item['foodPrice'],
                'unit' => $item['quantity'],
                'deliveryStatus_id' => 1, // Processing
            ]);
        }

        // Clear sessions
        session()->forget(['cart', 'payment_cart', 'payment_total']);

        return redirect()->route('order.history')->with('success', 'Payment successful!');
    }
}