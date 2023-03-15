@extends('layouts.app')
@section('content')
<div class="container-fluid">
	<div class="row bg-info text-white align-items-center justify-content-center mb-3" style="height:300px;">
		<div class="col-3  text-center">
			<img src="storage/img/smknekat-logo.png" alt="" width="200px">
		</div>
		<div class="col-4 fs-3">
			Permudah pembayaran SPP dan, cek riwayat pembayarannya di website SPP Nekat
		</div>
	</div>
    <div class="row justify-content-center">
		<div class="col-4">
			@guest
		    
			@if(session()->has('loginfailed'))
			<div class="alert alert-danger">
				{{message('loginfailed')}}
			</div>
			@endif
			<div class="card">
				<form class="px-5 py-4" action="{{route('login')}}" method="POST">
					@csrf
					<h4 class="mb-4 text-center">Masuk</h4>
	
					<div class="row mb-3">
						<div class="col">
						<label class="text-start" for="username" >Nama Pengguna</label>
						<input type="text" class="form-control @error('username') is-invalid @enderror" placeholder="" name="username" required id="username" autofocus value="{{old('username')}}">
						@error('username')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror	
							
						</div>
					</div>
					<div class="row mb-3">
						<div class="col">
						<label class="text-start" for="password">Kata Sandi</label>
						<input type="password" class="form-control mb-4 @error('password') is-invalid @enderror" placeholder="" name="password" id="password" required>	
						</div>
						@error('password')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<div class="row">
						<div class="col">
							<button class="btn btn-info" type="submit">Masuk</button>
						</div>
					</div>
				</form>
			</div>
			@else

			<div class="card px-3 py-3">
				@switch(Auth::user()->role)
					@case("admin")
						<div class="row">
							<div class="col">
								<a class="btn btn-info btn-block mb-3" href="{{route('admin.index')}}">Masuk ke Halaman Admin</a>
							</div>
						</div>
						<div class="row">
							<div class="col">
								<a class="btn btn-info btn-block mb-3" href="{{route('payment.entry')}}">Masuk ke Halaman Staff</a>
							</div>
						</div>
						@break
					@case("staff")
						<div class="row">
							<div class="col">
								<a class="btn btn-info btn-block mb-3" href="{{route('payment.entry')}}">Masuk ke Halaman Staff</a>
							</div>
						</div>
						@break
					@case("siswa")
					<div class="row">
							<div class="col">
								<a class="btn btn-info btn-block mb-3" href="{{route('student.index')}}">Lihat Riwayat Pembayaran</a>
							</div>
						</div>
				@endswitch
			</div>
			@endguest
		</div>
	</div>
</div>
@endsection