@extends('web.layouts.app')
@section('content')
    <x-admin.hmtl.test-meta/>
    <div class="area_padding">
        <div class="container BlogList">
            <div class="row">
                <div class="col-lg-12">
                    {!! Breadcrumbs::render('AuthorView',$user) !!}
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="section-headline text-center">
                        <h2 class="headline" >{{$user->name}}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($blogs as $blog)
                    <x-site.blog-card :row="$blog" />
                @endforeach
            </div>
        </div>
        <div class="container mt-5">
            <x-site.def.pagination :rows="$blogs"/>
        </div>
    </div>
@endsection
