<nav class="navbar navbar-expand-md navbar-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/admin') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            @if (Auth::user())
                <div class="navbar-nav mr-auto">
                    <div class="first-level-list">
                        {{ __('messages.Records') }}
                        <ul class="list-container">
                            <li><a href="{{route('record')}}">{{ __('messages.New Record') }}</a></li>
                            <li><a href="{{route('patient.search')}}">{{ __('messages.Search Record') }}</a></li>
                        </ul>
                    </div>
                    @if (Auth::user()->role === 'administrator')
                        <div class="first-level-list">
                            {{ __('Usuarios') }}
                            <ul class="list-container">
                                <li><a href="{{route('user')}}">{{ __('Crear usuario') }}</a></li>
                                <li><a href="{{route('user')}}">{{ __('Editar usuario') }}</a></li>
                            </ul>
                        </div>
                    @endif
                </div>
            @endif

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @if (Auth::user())
                    <li>
                        <admin-appointments-navbar
                            :routes="{{ json_encode([
                                'all' => route('appointment.get.all.ajax'),
                                'delete' => route('appointment.delete.ajax'),
                            ]) }}"
                        ></admin-appointments-navbar>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout.admin') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout.admin') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
