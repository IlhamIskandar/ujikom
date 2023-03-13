@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
	<h4>Pembayaran SPP</h4>
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
	<div class="row">
		<div class="col">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<form action="{{ route('admin.payment.create') }}" method="get">
							<div class="row mb-3">
								<div class="d-flex align-items-center ">
									<label for="searchKey">Cari Data Siswa</label>
									<input class="form-control mx-2" type="text" name="searchKey" id="searchKey" placeholder="masukan nisn" autofocus value="{{ $searchKey }}" style="width:150px">
									<button class="btn btn-secondary" type="submit" >Cari</button>
								</div>
							</div>
							<hr>
						</form>
					</div>
					<div class="row">
						<form action="{{route('admin.payment.store')}}" method="post">
							@csrf
							@forelse ($data as $d)
							<div class="row alert-secondary p-3 rounded">
								<div class="col-6">
									<div class="mb-3">
										<label for="nisn">NISN</label>
										<input class="form-control alert-secondary" type="text" name="nisn" id="nisn" placeholder="NISN Siswa" disabled value="{{ $d->nisn }}">
									</div>
									<div class="mb-3">
										<label for="nis">NIS</label>
										<input class="form-control" type="text" name="nis" id="nis" placeholder="NIS Siswa"  disabled value="{{ $d->nis }}">
									</div>
									<div class="mb-3">
										<label for="name">Nama Siswa</label>
										<input class="form-control" type="text" name="name" id="name" placeholder="Nama Siswa"  disabled value="{{ $d->student_name }}">
									</div>
									<div class="mb-3">
										<label for="kelas">Kelas</label>
										<input class="form-control" type="text" name="kelas" id="kelas" placeholder="Kelas"  disabled value="{{ $d->class_name }}">
									</div>
									<div class="mb-3">
										<label for="jurusan">Jurusan</label>
										<input class="form-control" type="text" name="jurusan" id="jurusan" placeholder="Jurusan"  disabled value="{{ $d->competency }}">
									</div>
								</div>
								<div class="col-6">
									<label for="year">Tahun SPP</label>
									<div class="mb-3">
										<input class="form-control" type="text" name="year" id="year" placeholder="Tahun SPP"  disabled value="{{ $d->year }}">
									</div>
									<div class="mb-3">
										<label for="nominal">Nominal SPP</label>
										<div class="input-group">
											<span class="input-group-text" id="basic-addon1">Rp.</span>
											<input class="form-control" type="text" name="nominal" id="nominal" placeholder="Nominal SPP"  disabled value="{{ $d->nominal }}">
										</div>
									</div>
									<input class="form-control" type="text" name="spp_id" id="spp_id" hidden value="{{ $d->spp_id }}">
									<input class="form-control alert-secondary" type="text" name="nisn" id="nisn" hidden value="{{ $d->nisn }}">

								</div>
							</div>
							@empty
							@if(session('fail'))
								<div class="row alert alert-danger">
									{{ session('fail')}}
								</div>
							@endif
							<div class="row alert-secondary p-3 rounded">
								<div class="col-6">
									<div class="mb-3">
										<label for="nisn">NISN</label>
										<input class="form-control" type="text" name="nisn" id="nisn" placeholder="NISN Siswa" autofocus disabled value="">
									</div>
									<div class="mb-3">
										<label for="nis">NIS</label>
										<input class="form-control" type="text" name="nis" id="nis" placeholder="NIS Siswa" autofocus disabled>
									</div>
									<div class="mb-3">
										<label for="name">Nama Siswa</label>
										<input class="form-control" type="text" name="name" id="name" placeholder="Nama Siswa" autofocus disabled>
									</div>
									<div class="mb-3">
										<label for="kelas">Kelas</label>
										<input class="form-control" type="text" name="kelas" id="kelas" placeholder="Kelas" autofocus disabled>
									</div>
									<div class="mb-3">
										<label for="jurusan">Jurusan</label>
										<input class="form-control" type="text" name="jurusan" id="jurusan" placeholder="Jurusan" autofocus disabled>
									</div>
								</div>
								<div class="col-6">
									<label for="year">Tahun SPP</label>
									<div class="mb-3">
										<input class="form-control" type="text" name="year" id="year" placeholder="Tahun SPP" autofocus disabled>
									</div>
									<div class="mb-3">
										<label for="nominal">Nominal SPP</label>
										<input class="form-control" type="text" name="nominal" id="nominal" placeholder="Nominal SPP" autofocus disabled>
									</div>
								</div>
							</div>
							
							@endforelse
							<hr>
							<div class="row">
								@forelse ($data as $d)
								<div class="col-6 mb-3">
									<label for="pay_amount"><h3>Total Bayar</h3></label>
									<div class="input-group">
										<span class="input-group-text" id="basic-addon1">Rp.</span>
										<input class="form-control" type="text" name="pay_amount" id="pay_amount" placeholder="masukan jumlah bayar" value="" required>
									</div>
								</div>
								<hr>
								<div>
									<button class="btn btn-danger" type="submit">Lakukan Pembayaran</button>
									<a class="btn btn-secondary" href="{{route('admin.payment.index')}}">kembali</a>
								</div>
								@empty
								<div class="col-6 mb-3">
									<label for="pay_amount"><h3>Total Bayar</h3></label>
									<div class="input-group">
										<span class="input-group-text " id="basic-addon1">Rp.</span>
										<input class="form-control" type="text" name="pay_amount" id="pay_amount" placeholder="masukan jumlah bayar"  disabled>
									</div>
								</div>
								<hr>
								<div>
									<button class="btn bg-secondary" disabled type="submit">Lakukan Pembayaran</button>
									<a class="btn btn-secondary" href="{{route('admin.payment.index')}}">kembali</a>
								</div>
								@endforelse
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	
</div>
@endsection