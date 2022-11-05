@php
    $routeActive = Route::currentRouteName();
@endphp


<li class="nav-item @if ($routeActive == 'dashboard') active @endif">
    <a class="nav-link" href="./">
        <span class="nav-link-icon d-md-none d-lg-inline-block">
            <x-icon type="home" classicon="icon" />
        </span>
        <span class="nav-link-title">
            Home
        </span>
    </a>
</li>

<li class="nav-item @if ($routeActive == 'rayons.index') active @endif dropdown">
    <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside"
        role="button" aria-expanded="false">
        <span class="nav-link-icon d-md-none d-lg-inline-block">
            <x-icon type="packages" classicon="icon"/>
        </span>
        <span class="nav-link-title">
            Master data
        </span>
    </a>
    <div class="dropdown-menu">
        <div class="dropdown-menu-columns">
            <a class="dropdown-item" href="{{ route('rayons.index') }}">
                Rayon
            </a>
        </div>
    </div>
</li>
