@extends('admin.layouts.app')
@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>
        <x-admin.card.def :page-data="$pageData" title="{{__('admin/def.page_config') }} {{ $pageData['TitlePage'] }}"  >
            <x-admin.main.settings modelname="{{$controllerName}}" :configArr="$configArr" :page-data="$pageData" />
        </x-admin.card.def>
   </x-admin.hmtl.section>
@endsection

