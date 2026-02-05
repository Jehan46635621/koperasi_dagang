<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

// HCMS Integration APIs
Route::prefix('hcms')->middleware(['auth:sanctum'])->group(function () {
    // Employee loan data for payroll deductions
    Route::get('/employees/{employee_id}/loans', function ($employee_id) {
        // Implementation will be added
        return response()->json(['message' => 'Endpoint ready for implementation']);
    });
    
    // Employee savings data for payroll deductions
    Route::get('/employees/{employee_id}/savings', function ($employee_id) {
        // Implementation will be added
        return response()->json(['message' => 'Endpoint ready for implementation']);
    });
    
    // Calculate total monthly deductions
    Route::get('/employees/{employee_id}/deductions', function ($employee_id) {
        // Implementation will be added
        return response()->json(['message' => 'Endpoint ready for implementation']);
    });
    
    // Record loan payment from payroll
    Route::post('/loans/{loan_id}/payments', function ($loan_id) {
        // Implementation will be added
        return response()->json(['message' => 'Endpoint ready for implementation']);
    });
    
    // Record savings contribution from payroll
    Route::post('/savings/{account_id}/contributions', function ($account_id) {
        // Implementation will be added
        return response()->json(['message' => 'Endpoint ready for implementation']);
    });
});
