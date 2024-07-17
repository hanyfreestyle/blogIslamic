<div class="{{$colrow}}">
    <div class="form-group MobilePhone">
        @if ($labelview)
            <label class="def_form_label col-form-label label_{{$dir}} font-weight-light" for="{{$id}}">
                {{$label}}
                @if($requiredSpan)
                    <span class="required_Span">*</span>
                @endif
            </label>
        @endif
        <input id="{{$id}}" name="{{$name}}" aria-label="{{$name}}" class="form-control {{$inputclass}} @error($name) is-invalid @enderror" value="{{$value}}"  @if($placeholder) placeholder="{{$label}}" @endif>
        @error($name)
        <div class="invalid_feedback_Div" role="alert">
            {{ \App\Helpers\AdminHelper::error($message,$name,$label) }}
        </div>
        @enderror
    </div>
</div>
<input type="hidden" name="countryCode_{{$id}}"  id="countryCode_{{$id}}">
<input type="hidden" name="countryDialCode_{{$id}}"  id="countryDialCode_{{$id}}" dir="ltr" >
<input type="hidden" name="form_id"  value="{{$id}}" dir="ltr" >

@section('AddStyle')
    {!! (new \App\Helpers\MinifyTools)->MinifyCss('intlTelInput/css/intlTelInput.css',$cssMinifyType,$cssReBuild) !!}
    {!! (new \App\Helpers\MinifyTools)->MinifyCss('intlTelInput/css/custom.css',$cssMinifyType,$cssReBuild) !!}
@endsection

@section('AddScript')
    {!! (new \App\Helpers\MinifyTools)->MinifyJs('intlTelInput/js/intlTelInput_'.thisCurrentLocale().'.js',"Seo",$cssReBuild) !!}
@endsection

@push('ScriptCode')
    <script>
        const {{$id}} = document.querySelector("#{{$id}}");
        const countryCode{{$id}} = document.querySelector("#countryCode_{{$id}}");
        const countryDialCode{{$id}} = document.querySelector("#countryDialCode_{{$id}}");
        const iti{{$id}} = window.intlTelInput({{$id}}, {
            initialCountry: "{{old('countryCode_'.$id,$initialCountry)}}",
            containerClass: "containerClass",
            countrySearch: false,
            preferredCountries: ['eg',"sa",'ae','kw','qa','bh','om','jo','','us'],
            onlyCountries: [{!! $onlyCountriesList !!}],
            excludeCountries: ["il"],
            fixDropdownWidth: true,
            formatAsYouType: true,
            nationalMode: true,
            formatOnDisplay: true,
            autoInsertDialCode: true,
            showFlags: true,
            showSelectedDialCode: false,
        });
        countryCode{{$id}}.value = iti{{$id}}.getSelectedCountryData().iso2;
        countryDialCode{{$id}}.value = iti{{$id}}.getSelectedCountryData().dialCode;
        {{$id}}.addEventListener('countrychange', () => {
            countryCode{{$id}}.value = iti{{$id}}.getSelectedCountryData().iso2;
            countryDialCode{{$id}}.value = iti{{$id}}.getSelectedCountryData().dialCode;
        });
    </script>
@endpush
