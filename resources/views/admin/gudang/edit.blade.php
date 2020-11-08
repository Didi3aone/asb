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
                <input class ="form-control" type="hidden" name="gudang_id" id="gudang_id" value="{{ $gudang->id }}">
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
                                <tr id="r_{{ $rows->id }}" data-id="{{ $key +1 }}">
                                    <td>
                                        <input class="form-control" id="rak_{{ $rows->id }}" name="rak[]" value="{{ $rows->name }}" type="text" disabled='disabled' />
                                    </td>
                                    <td>
                                        <button type="button" id="del_{{ $rows->id }}" data-id="{{ $rows->id }}" data-type="rcr" class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i></button>
                                        <button type="button" id="edit_{{ $rows->id }}" data-id="{{ $rows->id }}" data-type="rcr" class="btn btn-warning btn-sm edit"><i class="fa fa-edit"></i></button>
                                    <button type="button" id="update_{{ $rows->id }}" style="display: none;" data-id="{{ $rows->id }}" data-type="rcr" class="btn btn-success btn-sm update"><i class="fa fa-check"></i> </button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr data-id="0">
                                <td>
                                    <input class="form-control" id="rak_0" name="rak[]" value="" type="text" />
                                </td>
                                <td>
                                    <button type="button" id="add_rak" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> </button>
                                    <button type="button" id="save" class="btn btn-success btn-sm" onclick="savePart(0)"><i class="fa fa-check"></i> </button>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div>
                {{-- <button class="btn btn-primary" id="save" type="submit">
                    <span class="spinner-border spin-save spinner-border-sm" role="status" aria-hidden="true"></span>
                    <i class="fa fa-save"></i> {{ trans('global.save') }}
                </button> --}}
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
    
    let index = 1;
    $(document).ready(function () {
        $(".hide").hide();
        $('#add_rak').on('click', function (e) {
            e.preventDefault()
            // if(index <= 4) {
            let html = `
                <tr id="r_${index}" data-id="${index}">
                    <td>
                        <input class="form-control" id="rak_${index}" name="rak[]" value="" type="text" />
                    </td>
                    <td>
                        <button type="button" id="del_${index}" data-id="${index}" data-type="rcr" onclick="this.parentNode.parentNode.remove()" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                        <button type="button" id="edit_${index}" data-id="${index}" data-type="rcr" class="btn btn-warning btn-sm edit"><i class="fa fa-edit"></i></button>
                        <button type="button" id="save_${index}" class="btn btn-success btn-sm" onclick="savePart(${index})"><i class="fa fa-check"></i> </button>
                    </td>
                </tr>
            `
            $('#raks').append(html)
            index++
            // }
        });

        $("table").on("click", ".edit", function (e) {
            e.preventDefault();
            let id = $(this).data('id');
            $('#update_'+id).show();
            // $('#del_'+id).hide();
            $('#edit_'+id).hide();
            $('#rak_'+id).prop('disabled', false);
        });

        $("table").on("click", ".delete", function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            swal({
                title: "Are You Sure?",
                text: "Hapus Rak ini",
                showCancelButton: true,   
                confirmButtonColor: "#DD6B55",   
                confirmButtonText: "Yes",   
                cancelButtonText: "No!",   
                closeOnConfirm: true,   
                closeOnCancel: true,
            });
            /* swal({   
                title: "Are you sure?",       
                text: "Hapus Rak ini ?",     
                showCancelButton: true,   
                confirmButtonColor: "#DD6B55",   
                confirmButtonText: "Yes",   
                cancelButtonText: "No!",   
                closeOnConfirm: true,   
                closeOnCancel: true,
                // type: "input",
                animation: "slide-from-top",
                // inputPlaceholder: "Write reason"
            }, function(isConfirm){
                if (isConfirm) {
                    $.ajax({
                        type: "PUT",
                        url: "{{ route('admin.rak-del-partial') }}",
                        headers: {
                            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            _token: "{{ csrf_token() }}",
                            id : id
                        },
                        dataType:'json',
                        success: function (data) {
                            swal('Info',data.error_msg);
                            $('#r_'+id).remove();
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                }
            }); */
        });

        $("table").on("click", ".update", function (e) {
            e.preventDefault();
            let id = $(this).data('id');
            let rak = $('#rak_'+id).val();

            if(rak == '') {
                swal('Error','{{ trans('cruds.warehouse.fields.rak_val') }}');
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
                    console.log(response);
                    // swal('Info', 'Update Sukses');
                    // $('#update_'+id).hide();
                    // $('#edit_'+id).show();
                    // $('#rak_'+id).prop('disabled', true);
                },
                error: function (response) {
                    swal('info', 'Update Sukses');
                    $('#update_'+id).hide();
                    $('#edit_'+id).show();
                    $('#rak_'+id).prop('disabled', true);
                    console.log('Error:', response);
                }
            });
        });
    });

    function savePart(i) {
        let id = i;
        let gudang_id = $('#gudang_id').val();
        let rak = $('#rak_'+id).val();
        
        if(rak == '') {
            swal('Error','{{ trans('cruds.warehouse.fields.rak_val') }}');
            return false;
        }

        $.ajax({
            url: '{{ route('admin.rak-add-partial') }}',
            type: 'PUT',
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            },
            data: {
                _token: "{{ csrf_token() }}",
                id: id,
                gudang_id: gudang_id,
                rak: rak,
            },
            dataType: 'json',
            success: function(response) {
                console.log(response)
                swal('Info',response.error_msg);
                // $('#reason_'+ type +'_'+id).attr('id', 'reason_'+ type +'_'+response.mpp_id).prop('disabled', true);
                // $('#posisi_'+ type +'_'+id).attr('id', 'posisi_'+ type +'_'+response.mpp_id).prop('disabled', true);
                // $('#jumlah_'+ type +'_'+id).attr('id', 'jumlah_'+ type +'_'+response.mpp_id).prop('disabled', true);
                // $('#status_'+ type +'_'+id).attr('id', 'status_'+ type +'_'+response.mpp_id).prop('disabled', true);
                // $('#triwulan_'+ type +'_'+id).attr('id', 'triwulan_'+ type +'_'+response.mpp_id).prop('disabled', true);
                // $('#level_'+ type +'_'+id).attr('id', 'level_'+ type +'_'+response.mpp_id).prop('disabled', true);
                // $('#from_'+ type +'_'+id).attr('id', 'from_'+ type +'_'+response.mpp_id).prop('disabled', true);
                // $('#to_'+ type +'_'+id).attr('id', 'to_'+ type +'_'+response.mpp_id).prop('disabled', true);
                // $('#note_'+ type +'_'+id).attr('id', 'note_'+ type +'_'+response.mpp_id).prop('disabled', true);
                // $('#budget_'+ type +'_'+id).attr('id', 'budget_'+ type +'_'+response.mpp_id).prop('disabled', true);
                // $('#del_'+ type +'_'+id).attr('data-id',  response.mpp_id);
                // $('#edit_'+ type +'_'+id).attr('data-id',  response.mpp_id);
                // $('#update_'+ type +'_'+id).attr('data-id',  response.mpp_id);
                // $('#del_'+ type +'_'+id).attr('id', 'del_'+ type +'_'+response.mpp_id).show();
                // $('#edit_'+ type +'_'+id).attr('id', 'edit_'+ type +'_'+response.mpp_id).show();
                // $('#update_'+ type +'_'+id).attr('id', 'update_'+ type +'_'+response.mpp_id);
                $('#r_'+ type +'_'+id).attr('id', 'r_'+ type +'_'+response.rak_id);
                $('#remove_'+ type + '_'+id).hide();
                $('#save_'+ type + '_'+id).hide();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    }
</script>
@endsection