@extends('layouts.admin.app')
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
                {{--//VUEEEE--}}
                <admin-patient-patient-form
                    :route="{{ json_encode(route('patient.edit.ajax')) }}"
                    :patient-data="{{ json_encode($patient) }}"
                >
                </admin-patient-patient-form>
                <!-- Record -->
                <admin-patient-record-form
                    :route="{{ json_encode(route('patient.record.edit.ajax')) }}"
                    :patient-data="{{ json_encode($patient) }}"
                    :record-data="{{ json_encode($record) }}"
                >
                </admin-patient-record-form>
                <!-- Diseases -->
                <admin-patient-diseases-form
                    :route="{{ json_encode(route('patient.disease.edit.ajax')) }}"
                    :record-data="{{ json_encode($record) }}"
                    :diseases-data="{{ json_encode($diseases) }}"
                >
                </admin-patient-diseases-form>

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
                            @foreach($treatments as $treatment)
                                <?php $uniqueId = uniqid() ?>
                                <form id="<?= $uniqueId ?>" class="treatments-edit-form" action="{{route('patient.treatment.edit.ajax')}}" method="POST">
                                    <div class="tr" id="row-<?= $uniqueId ?>">
                                        <input type="date" name="date" class="td" value="{{$treatment['date']}}" readonly />
                                        <textarea name="description" data-focus="true" class="td" cols="60" rows="2" readonly>{{$treatment['description']}}</textarea>
                                        <input type="hidden" name="id" value="{{$treatment['id']}}" />
                                        <input type="hidden" name="patient_id" value="{{$patient['id']}}" />
                                        <span class="edit-icon" data-target="row-<?= $uniqueId ?>">edit</span>
                                        <button type="submit" class="hidden">{{__('Guardar')}}</button>
                                    </div>
                                    <div class="alert-success"></div>
                                    <div class="alert-danger"></div>
                                </form>
                            @endforeach
                            <div class="tr" id="btn-row">
                                <button type="button" id="add-treatment-btn">{{__('Añadir')}}</button>
                                <div class="alert-success"></div>
                                <div class="alert-danger"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--<script src="{{asset('js/admin/patient.js')}}" defer></script>--}}
@endsection