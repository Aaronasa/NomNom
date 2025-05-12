<?php

namespace App\Http\Controllers;

use App\Models\MenuDay;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user', 'orderDetailInOrder')->where('user_id', Auth::id())->get();

        // Add proof image paths to each order detail if exists
        foreach ($orders as $order) {
            foreach ($order->orderDetailInOrder as $detail) {
                $imagePath = public_path("images/proofs/orderDetail_{$detail->id}.jpg");
                if (file_exists($imagePath)) {
                    $detail->proofImageUrl = asset("images/proofs/orderDetail_{$detail->id}.jpg");
                } else {
                    $detail->proofImageUrl = null;
                }
            }
        }

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

    // NEW METHOD: Upload proof image from vendor
    public function uploadProof(Request $request, $orderDetailId)
    {
        $request->validate([
            'proof_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $orderDetail = OrderDetail::findOrFail($orderDetailId);

        // Save the image to public/images/proofs with a fixed name
        if ($request->hasFile('proof_image')) {
            $imageName = "orderDetail_{$orderDetail->id}.jpg";
            $request->file('proof_image')->move(public_path('images/proofs'), $imageName);
        }

        return redirect()->back()->with('success', 'Proof image uploaded successfully.');
    }
}
