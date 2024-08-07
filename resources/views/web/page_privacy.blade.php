@extends('web.layouts.app')
@section('content')
    <x-admin.hmtl.test-meta/>
    <div class="area_padding">
        <div class="container">
            <div class="col-lg-12">
                {!! Breadcrumbs::render('PagePrivacy') !!}
            </div>

            <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                <h1 class="headline">{{__('web/menu.privacy')}}</h1>
            </div>
            <div class="row">
                @foreach($webPrivacy as $privacy)
                    <div class="webPrivacy">
                        @if($privacy->h1)
                            <h2> {!! ChangeText($privacy->h1) !!}</h2>
                        @endif
                        @if($privacy->h2)
                            <h3> {!! ChangeText($privacy->h2) !!}</h3>
                        @endif

                        @if($privacy->des)
                            <p> {!! nl2br(ChangeText($privacy->des)) !!}</p>
                        @endif

                        @if($privacy->lists)
                            <ul>
                                @foreach(explode(PHP_EOL, $privacy->lists) as $list)
                                    <li> {!! ChangeText($list) !!}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
