@extends('web.layouts.app')
@section('content')
    <x-site.def.breadcrumbs>
        {!! Breadcrumbs::render('favorite_list') !!}
    </x-site.def.breadcrumbs>

    <div class="section-space pt-1 bg-primary-5p">
        <div class="container FavoritePage">

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <livewire:site.favorite-page-view />
                </div>
                <div class="col-lg-4 mt-5">
                    <x-site.contact.page-but/>
                    <div class="mb-5"></div>
                    <x-site.search.right-side />
                </div>

            </div>
        </div>
    </div>

@endsection
