@extends('layouts.admin.app')
@section('body_class', 'admin')
@section('content')
    <div id="admin-main-container" class="row">
        @if ($errors->any())
            <!-- Messages -->
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
        @endif
        <?php //this page is controlled by auth on controllers, but just in case controls if user is logged.?>
        @guest
            <a href="{{ route('login.admin') }}">Login</a>
        @else
                <div class="col-md-4 col-xs-12"></div>
                <div class="col-md-4 col-xs-12">
                    <p>{{ __('messages.Records') }}</p>
                    <ul>
                        <li><a href="{{route('record')}}">{{ __('messages.New Record') }}</a></li>
                        <li>{{ __('messages.Search Record') }}</li>
                    </ul>
                </div>
                <div class="col-md-4 col-xs-12"></div>
        @endif
    </div>
@endsection