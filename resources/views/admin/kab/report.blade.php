<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> {{ trans('global.report') }} {{ trans('cruds.kabupaten.title_singular') }} {{ $title->name }}</title>
    <!-- DataTables -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
</head>
<body>
    <div class="card">
        <div class="card-header">
        <center> {{ trans('global.report') }} {{ trans('cruds.kabupaten.title_singular') }} {{ $title->name }}</center>
        </div>
        <div class="card-body">
            <div class="mb-2">
                <table class="table table-striped" id="table-datatables">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th>
                                {{ trans('cruds.member.fields.no') }}
                            </th>
                            <th>
                                {{ trans('cruds.member.fields.nama') }}
                            </th>
                            <th>
                                {{ trans('cruds.member.fields.nik') }}
                            </th>
                            <th>
                                {{ trans('cruds.member.fields.hp') }}
                            </th>
                            <th>
                                {{ trans('cruds.member.fields.email') }}
                            </th>
                            <th>
                                {{ trans('cruds.member.fields.level_member') }}
                            </th>
                            <th>
                                {{ trans('cruds.member.fields.created_at') }}
                            </th>
                            <th>
                                {{ trans('cruds.member.fields.is_active') }}
                            </th>
                            <th>
                                {{ trans('cruds.kabupaten.title_singular') }}
                            </th>
                            {{-- 
                            <th>
                                {{ trans('cruds.provinsi.title_singular') }}
                            </th>
                            <th>
                                {{ trans('cruds.kecamatan.title_singular') }}
                            </th>
                            <th>
                                {{ trans('cruds.kelurahan.title_singular') }}
                            </th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($report as $key => $rows)
                            <tr>
                                <td>
                                    {{ $key+1 }}
                                </td>
                                <td>
                                    @php
                                        $kec = str_pad($rows->kecid,4,"0",STR_PAD_LEFT);   
                                    @endphp
                                    <a href="{{ route('admin.master-member.show', $rows->userid) }}" target="_blank">
                                        {{ $rows->provid ?? '-' }}.{{ $kec ?? '-' }}.{{ $rows->no_member ?? '-' }}
                                    </a>
                                </td>
                                <td>
                                    {{ $rows->name ?? '-' }}
                                </td>
                                <td>
                                    {{ $rows->nik ?? '-' }}
                                </td>
                                <td>
                                    {{ $rows->no_hp ?? '-' }}
                                </td>
                                <td>
                                    {{ $rows->email ?? '-' }}
                                </td>
                                <td>
                                    @if ($rows->status_korlap == 0)
                                        Anggota
                                    @elseif ($rows->status_korlap == 1)
                                        Korlap
                                    @endif
                                </td>
                                <td>
                                    {{ $rows->created_at ?? '-' }}
                                </td>
                                <td>
                                    @if($rows->is_active == 1)
                                        {{ trans('cruds.member.fields.active') }}
                                    @elseif($rows->is_active == 0)
                                        {{ trans('cruds.member.fields.inactive') }}
                                    @endif
                                </td>
                                <td>
                                    {{ $rows->kabname ?? '' }}
                                </td>
                                {{-- 
                                <td>
                                    {{ $rows->provname ?? '' }}
                                </td>
                                <td>
                                    {{ $rows->kecname ?? '' }}
                                </td>
                                <td>
                                    {{ $rows->kelname ?? '' }}
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
    <script type="text/javascript"> 
        $(document).ready(function () {
            $('#table-datatables').DataTable({
                dom: 'Bfrtip',
                searching: false,
                paging: false,
                buttons: ['csv', 'excel']
            });
        });
    </script>
</body>
</html>