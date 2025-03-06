<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoController;

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

Route::middleware("auth")->get("/", function () {
    return view("welcome");
});

Route::middleware("guest")->prefix("auth")->as("auth.")->group(function () {
    Route::get("/login", [AuthController::class, "login"])->name("login");
    Route::get("/register", [AuthController::class, "register"])->name("register");
    Route::post("/register", [AuthController::class, "doRegister"])->name("create");
    Route::post("/login", [AuthController::class, "authenticate"])->name("authenticate");
});

Route::post("/logout", [AuthController::class, "logout"])->name("logout");

Route::middleware("auth")->as("todo.")->group(function () {
    Route::get("/todo", [TodoController::class, "index"])->name("index");
    Route::get("/todo/add", [TodoController::class, "add"])->name("add");
    Route::post("/todo/add", [TodoController::class, "store"])->name("store");
    Route::delete("/todo/{id}", [TodoController::class, "delete"])->name("delete");
});
