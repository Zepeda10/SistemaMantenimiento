<!DOCTYPE html>
<html>
<head>
<title>TecNM | @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
</head>

<style>
    .efecto{
        border-bottom: 2px solid #3861A5;
        padding-bottom: 1px;
    }
    .efecto:hover{
        border-bottom: 2px solid #3861A5;
        padding-bottom: 1px;
    }
</style>

<body>
    
    <nav class="navbar navbar-light navbar-expand-lg mb-5" style="background-color: #1b396a;">
        <div class="container">
        @if (Auth::user()->role_id != 6 )
            <a @if(request()->routeIs('admin.preventivo')) class="navbar-brand mr-auto text-white efecto" @else class="navbar-brand mr-auto text-white" @endif href="{{route('admin.preventivo')}}">Mantenimiento Preventivo</a>
            <a @if(request()->routeIs('correctivo.index')) class="navbar-brand mr-auto text-white efecto" @else class="navbar-brand mr-auto text-white" @endif href="{{route('correctivo.index')}}">Mantenimiento Correctivo</a>
        @endif 

        <a @if(request()->routeIs('telecomunicaciones.index')) class="navbar-brand mr-auto text-white efecto" @else class="navbar-brand mr-auto text-white" @endif href="{{route('telecomunicaciones.index')}}">Telecomunicaciones</a>
       
        @if (Auth::user()->role_id == 1 or Auth::user()->role_id == 2)
            <a @if(request()->routeIs('equipos.index')) class="navbar-brand mr-auto text-white efecto" @else class="navbar-brand mr-auto text-white" @endif href="{{route('equipos.index')}}">Activos</a>
        @endif 

        @if (Auth::user()->role_id == 1)
            <a @if(request()->routeIs('usuarios.index')) class="navbar-brand mr-auto text-white efecto" @else class="navbar-brand mr-auto text-white" @endif href="{{route('usuarios.index')}}">Usuarios</a>
            <a @if(request()->routeIs('solicitudes.index')) class="navbar-brand mr-auto text-white efecto" @else class="navbar-brand mr-auto text-white" @endif href="{{route('solicitudes.index')}}">Solicitudes de acceso</a>
        @endif
        
        <a @if(request()->routeIs('dashboard')) class="navbar-brand mr-auto text-white efecto" @else class="navbar-brand mr-auto text-white" @endif href="{{route('dashboard')}}"><span style="text-transform: uppercase;">{{Auth::user()->usuario}}</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register-user') }}">Register</a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('signout') }}">Salir</a>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')



</body>


</html>