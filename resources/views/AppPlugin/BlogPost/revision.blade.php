@extends('admin.layouts.app')
@section('StyleFile')
    {!! (new \App\Helpers\MinifyTools)->setWebAssets('assets/admin/')->MinifyCss('css/html_def_2.css','Seo',true) !!}

    {{--    <style>--}}
    {{--        <?=  Jfcherng\Diff\DiffHelper::getStyleSheet(); ?>--}}
    {{--    </style>--}}
@endsection
@section('content')
{{--    <x-admin.hmtl.section>--}}
{{--        <div class="row mt-5">--}}

{{--        </div>--}}
{{--    </x-admin.hmtl.section>--}}

    <x-admin.hmtl.section>
        <div class="row mt-5 mb-3">
            <div class="col-lg-12">
                @foreach($AllData as $data)
                    @if($oldData->id == $data->id )
                        <a class="btn btn-danger ml-1 mb-1" href="{{route('admin.Blog.BlogPost.ListRevision',$data->id)}}" >
                            {{$data->loop_index}}
                        </a>
                    @else
                        <a class="btn btn-primary ml-1 mb-1" href="{{route('admin.Blog.BlogPost.ListRevision',$data->id)}}" >
                            {{$data->loop_index}}
                        </a>
                    @endif
                @endforeach
            </div>
            <div class="col-lg-12">
                {{dateDiff($oldData->updated_at)}}
                {{$oldData->userName->name}}
                <br>
                <a href="{{route('admin.Blog.BlogPost.edit',$oldData->blog_id)}}">{{$oldData->name}}</a>
                @if($canUpdate)
                    <br>
                    <a href="{{route('admin.Blog.BlogPost.edit',[$oldData->blog_id,'revision'=>$oldData->id])}}">استخدام المحتوى الحالى </a>
                @endif
            </div>
        </div>
    </x-admin.hmtl.section>

    <x-admin.hmtl.section>
        {!! $sideBySideResult !!}
    </x-admin.hmtl.section>

    <x-admin.hmtl.section>
        <div class="row mt-5">

        </div>
    </x-admin.hmtl.section>

@endsection


@push('JsCode')

@endpush
