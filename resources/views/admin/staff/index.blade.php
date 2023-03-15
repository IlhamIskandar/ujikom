@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
	<h4>Staff</h4>
	<div class="row">
		<div class="col">
			<div class="card">
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
				@if(session('success'))
				<div class="alert alert-success">
				{{ session('success')}}
				</div>
				@endif
				<div class="card-body">
					<a href="{{route('admin.staff.create')}}" class="btn btn-success btn-sm"><i class="fas fa-plus fa-fw me-3"></i>tambah</a>
					<hr>
					<table class="table" id="datatables">
						<thead>
							<tr>
								<th>Nama</th>
								<th>Username</th>	
								<th>Email</th>	
								<th>Aksi</th>		
							</tr>
						</thead>
						<tbody>
							@foreach($data as $row)
							<tr>
								<td>{{$row->name}}</td>
								<td>{{$row->username}}</td>
								<td>{{$row->email}}</td>
								<td>
									<form action="{{route('admin.staff.destroy', $row->user_id)}}" method="post">
										@csrf
										@method('DELETE')
										<a href="{{route('admin.staff.edit', $row->user_id)}}" class="btn btn-warning btn-sm" data-mdb-toggle="tooltip" title="Ubah Data" data-placement="top"><i class="fas fa-pencil fa-fw"></i></a>
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