<?php

/**
 * Logging in
 */
Route::group([
    'namespace' => 'Admin\Auth',
    'as' => 'admin.',
], static function () {
    Route::get('admin', [
        'as' => 'login',
        'uses' => 'LoginController@showForm',
    ]);
    Route::post('admin', [
        'as' => 'login',
        'uses' => 'LoginController@login',
    ]);
    Route::get('admin/logout', [
        'as' => 'logout',
        'uses' => 'LoginController@logout'
    ]);
});

/**
 * Admin area
 */
Route::group([
    'middleware' => ['auth:admin', 'setup'],
    'namespace' => 'Admin',
    'prefix' => 'admin',
    'as' => 'admin.'
], static function () {
    /**
     * Dashboard
     */
    Route::get('dashboard', [
        'uses' => 'DashboardController',
        'as' => 'dashboard',
    ]);

    /**
     * Config
     */
    Route::resource('config', 'ConfigController');

    /**
     * Admins
     */
    Route::resource('admins', 'AdminController');
    Route::post('admins/import', [
        'as' => 'admins.import',
        'uses' => 'Import\AdminController',
    ]);

    /**
     * Users
     */
    Route::post('users/set-status', [
        'as' => 'users.set-status',
        'uses' => 'UserController',
    ]);
    Route::post('users/import', [
        'as' => 'users.import',
        'uses' => 'Import\UserController',
    ]);
    Route::get('users/export/{brand}', [
        'as' => 'users.export',
        'uses' => 'Export\ExportUserController',
    ]);
    Route::resource('users/hyster', 'UserController');
    Route::resource('users/yale', 'UserController');


    /**
     * Emails
     */
    Route::group([
        'namespace' => 'Email',
    ], static function () {
        Route::get('emails', [
            'as' => 'emails',
            'uses' => 'IndexController',
        ]);
        Route::get('emails/{email}', [
            'as' => 'emails.show',
            'uses' => 'ShowController',
        ]);
        Route::post('emails/{email}/send', [
            'as' => 'emails.send',
            'uses' => 'SendController',
        ]);
    });

    /**
     * Datatables
     */
    Route::group([
        'namespace' => 'Datatable',
    ], static function () {
        Route::get('admin-data', [
            'uses' => 'AdminController',
            'as' => 'admins.datatable',
        ]);
        Route::get('user-data/{brand}', [
            'uses' => 'UserController',
            'as' => 'users.datatable',
        ]);
        Route::get('email-data', [
            'uses' => 'EmailLogController',
            'as' => 'emails.datatable',
        ]);
        Route::get('email-user-data/{email}', [
            'uses' => 'EmailUserController',
            'as' => 'emails.users.datatable',
        ]);

        Route::get('admin-reports', [
            'uses' => 'ReportController',
            'as' => 'reports.datatable',
        ]);
        Route::get('admin-broadcasts', [
            'uses' => 'BroadcastController',
            'as' => 'broadcasts.datatable',
        ]);
    });

    /**
     * Reports
     */
    Route::group([
        'namespace' => 'Report',
    ], static function () {
        Route::get('reports', [
            'uses' => 'IndexController',
            'as' => 'reports',
        ]);
        Route::get('reports/{report}/{stream?}', [
            'uses' => 'DownloadController',
            'as' => 'reports.download',
        ]);
    });

    /**
     * Queue management api
     */
    Route::group([
        'namespace' => 'Queue',
    ], static function () {
        Route::get('queue-info/{name}', [
            'as' => 'queue-info',
            'uses' => 'StatusController',
        ]);
        Route::get('queue-clear/{name}', [
            'as' => 'queue-clear',
            'uses' => 'ClearController',
        ]);
    });

    /**
     * Misc
     */
    Route::post('set-temp-password/{type}/{id}', [
        'as' => 'set-temp-password',
        'uses' => 'Auth\SetTempPasswordController',
    ]);

    /**
     * Exports
     */
    Route::group([
        'namespace' => 'Export',
    ], static function () {
        Route::get('export-report', [
            'uses' => 'ExportReportController',
            'as' => 'reports.export',
        ]);
    });
});
