@extends('layouts.app')
@section('content')
<div class="container gx-0 py-3">
	<div class="row text-center">
		<div class="col-12 p-2">
			<img src=" {{asset('storage/img/smknekat-logo.png') }}" alt="" width="70px">
		</div>
	</div>
	<div class="row text-center">
		<h2>Riwayat Pembayaran</h2>
	</div>
	<div class="row d-flex justify-content-center">
		<div class="col-9 border px-5 py-3">
			<table class="table">
						<thead>
							<tr>
								<th>Petugas</th>
								<th>NISN</th>
								<th>Tanggal Bayar</th>	
								<th>SPP</th>	
								<th>Jumlah Bayar</th>	
								<th>Kode</th>
							</tr>
						</thead>
						<tbody>
							@foreach($data as $row)
							<tr>
								<td>{{$row->name}}</td>
								<td>{{$row->payer}}</td>
								<td>{{date($row->payment_date)}}</td>
								<td>{{$row->year}}</td>
								<td>Rp. {{$row->pay_amount}}</td>
								<td>{{ $row->code }}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
		</div>
	</div>
</div>
@endsection