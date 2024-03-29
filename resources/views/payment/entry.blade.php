@extends('layouts.app')
@section('content')
<div class="container gx-0 py-3">
	<div class="row text-center">
		<div class="col-12 p-2">
			<img src=" {{asset('storage/img/smknekat-logo.png') }}" alt="" width="70px">
		</div>
	</div>
	<div class="row text-center">
		<h2>Pembayaran SPP</h2>
	</div>
	@if(session('success'))
	<div class="row d-flex justify-content-center">
		<div class="col-8 alert alert-success">
			<div class="">
				{{ session('success')}}
			</div>
		</div>
	</div>
	@endif
	@if(session('fail'))
	<div class="row d-flex justify-content-center">
		<div class="col-8 alert alert-danger">
			<div class="">
				{{ session('fail')}}
			</div>
		</div>
	</div>
	@endif
	@if ($errors->any())
	<div class="row">
		<div class="col">
			<div class="alert alert-danger">
				<ul>
		            @foreach ($errors->all() as $error)
		            <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		</div>
	</div>
	@endif
	<div class="row d-flex justify-content-center">
		<div class="col-8 border px-5 py-3">

			<div class="row">
						<form action="{{ route('payment.entry') }}" method="get">
							<div class="row mb-3">
								<div class="col align-items-center">
									<div class="d-flex justify-content-between mb-2 align-items-center">
										<a class="btn bg-success btn-sm text-white" href="{{route('payment.history')}}">Riwat pembayaran</a>
										<div class="d-flex align-items-center">
											<label for="searchKey">Cari Data Siswa</label>
											<input class="form-control ms-2" type="text" name="searchKey" id="searchKey" placeholder="masukan nisn" autofocus value="{{ $searchKey }}" style="width:150px">
										</div>
									</div>
									<div class="d-flex align-items-center justify-content-end">
										<button class="btn btn-secondary" type="submit" style="width:150px">Cari</button>
									</div>
								</div>
							</div>
						</form>
					<hr>
					</div>
					<div class="row">
						<form action="{{route('payment.store')}}" method="post">
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
									<input class="form-control" type="text" name="spp_id" id="spp_id" hidden value="{{ $d->spp_id }}">
									<input class="form-control alert-secondary" type="text" name="nisn" id="nisn" hidden value="{{ $d->nisn }}">

								</div>
							</div>
							@empty
							@if(session('notfound'))
								<div class="row alert alert-danger">
									{{ session('notfound')}}
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
									<div class="mb-3">
										<label for="nominal">Telah Dibayar</label>
										<div class="input-group">
											<span class="input-group-text" id="basic-addon1">Rp.</span>
											<input class="form-control" type="text" name="nominal" id="nominal" placeholder="Nominal SPP"  disabled value="{{ $paymentSum }}">
										</div>
									</div>
									<div class="mb-3">
										<label for="nominal">Sisa Pembayaran</label>
										<div class="input-group">
											<span class="input-group-text" id="basic-addon1">Rp.</span>
											<input class="form-control" type="text" name="nominal" id="nominal" placeholder="Nominal SPP"  disabled value="{{ $remaining }}">
										</div>
									</div>
								</div>
							</div>
							
							@endforelse
							<hr>
							<div class="row">
								@forelse ($data as $d)
								<label for="pay_amount"><h3>Total Bayar</h3></label>
								<div class="col-6 mb-3">
									<div class="input-group">
										<span class="input-group-text" id="basic-addon1">Rp.</span>
										<input class="form-control" type="text" name="pay_amount" id="pay_amount" placeholder="masukan jumlah bayar" value="" required>
									</div>
								</div>
								<div class="col-6 mb-3">
									<textarea class="form-control" type="text" name="information" id="information" placeholder="Tambahkan keterangan" rows="1"></textarea>
								</div>
								<hr>
								<div>
									<button class="btn btn-danger" type="submit">Lakukan Pembayaran</button>
								</div>
								@empty
								<label for="pay_amount"><h3>Total Bayar</h3></label>
								<div class="col-6 mb-3">
									<div class="input-group">
										<span class="input-group-text " id="basic-addon1">Rp.</span>
										<input class="form-control" type="text" name="pay_amount" id="pay_amount" placeholder="masukan jumlah bayar"  disabled>
									</div>
								</div>
								<div class="col-6 mb-3">
									<textarea class="form-control" type="text" name="information" id="information" placeholder="Tambahkan keterangan" disabled rows="1"></textarea>
								</div>
								<hr>
								<div>
									<button class="btn bg-secondary" disabled type="submit">Lakukan Pembayaran</button>
								</div>
								@endforelse
							</div>
						</form>
					</div>
		</div>
	</div>
</div>
@endsection