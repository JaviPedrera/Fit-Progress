<div id="flash-overlay-modal" class="modal fade {{ $modalClass or '' }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #00E200">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                <h4 class="modal-title" style="color:white"><i class="fa fa-info-circle" style="color:white"></i> {{ $title }}</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-4">
                        <img class="img-thumbnail" style="width:100%" src="{{asset('images/inbody.jpg')}}">
                    </div>
                    <div class="col-xs-1">
                        <i class="fa fa-arrow-left" style="margin:30px 0 0 -15px; font-size:4em"></i>
                    </div>
                    <div class="col-xs-7">
                        <p style="color:#3f3f3f">{{ $body }}</p>                    
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
