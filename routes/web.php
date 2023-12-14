<?php

use App\Models\User;
use App\Models\Faculty;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\AplicationController;
use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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

Route::get('/', function () {
    return view('welcome');
});

/*
1. get to return a view with a file selection and upload
2. post with uploading a file
 */





Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/profile_students', [ProfileController::class, 'edit'])->name('profile_students.edit');
    Route::patch('/profile_students', [ProfileController::class, 'update'])->name('profile_students.update');
    Route::delete('/profile_students', [ProfileController::class, 'destroy'])->name('profile_students.destroy');


    Route::get('/profile_employee', [ProfileController::class, 'edit'])->name('profile_employee.edit');
    Route::patch('/profile_employee', [ProfileController::class, 'update'])->name('profile_employee.update');
    Route::delete('/profile_employee', [ProfileController::class, 'destroy'])->name('profile_employee.destroy');


});

// маршруты для админа

Route::middleware(['auth', 'user_role:admin'])->group(function () {
    //Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('/courses', function () {
    return view('admin.courses');})->name('courses');

    // users
    Route::get('/users', function (Request $request) {
        $users = User::get();
    return view('admin.users', [
        'users' => $users
    ]);
    return view('admin.users');})->name('users');

    Route::patch('/users/{user}/updateRole', [UserController::class, 'updateRole'])
        ->name('users.updateRole');

    Route::delete('/users/{user}', [UserController::class, 'destroy_user'])->name('users.destroy_user');


    // faculties
    Route::get('/faculties', [FacultyController::class, 'showFaculty'])->name('faculties');
    Route::post('/faculties', [FacultyController::class, 'createFaculty'])->name('faculties.create');
    Route::delete('/faculties/{faculty}', [FacultyController::class, 'destroy_faculty'])->name('faculties.destroy_faculty');
    Route::patch('/faculties/{faculty}', [FacultyController::class, 'updateFaculty'])->name('faculties.update');

    // departments

    Route::get('/departments', [DepartmentController::class, 'showDepartment'])->name('departments');
    Route::post('/departments', [DepartmentController::class, 'createDepartment'])->name('departments.create');
    Route::delete('/departments/{department}', [DepartmentController::class, 'destroy_department'])->name('departments.destroy_department');

    Route::patch('/departments/{department}', [DepartmentController::class, 'updateDepartment'])->name('departments.update');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Route::post('/image/upload', 'App\Http\Controllers\ImageController@upload')->name('image.upload');

    Route::post('/dashboard', 'App\Http\Controllers\ImageController@upload')->name('image.upload');
    Route::get('/gallery', [ImageController::class, 'getAllImages'])->name('image.gallery');
});


// маршруты для студента

Route::get('/application', function () {
    return view('student.application');
})->middleware(['auth', 'user_role_student:student'])->name('application');

Route::middleware(['auth'])->group(function () {
    Route::post('/application', 'App\Http\Controllers\ApplicationController@upload')->name('application.upload');
    Route::get('/send', 'App\Http\Controllers\ApplicationController@send');

});



// для подтверждения почты

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');



// для сброса пароля

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', function (string $token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function (User $user, string $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        }
    );

    return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');





require __DIR__.'/auth.php';



