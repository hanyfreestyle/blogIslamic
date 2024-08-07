<?php


use Diglactic\Breadcrumbs\Breadcrumbs;


use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('<i class="fa-solid fa-house"></i>' , route('page_index'));
});

Breadcrumbs::for('PagePrivacy', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(__('web/menu.privacy'), route('PagePrivacy'));
});

Breadcrumbs::for('PageAbout', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(__('web/menu.main_about'), route('PageAbout'));
});

Breadcrumbs::for('PageReview', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(__('web/menu.main_review'), route('PageReview'));
});

Breadcrumbs::for('categories', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(__('web/menu.main_category'), route('categories_list'));
});

Breadcrumbs::for('CategoryView', function (BreadcrumbTrail $trail,$category) {
    $trail->parent('categories');
    $trail->push($category->name , route('CategoryView',$category->slug));
});

Breadcrumbs::for('BlogView', function (BreadcrumbTrail $trail,$category,$blog) {
    $trail->parent('categories');
    $trail->push($category->name , route('CategoryView',$category->slug));
    $trail->push($blog->name , route('blog_view',$blog->slug));
});

Breadcrumbs::for('TagView', function (BreadcrumbTrail $trail,$tag) {
    $trail->parent('home');
    $trail->push($tag->name , route('TagView',$tag->slug));
});

Breadcrumbs::for('AuthorView', function (BreadcrumbTrail $trail,$user) {
    $trail->parent('home');
    $trail->push($user->name , route('AuthorView',$user->slug));
});

Breadcrumbs::for('page404', function (BreadcrumbTrail $trail,$meta) {
    $trail->parent('home');
    $trail->push($meta->g_title, route('PageReview'));
});












