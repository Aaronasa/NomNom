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
    // In app/Http/Controllers/ReviewController.php

    public function index()
    {
        // The DeliveryStatusSeeder confirms 'already received' will have ID 3
        $alreadyReceivedStatusId = 3; //

        $orderDetails = OrderDetail::with([
            'menuDayInOrderDetail.foodInMenuDay',
            'orderInOrderDetail.user',
            'review',
            'deliveryStatusInOrderDetail'
        ])
            ->where('deliveryStatus_id', $alreadyReceivedStatusId) // Filter by OrderDetail's delivery status
            ->whereHas('orderInOrderDetail', function ($query) { // Ensure the order belongs to the logged-in user
                $query->where('user_id', Auth::id());
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('reviews', compact('orderDetails'));
    }
}
