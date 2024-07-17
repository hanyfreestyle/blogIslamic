<?php

use App\AppPlugin\AppPuzzle\AppPuzzleController;
use App\AppPlugin\AppPuzzle\AppPuzzleTreeAppCore;
use Illuminate\Support\Facades\Route;

Route::get('/puzzle/model/', [AppPuzzleController::class, 'IndexPuzzle'])->name('AppPuzzle.Model.IndexModel');
Route::get('/puzzle/data/', [AppPuzzleController::class, 'IndexPuzzle'])->name('AppPuzzle.Data.IndexModel');
Route::get('/puzzle/leads/', [AppPuzzleController::class, 'IndexPuzzle'])->name('AppPuzzle.Leads.IndexModel');
Route::get('/puzzle/product/', [AppPuzzleController::class, 'IndexPuzzle'])->name('AppPuzzle.Product.IndexModel');
Route::get('/puzzle/Config/', [AppPuzzleController::class, 'IndexPuzzle'])->name('AppPuzzle.Config.IndexModel');
Route::get('/puzzle/Crm/', [AppPuzzleController::class, 'IndexPuzzle'])->name('AppPuzzle.Crm.IndexModel');
Route::get('/puzzle/AppCore/', [AppPuzzleController::class, 'IndexPuzzle'])->name('AppPuzzle.AppCore.IndexModel');
Route::get('/AppPuzzle/Copy/{model}', [AppPuzzleController::class, 'CopyModel'])->name('AppPuzzle.Export');
Route::get('/AppPuzzle/Import/{model}', [AppPuzzleController::class, 'ImportModel'])->name('AppPuzzle.Import');
Route::get('/AppPuzzle/Remove/{model}', [AppPuzzleController::class, 'RemoveModel'])->name('AppPuzzle.Remove');
Route::get('/AppPuzzle/CoreFiles', [AppPuzzleTreeAppCore::class, 'ExportCoreFiles'])->name('AppPuzzle.CoreFiles');
Route::get('/AppPuzzle/AssetsFiles', [AppPuzzleTreeAppCore::class, 'ExportAssetsFiles'])->name('AppPuzzle.AssetsFiles');
Route::get('/AppPuzzle/AssetsCssFiles', [AppPuzzleTreeAppCore::class, 'ExportAssetsCssFiles'])->name('AppPuzzle.AssetsCssFiles');
//Route::get('/AppPuzzle/Info/{model}',[AppPuzzleController::class,'InfoModel'])->name('AppPuzzle.InfoModel');




