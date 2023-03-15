@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
	<h4>Pembayaran SPP</h4>
	<div class="row">
		<div class="col">
			<div class="card">
				@if(session('success'))
				<div class="alert alert-success">
				{{ session('success')}}
				</div>
				@endif
				@if ($errors->any())
				<div class="alert alert-danger">
					<ul>
					@if(session('fail'))
						<li>
							{{ session('fail')}}
						</li>
						@endif
						@foreach ($errors->all() as $error)
					        <li>{{ $error }}</li>
				        @endforeach
				    </ul>
				</div>
				@endif
				<div class="card-body">
					<div class="d-flex justify-content-between mb-3 align-items-center">
						<a href="{{route('admin.payment.create')}}" class="btn btn-success btn-sm"><i class="fas fa-plus fa-fw me-3"></i>lakukan pembayaran</a>
							<form action="{{route('admin.payment.print')}}" method="get">
								<div class="d-flex align-items-center">
									<input type="date" name="datefrom" id="datefrom" class="form-control me-2" required>
									<span>-</span>
									<input type="date" name="dateto" id="dateto" class="form-control mx-2" required>
									<button type="submit" class="btn btn-primary">Print</button>
								</div>
							</form>
							{{-- <a href="{{route('admin.payment.print')}}" class="btn btn-primary btn-sm"><i class="fas fa-file fa-fw me-3" ></i>Print</a> --}}
					</div>
					<hr>
					<table class="table" id="datatables">
						<thead>
							<tr>
								<th>Petugas</th>
								<th>NISN</th>
								<th>Tanggal Bayar</th>	
								<th>SPP</th>	
								<th>Jumlah Bayar</th>
								<th>Keterangan</th>		
								<th>Kode</th>
								<th>Aksi</th>		
							</tr>
						</thead>
						<tbody>
							@foreach($data as $row)
							<tr>
								<td>{{$row->name}}</td>
								<td>{{$row->payer}}</td>
								<td>{{date_format(date_create($row->payment_date),'d M Y H:i:s')}}</td>
								<td>{{$row->year.'(Rp. '.$row->nominal.')'}}</td>
								<td>Rp. {{$row->pay_amount}}</td>
								<td class="text-truncate" style="max-width: 130px">@if($row->information != null)
			        				{{$row->information}}
			        				@else
			        				-
			        				@endif
			        			</td>
								<td>{{ $row->code }}</td>
								<td>
									<form action="{{route('admin.payment.destroy', $row->spp_payment_id)}}" method="post">
										@csrf
										@method('DELETE')
										<a href="{{route('admin.payment.show', $row->spp_payment_id)}}" class="btn btn-info btn-sm" data-mdb-toggle="tooltip" title="Detail Data" data-placement="top"><i class="fas fa-file fa-fw"></i></a>   

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
@push('scripts')
<script type="text/javascript">
$('#datatables').DataTable( {
    paging: false,
} );
</script>
@endpush