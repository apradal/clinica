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
                <form id="table-filters-form" method="get" action="{{route('patient.search.ajax')}}">
                    <span>{{__('Filtros de búsqueda')}}: </span>
                    <input type="radio" id="name" name="search_filter" value="name" checked/>
                    <label for="name">{{__('Nombre')}}</label>
                    <input type="radio" id="surname" name="search_filter" value="surname" />
                    <label for="surname">{{__('Apellidos')}}</label>
                    <input type="radio" id="nif" name="search_filter" value="nif" />
                    <label for="nif">{{__('Dni')}}</label>
                    <input type="radio" id="email" name="search_filter" value="email" />
                    <label for="email">{{__('Email')}}</label>
                    <input type="radio" id="phone" name="search_filter" value="phone" />
                    <label for="phone">{{__('Teléfono')}}</label>
                    <input type="text" name="search_data" placeholder="{{__('Ejemplo: Prada')}}" />
                    <button id="filter-search-btn" type="submit">{{__('Buscar')}}</button>
                </form>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">{{__('Nombre')}}</th>
                            <th scope="col">{{__('Apellidos')}}</th>
                            <th scope="col">{{__('Dni')}}</th>
                            <th scope="col">{{__('Email')}}</th>
                            <th scope="col">{{__('Teléfono')}}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="{{asset('js/admin/searchpatient.js')}}" defer></script>
@endsection