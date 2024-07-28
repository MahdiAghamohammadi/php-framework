<?php

use Core\Router\Web\Route;

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index']);
Route::get("/users", [\App\Http\Controllers\UserController::class, 'index']);
Route::get("/user", [\App\Http\Controllers\UserController::class, 'create']);
Route::post("/user", [\App\Http\Controllers\UserController::class, 'store']);
Route::get("/user/{id}", [\App\Http\Controllers\UserController::class, 'edit']);
Route::put("/user/{id}", [\App\Http\Controllers\UserController::class, 'update']);
Route::delete("/user/{id}", [\App\Http\Controllers\UserController::class, 'destroy']);

//echo CURRENT_ROUTE;
//global $routes;
//echo "<br/>";
//print_r($routes);