<nav class="navbar navbar-expand-lg navbar-light mb-4 border-bottom">
    <div class="container">
        <div class="navbar-brand text-danger font-bold">
            <img src="{{ asset('/images/raspberry-pi-logo.png') }}" alt="Raspberry Pi" style="height: 30px;">
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item {{ Request::is('time-lapses') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('time-lapses.index') }}">Time-lapses <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item {{ Request::is('hotspot') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('hotspot') }}">Hotspot Settings <span class="sr-only">(current)</span></a>
                </li>
            </ul>
        </div>
    </div>
</nav>
