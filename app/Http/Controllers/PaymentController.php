<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        $subTotal = 0;
        foreach ($cart as $item) {
            $subTotal += $item['foodPrice'] * $item['quantity'];
        }
        
        $deliveryFee = 5000;
        $adminFee = 3000;
        $totalPrice = $subTotal + $deliveryFee + $adminFee;
        $orderId = uniqid('ORD-');
        
        return view('payment', compact('cart', 'subTotal', 'deliveryFee', 'adminFee', 'totalPrice', 'orderId'));
    }
    
    public function process(Request $request)
    {
        // Process payment and create order record
        $orderId = $request->input('order_id');
        $cart = session('cart', []);
        
        // Create order record
        $order = new Order();
        $order->orderDate = now();
        $order->totalPrice = $request->session()->get('totalPrice');
        $order->paymentStatus = 1; // Paid
        $order->save();
        
        // Create order details
        foreach ($cart as $item) {
            $orderDetail = new OrderDetail();
            $orderDetail->order_id = $order->id;
            $orderDetail->menuDay_id = $item['menuDayId'];
            $orderDetail->unit = $item['quantity'];
            $orderDetail->price = $item['foodPrice'];
            $orderDetail->deliveryStatus_id = 1; // On Process
            $orderDetail->save();
        }
        
        // Clear cart session
        $request->session()->forget('cart');
        
        return redirect()->route('history.index')->with('success', 'Payment successful!');
    }
}