<div class="modal fade" id="js-confirm-send" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Are you sure?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body js-confirm-send-text"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <form action="{{ route('admin.emails.send', [$email]) }}" class="js-send-route" method="POST">
                    @csrf
                    <input type="hidden" name="selected" class="js-selected-input" value="">
                    <button class="btn btn-primary">Send</button>
                </form>
            </div>
        </div>
    </div>
</div>
