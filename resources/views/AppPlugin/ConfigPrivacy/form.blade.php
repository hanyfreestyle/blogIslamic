@extends('admin.layouts.app')

@section('content')


  <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
  <x-admin.hmtl.section>
    <x-admin.card.def :page-data="$pageData">

      <form class="mainForm" action="{{route($PrefixRoute.'.update',intval($rowData->id))}}" method="post">
        @csrf
        <div class="row">
          <x-admin.form.input name="name" :row="$rowData" :label="__('admin/form.text_name')" col="4" tdir="ar"/>
        </div>

        <div class="row">
          @foreach ( config('app.web_lang') as $key=>$lang )

            <div class="col-lg-6 {{getColDir($key)}}">
              <x-admin.form.trans-input name="h1" :key="$key" :row="$rowData" label="H1" col="12" :tdir="$key"/>
              <x-admin.form.trans-input name="h2" :key="$key" :row="$rowData" label="H2" col="12" :tdir="$key" :req="false"/>
              <x-admin.form.trans-text-area name="des" :key="$key" :row="$rowData" col="12" :tdir="$key"
                                            :label="__('admin/form.text_content')" :req="false"/>

              <x-admin.form.trans-text-area name="lists" :key="$key" :row="$rowData" col="12" :tdir="$key"
                                            :label="__('admin/form.text_content')" :req="false"/>
            </div>

          @endforeach
        </div>


        <x-admin.form.submit-role-back :page-data="$pageData"/>

      </form>

    </x-admin.card.def>

  </x-admin.hmtl.section>

@endsection
