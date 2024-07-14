<header class="header bg-white py-3">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="logo">
            <img class="header-image img-fluid" alt="BROOBE" src="{{ asset('img/challenge.png') }}" style="max-height: 50px;">
        </div>
        <nav class="nav">
            <a class="nav-link" href="{{ route('obtener.metricas') }}">Get Metrics</a>
            <a class="nav-link" href="{{ route('listados.filtro') }}">Listado</a>
        </nav>
    </div>
</header>
