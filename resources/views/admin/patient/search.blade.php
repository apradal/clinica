@extends('layouts.admin.app')
@section('body_class', 'admin_record_search')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
            @if ($errors->any())
                <!-- Messages -->
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">{{ $error }}</div>
                    @endforeach
                @endif
                @if(session('message'))
                    <div id="message" class="alert alert-success">{{session('message')}}</div>
                @endif
                <h1>{{__('Listado de pacientes')}}</h1>
                <admin-patient-search-table
                    :routes="{{json_encode([
                        'add' => route('patient.search.ajax'),
                        'record' => route('patient')
                    ])}}"
                ></admin-patient-search-table>
            </div>
        </div>
    </div>
@endsection