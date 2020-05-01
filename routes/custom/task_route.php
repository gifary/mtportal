<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Route::get('/tasks','TaskController@index')->name('tasks.index');
Route::post('/save-task','TaskController@save_task')->name('save_task');
Route::post('/update-task','TaskController@update_task')->name('update_task');
Route::get('/post_task', 'TaskController@store')->name('post_task');
Route::get('/create', 'TaskController@create')->name('add_task_page');
Route::post('/create', 'TaskController@store')->name('post_task');
Route::get('/getData', 'TaskController@getData')->name('getData');
Route::post('/list', 'TaskController@paginate')->name('datatables_tasks');
Route::get('/create', 'TaskController@create')->name('add_task_page');
Route::get('/delete-task/{id}', 'TaskController@delete_task')->name('delete_task');

Route::post('/add-attachment', 'TaskController@save_task_attachment')->name('save_task_attachment');

Route::get('/task-search', 'TaskController@search_task')->name('search_task');
