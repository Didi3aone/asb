@extends('layouts.admin')
@section('content')
@can('customer_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-primary float-right" href="{{ route("admin.kelurahan.create") }}">
                <i class="fa fa-plus"></i> {{ trans('global.add') }} {{ trans('cruds.kelurahan.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.kelurahan.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable" id="kel">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.kelurahan.fields.nama') }}
                        </th>
                        <th>
                            Kecamatan
                        </th>
                        <th>
                            {{ trans('cruds.kelurahan.fields.active') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach($kel as $key => $rows)
                        <tr data-entry-id="{{ $rows->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $rows->name ?? '' }}
                            </td>
                            <td>
                                
                            </td>
                            <td>
                                
                            </td>
                            <td>
                                @can('customer_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.kelurahan.show', $rows->id) }}">
                                        <i class="fa fa-eye"></i> {{ trans('global.view') }}
                                    </a>
                                @endcan
                                @can('customer_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.kelurahan.edit', $rows->id) }}">
                                        <i class="fa fa-edit"></i> {{ trans('global.edit') }}
                                    </a>
                                @endcan
                                @can('customer_delete')
                                    
                                    <form action="{{ route('admin.kelurahan.destroy', $rows->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-xs btn-danger">
                                            <i class="fa fa-trash"></i> 
                                            {{ trans('global.delete') }}
                                        </button>
                                    </form>
                                @endcan
                            </td>

                        </tr>
                    @endforeach --}}
                </tbody>
            </table>
        </div>
    </div>
</div>
@section('scripts')
@parent
<script>
    $(document).ready( function () {
    $('#kel').DataTable({
           destroy: true,
           processing: true,
           serverSide: true,
           ajax: "{{ url('admin/kel-json') }}",
           columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'kec_name', name: 'kec_name' },
                    { data: 'is_active', name: 'is_active' },
                    { data: 'created_at', name: 'created_at' }
                 ]
        });
    });
    $(function () {
        let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
        let deleteButton = {
            text: deleteButtonTrans,
            url: "{{ route('admin.permissions.massDestroy') }}",
            className: 'btn-danger',
            action: function (e, dt, node, config) {
                var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
                    return $(entry).data('entry-id')
                });
                if (ids.length === 0) {
                    alert('{{ trans('global.datatables.zero_selected') }}')
                    return
                }
                if (confirm('{{ trans('global.areYouSure') }}')) {
                    $.ajax({
                    headers: {'x-csrf-token': _token},
                    method: 'POST',
                    url: config.url,
                    data: { ids: ids, _method: 'DELETE' }})
                    .done(function () { location.reload() })
                }
            }
        }
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
        @can('gudang_delete')
        dtButtons.push(deleteButton)
        @endcan
        $('.datatable:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    })

</script>
@endsection
@endsection