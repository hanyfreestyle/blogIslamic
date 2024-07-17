<div class="row">

    <div class="col-lg-9">
        <x-admin.card.normal>

            <form action="{{route($PrefixRoute.'.filter')}}" method="post">
                @csrf
                <input type="hidden" name="formName" value="{{$formName}}">
                <div class="row">
                    @if($fromDate)
                        <x-admin.form.date type="fromDate" value="{{old('from_date',issetArr($getSessionData,'from_date'))}}"/>
                    @endif

                    @if($toDate)
                        <x-admin.form.date type="toDate" value="{{old('to_date',issetArr($getSessionData,'to_date'))}}"/>
                    @endif

                    @if($isActive)
                        <x-admin.form.select-arr name="is_active" sendvalue="{{old('is_active',issetArr($getSessionData,'is_active'))}}"
                                                 select-type="selActive" label="{{__('admin/formFilter.fr_satus')}}" colrow="col-lg-3"
                                                 :required-span="false"/>
                    @endif

                    @if($continent)
                        <x-admin.form.select-arr name="continent_code" sendvalue="{{old('continent_code',issetArr($getSessionData,'continent_code'))}}"
                                                 :send-arr="$Continent_Arr" label="{{__('admin/dataCountry.t_continent')}}" colrow="col-lg-3"
                                                 :required-span="false"/>
                    @endif



                    @if($country)
                        <x-admin.form.select-arr name="country" :sendvalue="old('country',issetArr($getSessionData,'country'))" sendid="iso2"
                                                 :send-arr="$CashCountryList" label="{{__('admin/leadsContactUs.t_country')}}" :required-span="false"
                                                 colrow="col-lg-3 "/>
                    @endif


                    @if($countryId)
                        <x-admin.form.select-arr name="country_id" :sendvalue="old('country_id',issetArr($getSessionData,'country_id'))"
                                                 :send-arr="$CashCountryList" label="{{__('admin/leadsContactUs.t_country')}}" :required-span="false"
                                                 colrow="col-lg-3 "/>
                    @endif


                </div>

                @if($project)
                    <div class="row">
                        <x-admin.form.select-arr name="project_id" :sendvalue="old('project_id',issetArr($getSessionData,'project_id'))"
                                                 :send-arr="$CashCompoundList" label="{{__('admin/config/leadForm.t_listing_project')}}"
                                                 :labelview="false" colrow="col-lg-12 "/>
                    </div>
                @endif

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
                @if($viewDataTable)
                    <span class="info-box-number">{{number_format(count($row))}}</span>
                @else
                    <span class="info-box-number">{{number_format($row->total())}}</span>
                @endif


            </div>
        </div>
        @if($exportView)
            @if($row->total() > 0)
                @if($exportBut)
                    <form action="{{route($PrefixRoute.'.Export')}}" method="post">
                        @csrf
                        <input type="hidden" name="formName" value="{{$formName}}">
                        <button type="submit" name="Export" class="btn btn-primary btn-sm"><i class="fas fa-file-excel"></i> {{$expText}}</button>
                    </form>
                @endif
                @if($newRoute)
                    <form action="{{route($newRoute)}}" method="post">
                        @csrf
                        <input type="hidden" name="formName" value="{{$formName}}">
                        <button type="submit" name="ExportNew" class="btn btn-primary btn-sm"><i class="fas fa-file-excel"></i> {{ $newRouteTxt}}
                        </button>
                    </form>
                @endif
            @endif
        @endif
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
                minYear: 2022,
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
