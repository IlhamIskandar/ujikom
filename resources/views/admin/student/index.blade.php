@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
	<h4>Siswa</h4>
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
					<div class="align-items-center">
						<a href="{{route('admin.student.create')}}" class="btn btn-success btn-sm"><i class="fas fa-plus fa-fw me-3"></i>tambah</a>
					</div>
					<hr>
					<table class="table" id="datatables">
						<thead>
							<tr>
								<th>NISN</th>
								<th>NIS</th>
								<th>Nama</th>
								<th>Kelas</th>
								<th>Telepon</th>
								<th>Tahun SPP</th>
								<th>Aksi</th>		
							</tr>
						</thead>
						<tbody>
							@foreach($data as $row)
							<tr>
								<td style="max-width: 150px">{{$row->nisn}}</td>
								<td style="max-width: 150px">{{$row->nis}}</td>
								<td class="text-truncate" style="max-width: 180px">{{$row->student_name}}</td>
								<td class="text-truncate" style="max-width: 130px">{{$row->class_name.' '.$row->competency}}</td>
								<td>{{$row->phone_number}}</td>
								<td>{{$row->year}}</td>
								<td>
									<form action="{{route('admin.student.destroy', $row->user_id)}}" method="post">
										@csrf
										@method('DELETE')
										<a href="{{route('admin.student.show', $row->nisn)}}" class="btn btn-info btn-sm" data-mdb-toggle="tooltip" title="Detail Data" data-placement="top"><i class="fas fa-file fa-fw"></i></a>   
										<a href="{{route('admin.student.edit', $row->nisn)}}" class="btn btn-warning btn-sm" data-mdb-toggle="tooltip" title="Ubah Data" data-placement="top"><i class="fas fa-pencil fa-fw"></i></a>
										<button class="btn btn-danger btn-sm" data-mdb-toggle="tooltip" title="Hapus Data" data-placement="top" onclick="return confirm('Hapus Data?');"><i class="fas fa-trash-can fa-fw"></i>
                                                </button>
                                        
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