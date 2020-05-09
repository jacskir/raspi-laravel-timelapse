@extends('layouts.app')

@section('title', 'Hotspot Settings')

@section('content')

    <!-- Form -->
    <div class="row">
        <div class="col-md-6 col-lg-4">
            <form id="hotspotForm" action="/hotspot" method="POST">
                @csrf
                <div class="form-group">
                    <label for="password">Wi-Fi Password:</label>
                    <input type="text" class="form-control" id="password" name="password">
                </div>

                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#confirmHotspotModal">Save and restart</button>
                <!-- <button type="submit" class="btn btn-primary">oshoishdf</button> -->

                <!-- Modal -->
                <div class="modal fade" id="confirmHotspotModal" tabindex="-1" role="dialog" aria-labelledby="confirmHotspotLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="confirmHotspotLabel">Confirm</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                You will be disconnected from the current Raspberry Pi hotspot. Be sure to reconnect with the new password.
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-danger">Save and restart</button>
                            </div>
                        </div>
                    </div>
                </div>





            </form>
        </div>
    </div>



@endsection
