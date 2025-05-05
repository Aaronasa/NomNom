<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    public function index()
    {
        // Ambil data order details yang sudah dibayar (paymentStatus = 1)
        $paidOrderDetails = OrderDetail::with(['orderInOrderDetail.user', 'deliveryStatusInOrderDetail'])
            ->whereHas('orderInOrderDetail', function($query) {
                $query->where('paymentStatus', 1);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        // Ambil data order details yang belum dibayar (paymentStatus = 0)
        $unpaidOrderDetails = OrderDetail::with(['orderInOrderDetail.user', 'deliveryStatusInOrderDetail'])
            ->whereHas('orderInOrderDetail', function($query) {
                $query->where('paymentStatus', 0);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.order-details.index', compact('paidOrderDetails', 'unpaidOrderDetails'));
    }

    // Method lainnya (edit, update, delete, dll)...
}