@extends('admin.layouts.app')

@section('content')

    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.confirm-massage/>

    <x-admin.hmtl.section>
        <div class="row mb-3">
            <div class="col-9">
                <h1 class="def_h1_new">{!! print_h1($Model) !!}</h1>
            </div>
            <div class="col-3 dir_button">
                @if($Config['MorePhotosEdit'])
                    @can($PrefixRole.'_edit')
                        <td class="tc">
                            <x-admin.form.action-button url="{{route($PrefixRoute.'.More_PhotosEditAll',$Model->id)}}" type="edit" :tip="false"/>
                        </td>
                    @endcan
                @endif

                @if($pageData['WithSubCat'] == true and intval($pageData['ModelId']) != 0 )
                    <x-admin.form.action-button url="{{route($PrefixRoute.'.edit', [ $pageData['ModelId'],$Model->id])}}" type="back"/>
                @else
                    <x-admin.form.action-button url="{{route($PrefixRoute.'.edit', $Model->id)}}" type="back"/>
                @endif


            </div>
        </div>

        <x-admin.card.normal>
            <div class="row">
                @if(count($ListPhotos)>0)
                    <div class="row col-lg-12 hanySort">
                        @foreach($ListPhotos as $Photo)
                            <div class="col-lg-2 ListThisItam" data-index="{{$Photo->id}}" data-position="{{$Photo->postion}}">
                                <p class="PhotoImageCard"><img src="{{ defImagesDir($Photo->photo) }}"></p>
                                <div class="buttons mb-3">
                                    @can($PrefixRole.'_delete')
                                        <td class="tc">
                                            <x-admin.form.action-button url="#" id="{{route($PrefixRoute.'.More_PhotosDestroy',$Photo->id)}}" type="deleteSweet"/>
                                        </td>
                                    @endcan
                                    @if($Config['MorePhotosEdit'])
                                        @can($PrefixRole.'_edit')
                                            <td class="tc">
                                                <x-admin.form.action-button url="{{route($PrefixRoute.'.More_PhotosEdit',$Photo->id)}}" type="edit"/>
                                            </td>
                                        @endcan
                                    @endif

                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="col-lg-12">
                        <x-admin.hmtl.alert-massage type="nodata"/>
                    </div>
                @endif
            </div>
        </x-admin.card.normal>

        <x-admin.card.normal>


            <div class="row">
                <div class="col-lg-12">
                    <form class="mainForm" action="{{route($PrefixRoute.'.More_PhotosAdd')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="model_id" value="{{intval($Model->id)}}">
                        <input type="hidden" name="name" value="{{$Model->slug}}">
                        <x-admin.form.upload-file view-type="Add" :multiple="true"
                                                  thisfilterid="{{ \App\Helpers\AdminHelper::arrIsset($modelSettings,$controllerName.'_morephoto_filterid',0) }}"
                        />

                        @if($errors->has([]) )
                            <div class="liError">
                                @foreach ($errors->all() as $error)
                                    <li>{{ trim(str_replace('image', "", $error))  }}</li>
                                @endforeach
                            </div>
                        @endif

                        <div class="container-fluid">
                            <x-admin.form.submit text="Add"/>
                        </div>
                    </form>
                </div>
            </div>
        </x-admin.card.normal>


    </x-admin.hmtl.section>

@endsection


@push('JsCode')
    <x-admin.table.sweet-delete-js/>
    <script src="{{defAdminAssets('plugins/bootstrap/js/jquery-ui.min.js')}}"></script>
    <x-admin.ajax.sort-code url="{{ route($PrefixRoute.'.sortPhotoSave') }}"/>
@endpush
