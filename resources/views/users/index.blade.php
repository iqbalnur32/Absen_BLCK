@extends('users.dashboard_users')
@section('content')
<div class="container-fluid">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<h4>Absensi</h4>
			</div>
			<div class="card-body">
				<form method="POST" action="{{ route('ProcessAbsen') }}" enctype="multipart/form-data">
					{{csrf_field()}}
					@if (session('sukses'))
					<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert">×</button>
						{{ session('sukses') }}
					</div>
					@elseif(session('gagal'))
					<div class="alert alert-danger">
						<button type="button" class="close" data-dismiss="alert">×</button>
						{{ session('gagal') }}
					</div>
					@endif
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label>Kehadiran</label>
								<select class="form-control" name="cutoff">
									<option value="yes">Hadir</option>
									<option value="no">Tidak hadir</option>
								</select>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Keterangan Jika Izin</label>
								<input class="form-control" type="file" name="attachment">
								<small style="color: red">* Kosongkan Jika Kamu Hadir</small><br>
								<small style="color: red">* Foto Bukti Gambar Surat Sakit</small>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<input class="form-control" type="hidden" name="check_in" value="check_in">
								{{-- <label>Absensi</label>
								<select class="form-control" name="btnIn">
									<option value="check_in">Absen Masuk</option>
									<option value="check_out">Absen Keluar</option>
								</select> --}}
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<button type="submit" style="width: 100%;" class="btn btn-flat btn-success">Absen Masuk</button>	
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-body">
					<table id="table" class="table">
						<thead>
							<tr>
								<th class="text-center">Tanggal</th>
								<th class="text-center">Jam Masuk</th>
								<th class="text-center">Jam Keluar</th>
								<th class="text-center">Keterangan</th>
								<th class="text-center">Actions</th>
							</tr>
						</thead>
						@foreach($result_absen as $key)
						<?php $temp = explode(" ", $key->check_in) ?>
						<?php $test = explode(" ", $key->check_out) ?>
						<tbody>
							<tr>
								<td class="text-center">{{ $temp[0] }}</td>
								<td class="text-center">{{ $temp[1] }}</td>
								<td class="text-center">{{ $key->check_out ? $test[1] : 'kosong' }}</td>
								<td class="text-center"><img width="200" height="200" src="{{ $key->Attedances->attachment ? url('users/file/' . $key->Attedances->attachment) : url('https://bodybigsize.com/wp-content/uploads/2020/02/noimage-22.png') }}"></td>
								<td class="text-center">
									<form action="{{ route('ProcessAbsenKeluar',$key->id)}}" method="POST">
										@csrf
										<button class="btn btn-primary btn-sm" type="submit">Absen Keluar</button><br>
										<small style="color: red;">* Tombol Absen Keluar !</small>
									</form>
								</td>
							</tr>
						</tbody>
						@endforeach
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection