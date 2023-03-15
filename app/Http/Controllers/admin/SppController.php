<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Spp;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;

class SppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $spp = Spp::all();
        // $spp = DB::raw('call select_spp');
        return view('admin.spp.index', compact('spp'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.spp.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $credential = $request->validate([
            'year' => 'required',
            'nominal' => 'required|integer'
        ]);

        DB::beginTransaction();
        try{
            $store = Spp::create([
                'year' => $credential['year'],
                'nominal' => $credential['nominal']
            ]);
            // $store = DB::select('CALL insert_spp (?,?,?,?)', [$credential['year'], $credential['nominal'], Carbon::now('GMT+7'),Carbon::now('GMT+7'),]);
            //     dd($store);
            DB::commit();
        }catch(Exception $e){
            DB::rollback();
            return redirect()->route('admin.spp.index')->with('fail', 'Gagal Menambahkan Data')->withErrors($e->getMessage())->withInput();
        }
        
        return redirect()->route('admin.spp.index')->with('success', 'Berhasil Menambahkan Data');
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
        $data = Spp::find($id);

        return view('admin.spp.edit', compact('data'));
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
        $credential = $request->validate([
            'year' => 'required',
            'nominal' => 'required|integer'
        ]);

        DB::beginTransaction();
        try {
        $update = Spp::where('spp_id', $id)->update([
            'year' => $credential['year'],
            'nominal' => $credential['nominal']
        ]);
        DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('admin.spp.index')->with('fail', 'Gagal mengubah data')->withErrors($e->getMessage())->withInput();
        }

        return redirect()->route('admin.spp.index')->with('success', 'Berhasil mengubah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Spp::find($id);
        
        if($data->student()->count() > 0){
            return redirect()->route('admin.spp.index')->with('fail', 'Gagal menghapus data, beberapa siswa menggunakan data tersebut');
        }else{
            Spp::destroy($id);

            return redirect()->route('admin.spp.index')->with('success', 'Berhasil Menghapus Data');
        }
    }
}
