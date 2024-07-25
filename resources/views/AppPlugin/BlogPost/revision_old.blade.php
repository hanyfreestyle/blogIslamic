@extends('admin.layouts.app')
@section('StyleFile')
    {!! (new \App\Helpers\MinifyTools)->setWebAssets('assets/admin/')->MinifyCss('css/html_def.css','Seo',true) !!}
@endsection
@section('content')

    <x-admin.hmtl.section>
        <div class="row mt-5">
            <div class="col-lg-6 htmlDefDivX">
                <x-admin.card.normal title="النسخة السابقة">
                    {!! $oldHtml !!}
                </x-admin.card.normal>
            </div>

            <div class="col-lg-6 htmlDefDivX">
                <x-admin.card.normal title="النسخة الحالية">
                    {!! $content !!}
                </x-admin.card.normal>
            </div>


        </div>
    </x-admin.hmtl.section>



@endsection


@push('JsCode')

@endpush
