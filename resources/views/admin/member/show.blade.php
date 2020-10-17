@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Show Member
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
                            {{ $member->nama }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            NIK
                        </th>
                        <td>
                            {{ $member->nik }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            No. Telp
                        </th>
                        <td>
                            {{ $member->no_telp }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            No. HP
                        </th>
                        <td>
                            {{ $member->no_hp }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Email
                        </th>
                        <td>
                            {{ $member->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Alamat
                        </th>
                        <td>
                            {{ $member->alamat }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Provinsi
                        </th>
                        <td>
                            @php
                                $name = \App\Provinsi::getProv($member->provinsi);
                            @endphp
                            {{ $name->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Kabupaten/Kota
                        </th>
                        <td>
                            @php
                                $name = \App\Kabupaten::getKab($member->kabupaten);
                            @endphp
                            {{ $name->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Kecamatan
                        </th>
                        <td>
                            @php
                                $name = \App\Kecamatan::getKec($member->kecamatan);
                            @endphp
                            {{ $name->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Kelurahan
                        </th>
                        <td>
                            @php
                                $name = \App\Kelurahan::getKel($member->kelurahan);
                            @endphp
                            {{ $name->name ?? '' }}
                        </td>
                    </tr>
                    
                </tbody>
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