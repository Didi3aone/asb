@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.program.title_singular') }}
    </div>

    <div class="card-body">
        <form class="form-material mt-4" action="{{ route("admin.program.update", $program->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="form-group {{ $errors->has('nama') ? 'has-error' : '' }}">
                <label for="nama">{{ trans('cruds.program.fields.nama') }}*</label>
                <input type="text" id="nama" name="nama" class="form-control" value="{{ $program->name }}">
                @if($errors->has('nama'))
                    <em class="invalid-feedback">
                        {{ $errors->first('nama') }}
                    </em>
                @endif
                <p class="helper-block">

                </p>
            </div>
            <div class="form-group {{ $errors->has('start_date') ? 'has-error' : '' }}">
                <label for="start_date">{{ trans('cruds.program.fields.start_date') }}*</label>
                <input type="text" id="start_date" name="start_date" class="form-control date" value="{{ $program->start_date }}">
                @if($errors->has('start_date'))
                    <em class="invalid-feedback">
                        {{ $errors->first('start_date') }}
                    </em>
                @endif
                <p class="helper-block">

                </p>
            </div>
            <div class="form-group {{ $errors->has('end_date') ? 'has-error' : '' }}">
                <label for="end_date">{{ trans('cruds.program.fields.end_date') }}*</label>
                <input type="text" id="end_date" name="end_date" class="form-control date" value="{{ $program->end_date }}">
                @if($errors->has('end_date'))
                    <em class="invalid-feedback">
                        {{ $errors->first('end_date') }}
                    </em>
                @endif
                <p class="helper-block">

                </p>
            </div>
            <div class="form-group {{ $errors->has('desc') ? 'has-error' : '' }}">
                <label for="desc">{{ trans('cruds.program.fields.desc') }}*</label>
                <textarea class ="form-control" name="desc" value="" id="desc"> {{ $program->description }} </textarea>
                @if($errors->has('desc'))
                    <em class="invalid-feedback">
                        {{ $errors->first('desc') }}
                    </em>
                @endif
                <p class="helper-block">

                </p>
            </div>
            
            <div class="form-group">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>{{ trans('cruds.transaction-stock.fields.barang_id') }}</th>
                        {{-- <th>{{ trans('cruds.transaction-stock.fields.qty') }}</th>
                        <th>{{ trans('cruds.transaction-stock.fields.nomor_sparepart') }}</th> --}}
                        @if(count($detail) > 0)
                            <th>
                                <button type="button" id="add_item" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> </button>
                            </th>
                        @else
                            <th>&nbsp;</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody id="items">
                    @if(count($detail) > 0)
                        @foreach ($detail as $key => $rows)
                            <tr>
                                <td>
                                    <input id="id_detail_0" name="id_detail[]" type="hidden" value="{{ $rows->id }}" />
                                    <select name="id_barang[]" id="id_barang_0" class="form-control select2" required style="width: 100%; height:36px;">
                                        <option value="">{{ trans('global.pleaseSelect') }}</option>
                                        @foreach($item as $id => $it)
                                            <option value="{{ $id }}" @if($rows->id_barang == $id) selected @endif>{{ $it }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('gudang_id'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('gudang_id') }}
                                        </em>
                                    @endif
                                    <p class="helper-block">
                                    </p>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td>
                                <select name="id_barang[]" id="id_barang_0" class="form-control select2" required style="width: 100%; height:36px;">
                                    <option value="">{{ trans('global.pleaseSelect') }}</option>
                                    @foreach($item as $id => $it)
                                        <option value="{{ $id }}">{{ $it }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('gudang_id'))
                                    <em class="invalid-feedback">
                                        {{ $errors->first('gudang_id') }}
                                    </em>
                                @endif
                                <p class="helper-block">
                                </p>
                            </td>
                            <td>
                                <button type="button" id="add_item" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> </button>
                            </td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
            <div>
                <button class="btn btn-primary" id="save" type="submit">
                    <span class="spinner-border spin-save spinner-border-sm" role="status" aria-hidden="true"></span>
                    <i class="fa fa-save"></i> {{ trans('global.save') }}
                </button>
                <a href="{{ route('admin.program.index') }}" class="btn btn-default"> 
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
                            <select name="id_barang[]" id="id_barang_${index}" class="form-control select2" required style="width: 100%; height:36px;">
                                <option value="">{{ trans('global.pleaseSelect') }}</option>
                                @foreach($item as $id => $it)
                                    <option value="{{ $id }}">{{ $it }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('id_barang'))
                                <em class="invalid-feedback">
                                    {{ $errors->first('id_barang') }}
                                </em>
                            @endif
                            <p class="helper-block">
                            </p>
                        </td>
                        <td>
                            <a href="javascript:;" class="remove-item btn btn-danger btn-sm" onclick="this.parentNode.parentNode.remove()">
                                <i class="fa fa-times"></i>
                            </a>
                        </td>
                    </tr>
            `

            $('#items').append(html)
            $('.select2').select2();
            index++
        })
    })
</script>
@endsection