@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.member.title_singular') }}
    </div>

    <div class="card-body">
        <form class="form form-vertical" method="post" id="registrationForm" enctype="multipart/form-data">
        {{-- <form class="form-material mt-4" action="{{ route("admin.master-member.store") }}" method="POST" enctype="multipart/form-data"> --}}
            @csrf
            <div class="row">
				<div class="col">
					<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
						<label for="name">Nama Lengkap*</label>
						<input type="text" id="name" name="name" class="form-control" placeholder="Nama" value="" onKeyUp="uppercase(this);">
						@if($errors->has('name'))
							<em class="invalid-feedback">
								{{ $errors->first('name') }}
							</em>
						@endif
					</div>
				</div>
				<div class="col">
					<div class="form-group {{ $errors->has('nickname') ? 'has-error' : '' }}">
						<label for="name">Nama Panggilan*</label>
						<input type="text" id="nickname" name="nickname" class="form-control" placeholder="Nama Panggilan" value="" onKeyUp="uppercase(this);" required>
						@if($errors->has('nickname'))
							<em class="invalid-feedback">
								{{ $errors->first('nickname') }}
							</em>
						@endif
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<div class="form-group {{ $errors->has('nik') ? 'has-error' : '' }}">
						<label for="nik">No KTP*</label>
						<input type="text" id="nik" name="nik" class="form-control" placeholder="Nomor KTP" value="" onKeyUp="numericFilter(this);" required>
						@if($errors->has('nik'))
							<em class="invalid-feedback">
								{{ $errors->first('nik') }}
							</em>
						@endif
					</div>
				</div>
				<div class="col">
					<div class="form-group {{ $errors->has('no_kk') ? 'has-error' : '' }}">
						<label for="no_kk">No KK*</label>
						<input type="text" id="no_kk" name="no_kk" class="form-control" placeholder="Nomor KK" value="" onKeyUp="numericFilter(this);" required>
						@if($errors->has('no_kk'))
							<em class="invalid-feedback">
								{{ $errors->first('no_kk') }}
							</em>
						@endif
					</div>
				</div>
			</div>
			<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
				<label for="emailaddress">{{ trans('cruds.member.fields.email') }}*</label>
				<input type="text" id="emailaddress" name="emailaddress" class="form-control" placeholder="Alamat Email" value="" required>
				@if($errors->has('emailaddress'))
					<em class="invalid-feedback">
						{{ $errors->first('emailaddress') }}
					</em>
				@endif
			</div>
			<div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
				<label for="password">{{ trans('cruds.member.fields.password') }}*</label>
				<input type="password" id="password" name="password" class="form-control" required>
				@if($errors->has('password'))
					<em class="invalid-feedback">
						{{ $errors->first('password') }}
					</em>
				@endif
			</div>
			<div class="form-group {{ $errors->has('gender') ? 'has-error' : '' }}">
				<label for="gender">Jenis Kelamin*</label>
				<select name="gender" id="gender" class="form-control select2" required style="width: 100%; height:36px;">
					<option value="">-- Pilih --</option>
					<option value="0">Perempuan</option>
					<option value="1">Laki-Laki</option>
				</select>
				@if($errors->has('gender'))
					<em class="invalid-feedback">
						{{ $errors->first('gender') }}
					</em>
				@endif
			</div>
			<div class="row">
				<div class="col">
					<div class="form-group {{ $errors->has('tempat_lahir') ? 'has-error' : '' }}">
						<label for="tempat_lahir">Tempat Lahir*</label>
						<select name="tempat_lahir" id="tempat_lahir" class="form-control selectpicker" style="width: 100%; height:36px;" data-live-search="true" required>
							<option value="">-- Pilih --</option>
							@foreach($kabupaten as $data => $row)
								<option value="{{ $data }}" >{{ $row }}</option>
							@endforeach
						</select>
						@if($errors->has('tempat_lahir'))
							<em class="invalid-feedback">
								{{ $errors->first('tempat_lahir') }}
							</em>
						@endif
					</div>
				</div>
				<div class="col">
                    <div class="form-group {{ $errors->has('tgl_lahir') ? 'has-error' : '' }}">
                        <label for="tgl_lahir">Tanggal Lahir*</label>
                        <input type="text" id="tgl_lahir" name="tgl_lahir" class="form-control date" value="{{ old('tgl_lahir', date('Y-m-d')) }}">
                        @if($errors->has('tgl_lahir'))
                            <em class="invalid-feedback">
                                {{ $errors->first('tgl_lahir') }}
                            </em>
                        @endif
                        <p class="helper-block">

                        </p>
                    </div>	
				</div>
			</div>
			<div class="row">
				<div class="col">
					<div class="form-group {{ $errors->has('marital_status') ? 'has-error' : '' }}">
						<label for="marital_status">Status Pernikahan*</label>
						<select name="marital" id="marital" class="form-control select2" required style="width: 100%; height:36px;">
							<option value="">-- Pilih --</option>
							@foreach($marital as $data => $row)
								<option value="{{ $data }}" >{{ $row }}</option>
							@endforeach
						</select>
						@if($errors->has('marital_status'))
							<em class="invalid-feedback">
								{{ $errors->first('marital_status') }}
							</em>
						@endif
					</div>
				</div>
				<div class="col">
					<div class="form-group {{ $errors->has('job') ? 'has-error' : '' }}">
						<label for="job">Pekerjaan*</label>
						<select name="job" id="job" class="form-control selectpicker" style="width: 100%; height:36px;" data-live-search="true" required>
							<option value="">-- Pilih --</option>
							@foreach($job as $data => $row)
								<option value="{{ $data }}" >{{ $row }}</option>
							@endforeach
						</select>
						@if($errors->has('job'))
							<em class="invalid-feedback">
								{{ $errors->first('job') }}
							</em>
						@endif
					</div>
				</div>
			</div>
			<div class="form-group {{ $errors->has('no_hp') ? 'has-error' : '' }}">
				<label for="no_hp">{{ trans('cruds.member.fields.hp') }}*</label>
				<input type="text" id="no_hp" name="no_hp" placeholder="Nomor HP" class="form-control" onKeyUp="numericFilter(this);" required>
				@if($errors->has('no_hp'))
					<em class="invalid-feedback">
						{{ $errors->first('no_hp') }}
					</em>
				@endif
			</div>
			<div class="form-group">
				<label for="address">Alamat*</label>
				<textarea name="address" id="address" class="form-control" cols="20" rows="10" placeholder="Alamat Sesuai KTP"></textarea>
				@if($errors->has('address'))
					<em class="invalid-feedback">
						{{ $errors->first('address') }}
					</em>
				@endif
			</div>
			<div class="row">
				<div class="col">
					<div class="form-group {{ $errors->has('provinsi') ? 'has-error' : '' }}">
						<label for="provinsi">Provinsi*</label>
						<select name="provinsi" id="provinsi" class="form-control select2" style="width: 100%; height:36px;" required>
							<option value="">-- Pilih --</option>
							@foreach($provinsi as $data => $row)
								<option value="{{ $data }}" name="{{ $row }}">{{ $row }}</option>
							@endforeach
						</select>
						@if($errors->has('provinsi'))
							<em class="invalid-feedback">
								{{ $errors->first('provinsi') }}
							</em>
						@endif
					</div>
				</div>
				<div class="col">
					<div class="form-group {{ $errors->has('kabupaten') ? 'has-error' : '' }}">
						<label for="kabupaten">{{ trans('cruds.member.fields.kabupaten') }}*</label>
						<select name="kabupaten" id="kabupaten" class="form-control select2" required style="width: 100%; height:36px;">
							<option value="">-- Pilih --</option>
						</select>
						@if($errors->has('kabupaten'))
							<em class="invalid-feedback">
								{{ $errors->first('kabupaten') }}
							</em>
						@endif
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<div class="form-group {{ $errors->has('kecamatan') ? 'has-error' : '' }}">
						<label for="kecamatan">{{ trans('cruds.member.fields.kecamatan') }}*</label>
						<select name="kecamatan" id="kecamatan" class="form-control select2" required style="width: 100%; height:36px;">
							<option value="">-- Pilih --</option>
						</select>
						@if($errors->has('kecamatan'))
							<em class="invalid-feedback">
								{{ $errors->first('kecamatan') }}
							</em>
						@endif
					</div>
				</div>
				<div class="col">
					<div class="form-group {{ $errors->has('kelurahan') ? 'has-error' : '' }}">
						<label for="kelurahan">{{ trans('cruds.member.fields.kelurahan') }}*</label>
						<select name="kelurahan" id="kelurahan" class="form-control select2" required style="width: 100%; height:36px;">
							<option value="">-- Pilih --</option>
						</select>
						@if($errors->has('kelurahan'))
							<em class="invalid-feedback">
								{{ $errors->first('kelurahan') }}
							</em>
						@endif
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<div class="form-group {{ $errors->has('avatar') ? 'has-error' : '' }}">
						<label for="avatar">Foto Profil*</label>
						<input type="file" id="avatar" name="avatar" class="form-control" value="">
						@if($errors->has('avatar'))
							<em class="invalid-feedback">
								{{ $errors->first('avatar') }}
							</em>
						@endif
						<p class="helper-block">
						</p>
					</div>
				</div>
				<div class="col">
					<div class="form-group {{ $errors->has('foto_ktp') ? 'has-error' : '' }}">
						<label for="foto_ktp">{{ trans('cruds.member.fields.foto_ktp') }}*</label>
						<input type="file" id="foto_ktp" name="foto_ktp" class="form-control" value="">
						@if($errors->has('foto_ktp'))
							<em class="invalid-feedback">
								{{ $errors->first('foto_ktp') }}
							</em>
						@endif
						<p class="helper-block">
						</p>
					</div>
				</div>
				<div class="col">
					<div class="form-group {{ $errors->has('foto_kk') ? 'has-error' : '' }}">
						<label for="foto_kk">{{ trans('cruds.member.fields.foto_kk') }}*</label>
						<input type="file" id="foto_kk" name="foto_kk" class="form-control" value="">
						@if($errors->has('foto_kk'))
							<em class="invalid-feedback">
								{{ $errors->first('foto_kk') }}
							</em>
						@endif
						<p class="helper-block">
						</p>
					</div>
				</div>
			</div>
			<div class="form-check">
				<input type="checkbox" class="form-check-input" id="check" value="FALSE">
				<label class="form-check-label" for="check">Alamat Sesuai KTP</label>
			</div>
			<br>
			<div class="form-group">
				<label for="alamat_domisili">Alamat Domisili*</label>
				<textarea name="alamat_domisili" id="alamat_domisili" class="form-control" cols="20" rows="10" placeholder="Alamat Domisili"></textarea>
				@if($errors->has('alamat_domisili'))
					<em class="invalid-feedback">
						{{ $errors->first('alamat_domisili') }}
					</em>
				@endif
			</div>
			<div class="row">
				<div class="col">
					<div class="form-group {{ $errors->has('provinsi_domisili') ? 'has-error' : '' }}">
						<label for="provinsi_domisili">Provinsi Domisili*</label>
						<select name="provinsi_domisili" id="provinsi_domisili" class="form-control select2" required style="width: 100%; height:36px;">
							<option value="">-- Pilih --</option>
							@foreach($provinsi as $data => $row)
								<option value="{{ $data }}" >{{ $row }}</option>
							@endforeach
						</select>
						@if($errors->has('provinsi_domisili'))
							<em class="invalid-feedback">
								{{ $errors->first('provinsi_domisili') }}
							</em>
						@endif
					</div>
				</div>
				<div class="col">
					<div class="form-group {{ $errors->has('kabupaten_domisili') ? 'has-error' : '' }}">
						<label for="kabupaten_domisili">Kabupaten Domisili*</label>
						<select name="kabupaten_domisili" id="kabupaten_domisili" class="form-control select2" style="width: 100%; height:36px;" required>
							<option value="">-- Pilih --</option>
						</select>
						@if($errors->has('kabupaten_domisili'))
							<em class="invalid-feedback">
								{{ $errors->first('kabupaten_domisili') }}
							</em>
						@endif
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<div class="form-group {{ $errors->has('kecamatan_domisili') ? 'has-error' : '' }}">
						<label for="kecamatan_domisili">Kecamatan Domisili*</label>
						<select name="kecamatan_domisili" id="kecamatan_domisili" class="form-control select2" required style="width: 100%; height:36px;">
							<option value="">-- Pilih --</option>
						</select>
						@if($errors->has('kecamatan_domisili'))
							<em class="invalid-feedback">
								{{ $errors->first('kecamatan_domisili') }}
							</em>
						@endif
					</div>
				</div>
				<div class="col">
					<div class="form-group {{ $errors->has('kelurahan_domisili') ? 'has-error' : '' }}">
						<label for="kelurahan_domisili">kelurahan Domisili*</label>
						<select name="kelurahan_domisili" id="kelurahan_domisili" class="form-control select2" required style="width: 100%; height:36px;">
							<option value="">-- Pilih --</option>
						</select>
						@if($errors->has('kelurahan_domisili'))
							<em class="invalid-feedback">
								{{ $errors->first('kelurahan_domisili') }}
							</em>
						@endif
					</div>
				</div>
			</div>
			<div>
				<button type="submit" class="btn btn-primary">
					<i class="fa fa-save"></i> Daftar
				</button>
			</div>
        </form>
    </div>
</div>
@section('scripts')
@parent
<script>
    $(document).ready(function (e) {
        // $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
        });
        
        $("#check").change(function () {
            let alamat = $('#address').val();
			let prov = $('#provinsi').find('option:selected').val();
			let kab = $('#kabupaten').find('option:selected').val();
			let kec = $('#kecamatan').find('option:selected').val();
			let kel = $('#kelurahan').find('option:selected').val();
					
			let prov_name = $('#provinsi').find('option:selected').attr("name");
			let kab_name = $('#kabupaten').find('option:selected').attr("name");
			let kec_name = $('#kecamatan').find('option:selected').attr("name");
			let kel_name = $('#kelurahan').find('option:selected').attr("name");
					
			if (this.checked) {
				$("#alamat_domisili").val(alamat);
				$("#provinsi_domisili").prop('readonly', true);				
				$("#kabupaten_domisili").prop('readonly', true);				
				$("#kecamatan_domisili").prop('readonly', true);				
				$("#kelurahan_domisili").prop('readonly', true);	
				$("#provinsi_domisili").append('<option value="' + prov + '" selected>' + prov_name + '</option>');
				$("#kabupaten_domisili").append('<option value="' + kab + '" selected>' + kab_name + '</option>');
				$("#kecamatan_domisili").append('<option value="' + kec + '" selected>' + kec_name + '</option>');
				$("#kelurahan_domisili").append('<option value="' + kel + '" selected>' + kel_name + '</option>');
			} else {
				$("#alamat_domisili").val("");
				$("#provinsi_domisili").prop('readonly', false);				
				$("#kabupaten_domisili").prop('readonly', true);				
				$("#kecamatan_domisili").prop('readonly', true);				
				$("#kelurahan_domisili").prop('readonly', true);
				$('#provinsi_domisili').find('option').remove();		
				$('#kabupaten_domisili').find('option').remove();		
				$('#kecamatan_domisili').find('option').remove();		
				$('#kelurahan_domisili').find('option').remove();		
				$("#provinsi_domisili").append('<option value="">--Pilih--</option>');
				$("#kabupaten_domisili").append('<option value="">--Pilih--</option>');
				$("#kecamatan_domisili").append('<option value="">--Pilih--</option>');
				$("#kelurahan_domisili").append('<option value="">--Pilih--</option>');
			}
        });
        
		$('#registrationForm').on('submit', function(e){
            e.preventDefault();
            // $(this).html('Sending..');
			var name 				= $("#name").val();
			var nickname 			= $("#nickname").val();
			var nik 				= $("#nik").val();
			var no_kk 				= $("#no_kk").val();
			var email 				= $("#emailaddress").val();
			var password 			= $("#password").val();
			var gender 				= $("#gender").val();
			var tempat_lahir 		= $("#tempat_lahir").val();
			var tgl_lahir 			= $("#tgl_lahir").val();
			var marital 			= $("#marital").val();
			var job 				= $("#job").val();
			var no_hp 				= $("#no_hp").val();
			var nickname 			= $("#nickname").val();
			var address 			= $("#address").val();
			var provinsi 			= $("#provinsi").val();
			var kabupaten 			= $("#kabupaten").val();
			var kecamatan 			= $("#kecamatan").val();
			var kelurahan 			= $("#kelurahan").val();
			var alamat_domisili		= $("#alamat_domisili").val();
			var provinsi_domisili	= $("#provinsi_domisili").val();
			var kabupaten_domisili	= $("#kabupaten_domisili").val();
			var kecamatan_domisili	= $("#kecamatan_domisili").val();
			var kelurahan_domisili	= $("#kelurahan_domisili").val();
			var ktp					= $("#foto_ktp").val();
			var kk					= $("#foto_kk").val()
			var avatar  			= $("#avatar").val()
			if(name == '') {
				swal('Error','nama tidak boleh kosong');
				return false;
			}
			if(nickname == '') {
				swal('Error','nama panggilan tidak boleh kosong');
				return false;
			}
			if(nik == '') {
				swal('Error','nomor KTP tidak boleh kosong');
				return false;
			}
			if(no_kk == '') {
				swal('Error','nomor KK tidak boleh kosong');
				return false;
			}
			if(email == '') {
				swal('Error','email tidak boleh kosong');
				return false;
			}
			if(!validateEmail(email)) {
				swal('Error','masukkan email benar');
				return false;
			}
			if(password == '') {
				swal('Error','password tidak boleh kosong');
				return false;
			}
			if(password.length < 7 ) {
				swal('Error','password harus 6 karakter');
				return false;
			}
			if(gender == '') {
				swal('Error','jenis kelamin tidak boleh kosong');
				return false;
			}
			if(tempat_lahir == '') {
				swal('Error','tempat lahir tidak boleh kosong');
				return false;
			}
			if(tgl_lahir == '') {
				swal('Error','tanggal lahir tidak boleh kosong');
				return false;
			}
			if(marital == '') {
				swal('Error','status pernikahan tidak boleh kosong');
				return false;
			}
			if(job == '') {
				swal('Error','pekerjaan tidak boleh kosong');
				return false;
			}
			if(no_hp == '') {
				swal('Error','nomor hp tidak boleh kosong');
				return false;
			}
			if(address == '') {
				swal('Error','alamat tidak boleh kosong');
				return false;
			}
			if(provinsi == '') {
				swal('Error','provinsi tidak boleh kosong');
				return false;
			}
			if(kabupaten == '') {
				swal('Error','kabupaten tidak boleh kosong');
				return false;
			}
			if(kecamatan == '') {
				swal('Error','kecamatan tidak boleh kosong');
				return false;
			}
			if(kelurahan == '') {
				swal('Error','kelurahan tidak boleh kosong');
				return false;
			}
			if(alamat_domisili == '') {
				swal('Error','alamat domisili tidak boleh kosong');
				return false;
			}
			if(kabupaten_domisili == '') {
				swal('Error','kabupaten domisili tidak boleh kosong');
				return false;
			}
			if(provinsi_domisili == '') {
				swal('Error','provinsi domisili tidak boleh kosong');
				return false;
			}
			if(kecamatan_domisili == '') {
				swal('Error','kecamatan domisili tidak boleh kosong');
				return false;
			}
			if(kelurahan_domisili == '') {
				swal('Error','kelurahan domisili tidak boleh kosong');
				return false;
            }
			if(ktp == '') {
				swal('Error','Foto KTP tidak boleh kosong');
				return false;
            }
			if(kk == '') {
				swal('Error','Foto KK tidak boleh kosong');
				return false;
            }
			if(avatar == '') {
				swal('Error','Foto Profil tidak boleh kosong');
				return false;
            }
            
            var formData = new FormData(this);
            $.ajax({
                url: "{{ route('admin.master-member.store') }}",
                type: "POST",
                data: formData,
                // dataType: 'JSON',
                success: function (data) {
                    console.log(data);
                    if ((data.is_error) === true) {
                        swal('Error',data.error_msg);
                    } else {
                        swal('Info',data.error_msg);
                        document.getElementById("registrationForm").reset();
                        // $('#registrationForm').reset();
                        parent.history.back();
                    }
                },
                cache: false,
                contentType: false,
                processData: false,
                error: function (data) {
                    console.log('Error:', data);
                    swal('error',data.error_msg);
                }
            });
        });
    });
    
	function validateEmail($email) {
		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		return emailReg.test( $email );
	}

	function uppercase(obj){
		obj.value = obj.value.toUpperCase();
	}

	$("#provinsi_domisili").change(function() {
		let val = $(this).val();
		$.ajax({
			url: '{{ route('kab') }}',
			data: {
				val : val
			},
			dataType:'json',
			type:'GET',
			success: function(response) {
				var len = response.length;
				$('#kabupaten_domisili').find('option').remove();
				$("#kabupaten_domisili").prop('readonly', false);
				$("#kabupaten_domisili").append('<option value="">--Pilih--</option>');
				if(len > 1) {
					for( var i = 0; i<len; i++){
						var code = response[i]['id_kab'];
						var name = response[i]['name'];
						$("#kabupaten_domisili").append("<option value='"+code+"' name='"+name+"'>"+name+"</option>");
					}
				}
			}
		});
    });

	$("#kabupaten_domisili").change(function() {
		let val = $(this).val();
		$.ajax({
			url: '{{ route('kec') }}',
			data: {
				val : val
			},
			dataType:'json',
			type:'GET',
			success: function(response) {
				var len = response.length;
				$('#kecamatan_domisili').find('option').remove();
				$("#kecamatan_domisili").prop('readonly', false);
				$("#kecamatan_domisili").append('<option value="">--Pilih--</option>');
				if(len > 1) {
					for( var i = 0; i<len; i++){
						var code = response[i]['id_kec'];
						var name = response[i]['name'];
						$("#kecamatan_domisili").append("<option value='"+code+"' name='"+name+"'>"+name+"</option>");
					}
				}
			}
		});
	});

	$("#kecamatan_domisili").change(function() {
		let val = $(this).val();
		$.ajax({
			url: '{{ route('kel') }}',
			data: {
				val : val
			},
			dataType:'json',
			type:'GET',
			success: function(response) {
				var len = response.length;
				$('#kelurahan_domisili').find('option').remove();
				$("#kelurahan_domisili").prop('readonly', false);
				$("#kelurahan_domisili").append('<option value="">--Pilih--</option>');
				if(len > 1) {
					for( var i = 0; i<len; i++){
						var code = response[i]['id_kel'];
						var name = response[i]['name'];
						$("#kelurahan_domisili").append("<option value='"+code+"' name='"+name+"'>"+name+"</option>");
					}
				}
			}
		});
	});

	$("#provinsi").change(function() {
		let val = $(this).val();
		$.ajax({
			url: '{{ route('kab') }}',
			data: {
				val : val
			},
			dataType:'json',
			type:'GET',
			success: function(response) {
				var len = response.length;
				$('#kabupaten').find('option').remove();
				$("#kabupaten").prop('readonly', false);
				$("#kabupaten").append('<option value="">--Pilih--</option>');
				if(len > 1) {
					for( var i = 0; i<len; i++){
						var code = response[i]['id_kab'];
						var name = response[i]['name'];
						$("#kabupaten").append("<option value='"+code+"' name='"+name+"'>"+name+"</option>");
					}
				}
			}
		});
    });

	$("#kabupaten").change(function() {
		let val = $(this).val();
		$.ajax({
			url: '{{ route('kec') }}',
			data: {
				val : val
			},
			dataType:'json',
			type:'GET',
			success: function(response) {
				var len = response.length;
				$('#kecamatan').find('option').remove();
				$("#kecamatan").prop('readonly', false);
				$("#kecamatan").append('<option value="">--Pilih--</option>');
				if(len > 1) {
					for( var i = 0; i<len; i++){
						var code = response[i]['id_kec'];
						var name = response[i]['name'];
						$("#kecamatan").append("<option value='"+code+"' name='"+name+"'>"+name+"</option>");
					}
				}
			}
		});
	});

	$("#kecamatan").change(function() {
		let val = $(this).val();
		$.ajax({
			url: '{{ route('kel') }}',
			data: {
				val : val
			},
			dataType:'json',
			type:'GET',
			success: function(response) {
				var len = response.length;
				$('#kelurahan').find('option').remove();
				$("#kelurahan").prop('readonly', false);
				$("#kelurahan").append('<option value="">--Pilih--</option>');
				if(len > 1) {
					for( var i = 0; i<len; i++){
						var code = response[i]['id_kel'];
						var name = response[i]['name'];
						$("#kelurahan").append("<option value='"+code+"' name='"+name+"'>"+name+"</option>");
					}
				}
			}
		});
	});

	function numericFilter(txb) {
		txb.value = txb.value.replace(/[^\0-9]/ig, "");
    }
    
</script>
@endsection
@endsection