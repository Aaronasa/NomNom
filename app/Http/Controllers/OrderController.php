<?php

namespace App\Http\Controllers;

use App\Models\MenuDay;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user', 'orderDetailInOrder')->where('user_id', Auth::id())->get();
        return view('history', compact('orders'));
    }

    public function showOrderDetail($orderId)
{
    $order = Order::with('orderDetailInOrder')->findOrFail($orderId);

    $orderDetail = $order->orderDetailInOrder->first();

    $menuDayIds = explode(',', $orderDetail->menuDay_id);
    $menuDays = MenuDay::with('foodInMenuDay')->whereIn('id', $menuDayIds)->get();

    $foodDetails = $menuDays->map(function ($menuDay) {
        $food = $menuDay->foodInMenuDay;
        return [
            'foodName' => $food->foodName ?? 'Unknown',
            'foodDate' => $menuDay->foodDate ?? 'Unknown',
            'foodPrice' => $food->foodPrice ?? 0,
        ];
    });

    return view('OrderDetail', compact('order', 'orderDetail', 'foodDetails'));
}
}
