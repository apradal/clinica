@extends('layouts.admin.app')
@section('body_class', 'admin_record_index')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>{{__('record/index.New Record')}}</h1>
                @if ($errors->any())
                    <!-- Messages -->
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">{{ $error }}</div>
                    @endforeach
                @endif
                <admin-record-new-form
                    :route="{{ json_encode(route('record.save')) }}"
                >
                    <template slot="csrf">
                        {{ csrf_field() }}
                    </template>
                </admin-record-new-form>
            </div>
        </div>
    </div>
@endsection