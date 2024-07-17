<div class="row">
  <div class="col-lg-9">
    <x-admin.card.normal>

      <form action="{{route($PrefixRoute.$defRoute)}}" method="post">
        @csrf
        <input type="hidden" name="formName" value="{{$formName}}">
        <div class="row">

          <x-admin.form.date name="from_date" value="{{old('from_date',issetArr($getSessionData,'from_date'))}}" :label="__('admin/orders.filter_date_from')" :reqspan="false"/>
          <x-admin.form.date name="to_date" value="{{old('to_date',issetArr($getSessionData,'to_date'))}}" :label="__('admin/orders.filter_date_to')" :reqspan="false"/>
          <x-admin.form.date name="delivery_from" value="{{old('delivery_from',issetArr($getSessionData,'delivery_from'))}}" :label="__('admin/orders.filter_delivery_from')" :reqspan="false"/>
          <x-admin.form.date name="delivery_to" value="{{old('delivery_to',issetArr($getSessionData,'delivery_to'))}}" :label="__('admin/orders.filter_delivery_to')" :reqspan="false"/>

          {{--          <x-admin.form.select-arr name="is_active" sendvalue="{{old('is_active',issetArr($getSessionData,'is_active'))}}"--}}
          {{--                                   select-type="selActive" label="{{__('admin/formFilter.fr_satus')}}" :labelview="false" col="3"/>--}}


          <x-admin.form.select-arr name="city_id" sendvalue="{{old('city_id',issetArr($getSessionData,'city_id'))}}"
                                   :send-arr="$cashCityList" label="{{__('admin/orders.title_city')}}" col="3"
                                   :labelview="false"/>

          <x-admin.form.input name="price_from" :value="old('price_from',issetArr($getSessionData,'price_from'))"
                              col="3" :labelview="false" :placeholder="true" :label="__('admin/orders.filter_total_from')"/>

          <x-admin.form.input name="price_to" :value="old('price_to',issetArr($getSessionData,'price_to'))"
                              col="3" :labelview="false" :placeholder="true" :label="__('admin/orders.filter_total_to')"/>

        </div>
        {{$slot}}

        <div class="row formFilterBut">
          <button type="submit" name="Forget" class="btn btn-dark btn-sm"><i
             class="fas fa-filter"></i> {{__('admin/formFilter.but_filter')}}</button>
        </div>
      </form>


      @if(isset($getSessionData))
        <div class="row formForgetBut">
          <form action="{{route('admin.ForgetSession')}}" method="post">
            @csrf
            <input type="hidden" name="formName" value="{{$formName}}">
            <button type="submit" name="Forget" class="btn btn-danger btn-sm"><i
               class="fas fa-trash-alt"></i> {{__('admin/formFilter.but_clear')}}</button>
          </form>
        </div>
      @endif
    </x-admin.card.normal>

  </div>
  <div class="col-lg-3 filter_box_total">
    <div class="info-box mb-3 bg-success">
      <span class="info-box-icon"><i class="fas fa-server"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">{{__('admin/formFilter.box_total')}}</span>

        @if($yajraTable and $viewDataTable)
          <span class="info-box-number">{{number_format($row)}}</span>
        @else
          @if($viewDataTable)
            <span class="info-box-number">{{number_format(count($row))}}</span>
          @else
            <span class="info-box-number">{{number_format($row->total())}}</span>
          @endif
        @endif


      </div>
    </div>
  </div>
</div>

@push('JsCode')
  @if($fromDate)
    <script>
        $('.FilterForm').daterangepicker({
            singleDatePicker: true,
            autoApply: false,
            autoUpdateInput: false,
            showDropdowns: true,
            minYear: 2020,
            locale: {
                format: "YYYY-MM-DD",
                cancelLabel: 'Clear'
            },
            maxYear: parseInt(moment().format('YYYY'), 10),
        });

        $('.FilterForm').on('apply.daterangepicker', function (ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD'));
        });

        $('.FilterForm').on('cancel.daterangepicker', function (ev, picker) {
            $(this).val('');
        });
    </script>
  @endif

@endpush
