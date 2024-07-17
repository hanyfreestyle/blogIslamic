<?php

use App\AppPlugin\BlogPost\BlogCategoryController;
use App\AppPlugin\BlogPost\BlogPostController;
use App\AppPlugin\BlogPost\BlogTagsController;
use Illuminate\Support\Facades\Route;


Route::get('/BlogCategory', [BlogCategoryController::class, 'CategoryIndex'])->name('Blog.BlogCategory.index');
Route::get('/BlogCategory/Main', [BlogCategoryController::class, 'CategoryIndex'])->name('Blog.BlogCategory.index_Main');
Route::get('/BlogCategory/SubCategory/{id}', [BlogCategoryController::class, 'CategoryIndex'])->name('Blog.BlogCategory.SubCategory');

Route::get('/BlogCategory/DataTable', [BlogCategoryController::class, 'DataTable'])->name('Blog.BlogCategory.DataTable');
Route::get('/BlogCategory/create', [BlogCategoryController::class, 'CategoryCreate'])->name('Blog.BlogCategory.create');
Route::get('/BlogCategory/create/ar', [BlogCategoryController::class, 'CategoryCreate'])->name('Blog.BlogCategory.create_ar');
Route::get('/BlogCategory/create/en', [BlogCategoryController::class, 'CategoryCreate'])->name('Blog.BlogCategory.create_en');
Route::get('/BlogCategory/edit/{id}', [BlogCategoryController::class, 'CategoryEdit'])->name('Blog.BlogCategory.edit');
Route::get('/BlogCategory/editAr/{id}', [BlogCategoryController::class, 'CategoryEdit'])->name('Blog.BlogCategory.editAr');
Route::get('/BlogCategory/editEn/{id}', [BlogCategoryController::class, 'CategoryEdit'])->name('Blog.BlogCategory.editEn');
Route::get('/BlogCategory/emptyPhoto/{id}', [BlogCategoryController::class, 'emptyPhoto'])->name('Blog.BlogCategory.emptyPhoto');
Route::get('/BlogCategory/DeleteLang/{id}', [BlogCategoryController::class, 'DeleteLang'])->name('Blog.BlogCategory.DeleteLang');
Route::post('/BlogCategory/update/{id}', [BlogCategoryController::class, 'CategoryStoreUpdate'])->name('Blog.BlogCategory.update');
Route::get('/BlogCategory/destroy/{id}', [BlogCategoryController::class, 'destroyException'])->name('Blog.BlogCategory.destroy');
Route::get('/BlogCategory/config', [BlogCategoryController::class, 'config'])->name('Blog.BlogCategory.config');
Route::get('/BlogCategory/emptyIcon/{id}', [BlogCategoryController::class, 'emptyIcon'])->name('Blog.BlogCategory.emptyIcon');
Route::get('/BlogCategory/CatSort/{id}', [BlogCategoryController::class, 'CategorySort'])->name('Blog.BlogCategory.CatSort');
Route::post('/BlogCategory/SaveSort', [BlogCategoryController::class, 'CategorySaveSort'])->name('Blog.BlogCategory.SaveSort');

Route::get('/Blog', [BlogPostController::class, 'PostIndex'])->name('Blog.BlogPost.index');
Route::get('/Blog/DataTable', [BlogPostController::class, 'PostDataTable'])->name('Blog.BlogPost.DataTable');
Route::get('/Blog/Category/{Categoryid}', [BlogPostController::class, 'PostListCategory'])->name('Blog.BlogPost.ListCategory');
Route::get('/Blog/SoftDelete/', [BlogPostController::class, 'PostSoftDeletes'])->name('Blog.BlogPost.SoftDelete');

Route::get('/Blog/create', [BlogPostController::class, 'PostCreate'])->name('Blog.BlogPost.create');
Route::get('/Blog/create/ar', [BlogPostController::class, 'PostCreate'])->name('Blog.BlogPost.create_ar');
Route::get('/Blog/create/en', [BlogPostController::class, 'PostCreate'])->name('Blog.BlogPost.create_en');
Route::get('/Blog/edit/{id}', [BlogPostController::class, 'PostEdit'])->name('Blog.BlogPost.edit');
Route::get('/Blog/editAr/{id}', [BlogPostController::class, 'PostEdit'])->name('Blog.BlogPost.editAr');
Route::get('/Blog/editEn/{id}', [BlogPostController::class, 'PostEdit'])->name('Blog.BlogPost.editEn');
Route::post('/Blog/update/{id}', [BlogPostController::class, 'PostStoreUpdate'])->name('Blog.BlogPost.update');

Route::get('/Blog/destroy/{id}', [BlogPostController::class, 'destroy'])->name('Blog.BlogPost.destroy');
Route::get('/Blog/restore/{id}', [BlogPostController::class, 'Restore'])->name('Blog.BlogPost.restore');
Route::get('/Blog/force/{id}', [BlogPostController::class, 'PostForceDeleteException'])->name('Blog.BlogPost.force');
Route::get('/Blog/DeleteLang/{id}', [BlogPostController::class, 'DeleteLang'])->name('Blog.BlogPost.DeleteLang');
Route::get('/Blog/emptyPhoto/{id}', [BlogPostController::class, 'emptyPhoto'])->name('Blog.BlogPost.emptyPhoto');

Route::get('/Blog/photos/{id}', [BlogPostController::class, 'ListMorePhoto'])->name('Blog.BlogPost.More_Photos');
Route::post('/Blog/AddMore', [BlogPostController::class, 'AddMorePhotos'])->name('Blog.BlogPost.More_PhotosAdd');
Route::post('/Blog/saveSort', [BlogPostController::class, 'sortPhotoSave'])->name('Blog.BlogPost.sortPhotoSave');
Route::get('/Blog/PhotoDel/{id}', [BlogPostController::class, 'More_PhotosDestroy'])->name('Blog.BlogPost.More_PhotosDestroy');
Route::get('/Blog/PhotoEdit/{id}', [BlogPostController::class, 'More_PhotosEdit'])->name('Blog.BlogPost.More_PhotosEdit');
Route::post('/Blog/PhotoUpdate/{id}', [BlogPostController::class, 'More_PhotosUpdate'])->name('Blog.BlogPost.More_PhotosUpdate');
Route::get('/Blog/PhotosEdit/{id}', [BlogPostController::class, 'More_PhotosEditAll'])->name('Blog.BlogPost.More_PhotosEditAll');
Route::post('/Blog/PhotoUpdateAll/{id}', [BlogPostController::class, 'More_PhotosUpdateAll'])->name('Blog.BlogPost.More_PhotosUpdateAll');
Route::get('/Blog/config', [BlogPostController::class, 'config'])->name('Blog.BlogPost.config');

Route::get('/Blog/tags', [BlogTagsController::class, 'TagsIndex'])->name('Blog.BlogTags.index');
Route::get('/Blog/tags/DataTable', [BlogTagsController::class, 'TagsDataTable'])->name('Blog.BlogTags.DataTable');
Route::get('/Blog/tags/create', [BlogTagsController::class, 'TagsCreate'])->name('Blog.BlogTags.create');
Route::get('/Blog/tags/edit/{id}', [BlogTagsController::class, 'TagsEdit'])->name('Blog.BlogTags.edit');
Route::post('/Blog/tags/update/{id}', [BlogTagsController::class, 'TagsStoreUpdate'])->name('Blog.BlogTags.update');
Route::get('/Blog/tags/destroy/{id}', [BlogTagsController::class, 'TagsDelete'])->name('Blog.BlogTags.destroy');
Route::get('/Blog/tags/config', [BlogTagsController::class, 'TagsConfig'])->name('Blog.BlogTags.config');
Route::get('/Blog/tags/TagsSearch', [BlogTagsController::class, 'TagsSearch'])->name('BlogPost.TagsSearch');
Route::get('/Blog/tags/TagsOnFly', [BlogTagsController::class, 'TagsOnFly'])->name('BlogPost.TagsOnFly');

