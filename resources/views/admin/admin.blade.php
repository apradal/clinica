@extends('layouts\admin.app')
@section('body_class', 'admin')
@section('content')
    <?php //this page is controlled by auth on controllers, but just in case controls if user is logged.?>
    @guest
        <h1>misco</h1>
        <a href="{{ route('login.admin') }}">Login</a>
    @else
        <div id="admin-main-container" class="row">
            <div class="col-md-4 col-xs-12">misco</div>
            <div class="col-md-4 col-xs-12">tusco</div>
            <div class="col-md-4 col-xs-12">mmmm</div>
        </div>
    @endif
@endsection