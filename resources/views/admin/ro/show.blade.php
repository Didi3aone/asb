@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Show Request Order
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            Name
                        </th>
                        <td>
                            {{ $ro->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Start Date
                        </th>
                        <td>
                            {{ $ro->start_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            End Date
                        </th>
                        <td>
                            {{ $ro->end_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Description
                        </th>
                        <td>
                            {{ $ro->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Created By
                        </th>
                        <td>
                            {{ $ro->created_by }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Provinsi
                        </th>
                        <td>
                            Provinsi
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Kabupaten / Kota
                        </th>
                        <td>
                            Kabupaten
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Kecamatan
                        </th>
                        <td>
                            Kecamatan
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Kelurahan
                        </th>
                        <td>
                            Kelurahan
                        </td>
                    </tr>
                    
                </tbody>
            </table>
            <h2>Detail Penerima</h2>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>
                            NIK
                        </th>
                        <th>
                            No. KK 
                        </th>
                        <th>
                            Nama Penerima 
                        </th>
                        <th>
                            No. Telp 
                        </th>
                        <th>
                            No. Handphone 
                        </th>
                        <th>
                            Email 
                        </th>
                        <th>
                            Pekerjaan
                        </th>
                    </tr>
                </thead>
                <tbody>
                    
                </thead>
            </table>
            <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>
        

        <nav class="mb-3">
            <div class="nav nav-tabs">

            </div>
        </nav>
        <div class="tab-content">

        </div>
    </div>
</div>
@endsection