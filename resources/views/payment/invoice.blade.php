@extends('layouts.app')
@section('content')
<div class="container gx-0 py-3">
	<div class="row text-center">
		<div class="col-12 p-2">
			<img src=" {{asset('storage/img/smknekat-logo.png') }}" alt="" width="70px">
		</div>
	</div>
	<div class="row d-flex  justify-content-center">
	    <div class="col-8 border px-5 py-3">
	        <div class="row">
	        	<div class="col d-flex justify-content-center">
	        		<h2>Data Pembayaran</h2>
	        	</div>
	        </div>
	        <div class="row my-3">
	        	<div class="col">
			        <div class="card border">
			        	<div class="card-body">
			        		<div class="row">
			        			<div class="col-3">
			        				Nama Siswa
			        			</div>
			        			<div class="col">
			        				{{$data->student_name}}
			        			</div>
			        		</div>
			        		<div class="row">
			        			<div class="col-3">
			        				NISN
			        			</div>
			        			<div class="col">
			        				{{$data->nisn}}
			        			</div>
			        		</div>
			        		<div class="row">
			        			<div class="col-3">
			        				NIS
			        			</div>
			        			<div class="col">
			        				{{$data->nis}}
			        			</div>
			        		</div>
			        		<div class="row">
			        			<div class="col-3">
			        				Kelas
			        			</div>
			        			<div class="col">
			        				{{$data->class_name}}
			        			</div>
			        		</div>
			        		<div class="row">
			        			<div class="col-3">
			        				Jurusan
			        			</div>
			        			<div class="col">
			        				{{$data->competency}}
			        			</div>
			        		</div>
			        	</div>
			        </div>
	        	</div>
	        </div>
	        <div class="row my-3">
	        	<div class="col">	
			        <div class="card border alert-warning">
			        	<div class="card-body">
			        		<div class="row">
			        			<div class="col-3">
			        				Tahun SPP
			        			</div>
			        			<div class="col">
			        				{{$data->year}}
			        			</div>
			        		</div>
			        		<div class="row">
			        			<div class="col-3">
			        				Nominal
			        			</div>
			        			<div class="col">
			        				{{'Rp. '.$data->nominal}}
			        			</div>
			        		</div>
			        		<div class="row">
			        			<div class="col-3">
			        				Petugas
			        			</div>
			        			<div class="col">
			        				{{$data->name}}
			        			</div>
			        		</div>
			        		<div class="row">
			        			<div class="col-3">
			        				Tanggal Bayar
			        			</div>
			        			<div class="col">
			        				{{date_format(date_create($data->payment_date),'d M Y H:i:s')}}
			        			</div>
			        		</div>
			        	</div>
			        </div>
	        	</div>
	        </div>
	        <div class="row my-3">
	        	<div class="col">	
			        <div class="card border alert-success">
			        	<div class="card-body">
			        		<div class="row">
			        			<div class="col d-flex justify-content-between align-items-center">
			        				<h3>Jumlah Bayar</h3>
			        				<h2>{{'Rp. '.$data->pay_amount}}</h2>
			        			</div>
			        		</div>
			        	</div>
			        </div>
	        	</div>
	        </div>
	        <div class="row">
	        	<a href="{{route('payment.history')}}" class="text-success">Kembali</a>
	        </div>
	    </div>
	</div>
</div>
@endsection