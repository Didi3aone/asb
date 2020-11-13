@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.update') }} {{ trans('cruds.member.title_singular') }}
    </div>

    <div class="card-body">
        <form class="form-material mt-4" action="{{ route("admin.master-member.update", $member->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="row">
                <div class="col">
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label for="name">{{ trans('cruds.member.fields.nama') }}*</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ $member->name }}" onKeyUp="uppercase(this);">
                        @if($errors->has('name'))
                            <em class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </em>
                        @endif
                        <p class="helper-block">
                        </p>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group {{ $errors->has('nickname') ? 'has-error' : '' }}">
                        <label for="nickname">{{ trans('cruds.member.fields.nickname') }}*</label>
                        <input type="text" id="nickname" name="nickname" class="form-control" value="{{ $detail->nickname }}" onKeyUp="uppercase(this);">
                        @if($errors->has('nickname'))
                            <em class="invalid-feedback">
                                {{ $errors->first('nickname') }}
                            </em>
                        @endif
                        <p class="helper-block">
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group {{ $errors->has('nik') ? 'has-error' : '' }}">
                        <label for="nik">NIK*</label>
                        <input type="text" id="nik" name="nik" class="form-control" value="{{ $detail->nik }}" required>
                        @if($errors->has('nik'))
                            <em class="invalid-feedback">
                                {{ $errors->first('nik') }}
                            </em>
                        @endif
                    </div>
                </div>
                <div class="col">
                    <div class="form-group {{ $errors->has('no_kk') ? 'has-error' : '' }}">
                        <label for="no_kk">Nomor KK*</label>
                        <input type="text" id="no_kk" name="no_kk" class="form-control" value="{{ $detail->no_kk }}" required>
                        @if($errors->has('no_kk'))
                            <em class="invalid-feedback">
                                {{ $errors->first('no_kk') }}
                            </em>
                        @endif
                    </div>
                </div>
            </div>
            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                <label for="email">{{ trans('cruds.member.fields.email') }}*</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ $member->email }}" required>
                @if($errors->has('email'))
                    <em class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </em>
                @endif
            </div>
            {{-- <div class="row">
                <div class="col">
                    <div class="form-group {{ $errors->has('oldpassword') ? 'has-error' : '' }}">
                        <label for="oldpassword">{{ trans('cruds.member.fields.oldpassword') }}*</label>
                        <input type="password" id="oldpassword" name="oldpassword" class="form-control" value="" required>
                        @if($errors->has('oldpassword'))
                            <em class="invalid-feedback">
                                {{ $errors->first('oldpassword') }}
                            </em>
                        @endif
                    </div>
                </div>
                <div class="col">
                    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                        <label for="password">{{ trans('cruds.member.fields.newpassword') }}*</label>
                        <input type="password" id="password" name="password" class="form-control" value="" required>
                        @if($errors->has('password'))
                            <em class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </em>
                        @endif
                    </div>
                </div>
            </div> --}}
            <div class="form-group {{ $errors->has('gender') ? 'has-error' : '' }}">
                <label for="gender">{{ trans('cruds.member.fields.gender') }}*</label>
                <select name="gender" id="gender" class="form-control select2" required style="width: 100%; height:36px;">
                    <option value="">{{ trans('global.pleaseSelect') }}</option>
                    <option value="0" @if($member->gender == 0) selected @endif>Perempuan</option>
                    <option value="1" @if($member->gender == 1) selected @endif>Laki-Laki</option>
                </select>
                @if($errors->has('gender'))
                    <em class="invalid-feedback">
                        {{ $errors->first('gender') }}
                    </em>
                @endif
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group {{ $errors->has('pob') ? 'has-error' : '' }}">
                        <label for="pob">{{ trans('cruds.member.fields.pob') }}*</label>
                        <select name="pob" id="pob" class="form-control select2" required style="width: 100%; height:36px;">
                            <option value="">{{ trans('global.pleaseSelect') }}</option>
                            @foreach($pob as $data => $row)
                                <option value="{{ $data }}" @if($detail->birth_place == $data) selected @endif>{{ $row }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('pob'))
                            <em class="invalid-feedback">
                                {{ $errors->first('pob') }}
                            </em>
                        @endif
                    </div>
                </div>
                <div class="col">
                    <div class="form-group {{ $errors->has('dob') ? 'has-error' : '' }}">
                        <label for="dob">{{ trans('cruds.member.fields.dob') }}*</label>
                        <input type="text" id="dob" name="dob" class="form-control date" value="{{ $detail->tgl_lahir }}">
                        @if($errors->has('dob'))
                            <em class="invalid-feedback">
                                {{ $errors->first('dob') }}
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
                        <label for="marital_status">{{ trans('cruds.member.fields.marital_status') }}*</label>
                        <select name="marital" id="marital" class="form-control select2" required style="width: 100%; height:36px;">
                            <option value="">{{ trans('global.pleaseSelect') }}</option>
                            @foreach($marital as $data => $row)
                                <option value="{{ $data }}" @if($detail->status_kawin == $data) selected @endif>{{ $row }}</option>
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
                        <label for="job">{{ trans('cruds.member.fields.job') }}*</label>
                        <select name="job" id="job" class="form-control select2" required style="width: 100%; height:36px;">
                            <option value="">{{ trans('global.pleaseSelect') }}</option>
                            @foreach($job as $data => $row)
                                <option value="{{ $data }}" @if($detail->pekerjaan == $data) selected @endif>{{ $row }}</option>
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
                <input type="text" id="no_hp" name="no_hp" class="form-control" value="{{ old('no_hp', isset($member) ? $detail->no_hp : '') }}" required>
                @if($errors->has('no_hp'))
                    <em class="invalid-feedback">
                        {{ $errors->first('no_hp') }}
                    </em>
                @endif
            </div>
            {{-- <div class="col">
                <div class="form-group {{ $errors->has('level') ? 'has-error' : '' }}">
                    <label for="level">{{ trans('cruds.member.fields.level') }}*</label>
                    <select name="level" id="level" class="form-control select2" required style="width: 100%; height:36px;">
                        <option value="">{{ trans('global.pleaseSelect') }}</option>
                        <option value="0" @if($member->status_korlap == 0) selected @endif>Non Korlap</option>
                        <option value="1" @if($member->status_korlap == 1) selected @endif>Korlap</option>
                    </select>
                    @if($errors->has('level'))
                        <em class="invalid-feedback">
                            {{ $errors->first('level') }}
                        </em>
                    @endif
                </div>
            </div> --}}
            <div class="form-group">
                <label for="address">{{ trans('cruds.member.fields.address') }}*</label>
                <textarea class ="form-control" name="address" value="{{ old('alamat', isset($member) ? $member->alamat : '') }}" id="address"> {{ $detail->alamat }} </textarea>
                @if($errors->has('address'))
                    <em class="invalid-feedback">
                        {{ $errors->first('address') }}
                    </em>
                @endif
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group {{ $errors->has('provinsi') ? 'has-error' : '' }}">
                        <label for="provinsi">{{ trans('cruds.member.fields.provinsi') }}*</label>
                        <select name="provinsi" id="provinsi" class="form-control select2" required style="width: 100%; height:36px;">
                            <option value="">{{ trans('global.pleaseSelect') }}</option>
                            @foreach($provinsi as $data => $row)
                                <option value="{{ $data }}" @if($detail->provinsi == $data) selected @endif name="{{ $row }}">{{ $row }}</option>
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
                            <option value="">{{ trans('global.pleaseSelect') }}</option>
                            @foreach($kabupaten as $data => $row)
                                <option value="{{ $data }}" @if($detail->kabupaten == $data) selected @endif name="{{ $row }}">{{ $row }}</option>
                            @endforeach
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
                            <option value="">{{ trans('global.pleaseSelect') }}</option>
                            @foreach($kecamatan as $data => $row)
                                <option value="{{ $data }}" @if($detail->kecamatan == $data) selected @endif name="{{ $row }}">{{ $row }}</option>
                            @endforeach
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
                            <option value="">{{ trans('global.pleaseSelect') }}</option>
                            @foreach($kelurahan as $data => $row)
                                <option value="{{ $data }}" @if($detail->kelurahan == $data) selected @endif name="{{ $row }}">{{ $row }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('kelurahan'))
                            <em class="invalid-feedback">
                                {{ $errors->first('kelurahan') }}
                            </em>
                        @endif
                    </div>
                </div>
            </div>
            {{-- <div class="row">
                <div class="col">
                    <div class="form-group {{ $errors->has('foto_ktp') ? 'has-error' : '' }}">
                        <label for="kode">{{ trans('cruds.member.fields.foto_ktp') }}*</label>
                        <input type="file" id="foto_ktp" name="foto_ktp" class="form-control" value="{{ old('foto_ktp', '') }}">
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
                        <label for="kode">{{ trans('cruds.member.fields.foto_kk') }}*</label>
                        <input type="file" id="foto_kk" name="foto_kk" class="form-control" value="{{ old('foto_kk', '') }}">
                        @if($errors->has('foto_kk'))
                            <em class="invalid-feedback">
                                {{ $errors->first('foto_kk') }}
                            </em>
                        @endif
                        <p class="helper-block">
                        </p>
                    </div>
                </div>
            </div> --}}
            <div class="form-check">
				<input type="checkbox" class="form-check-input" id="check" value="FALSE">
				<label class="form-check-label" for="check">Alamat Sesuai KTP</label>
			</div>
			<br>
			<div class="form-group">
				<label for="alamat_domisili">Alamat Domisili*</label>
                <textarea name="alamat_domisili" id="alamat_domisili" class="form-control" cols="20" rows="10" placeholder="Alamat Domisili">{{ $detail->alamat_domisili }}</textarea>
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
								<option value="{{ $data }}" @if($detail->provinsi_domisili == $data) selected @endif>{{ $row }}</option>
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
                            @foreach($kabupatendomisili as $data => $row)
								<option value="{{ $data }}" @if($detail->kabupaten_domisili == $data) selected @endif>{{ $row }}</option>
							@endforeach
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
                            @foreach($kecamatandomisili as $data => $row)
								<option value="{{ $data }}" @if($detail->kecamatan_domisili == $data) selected @endif>{{ $row }}</option>
							@endforeach
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
                            @foreach($kelurahandomisili as $data => $row)
								<option value="{{ $data }}" @if($detail->kelurahan_domisili == $data) selected @endif>{{ $row }}</option>
							@endforeach
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
                <button class="btn btn-primary" id="save" type="submit">
                    <span class="spinner-border spin-save spinner-border-sm" role="status" aria-hidden="true"></span>
                    <i class="fa fa-save"></i> {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>
@section('scripts')
@parent
<script>
    $(document).ready(function() {
        
            
        $("#check").change(function () {
            var alamat  = $('#address').val();
            var prov    = $('#provinsi').find('option:selected').val();
            var kab     = $('#kabupaten').find('option:selected').val();
            var kec     = $('#kecamatan').find('option:selected').val();
            var kel     = $('#kelurahan').find('option:selected').val();
                    
            var prov_name = $('#provinsi').find('option:selected').attr("name");
            var kab_name = $('#kabupaten').find('option:selected').attr("name");
            var kec_name = $('#kecamatan').find('option:selected').attr("name");
            var kel_name = $('#kelurahan').find('option:selected').attr("name");

            if (this.checked) {
                $('#provinsi_domisili').find('option').remove();
                $('#kabupaten_domisili').find('option').remove();
                $('#kecamatan_domisili').find('option').remove();
                $('#kelurahan_domisili').find('option').remove();
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

    function uppercase(obj){
		obj.value = obj.value.toUpperCase();
	}
</script>
@endsection
@endsection