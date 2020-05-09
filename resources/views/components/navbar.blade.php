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
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#powerModal"><i class="fas fa-power-off"></i> Power</button>
        </div>
    </div>
</nav>

<!-- Modal -->
<div class="modal fade" id="powerModal" tabindex="-1" role="dialog" aria-labelledby="powerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="powerModalLabel">Power</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                You may be disconnected from the current Raspberry Pi hotspot.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning">Restart</button>
                <button type="button" class="btn btn-danger">Shut down</button>
            </div>
        </div>
    </div>
</div>
