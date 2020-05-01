List new file  models
- app/Zone.php
- app/Country.php
- app/Department.php

List modified file models
- app/User.php

List new file  controllers
- app/Http/Controllers/RoleController.php

List modified file model controllers
- app/Http/Controllers/BKPLeadController.php
- app/Http/Controllers/BusinessController.php
- app/Http/Controllers/LeadController.php
- app/Http/Controllers/ProjectController.php
- app/Http/Controllers/RolePermissionController.php
- app/Http/Controllers/SupportTicketController.php
- app/Http/Controllers/TaskController.php
- app/Http/Controllers/UserController.php


List modified routes
- Comment all route  in routes/custom/user_route.php

List change route in routes/web.php
- Route::resource('users', 'UserController');
- Route::resource('tasks', 'TaskController');

- Route::resource('roles', 'RoleController')->except(['index']);

- Route::resource('permissions', 'RolePermissionController', ['names' => 'role_permission']);
- Route::get('/users','UserController@index')->name('users.index');
- Route::get('/permissions/index','RolePermissionController@index')->name('permissions.index');
- Route::get('/permissions','RolePermissionController@index')->name('roles_and_permissions');
- Route::put('/permissions/{role_id}/update-permission','RolePermissionController@updatePermission');


List new migration files
- database/migrations/2020_04_25_114134_add_time_zone.php

List modified and new file in views 
- All files inside resources/views/users
- All files inside resources/views/roles
- All files inside resources/views/permissions


Before run please run the following command
- composer dump-autoload
- php artisan migrate
- php artisan cache:clear
