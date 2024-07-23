<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkspacesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OnboardingController;

Route::prefix('onboarding')->group(function () {
    Route::controller(OnboardingController::class)->group(function () {
        Route::get('/', 'index')->name('onboarding');
        Route::post('/admin', 'addAdminToCompany');
    });
});

Route::prefix('company')->controller(CompanyController::class)->group(function () {
    Route::post('create-legal', 'storeLegalCompany')->name('create.legal-company');
    Route::post('create-physical', 'storePhysicalCompany')->name('create.physical-company');
    Route::post('update-legal/{company}', 'updateLegalCompany')->name('update.legal-company');
    Route::post('update-physical/{company}', 'updatePhysicalCompany')->name('update.physical-company');
    Route::post('delete-image/{company}', 'removeImage')->name('company.delete-image');
    Route::post('add-to-workspace/{company}', 'addCompanyToWorkspace')->name('company.add-to-workspace');
    Route::get('find', 'find');
});

Route::post('user/update/onboarding', [UserController::class, 'updateOnboarding']);

Route::prefix('workspace')->controller(WorkspacesController::class)->group(function () {
    Route::post('/change-selected-workspace', 'changeSelectedWorkspace')->name('workspace.change-selected-workspace');
    Route::post('add-user', 'addUserToWorkspace')->name('workspace.add-user-to-workspace');
    Route::get('/create/{company_id?}', 'create')->name('workspace.create');
    Route::get('/create-company', 'createCompany')->name('workspace.create-company');
    Route::post('/approve', 'approveUserToWorkspace')->name('workspace.approve');
    Route::post('/unapprove', 'unapproveUserToWorkspace')->name('workspace.unapprove');
    Route::post('/request/send', 'sendJoinRequest');

    //should be at the end of post routes
    Route::post('/{company?}', 'store')->name('workspace.store');
});

