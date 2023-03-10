@extends('admin.layouts.app')
@section('content')
<div class="container">
	<h4>Pembayaran SPP</h4>
	<div class="row">
		<div class="col">
			<div class="card">
				@if(session('success'))
				<div class="alert alert-success">
				{{ session('success')}}
				</div>
				@endif
				@if(session('fail'))
				<div class="alert alert-danger">
				{{ session('fail')}}
				</div>
				@endif
				<div class="card-body">
					<a href="{{route('admin.payment.create')}}" class="btn btn-success btn-sm"><i class="fas fa-plus fa-fw me-3"></i>lakukan pembayaran</a>
					<table class="table">
						<thead>
							<tr>
								<th>Petugas</th>
								<th>NISN</th>
								<th>Nama Siswa</th>	
								<th>Tanggal Bayar</th>	
								<th>SPP</th>	
								<th>Jumlah Bayar</th>	

								<th>Aksi</th>		
							</tr>
						</thead>
						<tbody>
							@foreach($data as $row)
							<tr>
								<td>{{$row->name}}</td>
								<td>{{$row->nisn}}</td>
								<td>{{$row->student_name}}</td>
								<td>{{$row->payment_date}}</td>
								<td>{{$row->year}}</td>
								<td>Rp. {{$row->pay_amount}}</td>
								<td>
									<form action="{{route('admin.payment.destroy', $row->spp_payment_id)}}" method="post">
										@csrf
										@method('DELETE')
										<a href="{{route('admin.payment.edit', $row->spp_payment_id)}}" class="btn btn-warning btn-sm" data-mdb-toggle="tooltip" title="Ubah Data" data-placement="top"><i class="fas fa-pencil fa-fw"></i></a>
										<button class="btn btn-danger btn-sm" data-mdb-toggle="tooltip" title="Hapus Data" data-placement="top" onclick="return confirm('Hapus Data?');"><i class="fas fa-trash-can fa-fw"></i></button>
									</form>
								</td>
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