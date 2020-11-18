@extends('layouts.admin')
@section('content')
    
            <h1>{{ trans('global.welcome') }} {{ $name }}</h1>
@endsection
@section('scripts')
@parent

@endsection