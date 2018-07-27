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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;

Route::get('/', 'IndexController@index')->name('index');

Route::get('success', 'PaymentController@get');
Route::post('success', 'PaymentController@post');

Route::get('clear-cache', function() {
    Artisan::call('cache:clear');

    return redirect('/');
});
Route::get('config-cache', function() {
    Artisan::call('config:cache');

    return redirect('/');
});

Route::get('cron', function() {
    Artisan::call('mailchimp:update');

    return redirect('/');
});

Route::get('webinar-mail', function() {
    Artisan::call('webinar:mail');

    return redirect('/');
});

Route::get('currency', function() {
    Artisan::call('currency:usd');

    return redirect('/');
});

Route::get('migrate', function() {
    Artisan::call('migrate');
    
    return redirect('/');
});

Route::get('sitemap-generate', function() {
    Artisan::call('migrate');
    
    return redirect('/');
});

$segment = Request::segment('1');
if(empty($segment)){
    Route::match(['get', 'post'], '/trainer', 'HomeController@index')->name('home');
}else{

    if($segment !== 'trainer' && $segment !== 'learner'){
        $segment = '/trainer';
    }

    Route::match(['get', 'post'], $segment, 'HomeController@index')->name('home');
}

Route::get('/404', 'HomeController@notFound')->name('404');
Route::get('/google-reg', 'MyaccountController@socialgoogle')->name('socialgoogle');
Route::match(['get', 'post'], '/session', 'MyaccountController@session')->name('session');



Route::group(['prefix' => $segment], function () use($segment) {

    // redirects
    $fullUrl = Request::fullUrl();
    $url = Request::url();

    // if ($fullUrl != strtolower($fullUrl) && !strpos($fullUrl, 'admin') && !strpos($fullUrl, 'google-reg')) {
    //     header("HTTP/1.1 301 Moved Permanently");
    //     header('Location: ' . strtolower($url), true, 301);
    //     exit();
    // }
    if (preg_match("/^.*?page=1$/", $fullUrl)) {
        header("HTTP/1.1 301 Moved Permanently");
        header('Location: ' . $url, true, 301);
        exit();
    }
    // redirects end

    Auth::routes();

    Route::match(['get', 'post'], '/confirm', 'Auth\RegisterController@confirm')->name('confirm');
    Route::match(['get', 'post'], '/privacy-policy', 'IndexController@privacy')->name('privacy');

    Route::post('/socialreg', 'MyaccountController@social')->name('socialreg');
    Route::post('/telegramreg', 'MyaccountController@telegramreg')->name('telegramreg');
    Route::post('/exists', 'MyaccountController@exists')->name('exists');
    Route::post('/telegram-exists', 'MyaccountController@telegramexists')->name('telexists');

    Route::match(['get', 'post'], '/payment', 'PaymentController@index')->middleware('auth')->name('payment');

    Route::match(['get', 'post'], '/payment-event', 'PaymentController@event')->middleware('auth')->name('payment/event');

    Route::group(['prefix' => '/payment'], function (){
        Route::match(['get', 'post'], '/success', 'PaymentController@success')->name('payment/success');
        Route::match(['get', 'post'], '/event-success', 'PaymentController@success')->name('payment/eventsuccess');
        Route::post('/zero', 'PaymentController@zero')->name('payment/zero');

    });

    Route::match(['get', 'post'], '/myaccount', 'MyaccountController@index')->middleware('auth')->name('myaccount');

    Route::match(['post'],'/chat/send', 'ChatController@sendMessage')->middleware('auth')->name('chat/send');
    Route::match(['post'],'/chat/ban', 'ChatController@banUser')->middleware('auth')->name('chat/ban');
    Route::match(['post'],'/chat/delete', 'ChatController@deleteMessage')->middleware('auth')->name('chat/delete');


    // Learner pages routing
    if (App::environment() == 'local'){

        Route::match(['get','post'], '/bookmarks', 'BookmarksController@index')->middleware('auth')->name('bookmarks');
        Route::match(['get','post'], '/calendar', 'CalendarController@index')->middleware('auth')->name('calendar');

        Route::group(['prefix' => 'detail'],function (){
            Route::match(['get','post'],'health', 'DetailController@health')->middleware('auth')->name('health');

            Route::group(['prefix' =>  'physical'],function(){
                Route::match(['get','post'],'/step','DetailController@physicalStep')->middleware('auth')->name('physical-step');
            });

            Route::match(['get','post'],'/step','DetailController@step')->middleware('auth')->name('step');
        });

        Route::match(['get','post'], '/detail', 'DetailController@index')->middleware('auth')->name('detail');


        Route::match(['get','post'], '/diary', 'DiaryController@index')->middleware('auth')->name('diary');
        Route::match(['get','post'], '/food', 'FoodController@index')->middleware('auth')->name('food');
        Route::match(['get','post'], '/trainings', 'TrainingsController@index')->middleware('auth')->name('trainings');
        Route::match(['get','post'], '/wizard', 'WizardController@index')->middleware('auth')->name('wizard');

    }


    Route::group(['prefix' => '/myaccount'], function (){
        Route::post('/deleteImg', 'MyaccountController@deleteImg')->name('myaccount/deleteImg');
        Route::get('/bonus', 'MyaccountController@bonus')->name('myaccount/bonus');
        Route::get('/bonuses', 'MyaccountController@bonuses')->name('myaccount/bonuses');
        Route::get('/subscriptions', 'MyaccountController@subscriptions')->name('myaccount/subscriptions');
        Route::post('/referal', 'MyaccountController@referal')->middleware('auth')->name('myaccount/referal');
        Route::post('/update', 'MyaccountController@update')->middleware('auth')->name('myaccount/update');
        Route::post('/update', 'MyaccountController@update')->middleware('auth')->name('myaccount/update');
    });
    Route::post('/subscribe', 'HomeController@subscribe')->name('subscribe');
    Route::get('/about', 'AboutController@index')->name('about');

    Route::group(['prefix' => '/events'], function () {
        Route::get('/current', 'EventsController@current')->name('events/current');
        Route::get('/future', 'EventsController@future')->name('events/future');
        Route::get('/past', 'EventsController@past')->name('events/past');
    });
    Route::get('/events', 'EventsController@index')->name('events');
    Route::get('/events/{alias}', 'EventsController@view')->name('events/view');


    Route::get('/training', 'TrainingController@index')->name('training');
    Route::get('/training/search', 'TrainingController@search')->name('training/search');
    Route::post('/training/social', 'TrainingController@social')->name('training/social');

    Route::get('/training/file/{alias}', 'TrainingController@file')->name('training/file');

    Route::match(['get', 'post'], '/training/{alias}', 'TrainingController@category')->name('training/category');
    Route::group(['prefix' => '/training/{alias}'], function () {
        Route::get('/article', 'TrainingController@article')->name('training/article');
        Route::get('/briefcases', 'TrainingController@briefcases')->name('training/briefcases');
        Route::get('/video', 'TrainingController@video')->name('training/video');

//        Route::get('/book', 'TrainingController@article')->name('training/book');
        Route::get('/tutorials', 'TrainingController@article')->name('training/tutorials');
        Route::get('/paper', 'TrainingController@briefcases')->name('training/paper');
        Route::get('/benefits', 'TrainingController@video')->name('training/benefits');

        Route::get('/{view}', 'TrainingController@view')->name('training/view');
    });


    Route::get('/video/{alias}', 'VideoController@category')->name('video/category');
    Route::get('/video', 'VideoController@index')->name('video');

    Route::get('/questions', 'QuestionsController@index')->name('questions');

    Route::get('/experts', 'ExpertsController@index')->name('experts');
    Route::get('/experts/{alias}', 'ExpertsController@category')->name('experts/category');
    Route::group(['prefix' => '/experts'], function () {
        Route::get('/fitness', 'ExpertsController@fitness')->name('experts/fitness');
        Route::get('/nutritionist', 'ExpertsController@nutritionist')->name('experts/nutritionist');
        Route::get('/psychologist', 'ExpertsController@psychologist')->name('experts/psychologist');
        Route::get('/physical-therapist', 'ExpertsController@physicalTherapist')->name('experts/physical-therapist');
    });

});




Route::middleware('level:5')->prefix('admin')->group(function() {

    Route::get('', 'Admin\AdminController@index')->name('admin');
    Route::prefix('users')->group(function() {
        Route::get('', 'Admin\UsersController@index')->name('admin/users');
        Route::get('{id}', array('as'=>'edit_user', 'uses'=>'Admin\UsersController@show'));
        Route::get('create', 'Admin\UsersController@create')->name('admin/users/create');
        Route::post('store', 'Admin\UsersController@store')->name('admin/users/store');
        Route::post('destroy', 'Admin\UsersController@destroy');

        Route::get("get",array('as'=>'get','uses'=> 'Admin\UsersController@get_users'));
    });
    Route::prefix('experts')->group(function() {
        Route::get('', 'Admin\ExpertsController@index')->name('admin/experts');
        Route::get('{id}', array('as'=>'edit_expert', 'uses'=>'Admin\ExpertsController@show'));
        Route::get('create', 'Admin\ExpertsController@create')->name('admin/experts/create');
        Route::post('store', 'Admin\ExpertsController@store')->name('admin/experts/store');
        Route::post('destroy', 'Admin\ExpertsController@destroy');
        Route::prefix('groups')->group(function() {
            Route::get('', 'Admin\ExpertsController@index_group')->name('admin/experts/groups');
            Route::get('{id}', array('as'=>'edit_expert_group', 'uses'=>'Admin\ExpertsController@show_group'));
            Route::get('create', 'Admin\ExpertsController@create_group')->name('admin/experts/groups/create');
            Route::post('store', 'Admin\ExpertsController@store_group')->name('admin/experts/groups/store');
            Route::post('destroy', 'Admin\ExpertsController@destroy_group');
        });
    });
    Route::prefix('items')->group(function() {
        Route::get('', 'Admin\ItemsController@index')->name('admin/items');
        Route::get('{id}', array('as'=>'edit_item', 'uses'=>'Admin\ItemsController@show'));
        Route::get('{id}/clone', 'Admin\ItemsController@clone_item')->name('admin/items/clone');
        Route::get('create', 'Admin\ItemsController@create')->name('admin/items/create');
        Route::post('get', 'Admin\ItemsController@get')->name('admin/items/get');
        Route::post('store', 'Admin\ItemsController@store')->name('admin/items/store');
        Route::post('destroy', 'Admin\ItemsController@destroy');
    });
    Route::prefix('categories')->group(function() {
        Route::get('', 'Admin\CategoriesController@index')->name('admin/categories');
        Route::get('{id}', array('as'=>'edit_category', 'uses'=>'Admin\CategoriesController@show'));
        Route::get('create', 'Admin\CategoriesController@create')->name('admin/categories/create');
        Route::post('store', 'Admin\CategoriesController@store')->name('admin/categories/store');
        Route::post('destroy', 'Admin\CategoriesController@destroy');
    });
    Route::prefix('event')->group(function() {
        Route::get('', 'Admin\EventsController@index')->name('admin/event');
        Route::get('{id}', array('as'=>'edit_event', 'uses'=>'Admin\EventsController@show'));
        Route::get('create', 'Admin\EventsController@create')->name('admin/event/create');
        Route::post('store', 'Admin\EventsController@store')->name('admin/event/store');
        Route::post('destroy', 'Admin\EventsController@destroy');
    });
    Route::prefix('galleries')->group(function() {
        Route::get('', 'Admin\GalleryController@index')->name('admin/galleries');
        Route::get('create', 'Admin\GalleryController@create')->name('admin/galleries/create');
        Route::post('create', 'Admin\GalleryController@store');
        Route::get('destroy', array('as' => 'delete_album','uses' => 'Admin\GalleryController@destroy'));
        Route::get('{id}', array('as' => 'show_album','uses' => 'Admin\GalleryController@show'));

        Route::get('{id}/add', array('as' => 'add_image','uses' => 'Admin\PhotoController@show'));
        Route::post('add', array('as' => 'add_image_to_album','uses' => 'Admin\PhotoController@store'));
        Route::get('delete/{id}', array('as' => 'delete_image','uses' => 'Admin\PhotoController@destroy'));
        Route::post('/move', array('as' => 'move_image', 'uses' => 'Admin\PhotoController@move'));
    });
    Route::prefix('payments')->group(function() {
        Route::get('', 'Admin\PaymentsController@index')->name('admin/payments');
        Route::get('{id}', array('as'=>'edit_payment', 'uses'=>'Admin\PaymentsController@show'));
        Route::get('create', 'Admin\PaymentsController@create')->name('admin/payments/create');
        Route::post('store', 'Admin\PaymentsController@store')->name('admin/payments/store');
        Route::post('destroy', 'Admin\PaymentsController@destroy');
    });
    Route::prefix('subscribers')->group(function() {
        Route::get('', 'Admin\SubscribesController@get_subscribers')->name('admin/subscribers');
        Route::get('groups', 'Admin\MailchimpController@index')->name('admin/subscribers/groups');
        Route::post('groups/get', 'Admin\MailchimpController@get')->name('admin/subscribers/groups/get');
        Route::post('groups/store', 'Admin\MailchimpController@store')->name('admin/subscribers/groups/store');
        Route::post('destroy', 'Admin\SubscribesController@destroy_subscriber');

        Route::get('users', 'Admin\MailchimpController@index_users')->name('admin/subscribers/users');
        Route::post('users/get', 'Admin\UsersController@get_users')->name('admin/subscribers/users/get');
        Route::post('users/store', 'Admin\MailchimpController@store_user')->name('admin/subscribers/users/store');
        Route::post('users/destroy', 'Admin\MailchimpController@destroy_user')->name('admin/subscribers/users/destroy');
        Route::post('users/update', 'Admin\MailchimpController@update')->name('admin/subscribers/users/update');
        Route::post('groups/get_list', 'Admin\MailchimpController@get_groups')->name('admin/subscribers/groups/get_list');

        Route::post('emails', 'Admin\MailchimpController@emails');
        Route::post('update', 'Admin\MailchimpController@update_email');
    });
    Route::prefix('orders')->group(function() {
        Route::get('', 'Admin\PaymentsController@get_orders')->name('admin/orders');
        Route::get('{id}', array('as'=>'edit_order', 'uses'=>'Admin\PaymentsController@get_order'));
        Route::get('create', 'Admin\PaymentsController@create_order')->name('admin/orders/create_order');
        Route::post('store', 'Admin\PaymentsController@order')->name('admin/orders/order');
        Route::post('destroy', 'Admin\PaymentsController@destroy_order');
    });
    Route::prefix('webinars')->group(function() {
        Route::get('', 'Admin\PaymentsController@get_webinars')->name('admin/webinars');
        Route::get('{id}', array('as'=>'edit_webinar', 'uses'=>'Admin\PaymentsController@get_webinar'));
        Route::get('create', 'Admin\PaymentsController@create_webinar')->name('admin/webinars/create');
        Route::post('store', 'Admin\PaymentsController@store_webinar')->name('admin/webinars/store');
        Route::post('destroy', 'Admin\PaymentsController@destroy_webinar');
    });
    Route::prefix('settings')->group(function() {
        Route::get('', 'Admin\SettingsController@index')->name('admin/settings');
        Route::get('{id}', array('as'=>'edit_setting', 'uses'=>'Admin\SettingsController@show'));
        Route::get('create', 'Admin\SettingsController@create')->name('admin/settings/create');
        Route::post('store', 'Admin\SettingsController@store')->name('admin/settings/store');
        Route::post('destroy', 'Admin\SettingsController@destroy');
    });
    Route::prefix('chat')->group(function() {
        Route::get('', 'Admin\ChatController@index')->name('admin/chat');
        Route::get('{id}', array('as'=>'edit_chat', 'uses'=>'Admin\ChatController@show'));
    });
    Route::prefix('subscribes')->group(function() {
        Route::get('', 'Admin\SubscribesController@index')->name('admin/subscribes');
        Route::get('{id}', array('as'=>'edit_subscribe', 'uses'=>'Admin\SubscribesController@show'));
        Route::get('create', 'Admin\SubscribesController@create')->name('admin/subscribes/create');
        Route::post('store', 'Admin\SubscribesController@store')->name('admin/subscribes/store');
        Route::post('destroy', 'Admin\SubscribesController@destroy');

        Route::post('to', 'Admin\SubscribesController@sender');
    });

    Route::prefix('messages')->group(function() {
        Route::get('', 'Admin\MessagesController@index')->name('admin/messages');
        Route::get('{id}', 'Admin\MessagesController@show');
        Route::get('create', 'Admin\MessagesController@create')->name('admin/messages/create');
        Route::post('store', 'Admin\MessagesController@store');
        Route::post('destroy', 'Admin\MessagesController@destroy');
    });

    Route::prefix('menu')->group(function() {
        Route::get('', 'Admin\MenuController@index')->name('admin/menu');
        Route::get('{id}', 'Admin\MenuController@show');
        Route::get('create', 'Admin\MenuController@create')->name('admin/menu/create');
        Route::post('store', 'Admin\MenuController@store');
        Route::post('destroy', 'Admin\MenuController@destroy');
    });

    Route::prefix('components')->group(function() {
        Route::get('', 'Admin\ComponentsController@index')->name('admin/components');
        Route::get('{id}', 'Admin\ComponentsController@show');
        Route::get('create', 'Admin\ComponentsController@create')->name('admin/components/create');
        Route::post('store', 'Admin\ComponentsController@store');
        Route::post('destroy', 'Admin\ComponentsController@destroy');
    });

    Route::prefix('modules')->group(function() {
        Route::get('', 'Admin\ModulesController@index')->name('admin/modules');
        Route::get('{id}', 'Admin\ModulesController@show');
        Route::get('create', 'Admin\ModulesController@create')->name('admin/modules/create');
        Route::post('create', 'Admin\ModulesController@store');
        Route::post('destroy', 'Admin\ModulesController@destroy');
    });

    Route::prefix('lib')->group(function() {
        Route::get('', 'Admin\LibraryController@index')->name('admin/lib');
        Route::get('{id}', 'Admin\LibraryController@get_file');
        Route::post('store', 'Admin\LibraryController@store');
        Route::post('destroy', 'Admin\LibraryController@destroy');
    });

});
