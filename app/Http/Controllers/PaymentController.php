<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SppPayment;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = SppPayment::join('users', 'users.user_id', 'spp_payments.user_id')->join('spps', 'spps.spp_id', 'spp_payments.spp_id')->get()->sortByDesc('payment_date');
        // dd($data);
        return view('payment.history', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $searchKey = $request->input('searchKey');
        $staff = Auth::user();

        if($searchKey != null){
            $data = Student::where('nisn', $searchKey)->join('classes', 'students.class_id', '=', 'classes.class_id')->join('spps','students.spp_id', '=', 'spps.spp_id')->get();
            // dd($data);

            if($data->count() == 0){
                session()->flash('notfound', 'Data siswa tidak ditemukan');
                return view('payment.entry', compact('data', 'searchKey'));
            }else{
                return view('payment.entry', compact('data', 'searchKey'));
            }

        }else{
            $data = [];
            // dd($data);
            return view('payment.entry', compact('data', 'searchKey'));
        }
        
        // dd($staff);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $credential = $request->validate([
            'nisn' => 'required',
            'spp_id' => 'required',
            'pay_amount' => 'required',
        ]);

        // dd($request);
        DB::beginTransaction();
        try {
            $store = SppPayment::create([
                'user_id' => $user->user_id,
                'nisn' => $credential['nisn'],
                'payer' => $credential['nisn'],
                'payment_date' => Carbon::now('GMT+7'),
                'spp_id' => $credential['spp_id'],
                'pay_amount' => $credential['pay_amount'],
                'code' => Str::random(12),
            ]);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('payment.create')->withErrors($e->getMessage())->withInput();
        }

        return redirect()->route('payment.create')->with('success', 'Berhasil menyimpan data pembayaran');
        
        
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
