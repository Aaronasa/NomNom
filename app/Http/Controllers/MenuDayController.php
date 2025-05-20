<?php

namespace App\Http\Controllers;

use App\Models\MenuDay;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuDayController extends Controller
{
    public function ViewMenuDay()
    {
        $MenuDays = MenuDay::with('foodInMenuDay')->paginate(12);
        return view('home', [
            'MenuDays' => $MenuDays
        ]);
    }


    public function ViewMenuDayForAdmin()
    {
        $MenuDays = MenuDay::with('foodInMenuDay')->get();
        return view('admin', [
            'MenuDays' => $MenuDays
        ]);
    }

    public function ViewOrder(Request $request)
    {
        $date = $request->input('date', now()->format('Y-m-d'));

        $MenuDays = MenuDay::with(['foodInMenuDay.restaurantInFood'])
            ->whereDate('foodDate', $date)
            ->get();

        return view('order', [
            'MenuDays' => $MenuDays,
        ]);
    }

    public function foodDetail($id)
    {
        $menuDay = MenuDay::with('foodInMenuDay', 'foodInMenuDay.restaurantInFood')
            ->findOrFail($id);
        return view('foodDetail', [
            'menuDay' => $menuDay,
        ]);
    }


    public function addToCart(Request $request)
    {
        $food = $request->input('food');

        if (is_string($food)) {
            $food = json_decode($food, true);
        }

        $cart = session()->get('cart', []);

        $check = false;
        foreach ($cart as $index => $item) {
            if ($item['menuDayId'] == $food['menuDayId']) {
                $cart[$index]['quantity'] += 1;
                $check = true;
                break;
            }
        }

        if (!$check) {
            // Add food item to the cart
            $cart[] = [
                'menuDayId' => $food['menuDayId'],
                'foodName' => $food['foodName'],
                'foodPrice' => $food['foodPrice'],
                'foodImage' => $food['foodImage'],
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Food added to cart successfully.');
    }

    public function showCart()
    {
        $cart = session()->get('cart', []);

        $totalPrice = array_reduce($cart, function ($total, $item) {
            return $total + ($item['foodPrice'] * $item['quantity']);
        }, 0);

        return view('cart', [
            'cart' => $cart,
            'totalPrice' => $totalPrice,
        ]);
    }

    public function cartfinish()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Cart is empty.');
        }

        $totalPrice = array_reduce($cart, function ($total, $item) {
            return $total + $item['foodPrice'] * $item['quantity'];
        }, 0);

        // Store cart data in session for payment page
        session()->put('payment_data', [
            'cart' => $cart,
            'totalPrice' => $totalPrice
        ]);

        // Redirect to payment page instead of creating order immediately
        return redirect()->route('payment')->with('success', 'Proceed to payment.');
    }

    public function removeCart(Request $request)
    {
        $menuDayId = $request->input('menuDayId');
        $cart = session()->get('cart', []);

        $cart = array_map(function ($item) use ($menuDayId) {
            if ($item['menuDayId'] == $menuDayId) {
                $item['quantity']--;
            }
            return $item;
        }, $cart);

        $cart = array_filter($cart, function ($item) {
            return $item['quantity'] > 0;
        });

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Item removed from cart successfully.');
    }

public function update(Request $request)
{
    $cart = session()->get('cart', []);
    $menuDayId = $request->input('menuDayId');
    $quantity = (int)$request->input('quantity');
    
    // Find the item in the cart array
    $updated = false;
    foreach ($cart as $index => $item) {
        if ($item['menuDayId'] == $menuDayId) {
            // Update quantity
            $cart[$index]['quantity'] = $quantity;
            $updated = true;
            
            // Calculate item total - ensure it's an integer
            $itemTotal = intval($cart[$index]['foodPrice'] * $quantity);
            break;
        }
    }
    
    if (!$updated) {
        return response()->json(['success' => false, 'message' => 'Item not found in cart'], 404);
    }
    
    // Save updated cart
    session()->put('cart', $cart);
    
    // Calculate new subtotal - ensure it's an integer
    $subtotal = intval(array_reduce($cart, function ($total, $item) {
        return $total + ($item['foodPrice'] * $item['quantity']);
    }, 0));
    
    return response()->json([
        'success' => true,
        'itemTotal' => $itemTotal,
        'subtotal' => $subtotal
    ]);
}

    public function showPayment()
    {
        $paymentData = session()->get('payment_data', []);
        $cart = $paymentData['cart'] ?? [];
        $totalPrice = $paymentData['totalPrice'] ?? 0;

        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Cart is empty.');
        }

        // Calculate additional fees (replace with your actual logic)
        $deliveryFee = 10000; // Example delivery fee
        $adminFee = 2000;    // Example admin fee
        $grandTotal = intval($totalPrice + $deliveryFee + $adminFee);
        // dd($grandTotal);
        // Create the order first to get an order ID
        $order = new Order();
        $order->user_id = Auth::id();
        $order->orderDate = now();
        $order->totalPrice = $grandTotal;
        $order->paymentStatus = 'Unpaid';
        $order->save();

        // Store the order ID in session
        session()->put('payment_data.order_id', $order->id);

        // Add order items
        foreach ($cart as $item) {
            $order->orderDetailInOrder()->create([
                'menuDay_id' => $item['menuDayId'],
                'price' => $item['foodPrice'],
                'unit' => $item['quantity'],
                'deliveryStatus_id' => 1,
            ]);
        }

        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production', false);
        \Midtrans\Config::$isSanitized = config('midtrans.is_sanitized', true);
        \Midtrans\Config::$is3ds = config('midtrans.is_3ds', true);

        // Prepare Midtrans parameters
        $params = [
            'transaction_details' => [
                'order_id' => 'ORDER-' . $order->id,
                'gross_amount' => $grandTotal,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'phone' => Auth::user()->phone ?? '',
            ],
            'item_details' => array_map(function ($item) {
                return [
                    'id' => $item['menuDayId'],
                    'price' => (int) round($item['foodPrice']),
                    'quantity' => $item['quantity'],
                    'name' => $item['foodName'],
                ];
            }, $cart)
        ];
        
        // Add delivery and admin fees to item details
        $params['item_details'][] = [
            'id' => 'DELIVERY',
            'price' => $deliveryFee,
            'quantity' => 1,
            'name' => 'Delivery Fee',
        ];
        
        $params['item_details'][] = [
            'id' => 'ADMIN',
            'price' => $adminFee,
            'quantity' => 1,
            'name' => 'Admin Fee',
        ];

        // Get Snap token
        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return view('payment', [
            'cart' => $cart,
            'totalPrice' => $totalPrice,
            'deliveryFee' => $deliveryFee,
            'adminFee' => $adminFee,
            'grandTotal' => $grandTotal,
            'snapToken' => $snapToken,
            'order_id' => $order->id
        ]);
    }

    // Update paymentfinish method to use the order ID from session
    public function paymentfinish(Request $request)
    {
        $paymentData = session()->get('payment_data', []);
        $orderId = $paymentData['order_id'] ?? null;
        
        if (!$orderId) {
            return redirect()->route('cart')->with('error', 'No order found.');
        }
        
        // Find the order
        $order = Order::findOrFail($orderId);
        
        // Update payment status based on type of completion
        // In real implementation, you should check the actual payment status from Midtrans
        $order->paymentStatus = 'Paid';
        $order->save();
        
        // Clear cart and payment data from session
        session()->forget(['cart', 'payment_data']);
        
        return redirect()->route('order.history')->with('success', 'Payment completed successfully.');
    }

    // Add a callback handler for Midtrans notifications
    public function paymentCallback(Request $request)
    {
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        
        try {
            $notification = new \Midtrans\Notification();
            
            $transaction = $notification->transaction_status;
            $fraud = $notification->fraud_status;
            $order_id = $notification->order_id;
            
            // Extract order ID from 'ORDER-123' format
            $order_id = str_replace('ORDER-', '', $order_id);
            
            $order = Order::findOrFail($order_id);
            
            if ($transaction == 'capture') {
                if ($fraud == 'challenge') {
                    $order->paymentStatus = 'Pending';
                } else {
                    $order->paymentStatus = 'Paid';
                }
            } else if ($transaction == 'settlement') {
                $order->paymentStatus = 'Paid';
            } else if ($transaction == 'pending') {
                $order->paymentStatus = 'Pending';
            } else if ($transaction == 'deny') {
                $order->paymentStatus = 'Denied';
            } else if ($transaction == 'expire') {
                $order->paymentStatus = 'Expired';
            } else if ($transaction == 'cancel') {
                $order->paymentStatus = 'Canceled';
            }
            
            $order->save();
            
            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}