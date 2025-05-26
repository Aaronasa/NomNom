<?php

namespace App\Http\Controllers;

use App\Models\MenuDay;
use App\Models\Order;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // Make sure to import DB facade

class MenuDayController extends Controller
{
    public function ViewMenuDay()
    {
        $MenuDays = MenuDay::with('foodInMenuDay')->paginate(12);
        
        $reviews = Review::with([
            'user',
            'orderDetail.menuDayInOrderDetail.foodInMenuDay'
        ])
        ->whereNotNull('comment') 
        ->where('comment', '!=', '') 
        ->orderBy('created_at', 'desc')
        ->limit(10) 
        ->get();

        return view('home', [
            'MenuDays' => $MenuDays,
            'reviews' => $reviews
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

        $menuDayRatings = [];
        foreach ($MenuDays as $menuDay) {
            $averageRating = DB::table('reviews')
                ->join('order_details', 'reviews.order_detail_id', '=', 'order_details.id')
                ->where('order_details.menuDay_id', $menuDay->id)
                ->avg('reviews.rating');
            
            $reviewCount = DB::table('reviews')
                ->join('order_details', 'reviews.order_detail_id', '=', 'order_details.id')
                ->where('order_details.menuDay_id', $menuDay->id)
                ->count();
            
            $menuDayRatings[$menuDay->id] = [
                'average' => $averageRating ? round($averageRating, 1) : 0,
                'count' => $reviewCount
            ];
        }

        return view('order', [
            'MenuDays' => $MenuDays,
            'menuDayRatings' => $menuDayRatings
        ]);
    }

    public function foodDetail($id)
    {
        $menuDay = MenuDay::with('foodInMenuDay', 'foodInMenuDay.restaurantInFood')
            ->findOrFail($id);

        // Calculate average rating and review count for this specific menuDay
        $averageRatingDb = DB::table('reviews')
            ->join('order_details', 'reviews.order_detail_id', '=', 'order_details.id')
            ->where('order_details.menuDay_id', $menuDay->id)
            ->avg('reviews.rating');

        $reviewCountDb = DB::table('reviews')
            ->join('order_details', 'reviews.order_detail_id', '=', 'order_details.id')
            ->where('order_details.menuDay_id', $menuDay->id)
            ->count();

        $averageRating = $averageRatingDb ? round($averageRatingDb, 1) : 0;
        $reviewCount = $reviewCountDb;

        return view('foodDetail', [
            'menuDay' => $menuDay,
            'averageRating' => $averageRating, // Pass averageRating to the view
            'reviewCount' => $reviewCount,   // Pass reviewCount to the view
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

        session()->put('payment_data', [
            'cart' => $cart,
            'totalPrice' => $totalPrice
        ]);

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
        
        $updated = false;
        foreach ($cart as $index => $item) {
            if ($item['menuDayId'] == $menuDayId) {
                $cart[$index]['quantity'] = $quantity;
                $updated = true;
                $itemTotal = intval($cart[$index]['foodPrice'] * $quantity);
                break;
            }
        }
        
        if (!$updated) {
            return response()->json(['success' => false, 'message' => 'Item not found in cart'], 404);
        }
        
        session()->put('cart', $cart);
        
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

        $deliveryFee = 10000;
        $adminFee = 2000;
        $grandTotal = intval($totalPrice + $deliveryFee + $adminFee);

        $order = new Order();
        $order->user_id = Auth::id();
        $order->orderDate = now();
        $order->totalPrice = $grandTotal;
        $order->paymentStatus = 'Unpaid';
        $order->save();

        session()->put('payment_data.order_id', $order->id);

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

    public function paymentfinish(Request $request)
    {
        $paymentData = session()->get('payment_data', []);
        $orderId = $paymentData['order_id'] ?? null;
        
        if (!$orderId) {
            return redirect()->route('cart')->with('error', 'No order found.');
        }
        
        $order = Order::findOrFail($orderId);
        $order->paymentStatus = 'Paid';
        $order->save();
        
        session()->forget(['cart', 'payment_data']);
        
        return redirect()->route('order.history')->with('success', 'Payment completed successfully.');
    }

    public function paymentCallback(Request $request)
    {
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        
        try {
            $notification = new \Midtrans\Notification();
            
            $transaction = $notification->transaction_status;
            $fraud = $notification->fraud_status;
            $order_id = $notification->order_id;
            
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