<div class="row">
    <div class="col-lg-9">
        <x-admin.card.normal>
            <form action="{{route($PrefixRoute.$defRoute)}}" method="post">
                @csrf
                <input type="hidden" name="formName" value="{{$formName}}">
                <div class="row">
                    @if($fromDate)
                        <x-admin.form.date type="fromDate" value="{{old('from_date',issetArr($getSessionData,'from_date'))}}" :labelview="false"/>
                    @endif

                    @if($toDate)
                        <x-admin.form.date type="toDate" value="{{old('to_date',issetArr($getSessionData,'to_date'))}}" :labelview="false"/>
                    @endif


                    <x-admin.form.select-arr name="is_active" sendvalue="{{old('is_active',issetArr($getSessionData,'is_active'))}}" select-type="selActive"
                                             label="{{__('admin/formFilter.fr_satus')}}" :labelview="false" col="3"/>

                    <x-admin.form.select-arr name="type" sendvalue="{{old('type',issetArr($getSessionData,'type'))}}" :send-arr="$ProductType_Arr"
                                             label="{{__('admin/proProduct.pro_type')}}" col="3" :labelview="false"/>

                    <x-admin.form.select-arr name="brand_id" sendvalue="{{old('brand_id',issetArr($getSessionData,'brand_id'))}}" :send-arr="$CashBrandList"
                                             label="{{__('admin/proProduct.app_menu_brand')}}" col="3" :labelview="false"/>


                    <x-admin.form.select-arr name="cat_id" sendvalue="{{old('cat_id',issetArr($getSessionData,'cat_id'))}}" :send-arr="$CashCategoriesList"
                                             label="{{__('admin/proProduct.app_menu_category')}}" col="3" :labelview="false"/>


                    <x-admin.form.input name="price_from" :value="old('price_from',issetArr($getSessionData,'price_from'))" col="3" :labelview="false" :placeholder="true"
                                        :label="__('admin/proProduct.pro_filter_price_from')"/>

                    <x-admin.form.input name="price_to" :value="old('price_to',issetArr($getSessionData,'price_to'))" col="3" :labelview="false" :placeholder="true"
                                        :label="__('admin/proProduct.pro_filter_price_to')"/>

                    <x-admin.form.select-arr name="on_stock" sendvalue="{{old('on_stock',issetArr($getSessionData,'on_stock'))}}" :labelview="false"
                                             :send-arr="$OnStock_Arr" label="{{__('admin/proProduct.pro_status_stock')}}" col="3"/>

                    <x-admin.form.input name="name" :value="old('name',issetArr($getSessionData,'name'))" col="9" :labelview="false" :placeholder="true"
                                        :label="__('admin/proProduct.pro_text_name')"/>
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

                @if($onlyDataTable)
                    <span class="info-box-number">{{number_format($row)}}</span>
                @else
                    @if($yajraTable and $viewDataTable)
                        <span class="info-box-number">{{number_format($row)}}</span>
                    @else
                        @if($viewDataTable)
                            <span class="info-box-number">{{number_format(count($row))}}</span>
                        @else
                            <span class="info-box-number">{{number_format($row->total())}}</span>
                        @endif
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
