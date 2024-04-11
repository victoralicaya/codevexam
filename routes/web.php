<?php

use App\Livewire\Company\AddCompany;
use App\Livewire\Company\Company;
use App\Livewire\Company\ViewCompany;
use App\Livewire\Login;
use App\Livewire\Register;
use Illuminate\Support\Facades\Route;

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

Route::get('login', Login::class)->name('login');
Route::get('register', Register::class)->name('register');

Route::get('/', Company::class)->name('dashboard');
Route::get('company/{slug}', ViewCompany::class)->name('viewCompany');

Route::middleware(['auth'])->group(function() {
    Route::get('add-company', AddCompany::class)->name('addCompany');
});
