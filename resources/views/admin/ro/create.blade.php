@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header bg-warning">
        {{ trans('global.create') }} {{ trans('cruds.request-order.title_singular') }}
    </div>

    <div class="card-body">
        <form class="form-material mt-4" action="{{ route("admin.transaksi.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="tipe" value="1">
            <div class="form-group {{ $errors->has('nomor_ijin') ? 'has-error' : '' }}">
                {{-- <label for="nomor_ijin">{{ trans('cruds.request-order.fields.nomor_ijin') }}*</label> --}}
                <label for="nomor_ijin">No Request*</label>
                <input type="text" id="nomor_ijin" name="nomor_ijin" class="form-control" value="{{ old('nomor_ijin', '') }}">
                @if($errors->has('nomor_ijin'))
                    <em class="invalid-feedback">
                        {{ $errors->first('nomor_ijin') }}
                    </em>
                @endif
                <p class="helper-block">

                </p>
            </div>
            <div class="form-group {{ $errors->has('gudang_id') ? 'has-error' : '' }}">
                {{-- <label for="roles">{{ trans('cruds.request-order.fields.gudang_id') }}*</label> --}}
                <label for="roles">Program ID *</label>
                <select name="gudang_id" id="gudang_id" class="form-control select2" required style="width: 100%; height:36px;">
                    <option value="">{{ trans('global.pleaseSelect') }}</option>
                    @foreach($program as $id => $gd)
                        <option value="{{ $id }}">{{ $gd }}</option>
                    @endforeach
                </select>
                @if($errors->has('gudang_id'))
                    <em class="invalid-feedback">
                        {{ $errors->first('gudang_id') }}
                    </em>
                @endif
                <p class="helper-block">
                </p>
            </div>
            <br>
            <div class="form-group">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>{{ trans('cruds.request-order.fields.member') }}</th>
                            <th>{{ trans('cruds.request-order.fields.receive') }}</th>
                            <th>{{ trans('cruds.request-order.fields.receive_date') }}</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody id="items">
                    <tr>
                        <td>
                            <select name="member[]" id="member_0" class="form-control select2" required style="width: 100%; height:36px;">
                                <option value="">{{ trans('global.pleaseSelect') }}</option>
                                @foreach($member as $id => $it)
                                    <option value="{{ $id }}">{{ $it }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('member'))
                                <em class="invalid-feedback">
                                    {{ $errors->first('member') }}
                                </em>
                            @endif
                            <p class="helper-block">
                            </p>
                        </td>
                        <td>
                            <input type="checkbox" id="receive_0" name="receive[]">
                            {{-- <input type="text" id="receive_0" name="receive[]" onkeypress="return isNumber(event)" class="form-control" value="{{ old('receive', '') }}">
                            @if($errors->has('receive'))
                                <em class="invalid-feedback">
                                    {{ $errors->first('receive') }}
                                </em>
                            @endif --}}
                        </td>
                        <td>
                            <input type="text" id="receive_date_0" name="receive_date[]" class="form-control date" value="{{ old('receive_date', date('Y-m-d')) }}">
                            @if($errors->has('receive_date'))
                                <em class="invalid-feedback">
                                    {{ $errors->first('receive_date') }}
                                </em>
                            @endif
                        </td>
                        <td>
                            <button type="button" id="add_item" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div>
                <button class="btn btn-primary" id="save" type="submit">
                    <span class="spinner-border spin-save spinner-border-sm" role="status" aria-hidden="true"></span>
                    <i class="fa fa-save"></i> {{ trans('global.save') }}
                </button>
                <a href="{{ route('admin.ro.index') }}" class="btn btn-default"> 
                    <i class="fa fa-arrow-left"> {{ trans('global.back_to_list') }}</i>
                </a>
            </div>
        </form>


    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $("body").on("click",".btn-remove",function(){
        $(this).parents(".control-group").remove();
    });
    let index = 1
    $(document).ready(function () {
        $('#add_item').on('click', function (e) {
            e.preventDefault()

            let html = `
                    <tr data-id="${index}">
                        <td>
                            <select name="member[]" id="member_${index}" class="form-control select2" required style="width: 100%; height:36px;">
                                <option value="">{{ trans('global.pleaseSelect') }}</option>
                                @foreach($member as $id => $it)
                                    <option value="{{ $id }}">{{ $it }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('member'))
                                <em class="invalid-feedback">
                                    {{ $errors->first('member') }}
                                </em>
                            @endif
                            <p class="helper-block">
                            </p>
                        </td>
                        <td>
                            <input type="checkbox" id="receive_${index}" name="receive[]">
                        </td>
                        <td>
                            <input type="text" id="receive_date_${index}" name="receive_date" class="form-control" value="{{ old('receive_date', '') }}">
                            @if($errors->has('receive_date'))
                                <em class="invalid-feedback">
                                    {{ $errors->first('receive_date') }}
                                </em>
                            @endif
                        </td>
                        <td>
                            <a href="javascript:;" class="remove-item btn btn-danger btn-sm" onclick="this.parentNode.parentNode.remove()">
                                <i class="fa fa-times"></i>
                            </a>
                        </td>
                    </tr>
            `
            listStartDate(index)
            $('#items').append(html)
            $('.select2').select2();
            index++
        })
    })
    
    function listStartDate (i) {
        const $start = $('#receive_date_'+ i);
        var dateNow = new Date();
        
        $start.datetimepicker({
            defaultDate:dateNow
        });
    }
</script>
@endsection