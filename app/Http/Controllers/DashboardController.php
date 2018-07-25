<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Models\Booking;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Doctor;
use App\Models\Laboratory;
use App\Models\Order;
use App\Models\Product;
use App\Models\Radiology;
use App\Models\University;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $users = User::where('role', 2)->count();
        $categories = Category::count();
        $products = Product::where('approve', 1)->count();
        $new_products = Product::where('approve', 0)->count();
        $contacts = Contact::whereDate('created_at', DB::raw('CURDATE()'))
            ->count();
        $admins = User::where('role',1)->count();
        return view('olx.dashboard', compact(
            'users', 'categories', 'products', 'new_products', 'contacts', 'admins'
        ));
    }
}
