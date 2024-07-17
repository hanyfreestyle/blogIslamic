<?php
use App\AppPlugin\Pages\PageCategoryController;
use App\AppPlugin\Pages\PageController;
use App\AppPlugin\Pages\PageTagsController;
use Illuminate\Support\Facades\Route;


Route::get('/PageCategory',[PageCategoryController::class,'CategoryIndex'])->name('Pages.PageCategory.index');
Route::get('/PageCategory/Main',[PageCategoryController::class,'CategoryIndex'])->name('Pages.PageCategory.index_Main');
Route::get('/PageCategory/SubCategory/{id}',[PageCategoryController::class,'CategoryIndex'])->name('Pages.PageCategory.SubCategory');

Route::get('/PageCategory/DataTable',[PageCategoryController::class,'DataTable'])->name('Pages.PageCategory.DataTable');
Route::get('/PageCategory/create',[PageCategoryController::class,'CategoryCreate'])->name('Pages.PageCategory.create');
Route::get('/PageCategory/create/ar',[PageCategoryController::class,'CategoryCreate'])->name('Pages.PageCategory.create_ar');
Route::get('/PageCategory/create/en',[PageCategoryController::class,'CategoryCreate'])->name('Pages.PageCategory.create_en');
Route::get('/PageCategory/edit/{id}',[PageCategoryController::class,'CategoryEdit'])->name('Pages.PageCategory.edit');
Route::get('/PageCategory/editAr/{id}',[PageCategoryController::class,'CategoryEdit'])->name('Pages.PageCategory.editAr');
Route::get('/PageCategory/editEn/{id}',[PageCategoryController::class,'CategoryEdit'])->name('Pages.PageCategory.editEn');
Route::get('/PageCategory/emptyPhoto/{id}', [PageCategoryController::class,'emptyPhoto'])->name('Pages.PageCategory.emptyPhoto');
Route::get('/PageCategory/DeleteLang/{id}',[PageCategoryController::class,'DeleteLang'])->name('Pages.PageCategory.DeleteLang');
Route::post('/PageCategory/update/{id}',[PageCategoryController::class,'CategoryStoreUpdate'])->name('Pages.PageCategory.update');
Route::get('/PageCategory/destroy/{id}',[PageCategoryController::class,'destroyException'])->name('Pages.PageCategory.destroy');
Route::get('/PageCategory/config', [PageCategoryController::class,'config'])->name('Pages.PageCategory.config');
Route::get('/PageCategory/emptyIcon/{id}', [PageCategoryController::class,'emptyIcon'])->name('Pages.PageCategory.emptyIcon');
Route::get('/PageCategory/CatSort/{id}',[PageCategoryController::class,'CategorySort'])->name('Pages.PageCategory.CatSort');
Route::post('/PageCategory/SaveSort',[PageCategoryController::class,'CategorySaveSort'])->name('Pages.PageCategory.SaveSort');



Route::get('/pages',[PageController::class,'PostIndex'])->name('Pages.PageList.index');
Route::get('/pages/DataTable',[PageController::class,'PostDataTable'])->name('Pages.PageList.DataTable');
Route::get('/pages/Category/{Categoryid}',[PageController::class,'PostListCategory'])->name('Pages.PageList.ListCategory');
Route::get('/pages/SoftDelete/',[PageController::class,'PostSoftDeletes'])->name('Pages.PageList.SoftDelete');

Route::get('/pages/create',[PageController::class,'PostCreate'])->name('Pages.PageList.create');
Route::get('/pages/create/ar',[PageController::class,'PostCreate'])->name('Pages.PageList.create_ar');
Route::get('/pages/create/en',[PageController::class,'PostCreate'])->name('Pages.PageList.create_en');
Route::get('/pages/edit/{id}',[PageController::class,'PostEdit'])->name('Pages.PageList.edit');
Route::get('/pages/editAr/{id}',[PageController::class,'PostEdit'])->name('Pages.PageList.editAr');
Route::get('/pages/editEn/{id}',[PageController::class,'PostEdit'])->name('Pages.PageList.editEn');
Route::post('/pages/update/{id}',[PageController::class,'PostStoreUpdate'])->name('Pages.PageList.update');

Route::get('/pages/destroy/{id}',[PageController::class,'destroy'])->name('Pages.PageList.destroy');
Route::get('/pages/restore/{id}',[PageController::class,'Restore'])->name('Pages.PageList.restore');
Route::get('/pages/force/{id}',[PageController::class,'PostForceDeleteException'])->name('Pages.PageList.force');
Route::get('/pages/DeleteLang/{id}',[PageController::class,'DeleteLang'])->name('Pages.PageList.DeleteLang');
Route::get('/pages/emptyPhoto/{id}', [PageController::class,'emptyPhoto'])->name('Pages.PageList.emptyPhoto');

Route::get('/pages/photos/{id}',[PageController::class,'ListMorePhoto'])->name('Pages.PageList.More_Photos');
Route::post('/pages/AddMore',[PageController::class,'AddMorePhotos'])->name('Pages.PageList.More_PhotosAdd');
Route::post('/pages/saveSort', [PageController::class,'sortPhotoSave'])->name('Pages.PageList.sortPhotoSave');
Route::get('/pages/PhotoDel/{id}',[PageController::class,'More_PhotosDestroy'])->name('Pages.PageList.More_PhotosDestroy');
Route::get('/pages/PhotoEdit/{id}',[PageController::class,'More_PhotosEdit'])->name('Pages.PageList.More_PhotosEdit');
Route::post('/pages/PhotoUpdate/{id}',[PageController::class,'More_PhotosUpdate'])->name('Pages.PageList.More_PhotosUpdate');
Route::get('/pages/PhotosEdit/{id}',[PageController::class,'More_PhotosEditAll'])->name('Pages.PageList.More_PhotosEditAll');
Route::post('/pages/PhotoUpdateAll/{id}',[PageController::class,'More_PhotosUpdateAll'])->name('Pages.PageList.More_PhotosUpdateAll');
Route::get('/pages/config', [PageController::class,'config'])->name('Pages.PageList.config');


Route::get('/pages/tags', [PageTagsController::class, 'TagsIndex'])->name('Pages.PageTags.index');
Route::get('/pages/tags/DataTable', [PageTagsController::class, 'TagsDataTable'])->name('Pages.PageTags.DataTable');
Route::get('/pages/tags/create', [PageTagsController::class, 'TagsCreate'])->name('Pages.PageTags.create');
Route::get('/pages/tags/edit/{id}', [PageTagsController::class, 'TagsEdit'])->name('Pages.PageTags.edit');
Route::post('/pages/tags/update/{id}', [PageTagsController::class, 'TagsStoreUpdate'])->name('Pages.PageTags.update');
Route::get('/pages/tags/destroy/{id}', [PageTagsController::class, 'TagsDelete'])->name('Pages.PageTags.destroy');
Route::get('/pages/tags/config', [PageTagsController::class, 'TagsConfig'])->name('Pages.PageTags.config');
Route::get('/pages/tags/TagsSearch', [PageTagsController::class, 'TagsSearch'])->name('PageTags.TagsSearch');
Route::get('/pages/tags/TagsOnFly', [PageTagsController::class, 'TagsOnFly'])->name('PageTags.TagsOnFly');

