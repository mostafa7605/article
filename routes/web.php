<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Website\HomeController;
use App\Http\Controllers\Website\AuthController;
use App\Http\Controllers\Website\ProfileController;
use App\Http\Controllers\Website\ArticleController;
use App\Http\Controllers\Website\SearchController;
use App\Http\Controllers\Website\FollowerController;
use App\Http\Controllers\Website\PagesController;
use App\Http\Controllers\Website\RegisterController;
use App\Http\Controllers\Website\SubscribeController;
use App\Http\Controllers\Website\ContactController;
use App\Http\Controllers\NotificationController;





/*
|
|
|=================================================================
|=================================================================
| Website
|=================================================================
|=================================================================
|
|
*/

// -----------------------------------------   Home    -----------------------------------------
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/save_message', [ContactController::class, 'save_message'])->name('save_message');
// -----------------------------------------   Auth    -----------------------------------------
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/userlogin', [AuthController::class, 'user_login'])->name('loginuser');
Route::get('/user/logout', [AuthController::class, 'logout'])->name('user.logout');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'register_user']);
Route::get('check_username', [AuthController::class, 'check_username']);
Route::get('check_email2', [AuthController::class, 'check_email2']);

Route::post('/send_code', [RegisterController::class, 'send_code'])->name('send_code');
Route::post('/check_phone_sms_code', [RegisterController::class, 'check_phone_sms_code'])->name('check_phone_sms_code');



Route::get('auth/login/google', [AuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/login/google/callback', [AuthController::class, 'handleGoogleCallback']);
Route::get('/forget-password', [AuthController::class, 'forget'])->name('forget');
Route::get('/new-password', [AuthController::class, 'new_password'])->name('new_password');
Route::get('/change-password', [AuthController::class, 'change_password'])->name('change_password');
Route::post('/change-password', [AuthController::class, 'update_password'])->name('update_password');
Route::post('forget_password', [AuthController::class, 'forget_password'])->name('forget_password');

Route::get('/check-email', [AuthController::class, 'check_email'])->name('check_email');
Route::get('/password-reset/{token}', [AuthController::class, 'password_reset_email'])->name('password_reset');
Route::post('/user/forget', [AuthController::class, 'update_password_email']);

Route::group(['middleware' => ['customer']], function () {

    // ----------------------------------------    Profile    -----------------------------------------
    Route::get('/profile', [ProfileController::class, 'view'])->name('profile');
    Route::get('/edit-profile/{id}', [ProfileController::class, 'edit'])->name('edit-profile');
    Route::post('/updateprofile', [ProfileController::class, 'update'])->name('update-user');
    Route::get('/socialsync/{socialname}', [ProfileController::class, 'socialsync']);
    Route::get('/socialsync/{socialname}/callback', [ProfileController::class, 'socialsyncCallback']);
    Route::get('/person_profile/{id}', [PagesController::class, 'person_profile'])->name('person_profile');

    // ----------------------------------------    Follower    -----------------------------------------
    Route::get('/follower', [FollowerController::class, 'index_follower'])->name('follower');
    Route::get('/following', [FollowerController::class, 'index_following'])->name('following');
    Route::get('/follow_user/{id}', [FollowerController::class, 'change_following']);

    // ----------------------------------------   article   -----------------------------------------
    Route::get('/article/create', [ArticleController::class, 'create'])->name('article.create');
    Route::get('/bookmark/{id}', [ArticleController::class, 'bookmark']);
    Route::post('/save_article', [ArticleController::class, 'save_article'])->name('save_article');
    Route::get('/aditionalfields/{id}', [ArticleController::class, 'get_additional_category']);
    Route::get('/article/read/{id}', [ArticleController::class, 'article_read']);
    Route::post('article_pay', [ArticleController::class, 'article_pay'])->name('article_pay');
    Route::post('stripe', [ArticleController::class, 'stripePost'])->name('stripe.post');
    Route::post('/send_invitation', [ArticleController::class, 'send'])->name('send_invitation');
});
// ----------------------------------------   article   -----------------------------------------

Route::get('/article/view/{id}', [ArticleController::class, 'view'])->name('article.view');

Route::post('subscribe', [SubscribeController::class, 'subscribe'])->name('subscribe');



// ----------------------------------------   Search   -----------------------------------------
Route::any('/search/view', [SearchController::class, 'view'])->name('search');
Route::get('/search/view/{id}', [SearchController::class, 'view'])->name('search.view');

// ----------------------------------------   About US   -----------------------------------------
Route::get('/about_us', [PagesController::class, 'about_us'])->name('about_us');

// ----------------------------------------   How It Work   -----------------------------------------
Route::get('/how_it_work', [PagesController::class, 'how_it_work'])->name('how_it_work');

// ----------------------------------------   Mail   -----------------------------------------
Route::get('/unsubscribe', [PagesController::class, 'unsubscribe'])->name('unsubscribe');
Route::get('/unsubscribe3', [PagesController::class, 'unsubscribe3'])->name('unsubscribe3');


// -----------------------------------   Notification Mobile   --------------------------------
Route::get('/notification/view', [NotificationController::class, 'view'])->name('notification');

/*
|
|
|=================================================================
|=================================================================
| Admin
|=================================================================
|=================================================================
|
|
*/
Route::get('/admin', function () {
    return view('admin.login');
})->name('admin');

Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', '\App\Http\Controllers\Admin\AdminController@manualLogin');
    Route::post('/login', '\App\Http\Controllers\Admin\AdminController@manualLogin');

    Route::get('/get_rss_key', '\App\Http\Controllers\Admin\RssController@get_rss_key');

    Route::group(['middleware' => ['admin']], function () {
        Route::get('/welcome', '\App\Http\Controllers\Admin\HomeController@home');
        Route::get('/home', '\App\Http\Controllers\Admin\HomeController@index');
        Route::get('/users/edit/{id}', '\App\Http\Controllers\Admin\UserController@edit');
        Route::post('/users/update/{id}', '\App\Http\Controllers\Admin\UserController@update')->name('users.update');;
        Route::get('/user/index', '\App\Http\Controllers\Admin\HomeController@index')->name('admin.users.index');
        Route::resource('roles', \App\Http\Controllers\Admin\RoleController::class);
        Route::get('/add_image_slider', '\App\Http\Controllers\Admin\ImageSliderController@add_image_slider');
        Route::post('/create_image_slider', '\App\Http\Controllers\Admin\ImageSliderController@store');
        Route::get('/image_slider/delete/{id}', '\App\Http\Controllers\Admin\ImageSliderController@delete');
        Route::get('/image_slider/edit/{id}', '\App\Http\Controllers\Admin\ImageSliderController@edit');
        Route::post('/update_image_slider/{id}', '\App\Http\Controllers\Admin\ImageSliderController@update_image_slider');
        Route::get('/image_sliders', '\App\Http\Controllers\Admin\ImageSliderController@index');
        Route::get('/articles/{type}', '\App\Http\Controllers\Admin\ArticleController@index');
        Route::get('/articles/approved/{id}/{type}', '\App\Http\Controllers\Admin\ArticleController@approved');
        Route::get('/articles/show/{id}/{type}', '\App\Http\Controllers\Admin\ArticleController@show');
        Route::get('/articles/delete/{id}', '\App\Http\Controllers\Admin\ArticleController@delete');

        Route::get('/profile/edit', '\App\Http\Controllers\Admin\AdminController@profil_edit');
        Route::post('/saveinfo', '\App\Http\Controllers\Admin\AdminController@saveinfo');
        Route::get('/logout', function () {
            Auth::logout();
            return redirect()->to('admin/login');
        })->name('logout');
        Route::get('/messages', '\App\Http\Controllers\Admin\AdminController@all_messages');
        Route::get('/message/delete/{id}', '\App\Http\Controllers\Admin\AdminController@delete_message');
        Route::get('/view_message/{id}', '\App\Http\Controllers\Admin\AdminController@view_one_message');
        Route::post('/sendMessage', '\App\Http\Controllers\Admin\AdminController@send_message_reply');
        Route::get('/unapprovedMedia', '\App\Http\Controllers\Admin\MediaController@unapproved_index')->name('unapprovedmedia');



        Route::get('/users', '\App\Http\Controllers\Admin\UserController@index');
        Route::get('/users/delete/{id}', '\App\Http\Controllers\Admin\UserController@destroy');
        Route::get('/users/add', '\App\Http\Controllers\Admin\UserController@create');
        Route::post('/new_user/add_new', '\App\Http\Controllers\Admin\UserController@store');
        Route::get('/user/edit/{id}', '\App\Http\Controllers\Admin\UserController@edit');
        Route::post('/user/update/{id}', '\App\Http\Controllers\Admin\UserController@update');
        Route::get('/changerole/{id}/{value}', '\App\Http\Controllers\Admin\UserController@changerole');
        Route::any('/users/search_users', '\App\Http\Controllers\Admin\UserController@search_user')->name('search_user');


        Route::get('/roles', '\App\Http\Controllers\Admin\NewRoleController@index')->name('roles');
        Route::get('/roles/delete/{id}', '\App\Http\Controllers\Admin\NewRoleController@destroy');
        Route::get('/role/add', '\App\Http\Controllers\Admin\NewRoleController@create')->name('add_roles');
        Route::post('/new_role/add_new', '\App\Http\Controllers\Admin\NewRoleController@store');
        Route::get('/role/edit/{id}', '\App\Http\Controllers\Admin\NewRoleController@edit');
        Route::post('/role/update/{id}', '\App\Http\Controllers\Admin\NewRoleController@update');
        Route::any('/roles/search_roles', '\App\Http\Controllers\Admin\NewRoleController@search_role')->name('search_role');

        Route::resource('rss', '\App\Http\Controllers\Admin\RssController');
        Route::get('rss/delete/{id}', '\App\Http\Controllers\Admin\RssController@delete');


        Route::get('/image_sliders', '\App\Http\Controllers\Admin\NewImageSliderController@index')->name('image_sliders');
        Route::get('/image_sliders/delete/{id}', '\App\Http\Controllers\Admin\NewImageSliderController@destroy');
        Route::get('/image_slider/add', '\App\Http\Controllers\Admin\NewImageSliderController@create')->name('add_image_sliders');
        Route::post('/new_image_slider/add_new', '\App\Http\Controllers\Admin\NewImageSliderController@store');
        Route::get('/image_slider/edit/{id}', '\App\Http\Controllers\Admin\NewImageSliderController@edit');
        Route::post('/image_slider/update/{id}', '\App\Http\Controllers\Admin\NewImageSliderController@update');



        Route::get('/media', '\App\Http\Controllers\Admin\MediaController@index')->name('media');
        Route::get('/changeapprove/{id}/{value}', '\App\Http\Controllers\Admin\MediaController@change_approve');
        Route::get('/media/delete/{id}', '\App\Http\Controllers\Admin\MediaController@destroy');
        Route::any('/media/search_media', '\App\Http\Controllers\Admin\MediaController@search_media')->name('search_media');



        //////import data
        Route::get('/import/data', '\App\Http\Controllers\Admin\ImportController@get');
        Route::post('/import', '\App\Http\Controllers\Admin\ImportController@import');
    });
});
