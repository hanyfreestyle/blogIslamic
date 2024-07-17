@extends('admin.layouts.app')
@section('content')
  <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
  <x-admin.hmtl.section>
    <div class="content mb-3">
      <div class="container-fluid">
        <div class="row">
          <div class="col-9">
            <h1 class="def_h1_new">{{$rowData->filter->name}}</h1>
          </div>
          <div class="col-3 dir_button">
            <x-admin.form.action-button url="{{route('admin.config.upFilter.edit',$rowData->filter->id)}}" type="back" :tip="false" bg="dark"/>
          </div>
        </div>
      </div>
    </div>
  </x-admin.hmtl.section>

  <x-admin.hmtl.section>
    <div class="row">
      <div class="col-lg-12">
        <form class="mainForm uploadFilterForm" action="{{route('admin.config.upFilter.size.storeOrUpdate',intval($rowData->id))}}" method="post">
          @csrf
          <div class="container-fluid">
            <div class="row">

              <div class="col-lg-12">
                <x-admin.card.normal title="{{__('admin/config/upFilter.form_main_setting')}}">
                  <input type="hidden" name="filter_id" value="{{$rowData->filter_id}}">

                  <div class="row">
                    <x-admin.form.select-arr label="{{__('admin/config/upFilter.form_type')}}" name="type" colrow="col-lg-7"
                                             sendvalue="{{old('type',$rowData->type)}}" :send-arr="$filterTypeArr"
                    />
                  </div>

                  <div class="row">

                    <x-admin.form.input :row="$rowData" name="new_w" :label="__('admin/config/upFilter.form_new_w')" col="4" tdir="en"/>
                    <x-admin.form.input :row="$rowData" name="new_h" :label="__('admin/config/upFilter.form_new_h')" col="4" tdir="en"/>
                    <x-admin.form.input-color :row="$rowData" name="canvas_back" :label="__('admin/config/upFilter.form_canvas_back')"/>

                  </div>

                  <div class="row">
                    <x-admin.form.select-arr label="{{__('admin/config/upFilter.form_more_setting')}}" name="get_more_option"
                                             colrow="col-lg-4"
                                             sendvalue="{{old('get_more_option',$rowData->get_more_option)}}" select-type="selActive"/>

                    <x-admin.form.select-arr label="{{__('admin/config/upFilter.form_text_state')}}" name="get_add_text" colrow="col-lg-4"
                                             sendvalue="{{old('get_add_text',$rowData->get_add_text)}}" select-type="selActive"/>

                    <x-admin.form.select-arr label="{{__('admin/config/upFilter.form_watermark_state')}}" name="get_watermark"
                                             colrow="col-lg-4"
                                             sendvalue="{{old('get_watermark',$rowData->get_watermark)}}" select-type="selActive"/>

                  </div>

                  <div class="container-fluid">
                    <x-admin.form.submit text="{{$pageData['ViewType']}}"/>
                  </div>
                </x-admin.card.normal>

              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </x-admin.hmtl.section>
@endsection
