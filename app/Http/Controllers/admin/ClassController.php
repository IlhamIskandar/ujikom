<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classes;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Exception;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Classes::all()->sortBy('class_name');

        return view('admin.class.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.class.create');
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
            'classname' => 'required',
            'competency' => 'required'
        ]);

        DB::beginTransaction();
        try {
            // $store = Classes::create([
            //     'class_name' => $credential['classname'],
            //     'competency' => $credential['competency']
            // ]);
            $class = new Classes;
            $class->class_name = (string)$credential['classname'];
            $class->competency = (string)$credential['competency'];
            $class->created_at = Carbon::now('GMT+7');

            $store = DB::select('CALL insert_class(?,?,?,?)', [$class->class_name, $class->competency, Carbon::now('GMT+7'), Carbon::now('GMT+7')]);
            // dd($store);

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('admin.class.create')->with('fail', 'Gagal menambahkan data')->withErrors($e->getMessage())->withInput();

        }


        return redirect()->route('admin.class.index')->with('success', 'Berhasil menambahkan data');
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
        $data = Classes::find($id);

        return view('admin.class.edit', compact('data'));
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
            'classname' => 'required',
            'competency' => 'required'
        ]);

        DB::beginTransaction();
        try {
        $update = Classes::where('class_id', $id)->update([
            'class_name' => $credential['classname'],
            'competency' => $credential['competency']
        ]);
            
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('admin.class.create')->with('fail', 'Gagal mengubah data')->withErrors($e->getMessage())->withInput();

        }

        return redirect()->route('admin.class.index')->with('success', 'Berhasil mengubah data');    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Classes::find($id);
        
        if($data->student()->count() > 0){
            return redirect()->route('admin.class.index')->with('fail', 'Gagal menghapus data, beberapa siswa menggunakan data tersebut');
        }else{
            Classes::destroy($id);

            return redirect()->route('admin.spp.index')->with('success', 'Berhasil menghapus data');
        }
    }
}
