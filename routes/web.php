<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
*/
Auth::routes();
/*
 * Facebook and Google login redirects
 */
Route::get('/redirect', 'SocialAuthFacebookController@redirect');
Route::get('/callback', 'SocialAuthFacebookController@callback');
Route::get('/redirectGoogle', 'SocialAuthGoogleController@redirect');
Route::get('/callbackGoogle', 'SocialAuthGoogleController@callback');

/*
 * GET Routes
 */
Route::get('rooms/{slug}', 'RoomsController@slug')->name('rooms.slug');
Route::get('/', 'PageController@home')->name('home'); //PageController function home
Route::get('/my-rooms', 'RoomsController@myRooms')->middleware('auth')->name('rooms.myRooms');
Route::get('/contact', 'PageController@showContact')->name('page.contact');
Route::get('/about', 'PageController@showAbout')->name('page.about');

/*
 * RESOURCE Routes
 */
Route::resource('/rooms', 'RoomsController');// fetches all default functions inside controllers
Route::resource('/user', 'UserController');
Route::resource('/bookings', 'BookingController')->middleware('auth');
Route::resource('/reviews', 'ReviewsController')->middleware('auth');
Route::resource('/favorites', 'FavoritesController')->middleware('auth');

/*
 * POST Routes
 */
Route::post('/rooms/filter', 'RoomsController@filter')->name('rooms.filter');
Route::post('/rooms/get_booking_dates', 'RoomsController@get_booking_dates')->name('rooms.get_booking_dates');
Route::post('/rooms/form', 'RoomsController@formRooms')->name('rooms.form');
Route::post('/stripe_pay', 'BookingController@stripePay')->middleware('auth')->name('stripe.pay');
Route::post('/booking/checkout', 'BookingController@checkout')->middleware('auth')->name('booking.checkout');
Route::post('stripe/webhook', '\App\Http\Controllers\WebhookController@handleWebhook');
/*
 * REDIRECT 301 Routes
 */
Route::redirect('/home', '/', 301);
Route::redirect('/room', '/rooms', 301);
