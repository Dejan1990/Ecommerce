<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
       return view('admin.dashboard', [
            'product' => Product::get()->count(),
            'order' => Order::get()->count(),
            'user' => User::get()->count()
        ]);
    }
}
