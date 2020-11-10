@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.warehouse.title_singular') }}
    </div>

    <div class="card-body">
        <form class="form-material mt-4" action="{{ route("admin.gudang.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('nama_gudang') ? 'has-error' : '' }}">
                <label for="nama_gudang">{{ trans('cruds.warehouse.fields.name') }}*</label>
                <input type="text" id="name" name="nama_gudang" class="form-control" value="{{ old('nama_gudang', '') }}">
                @if($errors->has('nama_gudang'))
                    <em class="invalid-feedback">
                        {{ $errors->first('nama_gudang') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.permission.fields.title_helper') }}
                </p>
            </div>
            <div class="form-group">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>{{ trans('cruds.warehouse.fields.rak') }}</th>
                        <th>&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody id="raks">
                    <tr>
                        <td>
                            <input type="text" id="rak_0" name="rak[]" class="form-control" value="" style="width: 100%; height:36px;">
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
                <a href="{{ route('admin.gudang.index') }}" class="btn btn-default"> 
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
                            <input type="text" id="rak_${index}" name="rak[]" class="form-control" value="" style="width: 100%; height:36px;">
                        </td>
                        <td>
                            <a href="javascript:;" class="remove-item btn btn-danger btn-sm" onclick="this.parentNode.parentNode.remove()">
                                <i class="fa fa-times"></i>
                            </a>
                        </td>
                    </tr>
            `

            $('#raks').append(html)
            index++
        })
    })
</script>
@endsection