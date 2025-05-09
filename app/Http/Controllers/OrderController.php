<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function orders() {
        $user = auth()->user();
    
        // Eager load order details so each order includes its order_id from OrderDetail
        $orders = Order::with('details') // assumes you defined a 'details' relationship
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(10);
    
        return inertia('Customer/Orders', [
            'orders' => $orders,
        ]);
    }
    
    
}