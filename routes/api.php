<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Fleet Data
    Route::apiResource('fleet-datas', 'FleetDataApiController');

    // Money Received
    Route::apiResource('money-receiveds', 'MoneyReceivedApiController');

    // Float Management
    Route::apiResource('float-managements', 'FloatManagementApiController');
});
