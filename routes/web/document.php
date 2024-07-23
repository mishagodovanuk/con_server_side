<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DoctypeFieldController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DocumentRelationController;
use App\Http\Controllers\DocumentTypeController;
use App\Http\Controllers\ContainerInDocumentController;
use App\Http\Controllers\ServiceInDocumentController;
use App\Http\Controllers\SkuInDocumentController;

Route::resource('document-type', DocumentTypeController::class)->except(['show']);
Route::prefix('document-type')->group(function () {
    Route::controller(DocumentTypeController::class)->group(function () {
        Route::get('/preview', 'preview')->name('document-type.preview');
        Route::post('/draft', 'storeDraft')->name('document-type.draft.create');
        Route::post('/field', [DoctypeFieldController::class, 'store'])->name('field.create');
        Route::delete('/field/{key}', [DoctypeFieldController::class, 'destroy'])->name('field.destroy');
        Route::get('table/filter', 'filter');

        //should be in end of group
        Route::post('/{status}/{document_type}', 'changeStatus')->name('document-type.status.change');
    });
});

Route::resource('document', DocumentController::class)->except(['create']);
Route::prefix('document')->group(function () {
    Route::controller(DocumentController::class)->group(function () {
        Route::get('table/filter', 'filter')->name('document.filter');
        Route::get('table/{document_type}', 'table')->name('document.table');
        Route::post('table/create', 'createRelatedDocument')->name('related-document.create');
        Route::get('create/{document_type}', 'create')->name('document.create');
    });
});

Route::prefix('document/sku')->group(function () {
    Route::controller(SkuInDocumentController::class)->group(function () {
        Route::get('table/filter', 'filter')->name('sku-document.filter');
        Route::post('/', 'store')->name('sku-document.store');
        Route::post('/table', 'tableStore')->name('sku-document.table');
    });
});

Route::prefix('document/container')->group(function () {
    Route::controller(ContainerInDocumentController::class)->group(function () {
        Route::get('table/filter', 'filter')->name('container-document.filter');
        Route::post('/', 'store')->name('container-document.store');
        Route::post('/table', 'tableStore')->name('container-document.table');
    });
});

Route::prefix('document/service')->group(function () {
    Route::controller(ServiceInDocumentController::class)->group(function () {
        Route::get('table/filter', 'filter')->name('service-document.filter');
        Route::post('/', 'store')->name('service-document.store');
        Route::post('/table', 'tableStore')->name('service-document.table');
    });
});

Route::prefix('document/related')->controller(DocumentRelationController::class)->group(function () {
    Route::post('/', 'store')->name('related-document.store');
    Route::delete('/{document_id}/{related_id}', 'delete')->name('related-document.delete');
    Route::get('/filter', 'filter')->name('related-document.filter');
});
