<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Review;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{

    public function create($orderDetailId)
    {
        $orderDetail = OrderDetail::with([
            'orderInOrderDetail',
            'menuDayInOrderDetail.foodInMenuDay'
        ])->findOrFail($orderDetailId);

        if ($orderDetail->orderInOrderDetail->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $food = $orderDetail->menuDayInOrderDetail->foodInMenuDay;

        return view('addreviews', compact('orderDetail', 'food'));
    }
    public function store(Request $request, $orderDetailId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        $orderDetail = OrderDetail::with('orderInOrderDetail')->findOrFail($orderDetailId);

        if ($orderDetail->orderInOrderDetail->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        if ($orderDetail->review) {
            return back()->with('error', 'You have already reviewed this item.');
        }

        Review::create([
            'rating' => $request->rating,
            'comment' => $request->comment,
            'user_id' => Auth::id(),
            'order_detail_id' => $orderDetailId,
        ]);

        return redirect()->route('reviews.index')->with('success', 'Review submitted successfully!');
    }
    public function index()
    {
        $orderDetails = OrderDetail::with([
            'menuDayInOrderDetail.foodInMenuDay',
            'orderInOrderDetail',
            'review'
        ])
            ->whereHas('orderInOrderDetail', function ($query) {
                $query->where('user_id', Auth::id())
                    ->where('paymentStatus', 1);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('reviews', compact('orderDetails'));
    }
}
