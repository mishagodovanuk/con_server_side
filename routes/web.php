<?php


use App\Http\Controllers\AddressController;
use App\Http\Controllers\Auth\FeedbackController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\RegisterController as RegistrationController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationCodeController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContainerController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\DictionaryController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\GoodsController;
use App\Http\Controllers\IntegrationController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\LeftoverController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RegisterStatusController;
use App\Http\Controllers\RegulationController;
use App\Http\Controllers\ResidueController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SKUPackageController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\TransportController;
use App\Http\Controllers\TransportEquipmentController;
use App\Http\Controllers\TransportPlanningController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ValidatorController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\WorkspacesController;
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


Route::get('/test', [\App\Http\Controllers\TestController::class, 'test']);

Route::get('lang/{locale}', [LanguageController::class, 'swap']);

// Для верстки


Route::get('/view2', [\App\Http\Controllers\Layout2Controller::class, 'index']);

$prefix = App\Http\Middleware\LocaleMiddleware::getLocale();

Route::group(['prefix' => "$prefix"], function () {

    Auth::routes([
        'register' => false,
        'reset' => false,
        'verify' => false,
        'confirm' => false,
    ]);

    Route::get('/file/{path}', [FileController::class, 'getFile'])
        ->where('path', '.*')
        ->name('file.get');

    Route::prefix('register')->controller(RegistrationController::class)->group(function () {
        Route::post('send-code', 'sendVerificationCode')->name('register.send-code');
        Route::post('register', 'register')->name('registration');
    });

    Route::prefix('verification')->controller(VerificationCodeController::class)->group(function () {
        Route::post('validate-code', 'validateCode')->name('verification.validate-code');
    });

    Route::prefix('password')->group(function () {
        Route::post('send-code', [ForgotPasswordController::class, 'sendVerificationCode'])->name('password.send-code');
        Route::post('reset', [ResetPasswordController::class, 'reset'])->name('password.reset');
    });

    Route::post('contact-admin', [FeedbackController::class, 'contactWithAdmin'])->name('feedback.contact-with-admin');

    Route::prefix('address')->controller(AddressController::class)->group(function () {
        Route::get('/settlement', 'settlement')->name('address.settlement');
        Route::get('/street', 'street')->name('address.street');
    });

    Route::prefix('dictionary')->controller(DictionaryController::class)->group(function () {
        //make exception for company
        Route::get('/company', 'getCompanyList')->name('dictionary.company');
        Route::get('/{dictionary}', 'getDictionaryList')->name('dictionary.list');
    });


    Route::middleware('auth')->group(function () {

        include 'web/onboarding.php';

        //routes after onboarding complete
        Route::middleware('onboarding-check')->group(function () {
            Route::get('/view', [\App\Http\Controllers\LayoutController::class, 'index']);

            Route::get('/', function () {
                return redirect()->route('user-board');
            });

            Route::prefix('validate')->controller(ValidatorController::class)->group(function () {
                Route::post('user-in-workspace', 'validateUserInWorkspace');
                Route::post('private-data', 'validatePrivateData');
                Route::post('working-data', 'validateWorkingData');
                Route::post('password-data', 'validatePasswordData');
                Route::post('pin-data', 'validatePinData');
                Route::post('/warehouse/main-data', 'validateWarehouseData');
            });

            Route::resource('/workspace', WorkspacesController::class)->except(['create', 'store', 'show']);
            Route::prefix('workspace')->group(function () {
                Route::controller(WorkspacesController::class)->group(function () {
                    Route::get('price', 'getPrice')->name('workspace.price');
                    Route::get('list', 'getWorkspacesList')->name('workspace.list');
                });
            });

            //<----------------------------------------------------------------------------------------------->
            //<----------------------------------------------------------------------------------------------->
            //<----------------------------------------------------------------------------------------------->


            //routes after workspace request was accepted
            Route::middleware('waiting-for-workspace')->group(function () {
                Route::prefix('user')->group(function () {
                    Route::controller(UserController::class)->group(function () {
                        Route::get('/all', 'users')->name('user-board');
                        Route::get('/update/{user}', 'update')->name('user.update');
                        Route::post('account/update/{user}', 'updateData')->name('update-working-data');
                        Route::post('change-password/{user}', 'changePassword')->name('change-password');
                        Route::post('change-avatar/{user}', 'updateAvatar')->name('change-avatar');
                        Route::post('delete-avatar/{user}', 'deleteAvatar')->name('delete-avatar');
                        Route::post('create', 'store')->name('user.store');
                        Route::get('create', 'create')->name('user.create');
                        Route::get('show/{user}', 'show')->name('user.show');
                        Route::get('change-temp-password', 'showChangeTempPasswordForm')->name('show-temp-password-form');
                        Route::post('change-temp-password', 'changeTempPassword')->name('update.temp.password');
                        Route::delete('delete/{user}', 'destroy')->name('user.delete');
                        Route::get('filter', 'filter')->name('user.filter');
                        Route::post('send-password', 'sendPassword')->name('user.send_password');
                    });
                    Route::controller(ScheduleController::class)->group(function () {
                        Route::post('create-schedule-pattern', 'store');
                        Route::get('schedule/update/{user}', 'editSchedule')->name('user.schedule-update');
                        Route::post('schedule/update/{user}', 'updateSchedule');
                        Route::post('warehouse/schedule/update/{warehouse}', 'updateWarehouseSchedule');
                    });
                });


                Route::prefix('company')->controller(CompanyController::class)->group(function () {
                    Route::get('table/filter', 'filter')->name('company.filter');
                });
                Route::resource('/company', CompanyController::class, ['except' => ['store', 'update']]);
                //TRANSPORT

                Route::resource('/transport', TransportController::class);
                Route::prefix('transport')->controller(TransportController::class)->group(function () {
                    Route::get('table/filter', 'filter')->name('transport.filter');
                    Route::get('model-by-brand/{transport_brand}', 'getModelByBrand');
                    Route::post('store-with-additional', 'storeWithAdditional');
                    Route::post('delete-image/{transport}', 'deleteImage')->name('transport.delete-image');
                    Route::put('update-with-additional/{transport}', 'updateWithAdditional');
                });

                Route::resource('/transport-equipment', TransportEquipmentController::class);
                Route::get('equipment-model-by-brand/{additional_equipment_brand}', [TransportEquipmentController::class, 'getModelByBrand']);
                Route::post('/transport-equipment/delete-image/{transport_equipment}', [TransportEquipmentController::class, 'deleteImage'])->name('transport-equipment.delete-image');
                Route::get('/transport-equipment/table/filter', [TransportEquipmentController::class, 'filter'])->name('transport-equipment.filter');
                //END TRANSPORT


                Route::resource('/warehouse', WarehouseController::class);

                Route::prefix('warehouse')->controller(WarehouseController::class)->group(function () {
                    Route::get('table/filter', 'filter')->name('warehouse.filter');
                    Route::get('schedule/edit/{warehouse}', 'editSchedule')->name('warehouse.schedule-update');
                    Route::post('schedule/update/{warehouse}', 'updateSchedule');
                    Route::get('coordinates/{warehouse}', 'getCoordinates');
                });

                Route::resource('sku', GoodsController::class);
                Route::prefix('sku')->controller(GoodsController::class)->group(function () {
                    Route::get('get-by-category/{id}', 'getSkuByCategory')->name('sku.get-by-category');
                    Route::get('all-data/{sku}', 'getAllData')->name('sku.get-all-data');
                    Route::get('table/filter', 'filter')->name('sku.filter');
                    Route::get('table/{sku}/package-filter', 'packageFilter')->name('sku.package-filter');
                    Route::get('table/{sku}/barcode-filter', 'barcodeFilter')->name('sku.barcode-filter');
                });

                Route::prefix('sku')->controller(SKUPackageController::class)->group(function () {
                    Route::post('package', 'create')->name('package.create');
                    Route::put('package/{package}', 'update')->name('package.update');
                    Route::delete('package/{package}', 'delete')->name('package.delete');
                    Route::post('barcode', 'createBarcode')->name('barcode.create');
                    Route::put('barcode/{barcode}', 'updateBarcode')->name('barcode.update');
                    Route::delete('barcode/{barcode}', 'deleteBarcode')->name('barcode.delete');
                });

                Route::prefix('table')->controller(TableController::class)->group(function () {
                    Route::get('{model}', 'index')->name('table.index');
                    Route::post('{model}', 'create')->name('table.create');
                    Route::put('{model}/{id}', 'update')->name('table.update');
                    Route::delete('{model}/{id}', 'delete')->name('table.delete');
                });

                Route::prefix('bookmark')->controller(BookmarkController::class)->group(function () {
                    Route::get('find-by-key/{key}', 'findByKey');
                    Route::post('/', 'store');
                    Route::post('delete', 'deleteByKey');
                });

                Route::prefix('register')->group(function () {
                    Route::controller(RegisterController::class)->group(function () {
                        Route::get('/storekeeper', 'storekeeper')->name('register.storekeeper');
                        Route::get('/guard', 'guardian')->name('register.guardian');
                        Route::get('/filter', 'filter')->name('register.filter');
                        Route::post('/', 'store')->name('register.store');
                        Route::put('/{register}', 'update')->name('register.update');
                        Route::get('/create', 'create')->name('register.create');
                        Route::get('/managers', 'getManagers')->name('register.managers');
                        Route::get('/storekeepers', 'getStorekeepers')->name('register.storekeepers');
                        Route::post('/page-by-record', 'getPageByRegister')->name('register.get-page');
                    });

                    Route::controller(RegisterStatusController::class)->group(function () {
                        Route::post('/status/register/{register}', 'registerStatus')->name('register.register-status');
                        Route::post('/status/apply/{register}', 'applyStatus')->name('register.apply-status');
                        Route::post('/status/launch/{register}', 'launchStatus')->name('register.launch-status');
                        Route::post('/status/released/{register}', 'releasedStatus')->name('register.released-status');
                        Route::post('/cancel/entrance/{register}', 'cancelEntrance')->name('register.cancel-entrance');
                    });
                });

                include 'web/document.php';

                Route::resource('/transport-planning', TransportPlanningController::class)->except(['update']);
                Route::prefix('transport-planning')->group(function () {
                    Route::controller(TransportPlanningController::class)->group(function () {
                        Route::get('table/filter', 'filter')->name('transport-planning.filter');
                        Route::get('table/transport-request-filter', 'transportRequestFilter')->name('transport-planning.transport-request-filter');

                        Route::get('list/{date}', 'listByDate')->name('transport-planning.list-by-date');
                        Route::get('table/goods-invoice-filter', 'goodsInvoicesFilter')->name('transport-planning.goods-invoices-filter');

                        Route::get('table/{id}/transport-request-filter', 'transportRequestByPlanningFilter')->name('transport-planning.transport-request-by-planning-filter');
                        Route::get('table/{id}/goods-invoice-filter', 'goodsInvoicesByPlanningFilter')->name('transport-planning.goods-invoices-by-planning-filter');
                        Route::get('documents', 'getDocuments')->name('transport-planning.documents');
                        Route::put('/status/{status}', 'updateStatus')->name('transport-planning.update-status');
                        Route::post('/status', 'addStatus')->name('transport-planning.add-status');
                        Route::post('/status/{status}/failure', 'addFailure')->name('transport-planning.add-failure');
                        Route::delete('/status/{status}', 'deleteStatus')->name('transport-planning.delete-status');
                    });
                });

                Route::resource('/integrations', IntegrationController::class)->only(['store', 'update', 'destroy']);

                Route::resource('/leftovers', LeftoverController::class)->only(['index']);
                Route::prefix('leftovers')->group(function () {
                    Route::controller(LeftoverController::class)->group(function () {
                        Route::get('/table/filter', 'filter')->name('leftovers.filter');
                        Route::get('/table/filter-by-party', 'filterByParty')->name('leftovers.filter-by-party');
                        Route::get('/table/filter-by-package', 'filterByPartyAndPackage')->name('leftovers.filter-by-package');

                        Route::post('add/{document}', 'addByDocument')->name('leftovers.add-by-document');
                        Route::post('remove/{document}', 'removeByDocument')->name('leftovers.remove-by-document');
                        Route::post('move/{document}', 'moveByDocument')->name('leftovers.move-by-document');
                    });
                });


                Route::resource('/containers', ContainerController::class)->except(['destroy']);
                Route::prefix('containers')->group(function () {
                    Route::controller(ContainerController::class)->group(function () {
                        Route::get('table/filter', 'filter')->name('containers.filter');
                        Route::get('get-by-type/{id}', 'getContainersByType')
                            ->name('containers.get-by-type');
                        Route::get('all-data/{container}', 'getAllData')
                            ->name('containers.get-all-data');
                    });
                });

                Route::resource('/services', ServiceController::class)->except(['destroy']);
                Route::prefix('services')->group(function () {
                    Route::controller(ServiceController::class)->group(function () {
                        Route::get('table/filter', 'filter')->name('services.filter');

                        Route::get('get-by-type/{id}', 'getServicesByType')
                            ->name('services.get-by-type');
                    });
                });

                Route::prefix('regulations')->group(function () {
                    Route::controller(RegulationController::class)->group(function () {
                        Route::get('/search', 'search')->name('regulations.search');
                        Route::get('/list', 'getList')->name('regulations.list');
                        Route::get('/{regulation}', 'show')->name('regulations.show')->withTrashed();
                        Route::post('/duplicate/{regulation}', 'duplicate')->name('regulations.duplicate')->withTrashed();
                        Route::delete('/archive/{regulation}', 'archive')->name('regulations.archive')->withTrashed();
                        Route::delete('/{regulation}', 'destroy')->name('regulations.destroy')->withTrashed();
                    });
                });
                Route::resource('/regulations', RegulationController::class)->except(['edit', 'create', 'destroy', 'show']);

                Route::prefix('residue-control')->group(function () {
                    Route::controller(ResidueController::class)->group(function () {
                        Route::get('/', 'index')->name('residue-control.index');
                        Route::get('/create', 'create')->name('residue-control.create');
                        Route::get('/catalog', 'catalog')->name('residue-control.catalog');
                    });
                });

                Route::prefix('contracts')->group(function () {
                    Route::controller(ContractController::class)->group(function () {
                        Route::post('/comment', 'createComment')->name('contracts.create-comment');
                        Route::post('/change-status', 'changeStatus')->name('contracts.change-status');
                        Route::get('table/filter', 'filter')->name('contracts.filter');
                    });
                });
                Route::resource('/contracts', ContractController::class);

                Route::prefix('invoices')->group(function () {
                    Route::controller(InvoiceController::class)->group(function () {
                        Route::get('table/filter', 'filter')->name('invoices.filter');
                        Route::get('table/obligations-filter', 'obligations_filter')->name('invoices.obligations-filter');

                        Route::get('/', 'index')->name('invoices.index');
                        Route::get('/create', 'create')->name('invoices.create');
                        Route::get('/view', 'show')->name('invoices.view');
                    });
                });

               include 'web/match.php';
            });
        });
    });
});
