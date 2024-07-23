<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Match\CargoRequestController;
use App\Http\Controllers\Match\GoodsInvoiceController;
use App\Http\Controllers\Match\DispatcherController;
use App\Http\Controllers\Match\LogistController;
use App\Http\Controllers\Match\MatchController;
use App\Http\Controllers\Match\TransportPlanningController as TransportPlanningControllerAlias;
use App\Http\Controllers\TypeGoodsController;

Route::prefix('match')->group(function () {

    Route::controller(DispatcherController::class)->group(function () {
        Route::group(['middleware' => ['can:dispatcher']], function () {
            Route::prefix('dispatcher')->group(function () {
                Route::get('/', 'showDispatcher')->name('match.dispatcher.top-up');
                Route::get('/joint-ftl', 'jointFtl')->name('match.dispatcher.joint-ftl');
                Route::get('/larger-transport', 'largerTransport')->name('match.dispatcher.larger-transport');
                Route::get('/reverse-loading', 'reverseLoading')->name('match.dispatcher.back-haul');
                Route::get('/consolidation/draft', 'draft')->name('match.dispatcher.consolidation.draft');
                Route::get('/consolidation/created', 'created')->name('match.dispatcher.consolidation.created');
            });
        });
        Route::get('transport-planning/filter', 'filter')->name('match.transport-planning.filter');
    });

    Route::controller(CargoRequestController::class)->group(function () {
        Route::get('transport-planning/filter-by-cargo-request', 'transportPlanningFilter')
            ->name('match.transport-planning-by-cargo-request.filter');
        Route::get('reverse-loading/transport-planning/get-info/{transportPlanning}', 'getTransportPlanningInfo')
            ->name('match.reverse-loading.transport-planning.get-info');
    });


    Route::prefix('cargo-request')->controller(CargoRequestController::class)->group(function () {
        Route::get('/filter', 'cargoRequestFilter')->name('match.cargo-request.filter');
        Route::get('/get-info/{document}', 'getInfo')->name('match.cargo-request.get-info');
        Route::get('/route-by-cargo-request/{cargoRequest}', 'getRouteByCargoRequest')->name('match.cargo-request.get-route');
    });

    Route::controller(LogistController::class)->prefix('logistician')->group(function () {
        Route::group(['middleware' => ['can:logistic']], function () {
            Route::get('/', 'showLogistic')->name('match.logistician.pending-review');
            Route::get('/pending-review', 'pendinReview')->name('match.logistician.pending-review');
            Route::get('/in-progress', 'progress')->name('match.logistician.in-progress');
            Route::get('/confirmed', 'confirmed')->name('match.logistician.confirmed');
            Route::get('/rejected', 'rejected')->name('match.logistician.rejected');
        });
    });

    Route::prefix('transport-planning')->controller(TransportPlanningControllerAlias::class)->group(function () {
        Route::get('/get-info/{transportPlanning}', 'getTransportPlanningInfo')->name('match.transport-planning.get-info');
        Route::get('/get-total/{transportPlanning}', 'getTotal')->name('match.transport-planning.get-total');
        Route::post('/reserve', 'reserve')->name('match.transport-planning.reserve');
        Route::post('/unreserve', 'unReserve')->name('match.transport-planning.unreserve');
    });

    Route::prefix('goods-invoice')->controller(GoodsInvoiceController::class)->group(function () {
        Route::get('/get-by-planning/{transportPlanning}', 'getGoodsInvoicesByTransportPlanning')->name('match.goods-invoice.get-by-planning');
        Route::get('/get-info/{document}', 'getGoodsInvoicesInfo')->name('match.goods-invoice.get-info');
        Route::get('/filter', 'filter')->name('match.goods-invoice.filter');
    });


    Route::controller(MatchController::class)->group(function () {
        Route::get('/consolidation/filter', 'matchFilter')->name('match.consolidation.filter');
        Route::get('get-route-by-planning/{transportPlanning}', 'getRouteByPlanning')
            ->name('match.get-route-by-planning');
        Route::post('/consolidation/return-to-work/{consolidation}', 'returnToWork')
            ->name('match.consolidation.return-to-work');
    });
    Route::resource('consolidation', MatchController::class)
        ->except(['create', 'index']);
});

Route::resource('type-goods', TypeGoodsController::class);
