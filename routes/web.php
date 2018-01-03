<?php

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
	return redirect('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function () {
	Route::prefix('user')->group(function () {
		Route::name('user.list')->get('list', 'MarkerController@getList');
		Route::name('user.create')->get('create', 'MarkerController@getCreate');
		Route::name('user.save')->post('save', 'MarkerController@postSave');
		Route::name('user.delete')->delete('{id}/delete', 'MarkerController@deleteDelete');
		Route::name('user.destroy')->delete('destroy', 'MarkerController@deleteDestroy');
		Route::name('user.chgpwd')->get('change-password', 'UserController@getChangePassword');
		Route::name('user.change')->put('change', 'UserController@putChangePassword');
	});

	Route::prefix('department')->group(function () {
		Route::name('department.list')->get('list', 'DepartmentController@getList');
		Route::name('department.create')->get('create', 'DepartmentController@getCreate');
		Route::name('department.save')->post('save', 'DepartmentController@postSave');
		Route::name('department.edit')->get('{id}/edit', 'DepartmentController@getEdit');
		Route::name('department.update')->put('{id}/update', 'DepartmentController@putUpdate');
		Route::name('department.delete')->delete('{id}/delete', 'DepartmentController@deleteDelete');
	});

	Route::prefix('index')->group(function () {
		Route::name('index.list')->get('list', 'IndexController@getList');
		Route::name('index.create')->get('create', 'IndexController@getCreate');
		Route::name('index.save')->post('save', 'IndexController@postSave');
		Route::name('index.edit')->get('{id}/edit', 'IndexController@getEdit');
		Route::name('index.update')->put('{id}/update', 'IndexController@putUpdate');
		Route::name('index.delete')->delete('{id}/delete', 'IndexController@deleteDelete');
	});

	Route::prefix('subindex')->group(function () {
		Route::name('subindex.list')->get('list', 'SubindexController@getList');
		Route::name('subindex.create')->get('create', 'SubindexController@getCreate');
		Route::name('subindex.save')->post('save', 'SubindexController@postSave');
		Route::name('subindex.edit')->get('{id}/edit', 'SubindexController@getEdit');
		Route::name('subindex.update')->put('{id}/update', 'SubindexController@putUpdate');
		Route::name('subindex.delete')->delete('{id}/delete', 'SubindexController@deleteDelete');
	});
});

Route::prefix('marker')->group(function () {
	Route::get('login', 'MarkerController@getLogin');
	Route::name('marker.login')->post('login', 'MarkerController@postLogin');
	Route::name('marker.logout')->post('logout', 'MarkerController@postlogout');
});

Route::prefix('score')->group(function () {
	Route::name('score.indices')->get('indices', 'ScoreController@getIndices');
	Route::name('score.mark')->get('mark', 'ScoreController@getMark');
	Route::name('score.create')->post('create', 'ScoreController@postMark');
	Route::name('score.list')->get('list', 'ScoreController@getList');
	Route::name('score.statistics')->get('statistics', 'ScoreController@getStatistics');
});