@extends('admin.layouts.app')

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>

    <x-admin.hmtl.section>
        <div class="row mb-3">
            <div class="col-12 dir_button">
                @can($PrefixRole.'_add')
                    <x-admin.form.action-button  url="{{route($PrefixRoute.'.create')}}"  type="add" size="m" :tip="false"   />
                @endcan
                    <x-admin.form.action-button  url="{{route($PrefixRoute.'.index')}}"  type="back" size="m" :tip="false"   />
            </div>
        </div>
   </x-admin.hmtl.section>


    <x-admin.hmtl.section>
        <x-admin.card.normal title="{{__('admin/config/upFilter.app_menu_def_photo')}}">
            <div class="row">
                @if(count($rowData)>0)
                    <div class="row col-lg-12 hanySort">
                        @foreach($rowData as $row)
                            <div class="col-lg-2 ListThisItam"  data-index="{{$row->id}}" data-position="{{$row->postion}}" >
                                <p class="PhotoImageCard"><img src="{{defImagesDir($row->photo)}}"></p>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="col-lg-12">
                        <x-admin.hmtl.alert-massage type="nodata" />
                    </div>
                @endif
            </div>
        </x-admin.card.normal>
   </x-admin.hmtl.section>
@endsection

@push('JsCode')

    <script src="{{defAdminAssets('plugins/bootstrap/js/jquery-ui.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.hanySort').sortable({
                update: function (event, ui) {
                    $(this).children().each(function (index) {
                        if ($(this).attr('data-position') != (index+1)) {
                            $(this).attr('data-position', (index+1)).addClass('updated');
                        }
                    });
                    var positions = [];
                    $('.updated').each(function () {
                        positions.push([$(this).attr('data-index'), $(this).attr('data-position')]);
                        $(this).removeClass('updated');
                    });

                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: '{{ route($PrefixRoute.'.sortDefPhoto') }}',
                        type: 'POST',
                        dataType: 'text',
                        data: {
                            update: 1,
                            positions: positions
                        },
                        success: function (response) {
                            console.log(response);
                        }
                    });
                }
            });
        });
    </script>
@endpush
