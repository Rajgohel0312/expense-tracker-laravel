<?php

use App\Http\Controllers\ExpenseController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ExpenseController::class, 'showExpense'])->name('expenses.index');
Route::get('/expenses/addExpenses', [ExpenseController::class, 'addExpenses']);
Route::post('/expenses/create', [ExpenseController::class, 'create']);
Route::get('/expenses/addIncome', [ExpenseController::class, 'addIncome']);
Route::post('/expenses/createIncome', [ExpenseController::class, 'createIncome']);
Route::get('/expenses/{encryptedId}/edit', [ExpenseController::class, 'edit']);
Route::put('/expenses/{id}/update', [ExpenseController::class, 'update'])->name('expenses.update');
Route::delete('/expenses/{hashed_id}/delete', [ExpenseController::class, 'delete'])->name('expenses.delete');