<?php

namespace App\Http\Controllers;

use App\Models\DeliveryStatus;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DeliveryStatusController extends Controller
{
    /**
     * Update the delivery status and recipient information
     * when the status is set to delivery complete
     */
    public function updateDeliveryStatus(Request $request, $orderDetailId)
    {
        // Find the order detail
        $orderDetail = OrderDetail::findOrFail($orderDetailId);
        
        // Get the status ID from the request
        $statusId = $request->deliveryStatus_id;
        $deliveryStatus = DeliveryStatus::findOrFail($statusId);
        
        // Check if the new status is "deliverycomplete"
        if ($deliveryStatus->statusName === 'deliverycomplete') {
            // Validate recipient information is provided
            $validator = Validator::make($request->all(), [
                'nama_penerima' => 'required|string|max:255',
                'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);
            
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            
            // Handle the image upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $request->nama_penerima . '.' . $image->extension();
                $image->move(public_path('images/recipients'), $imageName);
                $imagePath = 'images/recipients/' . $imageName;
                
                // Store recipient info with the order detail
                $orderDetail->update([
                    'deliveryStatus_id' => $statusId,
                    'namapenerima' => $request->nama_penerima,
                    'image' => $imagePath
                ]);
                
                return redirect()->back()->with('success', 'Delivery confirmed with recipient information.');
            }
        } else {
            // Just update the status if not delivery complete
            $orderDetail->update([
                'deliveryStatus_id' => $statusId
            ]);
            
            return redirect()->back()->with('success', 'Delivery status updated successfully.');
        }
        
        return redirect()->back()->with('error', 'Failed to update delivery status.');
    }
    
    /**
     * Show form to update status to delivery complete with recipient info
     */
    public function showRecipientForm($orderDetailId)
    {
        $orderDetail = OrderDetail::with(['orderInOrderDetail', 'menuDayInOrderDetail.foodInMenuDay'])
            ->findOrFail($orderDetailId);
            
        // Get delivery complete status
        $deliveryCompleteStatus = DeliveryStatus::where('statusName', 'deliverycomplete')->first();
        
        if (!$deliveryCompleteStatus) {
            return redirect()->back()->with('error', 'Delivery complete status not found.');
        }
        
        return view('delivery.recipient_form', compact('orderDetail', 'deliveryCompleteStatus'));
    }
    
    /**
     * Display list of all delivery confirmations with recipient information
     */
    public function index()
    {
        $completedDeliveries = OrderDetail::with(['orderInOrderDetail', 'menuDayInOrderDetail.foodInMenuDay'])
            ->whereNotNull('namapenerima')
            ->whereNotNull('image')
            ->orderBy('updated_at', 'desc')
            ->paginate(10);
            
        return view('delivery.index', compact('completedDeliveries'));
    }
    
    /**
     * Show details of a specific delivery confirmation
     */
    public function show($orderDetailId)
    {
        $orderDetail = OrderDetail::with([
                'orderInOrderDetail', 
                'orderInOrderDetail.user',
                'menuDayInOrderDetail.foodInMenuDay'
            ])
            ->findOrFail($orderDetailId);
            
        // Check if this order detail has recipient information
        if (!$orderDetail->namapenerima || !$orderDetail->image) {
            return redirect()->route('delivery.index')
                ->with('error', 'This delivery does not have recipient information.');
        }
        
        return view('delivery.show', compact('orderDetail'));
    }
}