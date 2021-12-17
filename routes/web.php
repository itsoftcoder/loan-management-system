<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth'])->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // resource route for branch/
    Route::resource('branch', App\Http\Controllers\BranchController::class);
    Route::get('branch-change-status',[App\Http\Controllers\BranchController::class, 'changeStatus'])->name('branch.change-status');

    Route::get('branch-capital/{branch_id?}', [App\Http\Controllers\BranchCapitalController::class,'index'])->name('branch-capital.index');
    Route::get('branch-capital-create/{branch_id?}', [App\Http\Controllers\BranchCapitalController::class,'create'])->name('branch-capital.create');
    Route::post('branch-capital/{branch_id?}', [App\Http\Controllers\BranchCapitalController::class,'store'])->name('branch-capital.store');
    Route::get('branch-capital-edit/{branch_capital_id?}', [App\Http\Controllers\BranchCapitalController::class,'edit'])->name('branch-capital.edit');
    Route::put('branch-capital-update/{branch_capital_id?}', [App\Http\Controllers\BranchCapitalController::class,'update'])->name('branch-capital.update');

    Route::get('branch-holiday/{branch_id?}',[App\Http\Controllers\BranchHolidayController::class, 'index'])->name('branch-holiday.index');
    Route::get('branch-holiday-create/{branch_id?}',[App\Http\Controllers\BranchHolidayController::class, 'create'])->name('branch-holiday.create');
    Route::post('branch-holiday/{branch_id?}',[App\Http\Controllers\BranchHolidayController::class, 'store'])->name('branch-holiday.store');
    Route::get('branch-holiday-edit/{branch_id?}',[App\Http\Controllers\BranchHolidayController::class, 'edit'])->name('branch-holiday.edit');
    Route::put('branch-holiday-update/{branch_id?}',[App\Http\Controllers\BranchHolidayController::class, 'update'])->name('branch-holiday.update');
    Route::get('branch-holiday-change-friday-is-holiday',[App\Http\Controllers\BranchHolidayController::class, 'changeFridayIsHoliday'])->name('branch-holiday.change-friday-is-holiday');
    Route::get('branch-holiday-change-saturday-is-holiday',[App\Http\Controllers\BranchHolidayController::class, 'changeSaturdayIsHoliday'])->name('branch-holiday.change-saturday-is-holiday');
    Route::get('branch-holiday-change-sunday-is-holiday',[App\Http\Controllers\BranchHolidayController::class, 'changeSundayIsHoliday'])->name('branch-holiday.change-sunday-is-holiday');

});


Auth::routes();

