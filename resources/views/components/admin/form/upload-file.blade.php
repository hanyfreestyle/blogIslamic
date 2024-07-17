@if($addFilterList)
  @if(intval($thisfilterid) == 0)
    <x-admin.form.select-arr label="{{__('admin/config/upFilter.form_select_filter_lable')}}" name="{{$filterName}}" colrow="col-lg-6"
                             sendvalue="{{old('filter_id')}}" :send-arr="$filterTypes"/>
  @else
    <input type="hidden" name="{{$filterName}}" value="{{ $thisfilterid }}">
  @endif
@endif
<div class="{{$rowCol}}">
  <div class="form-group">
    <label class="col-md-12 col-form-label">{{$label}}
      @if($req)
        <span class="required_Span">*</span>
      @endif
    </label>
    <div class="uploadNotes">
      {{$notes}}
    </div>

    <div class="col-md-12">
      <input class="form-control @error($fileName) is-invalid @enderror" type="file" name="{{$fileName}}@if($multiple)[]@endif"
             accept="{{$acceptFile}}" @if($multiple) multiple @endif >
      @error($fileName)
      <span class="invalid-feedback" role="alert">
                    <strong>{{ \App\Helpers\AdminHelper::error($message,$fileName,$label) }}</strong>
                </span>
      @enderror
    </div>
    @if($viewType == 'Edit')
      @if(isset($rowData->$fildName) and $rowData->$fildName != '')
        <label class="col-md-12 col-form-label"> {{ $labelPhoto }}</label>
        <div class="col-md-12 fileUploadCurrent">
          <img class="img-thumbnail rounded" src="{{defImagesDir($rowData->$fildName)}}">
        </div>

        @if($emptyphotourl != '#' )
          <div class="row mt-3 mr-2 ml-2">
            <x-admin.form.action-button url="{{route($emptyphotourl,$rowData->id)}}" type="delete" :tip="true"/>
          </div>
        @endif

      @endif
    @endif
  </div>
</div>