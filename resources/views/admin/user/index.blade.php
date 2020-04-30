@extends('layouts.admin.app')
@section('body_class', 'admin_user_index')
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
                <admin-user-new-form
                        :route="{{ json_encode(route('user.create')) }}"
                />
            </div>
        </div>
    </div>
@endsection