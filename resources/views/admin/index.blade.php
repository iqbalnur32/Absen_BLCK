@extends('admin.dashboard_admin')
@section('content')
<div class="container-fluid">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<h4>Users Management</h4>
				<button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModal">Tambah Users</button>
			</div>
			<div class="card-body">
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

				@if (count($errors) > 0)
				<div class="alert alert-warning">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<ul>
						@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
				@endif
				<table id="table" class="table">
					<thead>
						<tr>
							<th>No</th>
							<th>Name</th>
							<th>Email</th>
							<th>Address</th>
							<th>Actions</th>
						</tr>
					</thead>
					@foreach($users as $key)
					<tbody>
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td>{{ $key->name }}</td>
							<td>{{ $key->email }}</td>
							<td>{{ $key->address }}</td>
							<td align="center" class="d-flex">
								<button class="btn btn-primary btn-sm open_modal_management" value="<?= $key->id?>"><i class="fas fa-pencil-alt"></i></button>
								<form action="{{ route('DeleteProcess',$key->id) }}"  method="POST">
									@csrf
									@method('delete')
									<button type="submit" class="btn btn-danger btn-sm"  onclick="return confirm('Yakin Data Mau Dihapus??');"><i class="fas fa-trash"></i></button>
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

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Create Users</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="{{ route('createProcess') }}" method="POST">
					@csrf
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label>Name</label>
								<input class="form-control" type="text" name="name" id="name" required>
								<input type="hidden" id="id_users" name="id_users">
							</div>	
							<div class="form-group">
								<label>No Phone</label>
								<input class="form-control" type="text" name="no_phone" id="no_phone" required>
							</div>	
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Email</label>
								<input class="form-control" type="email" name="email" id="email" required>
							</div>	
							<div class="form-group">
								<label>Password</label>
								<input class="form-control" type="text" name="password" id="password" required>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label>Role</label>
								<select class="form-control" id="role" name="role">
									<option value="admin">Admin</option>
									<option value="users">Users</option>
								</select>
							</div>		
						</div>
						<div class="col-lg-12 col-12">
							<div class="form-group">
								<label>Alamat</label>
								<textarea class="form-control" type="text" name="address" id="address" required></textarea>
							</div>
							<div class="float-right">
								<button type="submit" class="btn btn-sm btn-primary">Submit</button>
							</div>	
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- Modal Edit Management -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">Management Form</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
			</div>
			<div class="modal-body">
				<form id="frmProducts" name="frmProducts" novalidate="">
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label>Name</label>
								<input class="form-control" type="text" name="name" id="name_d" required>
								<input type="hidden" id="id_users" name="id_users">
							</div>	
							<div class="form-group">
								<label>No Phone</label>
								<input class="form-control" type="text" name="no_phone" id="no_phone_d" required>
							</div>	
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Email</label>
								<input class="form-control" type="email" name="email" id="email_d" required>
							</div>	
							<div class="form-group">
								<label>Password</label>
								<input class="form-control" type="text" name="password" id="password_d" required>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label>Role</label>
								<select class="form-control" id="role_d" name="role">
									<option value="admin">Admin</option>
									<option value="users">Users</option>
								</select>
							</div>		
						</div>
						<div class="col-lg-12 col-12">
							<div class="form-group">
								<label>Alamat</label>
								<textarea class="form-control" type="text" name="address" id="address_d" required></textarea>
							</div>
							<div class="float-right">
								<button type="submit" class="btn btn-sm btn-primary" id="btn-update">Update</button>
							</div>	
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

@section('javascript')

<script type="text/javascript">
	$(document).ready(function() {
		var my_url = '{{ env('BASE_URL') }}'

		$(document).on('click', '.open_modal_management', function() {
			var id_users = $(this).val();
			$.ajax({
				type: 'GET',
				dataType: 'JSON',
				url: my_url + 'admin/edit/' + id_users,
				success: function(data){
					$('#id_users').val(data.data.id);
					$('#name_d').val(data.data.name);
					$('#email_d').val(data.data.email);
					$('#no_phone_d').val(data.data.no_phone);
					$('#address_d').val(data.data.address);
					$('#role_d').val(data.data.role);
					$('#password_d').val(data.data.password);
					$('#myModal').modal('show');
				},
				error: function(error){
					console.log(error);
				}
			})
		})

		$('#btn-update').click(function(e) {
			e.preventDefault();

			let _token   = $('meta[name="csrf-token"]').attr('content');
			var formData = {
				id_users: $('#id_users').val(),
				name: $('#name_d').val(),
				email: $('#email_d').val(),
				no_phone: $('#no_phone_d').val(),
				address: $('#address_d').val(),
				role: $('#role_d').val(),
				password: $('#password_d').val(),
				_token: _token
			}

			var type = "PUT"
			var dataType = "JSON"
			var id_users = $('#id_users').val();
			var base_url = "{{ route('UpdateProcess', ':id') }}"
			base_url = base_url.replace(':id', id_users);

			$.ajax({
				url: base_url,
				type: type,
				data: formData,
				dataType: dataType,
				success: function(result) {
					if (result.code === 200) {
						Swal.fire({
							icon: 'success',
							title: 'Your work has been saved',
							showConfirmButton: false,
							timer: 1500,
						}).then((result) => {
							window.location = "/admin"
						}).catch((err) => {
							alert('Silahkan refresh')
						})

					} else if(result.code === 300) 	{
						Swal.fire({
							icon: 'error',
							title: 'Ops....! Failed Update',
							timer: 1500
						}).then((result) => { window.location = "/admin" })
					} else {
						alert('Erros Request')
					}
				},
				error: function(err) {
					Swal.fire({
						icon: 'error',
						title: 'Oops...',
						text: 'Something went wrong!',
						footer: '<a href>Why do I have this issue?</a>'
					}).then((result) => { window.location = "/admin" })
				}
			})
		})
	})
</script>
@endsection