@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row my-3">
        <div class="col card">
            <div class="card-header">
                <h3>{{ $data->student_name }}</h3>
            </div>
            <div class="row alert-secondary p-3 rounded">
                <div class="col-6">
                    <h4>Data Siswa</h4>
                    <div class="mb-3">
                        <label for="nisn">NISN</label>
                        <input class="form-control alert-secondary" type="text" name="nisn" id="nisn" placeholder="NISN Siswa" disabled value="{{ $data->nisn }}">
                    </div>
                    <div class="mb-3">
                        <label for="nis">NIS</label>
                        <input class="form-control" type="text" name="nis" id="nis" placeholder="NIS Siswa"  disabled value="{{ $data->nis }}">
                    </div>
                    <div class="mb-3">
                        <label for="name">Nama Siswa</label>
                        <input class="form-control" type="text" name="name" id="name" placeholder="Nama Siswa"  disabled value="{{ $data->student_name }}">
                    </div>
                    <div class="mb-3">
                        <label for="kelas">Kelas</label>
                        <input class="form-control" type="text" name="kelas" id="kelas" placeholder="Kelas"  disabled value="{{ $data->class_name }}">
                    </div>
                    <div class="mb-3">
                        <label for="jurusan">Jurusan</label>
                        <input class="form-control" type="text" name="jurusan" id="jurusan" placeholder="Jurusan"  disabled value="{{ $data->competency }}">
                    </div>
                </div>
                <div class="col-6">
                    <h4>Data SPP</h4>
                    <label for="year">Tahun SPP</label>
                    <div class="mb-3">
                        <input class="form-control" type="text" name="year" id="year" placeholder="Tahun SPP"  disabled value="{{ $data->year }}">
                    </div>
                    <div class="mb-3">
                        <label for="nominal">Nominal SPP</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">Rp.</span>
                            <input class="form-control" type="text" name="nominal" id="nominal" placeholder="Nominal SPP"  disabled value="{{ $data->nominal }}">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="nominal">Telah Dibayar</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">Rp.</span>
                            <input class="form-control" type="text" name="nominal" id="nominal" placeholder="Nominal SPP"  disabled value="{{ $paymentSum }}">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="nominal">Sisa Pembayaran</label>
                        @if ($remaining <= 0)
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">Rp.</span>
                            <input class="form-control" type="text" name="nominal" id="nominal" placeholder="Nominal SPP"  disabled value="Sudah Lunas">
                        </div>
                        @else
                        
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">Rp.</span>
                            <input class="form-control" type="text" name="nominal" id="nominal" placeholder="Nominal SPP"  disabled value="{{ $remaining }}">
                        </div>
                        @endif
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row my-4">
        <div class="col">
            <h2>Riwayat Pembayaran</h2>
        </div>
    </div>
    @forelse ($payments as $p)
    <div class="row my-3">
        <div class="col card px-0 border">
            <div class="card-header d-flex justify-content-between align-item-center">
                <h5>{{date_format(date_create($p->payment_date),'d M Y H:i:s')}}</h5>
                <div class="row">
                    <span>Kode Pembayaran : {{ $p->code }}</span>
                </div>
            </div>
            <div class="card-body py-2">
                <div class="row mb-1">
                    <div class="col-2 ">
                        Petugas 
                    </div>
                    <div class="col-4">
                        {{ $p->name }}
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-2 ">
                        Tahun SPP 
                    </div>
                    <div class="col-4">
                        {{ $p->year.' (Rp. '.$p->nominal.')' }}
                    </div>
                </div>
            </div>
            <div class="card-footer alert-success d-flex justify-content-between align-item-center">
                <h4>Jumlah Bayar</h4>
                    <h4>Rp. {{ $p->pay_amount }}</h4>
            </div>
        </div>
    </div>
    @empty
    <div class="row">
        <div class="col">
            <center class="w-bold">Tidak ada data pembayaran</center>
        </div>
    </div>
    @endforelse
</div>
@endsection