<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Exception;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::where('role','staff')->get();
        return view('admin.staff.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.staff.create');
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
            'name' => 'required',
            'email' => 'required|email',
            'username' => 'required',
            'password' => 'required|confirmed',
        ]);
        // dd($credential);
        DB::beginTransaction();
        try {
            $store = User::create([
                'username' => $credential['username'],
                'password' => Hash::make($credential['password']),
                'name' => $credential['name'],
                'role' => 'staff',
                'email' => $credential['email'],
            ]);
            
            DB::commit();

        } catch (Exception $e) {
            DB::rollback();
            // dd($e);
            $errorCode = $e->errorInfo[1];

            if($errorCode == 1062){
                return redirect()->route('admin.staff.create')->with('fail', 'Gagal menambahkan data')->withErrors('Email atau Username telah digunakan')->withInput();
            }
            return redirect()->route('admin.staff.create')->with('fail', 'Gagal menambahkan data')->withErrors($e->getMessage());
        }

        return redirect()->route('admin.staff.index')->with('success', 'Berhasil menambahkan data');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    	$data = User::where('user_id',$id)->first();
        // dd($data);
        return view('admin.staff.edit', compact('data'));
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
            'name' => 'required',
            'email' => 'required|email',
            'username' => 'required',
        ]);


        DB::beginTransaction();
        try {

            $update = User::where('user_id', $id)->update([
                'username' => $credential['username'],
                'name' => $credential['name'],
                'email' => $credential['email'],
            ]);
            
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();

            $errorCode = $e->errorInfo[1];
            if($errorCode == 1062){
                return redirect()->route('admin.staff.create')->with('fail', 'Gagal mengubah data')->withErrors('Email atau Username telah digunakan')->withInput();
            }
            return redirect()->route('admin.staff.create')->with('fail', 'Gagal mengubah data')->withErrors($e->getMessage());
        }

        return redirect()->route('admin.staff.index')->with('success', 'Berhasil mengubah data');
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
            $a = User::destroy($id);
            
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('admin.staff.index')->with('fail', 'Gagal menghapus data')->withErrors($e->getMessage());
        }

        return redirect()->route('admin.staff.index')->with('success', 'Berhasil menghapus data');
    }
}
