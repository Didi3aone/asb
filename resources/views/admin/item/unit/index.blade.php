@extends('layouts.admin')
@section('content')
@can('item_unit_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-primary float-right" href="{{ route("admin.item-unit.create") }}">
                <i class="fa fa-plus"></i> {{ trans('global.add') }} {{ trans('cruds.item-unit.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.item-unit.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.item-unit.fields.nama') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($itemUnit as $key => $itemUnits)
                        <tr data-entry-id="{{ $itemUnits->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $itemUnits->nama ?? '' }}
                            </td>
                            <td>
                                @can('item_unit_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.item-unit.show', $itemUnits->id) }}">
                                        <i class="fa fa-eye"></i> {{ trans('global.view') }}
                                    </a>
                                @endcan
                                @can('item_unit_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.item-unit.edit', $itemUnits->id) }}">
                                        <i class="fa fa-edit"></i> {{ trans('global.edit') }}
                                    </a>
                                @endcan
                                @can('item_unit_delete')
                                    
                                    <form action="{{ route('admin.item-unit.destroy', $itemUnits->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@section('scripts')
@parent
<script>
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