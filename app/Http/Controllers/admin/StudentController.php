<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Student;
use App\Models\Classes;
use App\Models\Spp;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Exception;
use Yajra\DataTables\Facades\DataTables;


class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // protected $model;
    // public function __construct(User $model)
    public function index(Request $filters)
    {
        // dd($request);
        $classes = Classes::all()->sortBy('class_name');
        $spps = Spp::all()->sortBy('year');
        $data = Student::filter($filters->all())->join('classes', 'students.class_id', '=', 'classes.class_id')->join('spps','students.spp_id', '=', 'spps.spp_id')->get();

        return view('admin.student.index', compact('data','classes', 'spps'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = Classes::all()->sortBy('class_name');
        $spps = Spp::all()->sortBy('year');
        return view('admin.student.create', compact('classes', 'spps'));
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
            'nisn' => 'required',
            'nis' => 'required',
            'name' => 'required',
            'class' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'spp' => 'required',

            'email' => 'required|email',
            'username' => 'required',
            'password' => 'required|confirmed',
        ]);

        DB::beginTransaction();
        try {
            $account = User::create([
                'name' => $credential['name'],
                'email' => $credential['email'],
                'username' => $credential['username'],
                'password' => Hash::make($credential['password']),
                'role' => 'siswa',
            ]);
            try {
                $store = Student::create([
                    'nisn' => $credential['nisn'],
                    'nis' => $credential['nis'],
                    'student_name' => $credential['name'],
                    'class_id' => $credential['class'],
                    'address' => $credential['address'],
                    'phone_number' => $credential['phone'],
                    'spp_id' => $credential['spp'],
                    'user_id' => $account['user_id'],
                ]);

            } catch (Exception $e) {
                DB::rollback();
                $errorCode = $e->errorInfo[1];

                if($errorCode == 1062){
                    return redirect()->route('admin.student.create')->with('fail', 'Gagal menambahkan data')->withErrors('Email atau Username telah digunakan')->withInput();
                }
                return redirect()->route('admin.student.create')->with('fail', 'Gagal menambahkan data')->withErrors($e->getMessage())->withInput();
            }

            // dd($account, $store);
            DB::commit();
            return redirect()->route('admin.student.index')->with('success', 'Berhasil menambahkan data');

        } catch (Exception $e) {
            DB::rollback();

            $errorCode = $e->errorInfo[1];
            if($errorCode == 1062){
                return redirect()->route('admin.student.create')->with('fail', 'Gagal menambahkan data')->withErrors('Email atau Username telah digunakan')->withInput();
            }

            return redirect()->route('admin.student.create')->with('fail', 'Gagal menambahkan data')->withErrors($e->getMessage())->withInput();
        }

        return redirect()->route('admin.student.index')->with('success', 'Berhasil menambahkan data.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Student::where('nisn',$id)->join('classes', 'students.class_id', '=', 'classes.class_id')->join('spps','students.spp_id', '=', 'spps.spp_id')->join('users','students.user_id', '=', 'users.user_id')->first();

        return view('admin.student.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $classes = Classes::all()->sortBy('class_name');
        $spps = Spp::all()->sortBy('year');
        $data = Student::where('nisn', $id)->join('users','students.user_id', '=', 'users.user_id')->first();

        return view('admin.student.edit', compact('data','classes', 'spps'));
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
        // dd($id);
        $credential = $request->validate([
            'nisn' => 'required',
            'nis' => 'required',
            'name' => 'required',
            'class' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'spp' => 'required',

            'email' => 'required|email',
            'username' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $account = User::where('user_id', $request->id_account)->update([
                'name' => $credential['name'],
                'email' => $credential['email'],
                'username' => $credential['username'],
                'password' => $credential['nisn'],

            ]);

            try {
                $update = Student::where('nisn', $id)->update([
                    'nisn' => $credential['nisn'],
                    'nis' => $credential['nis'],
                    'student_name' => $credential['name'],
                    'class_id' => $credential['class'],
                    'address' => $credential['address'],
                    'phone_number' => $credential['phone'],
                    'spp_id' => $credential['spp'],
                ]);
                
            } catch (Exception $e) {
                DB::rollback();

                $errorCode = $e->errorInfo[1];
                if($errorCode == 1062){
                    return redirect()->route('admin.student.edit')->with('fail', 'Gagal menambahkan data')->withErrors('Email atau Username telah digunakan')->withInput();
                }

                return redirect()->route('admin.student.edit', $id)->with('fail', 'Gagal mengubah data')->withErrors($e->getMessage())->withInput();
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            $errorCode = $e->errorInfo[1];
                if($errorCode == 1062){
                    return redirect()->route('admin.student.edit')->with('fail', 'Gagal menambahkan data')->withErrors('Email atau Username telah digunakan')->withInput();
                }
            return redirect()->route('admin.student.edit', $id)->with('fail', 'Gagal mengubah data')->withErrors($e->getMessage())->withInput();
        }


        return redirect()->route('admin.student.index')->with('success', 'Berhasil mengubah data');
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
            return redirect()->route('admin.student.index')->with('fail', 'Gagal menghapus data')->withErrors($e->getMessage());
        }
        
        return redirect()->route('admin.student.index')->with('succes', 'Berhasil menghapus data');
    }
}
