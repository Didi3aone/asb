<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report Program {{ trans('cruds.program.title_singular') }} - {{ $program->name }}</title>
    <!-- DataTables -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
</head>
<body>
    <div class="card">
        <div class="card-header">
            <center>Report {{ trans('cruds.program.title_singular') }} - {{ $program->name }}</center>
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