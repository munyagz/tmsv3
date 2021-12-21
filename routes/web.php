<?php

Route::view('/', 'welcome');
Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Fleet Data
    Route::delete('fleet-datas/destroy', 'FleetDataController@massDestroy')->name('fleet-datas.massDestroy');
    Route::post('fleet-datas/parse-csv-import', 'FleetDataController@parseCsvImport')->name('fleet-datas.parseCsvImport');
    Route::post('fleet-datas/process-csv-import', 'FleetDataController@processCsvImport')->name('fleet-datas.processCsvImport');
    Route::resource('fleet-datas', 'FleetDataController');

    // Reports
    Route::delete('reports/destroy', 'ReportsController@massDestroy')->name('reports.massDestroy');
    Route::get('reports/floats', 'ReportsController@floatReport')->name('reports.floats');
    Route::get('reports/orders', 'ReportsController@ordersReport')->name('reports.orders');
    Route::get('reports/expenses', 'ReportsController@expensesReport')->name('reports.expenses');
    Route::post('reports/expenses', 'ReportsController@expensesReportSearch')->name('reports.postexpenses');
    Route::get('reports/profitloss', 'ReportsController@profitlossReport')->name('reports.profitloss');
    Route::post('reports/profitloss', 'ReportsController@profitLossReportSearch')->name('reports.postprofitloss');
    Route::post('reports/search', 'ReportsController@ordersReportSearch')->name('reports.search');
    //Route::resource('reports', 'ReportsController');

    // Money Received
    Route::delete('money-receiveds/destroy', 'MoneyReceivedController@massDestroy')->name('money-receiveds.massDestroy');
    Route::post('money-receiveds/parse-csv-import', 'MoneyReceivedController@parseCsvImport')->name('money-receiveds.parseCsvImport');
    Route::post('money-receiveds/process-csv-import', 'MoneyReceivedController@processCsvImport')->name('money-receiveds.processCsvImport');
    Route::resource('money-receiveds', 'MoneyReceivedController');

    // Float Management
    Route::delete('float-managements/destroy', 'FloatManagementController@massDestroy')->name('float-managements.massDestroy');
    Route::resource('float-managements', 'FloatManagementController');

    // Send Float
    Route::delete('send-floats/destroy', 'SendFloatController@massDestroy')->name('send-floats.massDestroy');
    Route::post('send-floats/parse-csv-import', 'SendFloatController@parseCsvImport')->name('send-floats.parseCsvImport');
    Route::post('send-floats/process-csv-import', 'SendFloatController@processCsvImport')->name('send-floats.processCsvImport');
    Route::resource('send-floats', 'SendFloatController');

    // Expense Categories
    Route::delete('expense-categories/destroy', 'ExpenseCategoriesController@massDestroy')->name('expense-categories.massDestroy');
    Route::resource('expense-categories', 'ExpenseCategoriesController');

    // Other Expenses
    Route::delete('other-expenses/destroy', 'OtherExpensesController@massDestroy')->name('other-expenses.massDestroy');
    Route::post('other-expenses/parse-csv-import', 'OtherExpensesController@parseCsvImport')->name('other-expenses.parseCsvImport');
    Route::post('other-expenses/process-csv-import', 'OtherExpensesController@processCsvImport')->name('other-expenses.processCsvImport');
    Route::resource('other-expenses', 'OtherExpensesController');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
Route::group(['as' => 'frontend.', 'namespace' => 'Frontend', 'middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Fleet Data
    Route::delete('fleet-datas/destroy', 'FleetDataController@massDestroy')->name('fleet-datas.massDestroy');
    Route::post('fleet-datas/report', 'FleetDataController@dataFilter')->name('fleet-datas.report');
    Route::resource('fleet-datas', 'FleetDataController');

    // Reports
    Route::delete('reports/destroy', 'ReportsController@massDestroy')->name('reports.massDestroy');
    Route::get('reports/floats', 'ReportsController@floatReport')->name('reports.floats');
    Route::get('reports/profitloss', 'ReportsController@profitlossReport')->name('reports.profitloss');
    Route::post('reports/profitloss', 'ReportsController@profitLossReportSearch')->name('reports.postprofitloss');
    Route::resource('reports', 'ReportsController');

    // Money Received
    Route::delete('money-receiveds/destroy', 'MoneyReceivedController@massDestroy')->name('money-receiveds.massDestroy');
    Route::post('money-receiveds/report', 'MoneyReceivedController@dataFilter')->name('money-receiveds.report');
    Route::resource('money-receiveds', 'MoneyReceivedController');

    // Float Management
    Route::delete('float-managements/destroy', 'FloatManagementController@massDestroy')->name('float-managements.massDestroy');
    Route::resource('float-managements', 'FloatManagementController');

    // Send Float
    Route::delete('send-floats/destroy', 'SendFloatController@massDestroy')->name('send-floats.massDestroy');
    Route::post('send-floats/report', 'SendFloatController@dataFilter')->name('send-floats.report');
    Route::resource('send-floats', 'SendFloatController');

    // Expense Categories
    Route::delete('expense-categories/destroy', 'ExpenseCategoriesController@massDestroy')->name('expense-categories.massDestroy');
    Route::resource('expense-categories', 'ExpenseCategoriesController');

    // Other Expenses
    Route::delete('other-expenses/destroy', 'OtherExpensesController@massDestroy')->name('other-expenses.massDestroy');
    Route::post('other-expenses/report', 'OtherExpensesController@dataFilter')->name('other-expenses.report');
    Route::resource('other-expenses', 'OtherExpensesController');

    Route::get('frontend/profile', 'ProfileController@index')->name('profile.index');
    Route::post('frontend/profile', 'ProfileController@update')->name('profile.update');
    Route::post('frontend/profile/destroy', 'ProfileController@destroy')->name('profile.destroy');
    Route::post('frontend/profile/password', 'ProfileController@password')->name('profile.password');
});
