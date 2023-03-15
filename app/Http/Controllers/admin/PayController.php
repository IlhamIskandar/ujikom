<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SppPayment;
use App\Models\Student;
use PDF;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = SppPayment::join('users', 'users.user_id', 'spp_payments.user_id')->join('spps', 'spps.spp_id', 'spp_payments.spp_id')->get()->sortByDesc('payment_date');

        return view('admin.payment.index', compact('data'));
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
            
            if($data->count() == 0){
                session()->flash('notfound', 'Data siswa tidak ditemukan');
                $paymentSum = "-";
                $sppNominal = "-";
                $remaining = "-";
                return view('admin.payment.entry', compact('data', 'searchKey','remaining', 'paymentSum'));
            }else{
                $spp = Student::where('nisn', $searchKey)->join('spps','students.spp_id', '=', 'spps.spp_id')->first();
                $payments = SppPayment::where([['nisn', $searchKey], ['spp_id', $spp->spp_id]])->get();
                $paymentSum = $payments->sum('pay_amount');
                $sppNominal = $spp->nominal;
                $remaining = $sppNominal - $paymentSum;

                return view('admin.payment.entry', compact('data', 'searchKey', 'remaining', 'paymentSum'));
            }

        }else{
            $data = [];
            $paymentSum = "-";
            $sppNominal = "-";
            $remaining = "-";
            // dd($data);
            return view('admin.payment.entry', compact('data', 'searchKey','remaining', 'paymentSum'));
        }
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
            'information' => '',
        ]);
        $payamount = (int)$credential['pay_amount'];

        $nisn = $credential['nisn'];
        $spp = Student::select('students.spp_id', 'nominal')->where('nisn', $nisn)->join('spps', 'spps.spp_id', 'students.spp_id')->first();
        $payments = SppPayment::where([['nisn', $nisn], ['spp_id', $spp->spp_id]])->get();
        $paymentSum = $payments->sum('pay_amount');
        $sppNominal = $spp->nominal;
        $remaining = $sppNominal - $paymentSum;
        // dd($paymentSum,$sppNominal,$remaining);
        if ($payamount > $sppNominal) {

            return redirect()->route('admin.payment.create')->with('fail','Total Bayar melebihi Nominal SPP')->withInput();
        } elseif ($payamount > $remaining){
            return redirect()->route('admin.payment.create')->with('fail','Total Bayar melebihi Sisa Pembayaran')->withInput();
        }else {
            
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
                    'information' => $credential['information'],
                    'code' => Str::random(12),
                ]);
    
                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();
                return redirect()->route('admin.payment.create')->withErrors($e->getMessage())->withInput();
            }
            $id = $store->spp_payment_id;
            return redirect()->route('admin.payment.index')->with('success', 'Berhasil menyimpan data pembayaran');
            
        }


        // // dd($request);
        // DB::beginTransaction();
        // try {
        //     $store = SppPayment::create([
        //         'user_id' => $user->user_id,
        //         'nisn' => $credential['nisn'],
        //         'payer' => $credential['nisn'],
        //         'payment_date' => Carbon::now('GMT+7'),
        //         'spp_id' => $credential['spp_id'],
        //         'pay_amount' => $credential['pay_amount'],
        //         'code' => Str::random(12),
        //     ]);

        //     DB::commit();
        // } catch (Exception $e) {
        //     DB::rollBack();
        //     return redirect()->route('admin.payment.create')->withErrors($e->getMessage())->withInput();
        // }

        // return redirect()->route('admin.payment.index')->with('success', 'Berhasil menyimpan data pembayaran');
        
        
    }

    public function print(Request $request)
    {
        $from = $request->datefrom.' 00:00:00';
        $to = $request->dateto.' 23:59:59';
        $data = SppPayment::whereBetween('payment_date', [$from, $to])->join('users', 'users.user_id', 'spp_payments.user_id')->join('spps', 'spps.spp_id', 'spp_payments.spp_id')->get();
        // dd($from, $to, $data);
     
            // $pdf = PDF::loadView('admin.payment.print', ['data'=>$data]);
            // return $pdf->download('SPP-report.pdf');
        return view('admin.payment.print', compact('data', 'from', 'to'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {  
        $data = SppPayment::where('spp_payment_id', $id)->join('students', 'students.nisn', '=', 'spp_payments.nisn')->join('spps', 'spps.spp_id', '=', 'spp_payments.spp_id')->join('classes', 'students.class_id', '=', 'classes.class_id')->join('users', 'users.user_id', '=', 'spp_payments.user_id')->first();
        // dd($data);
        return view('admin.payment.show', compact('data'));
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
        DB::beginTransaction();
        try {
            $a = SppPayment::destroy($id);
            
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('admin.payment.index')->with('fail', 'Gagal menghapus data')->withErrors($e->getMessage());
        }

        return redirect()->route('admin.payment.index')->with('success', 'Berhasil menghapus data');
    }
}
