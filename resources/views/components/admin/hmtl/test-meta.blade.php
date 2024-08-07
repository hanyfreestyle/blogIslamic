@section('AddStyle')
<style>
    .testMeta{
        width: 100%;
        margin-top: 100px;
        height: 500px;
        direction: ltr;
    }
</style>
@endsection
@if($isactive)
    <div class="container">
        <div class="col-lg-12">
            <textarea class="testMeta" name="w3review" rows="4" cols="50">{!! SEO::generate() !!}</textarea>
        </div>
    </div>
{{--    <div class="container">--}}
{{--        <div class="col-lg-12">--}}
{{--            <textarea class="testMeta" name="w3review" rows="4" cols="50">{!! $printSchema->Businesses() !!}</textarea>--}}
{{--        </div>--}}
{{--    </div>--}}
@endif

