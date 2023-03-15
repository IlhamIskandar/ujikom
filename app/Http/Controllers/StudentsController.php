<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SppPayment;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->user_id;
        $data = Student::where('user_id', $id)->join('spps', 'spps.spp_id', 'students.spp_id')->first();
        $payment = SppPayment::where([['nisn', $data->nisn], ['spps.spp_id', $data->spp_id]])->join('users', 'users.user_id', '=', 'spp_payments.user_id')->join('spps', 'spps.spp_id', '=', 'spp_payments.spp_id')->get();
        $payments = SppPayment::where('nisn', $data->nisn)->join('users', 'users.user_id', '=', 'spp_payments.user_id')->join('spps', 'spps.spp_id', '=', 'spp_payments.spp_id')->get()->sortByDesc('payment_date');
        $paymentSum = $payment->sum('pay_amount');
        $sppNominal = $data->nominal;
        $remaining = $sppNominal - $paymentSum;
        // dd($paymentSum, $sppNominal, $remaining);
        return view('student.index', compact('data', 'payments', 'paymentSum', 'sppNominal', 'remaining', 'payment'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
