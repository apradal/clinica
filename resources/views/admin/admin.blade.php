@extends('layouts.admin.app')
@section('body_class', 'admin')
@section('content')
    <div id="admin-main-container" class="container">
        <div class="row menus">
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
                    <div class="records">
                        <h2>{{ __('messages.Records') }}</h2>
                        <div class="menu-btn">
                            <button>
                                <a href="{{route('record')}}">{{ __('messages.New Record') }}</a>
                                <font-awesome-icon icon="plus-circle"/>
                            </button>
                        </div>
                        <div class="menu-btn">
                            <button>
                                <a href="{{route('patient.search')}}">{{ __('messages.Search Record') }}</a>
                                <font-awesome-icon icon="search"/>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-xs-12"></div>
            @endif
        </div>
    </div>
@endsection