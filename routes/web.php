<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IslandController;
use App\Http\Controllers\DonorsController;
use App\Http\Controllers\FishCentersController;
use App\Http\Controllers\AssetsController;
use App\Http\Controllers\ShareController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\StockTakeController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\CommentController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function ()
 {
    Route::get('/home', [DashboardController::class, 'index'])->name('index');
    Route::get('/about', [DashboardController::class, 'about'])->name('about.index');

    //island
    Route::group(['as' => 'island.', 'prefix' => 'island'], function () {
        Route::get('', [IslandController::class, 'index'])->name('index');
        Route::get('create', [IslandController::class, 'create'])->name('create');
        Route::post('', [IslandController::class, 'store'])->name('store');
        Route::post('datatables', [IslandController::class, 'datatables'])->name('datatables');
        Route::get('export', [IslandController::class, 'exportlist'])->name('export');
        Route::group(['prefix' => '{kiisland?}'], function () {  //->where(['id' => '[0-9]+'])
            Route::get('', [IslandController::class, 'show'])->name('show');
            Route::get('edit', [IslandController::class, 'edit'])->name('edit');
            Route::match(['PUT', 'PATCH'], '', [IslandController::class, 'update'])->name('update');
            Route::delete('', [IslandController::class, 'delete'])->name('delete');
        });
    });

    //donor
    Route::group(['as' => 'donor.', 'prefix' => 'donor'], function () {
        Route::get('', [DonorsController::class, 'index'])->name('index');
        Route::get('create', [DonorsController::class, 'create'])->name('create');
        Route::post('', [DonorsController::class, 'store'])->name('store');
        Route::post('datatables', [DonorsController::class, 'datatables'])->name('datatables');
        Route::get('export', [DonorsController::class, 'exportlist'])->name('export');
        Route::group(['prefix' => '{donor_id}'], function () {  //->where(['id' => '[0-9]+'])
            Route::get('', [DonorsController::class, 'show'])->name('show');
            Route::get('edit', [DonorsController::class, 'edit'])->name('edit');
            Route::match(['PUT', 'PATCH'], '', [DonorsController::class, 'update'])->name('update');
            Route::delete('', [DonorsController::class, 'delete'])->name('delete');
        });
    });

    //fish center
    Route::group(['as' => 'fishcenter.', 'prefix' => 'fishcenter'], function () {
        Route::get('', [FishCentersController::class, 'index'])->name('index');
        Route::get('create', [FishCentersController::class, 'create'])->name('create');
        Route::post('', [FishCentersController::class, 'store'])->name('store');
        Route::post('datatables', [FishCentersController::class, 'datatables'])->name('datatables');
        Route::get('export', [FishCentersController::class, 'exportlist'])->name('export');
        Route::group(['prefix' => '{fishcenter}'], function () {  //->where(['id' => '[0-9]+'])
            Route::get('', [FishCentersController::class, 'show'])->name('show');
            Route::get('edit', [FishCentersController::class, 'edit'])->name('edit');
            Route::match(['PUT', 'PATCH'], '', [FishCentersController::class, 'update'])->name('update');
            Route::delete('', [FishCentersController::class, 'delete'])->name('delete');
        });
    });

// assets

    Route::group(['as' => 'asset.', 'prefix' => 'asset'], function () {
        Route::get('', [AssetsController::class, 'index'])->name('index');
        Route::get('create', [AssetsController::class, 'create'])->name('create');
        Route::post('', [AssetsController::class, 'store'])->name('store');
        Route::post('datatables', [AssetsController::class, 'datatables'])->name('datatables');
        Route::get('export', [AssetsController::class, 'exportlist'])->name('export');
        Route::group(['prefix' => '{asset}'], function () {  //->where(['id' => '[0-9]+'])
            Route::get('', [AssetsController::class, 'show'])->name('show');
            Route::get('edit', [AssetsController::class, 'edit'])->name('edit');
            Route::match(['PUT', 'PATCH'], '', [AssetsController::class, 'update'])->name('update');
            Route::delete('', [AssetsController::class, 'delete'])->name('delete');
        });
    });

    // share

    Route::group(['as' => 'share.', 'prefix' => 'share'], function () {
        Route::get('', [ShareController::class, 'index'])->name('index');
        Route::get('donors', [ShareController::class, 'indexofdonors'])->name('indexofdonors');
        Route::get('create/{donor_id}', [ShareController::class, 'create'])->name('create');
        Route::post('', [ShareController::class, 'store'])->name('store');
        Route::post('datatables', [ShareController::class, 'datatables'])->name('datatables');
        Route::get('export', [ShareController::class, 'exportlist'])->name('export');
        Route::group(['prefix' => '{share_id}'], function () {  //->where(['id' => '[0-9]+'])
            Route::get('', [ShareController::class, 'show'])->name('show');
            Route::get('edit', [ShareController::class, 'edit'])->name('edit');
            Route::match(['PUT', 'PATCH'], '', [ShareController::class, 'update'])->name('update');
            Route::delete('', [ShareController::class, 'delete'])->name('delete');
        });
    });

    // chart

    Route::group(['as' => 'chart.', 'prefix' => 'chart'], function () {
        Route::get('', [ChartController::class, 'index'])->name('index');
        Route::get('create', [ChartController::class, 'create'])->name('create');
        Route::post('', [ChartController::class, 'store'])->name('store');
        Route::post('datatables', [ChartController::class, 'datatables'])->name('datatables');
        Route::get('export', [ChartController::class, 'exportlist'])->name('export');
        Route::group(['prefix' => '{chart_id}'], function () {  //->where(['id' => '[0-9]+'])
            Route::get('', [ChartController::class, 'show'])->name('show');
            Route::get('edit', [ChartController::class, 'edit'])->name('edit');
            Route::match(['PUT', 'PATCH'], '', [ChartController::class, 'update'])->name('update');
            Route::delete('', [ChartController::class, 'delete'])->name('delete');
        });
    });


    Route::group(['as' => 'report.', 'prefix' => 'report'], function () {
        Route::get('', [ReportsController::class, 'index'])->name('index');
        Route::get('create', [ReportsController::class, 'create'])->name('create');
        Route::post('', [ReportsController::class, 'store'])->name('store');
        Route::post('datatables', [ReportsController::class, 'datatables'])->name('datatables');
        Route::get('export', [ReportsController::class, 'exportlist'])->name('export');
        Route::group(['prefix' => '{reports_id}'], function () {  //->where(['id' => '[0-9]+'])
            Route::get('', [ReportsController::class, 'AssetDonatedReportPdf'])->name('showpdf');
            Route::get('shares', [ReportsController::class, 'SharesAssetReportPdf'])->name('sharespdf');
            Route::get('edit', [ReportsController::class, 'edit'])->name('edit');
            Route::match(['PUT', 'PATCH'], '', [ReportsController::class, 'update'])->name('update');
            Route::delete('', [ReportsController::class, 'delete'])->name('delete');
        });
    });

        // stock take

        Route::group(['as' => 'stocktake.', 'prefix' => 'stocktake'], function () {
            Route::get('', [StockTakeController::class, 'index'])->name('index');
            Route::get('fishcenter', [StockTakeController::class, 'indexoffishcenter'])->name('indexoffishcenter');
            Route::get('create/{fishcenter_id}', [StockTakeController::class, 'create'])->name('create');
            Route::post('', [StockTakeController::class, 'store'])->name('store');
            Route::post('datatables', [StockTakeController::class, 'datatables'])->name('datatables');
            Route::get('export', [StockTakeController::class, 'exportlist'])->name('export');
            Route::group(['prefix' => '{stocktake_id}'], function () {  //->where(['id' => '[0-9]+'])
                Route::get('', [StockTakeController::class, 'show'])->name('show');
                Route::get('edit', [StockTakeController::class, 'edit'])->name('edit');
                Route::match(['PUT', 'PATCH'], '', [StockTakeController::class, 'update'])->name('update');
                Route::delete('', [StockTakeController::class, 'delete'])->name('delete');
            });
        });


          // status

          Route::group(['as' => 'status.', 'prefix' => 'status'], function () {
            Route::get('', [StatusController::class, 'index'])->name('index');
            Route::get('donors', [StatusController::class, 'indexofdonors'])->name('indexofdonors');
            Route::get('create', [StatusController::class, 'create'])->name('create');
            Route::post('', [StatusController::class, 'store'])->name('store');
            Route::post('datatables', [StatusController::class, 'datatables'])->name('datatables');
            Route::get('export', [StatusController::class, 'exportlist'])->name('export');
            Route::group(['prefix' => '{status_id}'], function () {  //->where(['id' => '[0-9]+'])
                Route::get('', [StatusController::class, 'show'])->name('show');
                Route::get('edit', [StatusController::class, 'edit'])->name('edit');
                Route::match(['PUT', 'PATCH'], '', [StatusController::class, 'update'])->name('update');
                Route::delete('', [StatusController::class, 'delete'])->name('delete');
            });
        });


        // comment

        Route::group(['as' => 'comment.', 'prefix' => 'comment'], function () {
            Route::get('', [CommentController::class, 'index'])->name('index');
            Route::get('create', [CommentController::class, 'create'])->name('create');
            Route::post('', [CommentController::class, 'store'])->name('store');
            Route::post('datatables', [CommentController::class, 'datatables'])->name('datatables');
            Route::get('export', [CommentController::class, 'exportlist'])->name('export');
            Route::group(['prefix' => '{comment_id}'], function () {  //->where(['id' => '[0-9]+'])
                Route::get('', [CommentController::class, 'show'])->name('show');
                Route::get('edit', [CommentController::class, 'edit'])->name('edit');
                Route::match(['PUT', 'PATCH'], '', [CommentController::class, 'update'])->name('update');
                Route::delete('', [CommentController::class, 'delete'])->name('delete');
            });
        });

        

});


