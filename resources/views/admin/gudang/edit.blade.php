@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.warehouse.title_singular') }}
    </div>

    <div class="card-body">
        <form class="form-material mt-4" action="{{ route("admin.gudang.update", $gudang->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('nama_gudang') ? 'has-error' : '' }}">
                <label for="nama_gudang">{{ trans('cruds.warehouse.fields.name') }}*</label>
                <input type="text" id="name" name="nama_gudang" class="form-control" value="{{ $gudang->nama_gudang }}">
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
                        <th>
                            @if(count($rak) > 0)
                                <button type="button" id="add_rak" class="btn btn-primary btn-sm">
                                    <i class="fa fa-plus"></i>
                                </button>
                            @else
                                &nbsp;
                            @endif
                        </th>
                    </tr>
                    </thead>
                    <tbody id="raks">
                        @if(count($rak) > 0)
                            @foreach ($rak as $key => $rows)
                                <tr id="r_rcr_{{ $rows->id }}" data-id="{{ $key +1 }}">
                                    <td>
                                        <input class="form-control" id="rak_{{ $rows->id }}" name="rak[]" value="{{ $rows->name }}" type="text" disabled='disabled' />
                                    </td>
                                    <td>
                                        <button type="button" id="del_rcr_{{ $rows->id }}" data-id="{{ $rows->id }}" data-type="rcr" class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i></button>
                                        <button type="button" id="edit_rcr_{{ $rows->id }}" data-id="{{ $rows->id }}" data-type="rcr" class="btn btn-warning btn-sm edit"><i class="fa fa-edit"></i></button>
                                    <button type="button" id="update_rcr_{{ $rows->id }}" style="display: none;" data-id="{{ $rows->id }}" data-type="rcr" class="btn btn-success btn-sm update"><i class="fa fa-check"></i> </button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr data-id="0">
                                <td>
                                    <input class="form-control" id="rak_0" name="rak[]" value="{{ $rows->name }}" type="text" disabled='disabled' />
                                </td>
                                <td>
                                    <button type="button" id="add_rcr" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> </button>
                                    <button type="button" id="save_rcr" class="btn btn-success btn-sm" onclick="savePart(0,'rcr')"><i class="fa fa-check"></i> </button>
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
    let index = 1;
    $(document).ready(function () {
        $(".hide").hide();
        $('#add_rak').on('click', function (e) {
            e.preventDefault()
            // if(index <= 4) {
            let html = `
                <tr id="r_rcr_${index}" data-id="${index}">
                    <td>
                        <input class="form-control" id="rak_{{ $rows->id }}" name="rak[]" value="" type="text" />
                    </td>
                    <td>
                        <button type="button" id="del_rcr_{{ $rows->id }}" data-id="{{ $rows->id }}" data-type="rcr" class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i></button>
                        <button type="button" id="edit_rcr_{{ $rows->id }}" data-id="{{ $rows->id }}" data-type="rcr" class="btn btn-warning btn-sm edit"><i class="fa fa-edit"></i></button>
                    <button type="button" id="update_rcr_{{ $rows->id }}" style="display: none;" data-id="{{ $rows->id }}" data-type="rcr" class="btn btn-success btn-sm update"><i class="fa fa-check"></i> </button>
                    </td>
                </tr>
            `
            $('#add_recrut').append(html)
            $('.select2').select2();
            listLevelRcr(index)
            
            index++
            // }
        });

        $("table").on("click", ".update", function (e) {
            e.preventDefault();
            let id = $(this).data('id');
            let rak = $('#rak_'+id).val();

            if(rak == '' || budget == 0) {
                swal('Error','budget empty');
                return false;
            }
            $.ajax({
                url: '{{ route('admin.rak-update-partial') }}',
                type: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    _token: "{{ csrf_token() }}",
                    id : id,
                    rak: rak,
                },
                dataType: 'json',
                success: function(response) {
                    swal('Info',response.error_msg);
                    $('#update_'+id).hide();
                    $('#edit_'+id).show();
                    $('#rak_'+id).prop('disabled', true);
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });
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