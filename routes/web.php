<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\gCalendarController;
use App\Http\Controllers\SecretaryController;
use Spatie\GoogleCalendar\Event;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*------------admin route------ */
Route::prefix('admin')->group(function(){
    Route::get('/login',[AdminController::class, 'Index'])->name('login_form');
    Route::post('/login/owner',[AdminController::class, 'Login'])->name('admin.login');
    Route::get('/dashboard',[AdminController::class, 'Dashboard'])->name('admin.dashboard')->middleware('admin');
    Route::get('/logout',[AdminController::class, 'AdminLogout'])->name('admin.logout')->middleware('admin');
    Route::get('/register',[AdminController::class, 'AdminRegister'])->name('admin.register');
});

Route::post('/register/create',[AdminController::class, 'AdminRegisterCreate'])->name('admin.register.create');

/*------------end  admin route------ */


/*------------secretary route------ */
Route::prefix('secretary')->group(function(){
    Route::get('/login',[SecretaryController::class, 'SecretaryIndex'])->name('secretary_login_form');
    Route::get('/dashboard',[SecretaryController::class, 'SecretaryDashboard'])->name('secretary.dashboard')->middleware('secretary');
    Route::post('/login/owner',[SecretaryController::class, 'SecretaryLogin'])->name('secretary.login');
    Route::get('/logout',[SecretaryController::class, 'SecretaryLogout'])->name('secretary.logout')->middleware('secretary');
    Route::get('/register',[SecretaryController::class, 'SecretaryRegister'])->name('secretary.register');
});

Route::post('/register/create',[SecretaryController::class, 'SecretaryRegisterCreate'])->name('secretary.register.create');

/*------------end  secretary route------ */


Route::get('/', function () {
    return view('calendar.createEvent');
 
    $event = new Event;

    $event->name = 'A new event';
    $event->description = 'Event description';
    $event->startDateTime = Carbon\Carbon::now();
    $event->endDateTime = Carbon\Carbon::now()->addHour();
    $event->addAttendee([
        'email' => 'john@example.com',
        'name' => 'John Doe',
        'comment' => 'Lorum ipsum',
    ]);
    $event->addAttendee(['email' => 'anotherEmail@gmail.com']);
    $event->addMeetLink(); // optionally add a google meet link to the event
    
    $event->save();
    
    // get all future events on a calendar
    $events = Event::get();
    
    // update existing event
    $firstEvent = $events->first();
    $firstEvent->name = 'updated name';
    $firstEvent->save();
    
    $firstEvent->update(['name' => 'updated again']);
    
    // create a new event
    Event::create([
       'name' => 'A new event',
       'startDateTime' => Carbon\Carbon::now(),
       'endDateTime' => Carbon\Carbon::now()->addHour(),
    ]);
    
    // delete an event
    $event->delete();
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*------------gCalendar routes------ */
Route::get('/gcalendar', [gCalendarController::class, 'index'])->name('cal.index');
Route::get('/gcalendar/oauth', [gCalendarController::class, 'oauth'])->name('oauthCallback');
Route::get('/gcalendar/create', [gCalendarController::class, 'create'])->name('cal.create');
Route::post('/gcalendar/store', [gCalendarController::class, 'store'])->name('cal.store');
Route::get('/gcalendar/show/{eventId}', [gCalendarController::class, 'show'])->name('cal.show');
Route::post('/gcalendar/update/{eventId}', [gCalendarController::class, 'update'])->name('cal.update');
Route::get('/gcalendar/destroy/{eventId}', [gCalendarController::class, 'destroy'])->name('cal.destroy');
/*------------end gCalendar routes------ */

require __DIR__.'/auth.php';