<nav class="navbar navbar-expand-lg user-nav">
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav gap-3">
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() === 'admin' ? 'active' : ''}}" aria-current="page" href="{{ route(name: 'admin') }}">Vehículos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() === 'brands' ? 'active' : ''}}" href="{{ route(name: 'brands') }}">Marcas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() === 'types' ? 'active' : ''}}" href="{{ route(name: 'types') }}">Tipos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() === 'colors' ? 'active' : ''}}" href="{{ route(name: 'colors') }}">Colores</a>
            </li>
        </ul>
    </div>
</nav>