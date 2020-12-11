<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report Transaksi {{ trans('cruds.transaction-stock.title_singular') }} </title>
    <!-- DataTables -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
</head>
<body>
    <div class="card">
        <div class="card-header">
            <center>Report {{ trans('cruds.transaction-stock.title_singular') }} </center>
        </div>
        <div class="card-body">
            <div class="mb-2">
                {{-- <div class="float-right">
                    Download File : <button name="create_excel" id="create_excel" class="btn btn-success">Excel Export</button><br><br>
                </div> --}}
                <table class="table table-striped" id="table-datatables">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">{{ trans('cruds.transaction-stock.fields.nomor_transaksi') }}</th>
                            <th scope="col">{{ trans('cruds.transaction-stock.fields.gudang_id') }}</th>
                            <th scope="col">{{ trans('cruds.transaction-stock.fields.rak_id') }}</th>
                            <th scope="col">{{ trans('cruds.transaction-stock.fields.barang_id') }}</th>
                            <th scope="col">{{ trans('cruds.transaction-stock.fields.in') }}</th>
                            <th scope="col">{{ trans('cruds.transaction-stock.fields.out') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @php
                            echo "<pre>";
                                print_r($report);
                            echo "</pre>";
                        @endphp --}}
                        @foreach($report as $key => $rows)
                            <tr>
                                <td>
                                    {{ $key+1 }}
                                </td>
                                <td>
                                    {{ $rows->nomor_ijin ?? '' }}
                                </td>
                                <td>
                                    {{ $rows->nama_gudang ?? '' }}
                                </td>
                                <td>
                                    {{ $rows->rak_id ?? '' }}
                                </td>
                                @php
                                    $dt = \App\TransaksiStokDetail::dt($rows->id);
                                @endphp
                                <td>
                                    @foreach($dt as $key => $datas)
                                        @php
                                            $name = \App\Item::getItem($datas->barang_id);
                                        @endphp
                                        {{ $name->nama }}<br>
                                    @endforeach
                                </td>
                                @if($rows->tipe == 1)
                                <td>
                                    @foreach($dt as $key => $datas)
                                    {{ $datas->qty }}<br>
                                    @endforeach
                                </td>
                                @else
                                <td>
                                    0
                                </td>
                                @endif
                                @if($rows->tipe == 2)
                                    <td>
                                        @foreach($dt as $key => $datas)
                                        {{ $datas->qty }}<br>
                                        @endforeach
                                    </td>
                                    @else
                                    <td>
                                        0
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        <tr>
                            <td><b>Total</b></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>{{ $sumIn->income }}</td>
                            <td>{{ $sumOut->outcome }}</td>
                        </tr>
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