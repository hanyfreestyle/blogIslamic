<div class="col-lg-{{$col}}">
    <div class="form-group">
        @if($labelView)
            <label class="def_form_label col-form-label font-weight-light">
                {{$label}}
                @if($req)<span class="required_Span">*</span>@endif
            </label>
        @endif
        <select id="{{$id}}" class="select2 is-invalid" multiple="multiple" name="{{$name}}[]" data-placeholder="" style="width: 100%;">
            @if($type == 'Main')
                @foreach($categories as $category )
                    <option value="{{$category->id}}"
                    @if(is_array($selCat))
                        {{ (in_array($category->id,$selCat)) ? 'selected' : ''}}
                        @endif

                    @if($hasTrans)
                        {{ (collect(old('categories'))->contains($category->id)) ? 'selected':'' }}>{{ print_h1($category)}}

                        @else
                            {{ (collect(old('categories'))->contains($category->id)) ? 'selected':'' }}>{{ $category->name}}
                        @endif

                    </option>
                @endforeach
            @else
                {{$slot}}
            @endif

        </select>

        @error($name)
        <span class="invalid-feedback" role="alert">
            <strong>{{ \App\Helpers\AdminHelper::error($message,$name,$label) }}</strong>
        </span>
        @enderror
    </div>

</div>
