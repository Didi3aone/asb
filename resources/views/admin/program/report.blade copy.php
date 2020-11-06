@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        Report {{ trans('cruds.program.title_singular') }} - {{ $program->name }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Nama Program</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Barang</th>
                    </tr>
                </thead>
                <tbody>
                   @foreach($report as $key => $rows)
                        <tr>
                            <td>
                                {{ $key+1 }}
                            </td>
                            <td>
                                {{ $rows->name ?? '' }}
                            </td>
                            <td>
                                {{ $rows->description ?? '' }}
                            </td>
                            <td>
                                {{ $rows->nama ?? '' }}
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
    });

    $('#report').on('click', function () {
        var start   = $("#start").val();
        var end     = $("#end").val();
        var type    = $("#type").val();
        if(type == '') {
			swal("Error","{{ trans('cruds.program.fields.reporttype') }}");
			return false;
		}
        window.open("{{ route('admin.report-program') }}?start="+ start +"&end="+ end +"&type="+ type);
    });

</script>
@endsection
@endsection