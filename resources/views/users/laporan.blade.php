<!DOCTYPE html>
<html>
<head>
	<title>Laporan Absensi Data</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

	<div class="container">
		<center>
			<br>
			<h4>Laporan Absensi Data</h4>
		</center>
		<br/>
		<br>
		<table class='table table-bordered'>
			<thead>
				<tr>
					<th>No</th>
					<th>Tanggal</th>
					<th>Jam Masuk</th>
					<th>Jam Keluar</th>
					<th>Status Kehadiran</th>
					<th>Keterangan</th>
				</tr>
			</thead>
			<tbody>
				@if(is_array($data))
					@foreach($data as $key)
					<?php $temp = explode(" ", $key->check_in) ?>
					<?php $test = explode(" ", $key->check_out) ?>
					<tr>
						<td>{{$loop->iteration}}</td>
						<td>{{ $temp[0] }}</td>
						<td>{{ $temp[1] }}</td>
						<td>{{ $key->check_out ? $test[1] : 'kosong' }}</td>
						<td>{{$key->Attedances->cutoff}}</td>
						<td><img width="200" height="200" src="{{ $key->Attedances->attachment ? url('users/file/' . $key->Attedances->attachment) : url('https://bodybigsize.com/wp-content/uploads/2020/02/noimage-22.png') }}"></td>
									<td class="text-center">
					</tr>
					@endforeach
				@else
					@foreach($data as $key)
					<?php $temp = explode(" ", $key->check_in) ?>
					<?php $test = explode(" ", $key->check_out) ?>
					<tr>
						<td>{{$loop->iteration}}</td>
						<td>{{ $temp[0] }}</td>
						<td>{{ $temp[1] }}</td>
						<td>{{ $key->check_out ? $test[1] : 'kosong' }}</td>
						<td>{{$key->Attedances->cutoff }}</td>
						<td><img width="200" height="200" src="{{ $key->Attedances->attachment ? url('users/file/' . $key->Attedances->attachment) : url('https://bodybigsize.com/wp-content/uploads/2020/02/noimage-22.png') }}"></td>
									<td class="text-center">
					</tr>
					@endforeach
				@endif
			</tbody>
		</table>

	</div>

</body>
</html>