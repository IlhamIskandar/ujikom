@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
	<h4>Kelas</h4>
	@if ($errors->any())
	<div class="row">
		<div class="col">
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
		</div>
	</div>
	@endif
	<div class="row">
		<div class="col-6">
			<div class="card">
				<div class="card-header">
					<h5>Ubah Kelas</h5>
				</div>
				<div class="card-body">
					<form action="{{route('admin.class.update', $data->class_id)}}" method="post">
						@csrf
						@method('PUT')
						<div class="mb-3">
						<label for="classname">Nama Kelas</label>
							<div class="input-group">
								<input class="form-control" type="text" name="classname" id="classname" placeholder="Nama Kelas" autofocus value="{{$data->class_name}}">
							</div>	
						</div>
						<hr>
						<div class="mb-3">
							<label for="competency">Jurusan</label>
							<div class="input-group">
								<input class="form-control" type="text" name="competency" id="competency" placeholder="Jurusan Keahlian" value="{{$data->competency}}">
							</div>
						</div>
						<hr>
						<button class="btn btn-info" type="submit">Simpan</button>
						<a class="btn btn-secondary" href="{{route('admin.class.index')}}">Kembali</a>
					</form>
				</div>
			</div>
			
		</div>
	</div>
</div>
@endsection