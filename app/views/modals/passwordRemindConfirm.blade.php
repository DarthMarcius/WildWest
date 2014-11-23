<div class="modal fade" id="password-remind-confirm-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title text-success" id="myModalLabel">Reminder status</h4>
            </div>
            <div class="modal-body">
                <b class="text-success">{{ Session::get('status') }}</b>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                        <button type="button" class="btn btn-success btn-lg btn-block" data-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>