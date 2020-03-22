@extends('layouts\admin.app')
@section('body_class', 'admin_record_index')
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
                <h1>{{$patient['name']}} {{$patient['surname']}}</h1>
                <!-- Patient -->
                @include('includes.admin.patient.form.patient')
                <!-- Record -->
                @include('includes.admin.patient.form.record')
                <!-- Diseases -->
                @include('includes.admin.patient.form.diseases')
                <div class="row">
                    <div class="col-12">
                        <h4>{{__('Plan de Tratamientos')}}</h4>
                        <div id="treatment-table" data-pacient-id="{{$patient['id']}}">
                            <div class="tr">
                                <div class="td">{{__('Fecha')}}</div>
                                <div class="td">{{__('Descripción')}}</div>
                                {{--<div class="td"></div>--}}
                                {{--<div class="td"></div>--}}
                            </div>
                            <button type="button" id="add-treatment-btn">{{__('Añadir')}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('js/admin/patient.js')}}" defer></script>
@endsection