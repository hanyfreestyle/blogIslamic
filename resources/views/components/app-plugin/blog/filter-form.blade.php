<div class="row">
    <div class="col-lg-9">
        <x-admin.card.normal>
            <form action="{{route($PrefixRoute.$defRoute)}}" method="post">
                @csrf
                <input type="hidden" name="formName" value="{{$formName}}">
                <div class="row">
                    <x-admin.form.select-multiple name="cat_id" :categories="$CategoriesList" col="6" :label-view="false"
                                                  :sel-cat="old('cat_id',issetArr($getSessionData,'cat_id'))"/>

                    <x-admin.form.input name="name" :value="old('name',issetArr($getSessionData,'name'))" col="6" :labelview="false" :placeholder="true"
                                        :label="__('admin/blogPost.blog_text_name')"/>

                    <x-admin.form.date type="fromDate" value="{{old('from_date',issetArr($getSessionData,'from_date'))}}" :labelview="false"/>
                    <x-admin.form.date type="toDate" value="{{old('to_date',issetArr($getSessionData,'to_date'))}}" :labelview="false"/>

                    @can('Blog_teamleader')
                        <x-admin.form.select-multiple name="user_id" :categories="$UserList" col="6" :label-view="false" :has-trans="false"
                                                      :sel-cat="old('user_id',issetArr($getSessionData,'user_id'))"/>

                    @endcan

                </div>
                <div class="row">
                    <x-admin.form.input name="des_text" :value="old('des_text',issetArr($getSessionData,'des_text'))" col="6" :labelview="false" :placeholder="true"
                                        :label="__('admin/blogPost.filter_des')"/>
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
                        <button type="submit" name="Forget" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> {{__('admin/formFilter.but_clear')}}</button>
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
                <span class="info-box-number">{{number_format($row->count())}}</span>
            </div>
        </div>
    </div>
</div>

@push('JsCode')
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
@endpush
