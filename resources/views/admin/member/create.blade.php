@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.member.title_singular') }}
    </div>

    <div class="card-body">
        <form class="form-material mt-4" action="{{ route("admin.master-member.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">{{ trans('cruds.member.fields.nama') }}*</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($user) ? $user->name : '') }}" required>
                @if($errors->has('name'))
                    <em class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </em>
                @endif
            </div>
            <div class="form-group {{ $errors->has('nickname') ? 'has-error' : '' }}">
                <label for="nickname">{{ trans('cruds.member.fields.nickname') }}*</label>
                <input type="text" id="nickname" name="nickname" class="form-control" value="{{ old('nickname', isset($user) ? $user->nickname : '') }}" required>
                @if($errors->has('nickname'))
                    <em class="invalid-feedback">
                        {{ $errors->first('nickname') }}
                    </em>
                @endif
            </div>
            <div class="form-group {{ $errors->has('nik') ? 'has-error' : '' }}">
                <label for="nik">{{ trans('cruds.member.fields.nik') }}*</label>
                <input type="text" id="nik" name="nik" class="form-control" value="{{ old('nik', isset($user) ? $user->nik : '') }}" required>
                @if($errors->has('nik'))
                    <em class="invalid-feedback">
                        {{ $errors->first('nik') }}
                    </em>
                @endif
            </div>
            <div class="form-group {{ $errors->has('nik') ? 'has-error' : '' }}">
                <label for="nik">No. KK*</label>
                <input type="text" id="nik" name="nik" class="form-control" value="{{ old('nik', isset($user) ? $user->nik : '') }}" required>
                @if($errors->has('nik'))
                    <em class="invalid-feedback">
                        {{ $errors->first('nik') }}
                    </em>
                @endif
            </div>
            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                <label for="email">{{ trans('cruds.member.fields.email') }}*</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email', isset($user) ? $user->email : '') }}" required>
                @if($errors->has('email'))
                    <em class="invalid-feedback">
                        {{ $errors->first('email') }}
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
            <div class="row">
                <div class="col">
                    <div class="form-group {{ $errors->has('gender') ? 'has-error' : '' }}">
                        <label for="gender">{{ trans('cruds.member.fields.gender') }}*</label>
                        <select name="gender" id="gender" class="form-control select2" required style="width: 100%; height:36px;">
                            <option value="">{{ trans('global.pleaseSelect') }}</option>
                            <option value="0">Perempuan</option>
                            <option value="1">Laki-Laki</option>
                        </select>
                        @if($errors->has('gender'))
                            <em class="invalid-feedback">
                                {{ $errors->first('gender') }}
                            </em>
                        @endif
                    </div>
                </div>
                <div class="col">
                    <div class="form-group {{ $errors->has('marital_status') ? 'has-error' : '' }}">
                        <label for="marital_status">{{ trans('cruds.member.fields.marital_status') }}*</label>
                        <select name="marital" id="marital" class="form-control select2" required style="width: 100%; height:36px;">
                            <option value="">{{ trans('global.pleaseSelect') }}</option>
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
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group {{ $errors->has('no_telp') ? 'has-error' : '' }}">
                        <label for="no_telp">{{ trans('cruds.member.fields.telp') }}*</label>
                        <input type="text" id="no_telp" name="no_telp" class="form-control" value="{{ old('no_telp', isset($user) ? $user->no_telp : '') }}" required>
                        @if($errors->has('no_telp'))
                            <em class="invalid-feedback">
                                {{ $errors->first('no_telp') }}
                            </em>
                        @endif
                    </div>
                </div>
                <div class="col">
                    <div class="form-group {{ $errors->has('no_hp') ? 'has-error' : '' }}">
                        <label for="no_hp">{{ trans('cruds.member.fields.hp') }}*</label>
                        <input type="text" id="no_hp" name="no_hp" class="form-control" required>
                        @if($errors->has('no_hp'))
                            <em class="invalid-feedback">
                                {{ $errors->first('no_hp') }}
                            </em>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col">
                    <div class="form-group {{ $errors->has('job') ? 'has-error' : '' }}">
                        <label for="job">{{ trans('cruds.member.fields.job') }}*</label>
                        <select name="job" id="job" class="form-control select2" required style="width: 100%; height:36px;">
                            <option value="">{{ trans('global.pleaseSelect') }}</option>
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
                <div class="col">
                    <div class="form-group {{ $errors->has('level') ? 'has-error' : '' }}">
                        <label for="level">{{ trans('cruds.member.fields.level') }}*</label>
                        <select name="level" id="level" class="form-control select2" required style="width: 100%; height:36px;">
                            <option value="">{{ trans('global.pleaseSelect') }}</option>
                            <option value="0">Non Korlap</option>
                            <option value="1">Korlap</option>
                        </select>
                        @if($errors->has('level'))
                            <em class="invalid-feedback">
                                {{ $errors->first('level') }}
                            </em>
                        @endif
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="address">{{ trans('cruds.member.fields.address') }}*</label>
                <textarea class ="form-control" name="address" value="{{ old('alamat', isset($user) ? $member->alamat : '') }}" id="address"> </textarea>
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
                                <option value="{{ $data }}" >{{ $row }}</option>
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
                        <select name="kabupaten" id="kabupaten" class="form-control select2" required style="width: 100%; height:36px;" disabled>
                            <option value="">{{ trans('global.pleaseSelect') }}</option>
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
                        <select name="kecamatan" id="kecamatan" class="form-control select2" required style="width: 100%; height:36px;" disabled>
                            <option value="">{{ trans('global.pleaseSelect') }}</option>
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
                        <select name="kelurahan" id="kelurahan" class="form-control select2" required style="width: 100%; height:36px;" disabled>
                            <option value="">{{ trans('global.pleaseSelect') }}</option>
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
    $("#provinsi").change(function() {
        let val = $(this).val();
        $.ajax({
            url: '{{ route('admin.get-kab') }}',
            data: {
                val : val
            },
            dataType:'json',
            type:'GET',
            success: function(response) {
                var len = response.length;
                $("#kabupaten").prop('disabled', false);
                if(len > 1) {
                    for( var i = 0; i<len; i++){
                        var code = response[i]['id_kab'];
                        var name = response[i]['name'];
                        $("#kabupaten").append("<option value='"+code+"'>"+name+"</option>");
                    }
                }
            }
        });
    });

    $("#kabupaten").change(function() {
        let val = $(this).val();
        $.ajax({
            url: '{{ route('admin.get-kec') }}',
            data: {
                val : val
            },
            dataType:'json',
            type:'GET',
            success: function(response) {
                var len = response.length;
                $("#kecamatan").prop('disabled', false);
                if(len > 1) {
                    for( var i = 0; i<len; i++){
                        var code = response[i]['id_kec'];
                        var name = response[i]['name'];
                        $("#kecamatan").append("<option value='"+code+"'>"+name+"</option>");
                    }
                }
            }
        });
    });

    $("#kecamatan").change(function() {
        let val = $(this).val();
        $.ajax({
            url: '{{ route('admin.get-kel') }}',
            data: {
                val : val
            },
            dataType:'json',
            type:'GET',
            success: function(response) {
                var len = response.length;
                $("#kelurahan").prop('disabled', false);
                if(len > 1) {
                    for( var i = 0; i<len; i++){
                        var code = response[i]['id_kel'];
                        var name = response[i]['name'];
                        $("#kelurahan").append("<option value='"+code+"'>"+name+"</option>");
                    }
                }
            }
        });
    });
</script>
@endsection
@endsection