@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <h4>Dashboard</h4>
    <div class="row mb-3">
        <div class="col-3">
            <div class="card">
                <div class="card-body d-flex justify-content-start py-2">
                    <div class="row align-items-center">
                        <div class="col">
                            <i class="fas fa-user-graduate fa-2x bg-primary text-white p-3 rounded"></i>
                        </div>
                        <div class="col">
                            <p>Siswa</p>
                            <h4>{{ $students->count() }}</h4>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card">
                <div class="card-body d-flex justify-content-start py-2">
                    <div class="row align-items-center">
                        <div class="col">
                            <i class="fas fa-chalkboard fa-2x bg-primary text-white p-3 rounded"></i>
                        </div>
                        <div class="col">
                            <p>Kelas</p>
                            <h4>{{ $classes->count() }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card">
                <div class="card-body d-flex justify-content-start py-2">
                    <div class="row align-items-center">
                        <div class="col">
                            <i class="fas fa-calendar-days fa-2x bg-primary text-white p-3 rounded"></i>
                        </div>
                        <div class="col">
                            <p>SPP</p>
                            <h4>{{ $spps->count() }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card">
                <div class="card-body d-flex justify-content-start py-2">
                    <div class="row align-items-center">
                        <div class="col">
                            <i class="fas fa-user-tie fa-2x bg-primary text-white p-3 rounded"></i>
                        </div>
                        <div class="col">
                            <p>Staff</p>
                            <h4>{{ $staff->count() }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4>Pembayaran Terbaru</h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Petugas</th>
                                <th>NISN</th>
                                <th>Tanggal Bayar</th>	
                                <th>Jumlah Bayar</th>
                                <th>Tahun SPP</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($payments as $row)
                            <tr>
                                <td>{{$row->name}}</td>
                                <td>{{$row->payer}}</td>
                                <td>{{date_format(date_create($row->payment_date),'d M Y h:i:s')}}</td>
                                <td>Rp. {{$row->pay_amount}}</td>
                                <td>{{$row->year.' (Rp. '.$row->nominal.')'}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection