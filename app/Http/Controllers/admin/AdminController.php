<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Spp;
use App\Models\SppPayment;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $payments = SppPayment::join('users', 'users.user_id', 'spp_payments.user_id')->join('spps', 'spps.spp_id', 'spp_payments.spp_id')->get()->sortByDesc('payment_date');
        $classes = Classes::all()->sortBy('class_name');
        $students = Student::all();
        $spps = Spp::all();
        $staff = User::where('role','staff')->get();

        return view('admin.index', compact('payments', 'students', 'classes', 'spps', 'staff'));
    }
}
