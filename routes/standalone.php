<?php

Route::group([
    'namespace' => 'Standalone',
], static function () {
    // Track email opened
    Route::get('emails/track/{trackToken}', [
        'as' => 'emails.track',
        'uses' => 'TrackEmailController'
    ]);

    // Check Htaccess status
    Route::get('htaccess/status', [
        'uses' => 'HtaccessController',
    ]);
});
