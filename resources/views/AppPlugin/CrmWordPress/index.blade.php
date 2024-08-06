@extends('admin.layouts.app')

@section('content')





    <x-admin.hmtl.section>

        <div class="row mt-5">
            <div class="col-lg-12">
                <textarea id="w3review" style="width: 100%; height: 350px; direction: ltr" name="w3review" rows="4" cols="100">{{$descleane}}</textarea>
                <textarea id="w3review" style="width: 100%; height: 350px; direction: ltr" name="w3review" rows="4" cols="100">{{$destext}}</textarea>
                <textarea id="w3review" style="width: 100%; height: 350px; direction: ltr" name="w3review" rows="4" cols="100">{{$des}}</textarea>

            </div>

        </div>

    </x-admin.hmtl.section>


@endsection

@push('JsCode')

@endpush
