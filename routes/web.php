<?php


/*
|--------------------------------------------------------------------------
| Backend Routes
|--------------------------------------------------------------------------
*/

Route::get('/admin-giris', 'Back\AuthController@login')->name('admin.login');


Route::prefix('admin')->name('admin.')->middleware('isLogin')->group(function(){
  Route::get('giris','Back\AuthController@login')->name('login');
  Route::post('giris','Back\AuthController@loginPost')->name('login.post');
});

Route::prefix('admin')->name('admin.')->middleware('isAdmin')->group(function(){
  Route::get('panel','Back\Dashboard@index')->name('dashboard');
  // MAKALE ROUTE'S
   Route::get('makaleler/silinenler','Back\ArticleController@trashed')->name('trashed.article');
  Route::resource('ziyaretler','Back\ArticleController');
  Route::get('/switch','Back\ArticleController@switch')->name('switch');
  Route::get('/deletearticle/{id}','Back\ArticleController@delete')->name('delete.article');
  Route::get('/harddeletearticle/{id}','Back\ArticleController@hardDelete')->name('hard.delete.article');
  Route::get('/recoverarticle/{id}','Back\ArticleController@recover')->name('recover.article');


  // Config's Route
  Route::get('/ayarlar','Back\ConfigController@index')->name('config.index');
  Route::post('/ayarlar/update','Back\ConfigController@update')->name('config.update');
  //
  Route::get('cikis','Back\AuthController@logout')->name('logout');
});


/*
|--------------------------------------------------------------------------
| Front Routes
|--------------------------------------------------------------------------
*/
Route::get('/','Back\AuthController@login')->name('admin.login');
