<div class="col-lg-{{$col}}">
  <div class="form-group">
    @if($labelview)
      <label class="def_form_label col-form-label font-weight-light">
        {{$label}}
        @if($req)
          <span class="required_Span">*</span>
        @endif
      </label>
    @endif
    <div class="input-group">
      <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                      </span>
      </div>
      <input type="text" id="{{$id}}" value="{{$value}}" placeholder="YYYY-MM-DD" name="{{$name}}"
             class="form-control float-right DatePickerForm  @error($name) is-invalid @enderror">

      @error($name)
      <span class="invalid-feedback" role="alert">
            <strong>{{ \App\Helpers\AdminHelper::error($message,$name,$label) }}</strong>
            </span>
      @enderror
    </div>
  </div>
</div>

@push('JsCode')
  <script>
      $('.DatePickerForm').daterangepicker({
          singleDatePicker: true,
          autoApply: true,
          autoUpdateInput: false,
          showDropdowns: true,
          minYear: 2022,
          locale: {
              format: "YYYY-MM-DD",
              cancelLabel: 'Clear'
          },
          maxYear: parseInt(moment().format('YYYY'), 10),
      });

      $('.DatePickerForm').on('apply.daterangepicker', function (ev, picker) {
          $(this).val(picker.startDate.format('YYYY-MM-DD'));
      });
      //
      // $('.DatePickerForm').on('cancel.daterangepicker', function (ev, picker) {
      //     $(this).val('');
      // });
  </script>
@endpush
