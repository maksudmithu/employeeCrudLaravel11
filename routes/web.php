<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [EmployeeController::class, 'index'])->name('employee.index');
Route::get('/create', [EmployeeController::class, 'create'])->name('employee.create');
Route::post('/create', [EmployeeController::class, 'store'])->name('employee.store');
Route::get('/edit/{id}', [EmployeeController::class, 'edit'])->name('employee.edit');
Route::post('/update/{id}', [EmployeeController::class, 'update'])->name('employee.update');
Route::get('/delete/{id}', [EmployeeController::class, 'delete'])->name('employee.delete');
