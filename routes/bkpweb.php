<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('/');
Route::get('/home', 'HomeController@index')->name('home');





Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
      return 'DONE'; //Return anything
  });
  //Auth::routes();
  
  
  
  Auth::routes();
  
  Route::get('/home', 'HomeController@index')->name('home');
  Route::get('/', 'HomeController@index')->name('/');
  
  //Route::get('/', 'PostController@index')->name('home');
  
  Route::resource('users', 'UserController');
  Route::resource('tasks', 'TaskController');
  
  Route::resource('roles', 'RoleController');
  
  Route::resource('permissions', 'RolePermissionController', ['names' => 'role_permission']);
  Route::get('/users','UserController@index')->name('users.index');
  Route::get('/permissions/index','RolePermissionController@index')->name('permissions.index');
  Route::get('/permissions','RolePermissionController@index')->name('roles_and_permissions');
  
  
  // All Task Route are here. Developed by Developer http://www.deveshut.com
  
  
  Route::group(['middleware' => ['isAdmin']], function () {
  include_once('custom/task_route.php');
  include_once('custom/user_route.php');
  });
  
  
  Route::resource('posts', 'PostController');
  
  Route::get('/supportticket','SupportTicketController@index')->name('supportticket');
  ;
  Route::get('/create', 'SupportTicketController@create')->name('add_ticket_page');
  Route::post('/commentAdd', 'SupportTicketController@commentAdd')->name('commentAdd');
  Route::post('/taskcommentAdd', 'SupportTicketController@taskcommentAdd')->name('taskcommentAdd');
  Route::post('/taskattachmentcommentAdd', 'SupportTicketController@taskattachmentcommentAdd')->name('taskattachmentcommentAdd');
  
  Route::get('/create', 'SupportTicketController@create')->name('add_ticket_page');
  
  Route::post('/create', 'SupportTicketController@store')->name('post_ticket');
  
  Route::get('/getSupportTicketData', 'SupportTicketController@getSupportTicketData')->name('getSupportTicketData');
  
  
  
  
  
  /////STACK STARTS
  Route::get('/stack', 'BusinessController@viewBusiness')->name('business');
  Route::get('/business/create', 'BusinessController@create')->name('business.create');
  Route::post('/business/create', 'BusinessController@store')->name('business.store');
  
  
  
  //Route::resource('customers', 'CustomersController');
  Route::get('/stacks/edit/', 'StackController@edit');
  
  
  Route::post('/business/stacks/create/{id}/{type}', [
      'uses' => 'StackController@create',
      'as' => 'stack.create'
  ]);
  
  Route::post('/stack/create', 'StackController@store')->name('stack.store');
  
  
  Route::post('/business/search', 'BusinessController@search')->name('business.search');
  
  Route::post('/stack/edit/{id}', 'StackController@edit')->name('stack.edit');
  
  
  
  
  Route::get('/business/newsearch/{keyward}', 'BusinessController@newsearch')->name('business.newsearch');
  
  //Route::patch('stack', 'StackController@update')->name('stack.update');
  
  
  Route::get('/live_search/action', 'BusinessController@action')->name('live_search.action');
  
  
  Route::post('/business/datas/','BusinessController@datas')->name('business.datas');
  
  
  
  Route::post('/autocomplete/fetch', 'BusinessController@fetch')->name('autocomplete.fetch');
  
  
  
  Route::post('/contact/store', 'ContactController@store')->name('contact.store');
  Route::post('/contact/edit/{id}', 'ContactController@edit')->name('contact.edit');
  
  
  
  Route::post('/contact/delete/{id}', 'ContactController@deleteRow')->name('contact.delete');
  
  
  Route::patch('contact', 'ContactController@update')->name('contact.update');
  
  Route::post('/business/contact/create/{id}', [
    'uses' => 'ContactController@create',
    'as' => 'contact.create'
  ]);
  
  Route::get ('/business/contact/multiDdelete', ['uses' => 'ContactController@testDelete', 'before' => 'csrf']);
  
  Route::resource('contact', 'ContactController');
  
  
  Route::resource('stacks', 'StackController');

  
  
  Route::patch('/preferences/{id}',[
      'as' => 'user.preferences.update',
      'uses' => 'StackController@update'
  ]);
  
  
  
  Route::post('/business/contact/{id}/{type}', [
      'uses' => 'ContactController@create',
      'as' => 'contact.create'
  ]);
  
  
  
  
  Route::get('showmodal',['as' => 'contact.showmodal', 'uses' => 'ContactController@getStudent']);
  
  
  
  Route::get('stack/{id}/{buisness_id}/delete', ['as' => 'stack.destroy', 'uses' => 'StackController@destroy']);
  
  
  Route::get('stack.showmodal',['as' => 'stack.showmodal', 'uses' => 'StackController@getStack']);
  
  
  
  Route::get('contact/{id}/{buisness_id}', 'ContactController@destroy')->name('contact.destroy');
 
  // Project Routes
  Route::get('viewproject', 'ProjectController@viewProject')->name('projects.viewProject');
  
  
  
  Route::post('store-lead', 'LeadController@store')->name('leads.store');
  Route::get('view-lead/{id}', 'LeadController@view_leads')->name('leads.view');
  
  Route::post('update-lead', 'LeadController@update')->name('leads.update');
  Route::get('/leads-categori/{id}', 'LeadController@leads_categori')->name('leads.categori');
  Route::get('/lead-delete/{id}', 'LeadController@lead_delete')->name('leads.delete');
  Route::resource('leads', 'LeadController', ['names' => 'leads']);
  Route::get('fetchlead', 'LeadController@fetchlead')->name('fetchlead');