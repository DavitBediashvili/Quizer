<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QuizController;

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
    return view('home');
})->name('home');

Route::get("/login", [AuthController::class, 'loginPage'])->name("login");
Route::post("/login", [AuthController::class, 'login']);

Route::get("/register", [AuthController::class, 'registerPage'])->name("register");
Route::post("/register", [AuthController::class, 'register']);

Route::middleware('auth')->get("/logout", [AuthController::class, 'logout'])->name("logout");

Route::middleware('admin')->get("/admin", [QuizController::class, 'admin'])->name("admin");
Route::middleware('admin')->post("/admin", [QuizController::class, 'admin']);

Route::get("/quizzes", [QuizController::class, 'list'])->name("list");
Route::post("/quizzes", [QuizController::class, 'list']);

Route::middleware('auth')->get("/quizzes_create", [QuizController::class, 'create'])->name("create");
Route::middleware('auth')->post("/quizzes_create", [QuizController::class, 'create']);

Route::middleware('auth')->get("/profile", [QuizController::class, 'profile'])->name("profile");
Route::middleware('auth')->post("/profile", [QuizController::class, 'profile']);

Route::middleware('auth')->get("/quiz_change/{names}", [QuizController::class, 'quiz_change'])->name("change");
Route::middleware('auth')->post("/quiz_change/{names}", [QuizController::class, 'quiz_change']);

Route::get("/quizz/{ids}", [QuizController::class, 'quiz_play'])->name("game");
Route::post("/quizz/{ids}", [QuizController::class, 'quiz_play']);