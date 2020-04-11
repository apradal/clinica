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
                <admin-patient-treatment-form
                    :routes="{{ json_encode([
                        'add' => route('patient.treatment.add.ajax'),
                        'edit' => route('patient.treatment.edit.ajax')
                    ]) }}"
                    :treatment-data="{{ json_encode($treatments) }}"
                    :patient-data="{{ json_encode($patient) }}"
                >
                </admin-patient-treatment-form>
            </div>
        </div>
    </div>
@endsection