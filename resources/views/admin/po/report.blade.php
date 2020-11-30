<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report Purchase Order {{ trans('cruds.transaction-stock.title_singular') }} </title>
    <!-- DataTables -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
</head>
<body>
    <div class="card">
        <div class="card-header">
            <center>Report Purchase Order </center>
        </div>
        <div class="card-body">
            <div class="mb-2">
                <table class="table table-striped" id="table-datatables">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Transaction Number</th>
                            <th scope="col">Supplier</th>
                            <th scope="col">Rincian Barang</th>
                            <th scope="col">qty</th>
                            <th scope="col">Price</th>
                            <th scope="col">PPN</th>
                            <th scope="col">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($po as $key => $rows)
                            <tr>
                                <td>
                                    {{ $key+1 }}
                                </td>
                                <td>
                                    <a href="{{ route('admin.po.show', $rows->id) }}">
                                        {{ $rows->no_po ?? '' }}
                                    </a>
                                </td>
                                <td>
                                    @php
                                        $name = \App\User::getName($rows->supplier_id);
                                    @endphp
                                    {{ $name->name ?? '' }}
                                </td>
                                @php
                                    $dt = \App\DetailPurchase::dt($rows->id);
                                @endphp
                                <td>
                                    @foreach($dt as $key => $datas)
                                    @php
                                        $name = \App\Item::getItem($datas->id_barang);
                                    @endphp
                                    {{ $name->nama }}<br>
                                @endforeach
                                </td>
                                <td>
                                    @foreach($dt as $key => $datas)
                                    {{ $datas->qty }}<br>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($dt as $key => $datas)
                                    @php
                                        $rp = App\DetailPurchase::rupiah($datas->price);
                                    @endphp
                                    {{ $rp }}<br>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($dt as $key => $datas)
                                    @if($datas->ppn == 0)
                                        Tidak
                                    @else
                                        Ya
                                    @endif
                                    <br>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($dt as $key => $datas)
                                    @php
                                        $rp = App\DetailPurchase::rupiah($datas->total);
                                    @endphp
                                    {{ $rp }}<br>
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td>
                                Total
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                {{ $detail->totqty }}
                            </td>
                            <td>
                                @php
                                    $rp = App\DetailPurchase::rupiah($detail->totprice);
                                @endphp
                                {{ $rp }}
                            </td>
                            <td></td>
                            <td>@php
                                    $rp = App\DetailPurchase::rupiah($detail->grandtot);
                                @endphp
                                {{ $rp }}
                            </td>
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