<?php


use App\Http\Controllers\InvoiceSystem;
use App\Http\Controllers\GeneralController;
Route::get('change_language/{locale}' , [GeneralController::class , 'changeLanguage' ])->name('frontend_change_locale');

Route::resource('/invoice' , InvoiceSystem::class);
Route::get('/invo/{id}/show' ,[InvoiceSystem::class , 'dispaly']);
Route::get('invoice/print/{id}',[InvoiceSystem::class , 'print']);
Route::get('invoice/pdf/{id}',[InvoiceSystem::class , 'pdf']);
Route::get('invoice/send_to_email/{id}',[InvoiceSystem::class , 'send_to_email']);


