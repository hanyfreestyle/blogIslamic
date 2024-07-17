<div class="col-lg-12">

  <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
    @foreach ( $langSend as $key=>$lang )
      <li class="nav-item">
        <a class="nav-link @if($loop->index == 0) active @endif" id="custom-content-below-{{$key}}-tab" data-toggle="pill"
           href="#custom-content-below-{{$key}}" role="tab" aria-controls="custom-content-below-{{$key}}"
           @if($loop->index == 0) aria-selected="true" @endif>{{$lang}}</a>
      </li>
    @endforeach
  </ul>
  <div class="tab-content" id="custom-content-below-tabContent">
    @foreach ( $langSend as $key=>$lang )
      <div class="tab-pane fade @if($loop->index == 0) show active @endif" id="custom-content-below-{{$key}}" role="tabpanel"
           aria-labelledby="custom-content-below-{{$key}}-tab">
        <div class="row pt-2">
          <x-admin.form.trans-input name="name" :key="$key" :row="$row" :tdir="$key" :label="__('admin/proProduct.pro_text_name')" col="6"/>
          @if($viewtype == 'Add' )
            <x-admin.form.trans-input name="slug" :key="$key" :row="$row" :label="__('admin/form.text_g_slug')" :tdir="$key" col="6"/>
          @elseif($viewtype == 'Edit')
            @can($PrefixRole."_edit_slug")
              <x-admin.form.trans-input name="slug" :key="$key" :row="$row" :label="__('admin/form.text_g_slug')" :tdir="$key" col="6"/>
            @else
              <input type="hidden" name="{{ $key }}[slug]" value="{{$row->translate($key)->slug}}">
            @endcan
          @endif
        </div>

        <div class="row">
          <x-admin.form.trans-text-area name="des" :label="__('admin/proProduct.pro_text_des')" :key="$key" :row="$row" :tdir="$key"/>
        </div>

        <div class="row">
          <x-admin.form.trans-text-area name="short_des" :label="__('admin/proProduct.pro_text_des_short')" :key="$key" :row="$row" :tdir="$key"/>
        </div>

        <div class="row">
          <x-admin.form.trans-input name="g_title" :key="$key" :row="$row" :label="__('admin/form.text_g_title')" :tdir="$key"/>
          <x-admin.form.trans-text-area name="g_des" :key="$key" :row="$row" :label="__('admin/form.text_g_des')" :tdir="$key"/>
        </div>

      </div>
    @endforeach
  </div>
</div>