<div class="modal fade" id="js-temp-password-check" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Temporary password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Would you like to set this delegate a temporary password?</p>
                <p>
                    Their password will be set to
                    <strong>{{ config('envx.temp-password') }}</strong>
                    and an email will be sent confirming the update.
                </p>
                <input type="hidden" value="" class="js-temp-password-model-id">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button class="btn btn-primary js-confirm-temp-password">Set password</button>
            </div>
        </div>
    </div>
</div>
