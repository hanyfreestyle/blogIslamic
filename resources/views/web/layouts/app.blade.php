<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" {!!htmlArDir()!!} >
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow">
    {!! SEO::generate() !!}
    <x-site.def.fav-icon/>
    {!! (new \App\Helpers\MinifyTools)->MinifyCss('vendor/animate.css/animate.min.css',$cssMinifyType,$cssReBuild) !!}
    {!! (new \App\Helpers\MinifyTools)->MinifyCss('vendor/bootstrap/css/bootstrap.min.css',$cssMinifyType,$cssReBuild) !!}
{{--    {!! (new \App\Helpers\MinifyTools)->MinifyCss('vendor/boxicons/css/boxicons.min.css',$cssMinifyType,$cssReBuild) !!}--}}
{{--    {!! (new \App\Helpers\MinifyTools)->MinifyCss('vendor/glightbox/css/glightbox.min.css',$cssMinifyType,$cssReBuild) !!}--}}
{{--    {!! (new \App\Helpers\MinifyTools)->MinifyCss('vendor/swiper/swiper-bundle.min.css',$cssMinifyType,$cssReBuild) !!}--}}
    {!! (new \App\Helpers\MinifyTools)->MinifyCss('css/style.css','Seo',$cssReBuild) !!}

    {!! (new \App\Helpers\MinifyTools)->MinifyCss('css/style_menu_footer.css',$cssMinifyType,$cssReBuild) !!}
    {!! (new \App\Helpers\MinifyTools)->MinifyCss('css/style_edit.css',$cssMinifyType,$cssReBuild) !!}
    {!! (new \App\Helpers\MinifyTools)->MinifyCss('css/style_blog.css',"Seo",$cssReBuild) !!}
    {!! (new \App\Helpers\MinifyTools)->MinifyCss('fontawesome/all.css',$cssMinifyType,$cssReBuild) !!}
    {{--    {!! (new \App\Helpers\MinifyTools)->MinifyCss('share/share_buttons.css',$cssMinifyType,$cssReBuild) !!}--}}
    @yield('AddStyle')
    @livewireStyles
</head>
<body>

@include('web.layouts.inc.header_menu')
@yield('content')
@include('web.layouts.inc.footer')

<div id="preloader"></div>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="fas fa-angle-up"></i></a>

{!! (new \App\Helpers\MinifyTools)->MinifyJs('js/jquery-3.7.1.min.js',"Web",false) !!}
{!! (new \App\Helpers\MinifyTools)->MinifyJs('js/lazy/jquery.lazy.min.js',"SeoWeb",$cssReBuild) !!}
{!! (new \App\Helpers\MinifyTools)->MinifyJs('js/lazy/lazy_fun.js',"Seo",$cssReBuild) !!}
{!! (new \App\Helpers\MinifyTools)->MinifyJs('vendor/bootstrap/js/bootstrap.bundle.min.js',"Web",$cssReBuild) !!}
{!! (new \App\Helpers\MinifyTools)->MinifyJs('vendor/glightbox/js/glightbox.min.js',"Web",$cssReBuild) !!}
{!! (new \App\Helpers\MinifyTools)->MinifyJs('vendor/isotope-layout/isotope.pkgd.min.js',"Web",$cssReBuild) !!}
{!! (new \App\Helpers\MinifyTools)->MinifyJs('vendor/swiper/swiper-bundle.min.js',"Web",$cssReBuild) !!}
{!! (new \App\Helpers\MinifyTools)->MinifyJs('js/main.js',"Web",$cssReBuild) !!}
<x-site.js.load-web-font/>
@livewireScripts
<script>
    document.addEventListener('livewire:load', () => {
        Livewire.onPageExpired((response, message) => {})
    })
</script>
@yield('AddScript')
@stack('ScriptCode')
{{--{!! $printSchema->Businesses() !!}--}}
</body>
</html>
