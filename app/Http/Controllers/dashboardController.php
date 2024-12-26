<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class dashboardController extends Controller
{
    public function admindashboard()
    {
        $productsCount = DB::table('products')->count();
        $usersCount = DB::table('user_registers')->count();
        $ordersCount = DB::table('orders')->count();

        return view('admin.dashboard', [
            'productsCount' => $productsCount,
            'usersCount' => $usersCount,
            'ordersCount' => $ordersCount,
        ]);
    }
    public function managerdashboard()
    {
        $productsCount = DB::table('products')->count();

        return view('manager.dashboard', [
            'productsCount' => $productsCount
        ]);
    }
    public function adviserdashboard()
    {
        $productsCount = DB::table('products')->count();

        return view('adviser.dashboard', [
            'productsCount' => $productsCount
        ]);
    }
}
