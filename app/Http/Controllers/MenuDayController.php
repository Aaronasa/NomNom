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

        // Create a new order
        $order = new Order();
        $order->user_id = Auth::id(); 
        $order->orderDate = now(); 
        $order->totalPrice = $totalPrice; 
        $order->paymentStatus = '0'; 
        $order->save();

        foreach ($cart as $item) {
            $order->orderDetailInOrder()->create([
                'menuDay_id' => $item['menuDayId'], 
                'price' => $item['foodPrice'],
                'unit' => $item['quantity'], 
                'deliveryStatus_id' => 1, 
            ]);
        }

        session()->forget('cart'); 

        return redirect()->route('order.history')->with('success', 'Order placed successfully.');
    }

    public function removeCart(Request $request){
        $menuDayId = $request->input('menuDayId');
        $cart = session()->get('cart', []) ;

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
}
