<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DOController;

use App\Http\Controllers\ITRController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ExpiredController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StockCountController;

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

// login
Route::middleware(['guest'])->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('home');
    Route::post('/login', [AuthController::class, 'authenticate']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/markasread/{id}', function ($id) {
        $notification = auth()->user()->unreadNotifications->find($id);

        if ($notification) {
            // Mark the notification as read
            
            // Do something with the notification, if needed
            if(str_contains($notification->data['message'], 'Material')) {
                $notification->markAsRead();
                return redirect()->route('materialReqs');
            }

            if(str_contains($notification->data['message'], 'Stock Count')) {
                $notification->markAsRead();
                return redirect()->route('stockCounts');
            }

            if(str_contains($notification->data['message'], 'ITR')) {
                $notification->markAsRead();
                return redirect()->route('itr');
            }

            if(str_contains($notification->data['message'], 'DO')) {
                $notification->markAsRead();
                return redirect()->route('do');
            }
        }

        return back();
    })->name('markasread');

    Route::get('/markasread-all', function () {
        auth()->user()->unreadNotifications->markAsRead();

        return back();
    })->name('markasread-all');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    /* Report */
    Route::get('/report', function () {
        return view('admin/report');
    });
    
    // Material Request
    Route::get('/materialreq', [MaterialController::class, 'index'])->name('materialReqs');
    Route::get('/create-material', [MaterialController::class, 'indexcreate']);
    Route::post('/materialreq-store', [MaterialController::class, 'store']);
    Route::get('/view-material/{materialId}', [MaterialController::class, 'detailmaterial']);
    Route::get('/delete-material/{materialId}', [MaterialController::class, 'destroymaterial']);
    Route::put('/update-material/{materialId}', [MaterialController::class, 'update'])->name('updateMaterial');
    Route::get('/update-index-material/{materialId}', [MaterialController::class, 'edit'])->name('updateIndexMaterial');
    Route::get('/material-pdf/{id}', [MaterialController::class, 'generatepdf'])->name('material-pdf');
    
    // product
    Route::middleware(['auth', 'role:admin_gudang'])->group(function () {
        Route::get('/product', [ProductController::class, 'index'])->name('products');
        Route::get('/create-product', [ProductController::class, 'indexcreate']);
        Route::post('/product-store', [ProductController::class, 'store']);
        Route::get('/view-product/{productId}', [ProductController::class, 'detailproduct']);
        Route::get('/delete-product/{productId}', [ProductController::class, 'destroyproduct']);
        Route::get('/edit-product/{productId}', [ProductController::class, 'edit'])->name('editProduct');
        Route::put('/update-product/{productId}', [ProductController::class, 'update'])->name('updateProduct');

        // Expired
        Route::get('/expiredMaterial', [ExpiredController::class, 'expiredMaterial'])->name('expiredMaterial');
        Route::put('/activeMaterial/{id}', [ExpiredController::class, 'activeMaterial'])->name('activeMaterial');
        Route::get('/expiredStock', [ExpiredController::class, 'expiredStock'])->name('expiredStock');
        Route::put('/activeStock/{id}', [ExpiredController::class, 'activeStock'])->name('activeStock');
        Route::get('/expiredITR', [ExpiredController::class, 'expiredITR'])->name('expiredITR');
        Route::put('/activeITR/{id}', [ExpiredController::class, 'activeITR'])->name('activeITR');
        Route::get('/expiredDO', [ExpiredController::class, 'expiredDO'])->name('expiredDO');
        Route::put('/activeDO/{id}', [ExpiredController::class, 'activeDO'])->name('activeDO');

        Route::get('/reporting', [ReportController::class, 'index'])->name('reporting');

    });
    
    // ITR
    Route::get('/ITR', [ITRController::class, 'index'])->name('itr');
    Route::get('/ITR-In', [ITRController::class, 'ITRIn'])->name('itrIn');
    Route::get('/create-ITR', [ITRController::class, 'indexcreate']);
    Route::post('/ITR-store', [ITRController::class, 'store']);
    Route::get('/delete-ITR/{itrId}', [ITRController::class, 'destroyitr']);
    Route::get('/view-ITR/{itrId}', [ITRController::class, 'detailItr']);
    Route::get('/edit-ITR/{itrId}', [ITRController::class, 'edit'])->name('editItr');
    Route::put('/update-ITR/{itrId}', [ITRController::class, 'update'])->name('updateItr');
    Route::get('/itr-pdf/{id}', [ITRController::class, 'generatepdf'])->name('itr-pdf');
    
    // Stock Count
    Route::get('/stockcount', [StockCountController::class, 'index'])->name('stockCounts');
    Route::get('/create-stock', [StockCountController::class, 'indexcreate']);
    Route::post('/stockcount-store', [StockCountController::class, 'store']);
    Route::get('/delete-stockcount/{stockcountId}', [StockCountController::class, 'destroystockcount']);
    Route::get('/view-stockcount/{stockcountId}', [StockCountController::class, 'detailstockcount']);
    Route::get('/edit-stock/{stockcountId}', [StockCountController::class, 'edit']);
    Route::put('/update-stock/{stockcountId}', [StockCountController::class, 'update'])->name('updateStock');
    Route::get('/stockcount-pdf/{id}', [StockCountController::class, 'generatepdf'])->name('stockcount-pdf');

    // Delivery Order
    Route::get('/DO', [DOController::class, 'index'])->name('do');
    Route::get('/create-DO', [DOController::class, 'indexcreate']);
    Route::post('/DO-store', [DOController::class, 'store']);
    Route::get('/view-DO/{id}', [DOController::class, 'detailDO'])->name('viewDO');
    Route::get('/delete-DO/{id}', [DOController::class, 'destroyDO'])->name('destroyDO');
    Route::get('/edit-DO/{id}', [DOController::class, 'edit'])->name('editDO');
    Route::put('/update-DO/{id}', [DOController::class, 'update'])->name('updateDO');
    Route::get('/DO-pdf/{id}', [DOController::class, 'generatepdf'])->name('DO-pdf');
    
    // logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Admin Pengajuan
Route::middleware(['auth', 'role:admin_pengajuan'])->group(function () {
    Route::put('/approveITR/{id}', [ITRController::class, 'approve'])->name('approveITR');
    Route::put('/approvematerial/{id}', [MaterialController::class, 'approve'])->name('approveMaterial');
    Route::put('/approvestock/{id}', [StockCountController::class, 'approve'])->name('approveStock');
    Route::put('/approveDO/{id}', [DOController::class, 'approve'])->name('approveDO');

});