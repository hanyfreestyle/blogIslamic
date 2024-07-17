<div class="card card-{{$bg}} card-outline">
  <div class="card-header def_card_header">
    <h3 class="card-title text-{{$bg}} font-weight-normal ">{{$title}}</h3>
    <div class="card-tools">
      @if($pageData['AddButToCard'])
        @if( isset($pageData['ViewType']) and $pageData['ViewType'] == 'List')
          @if( $pageData['AddLang'] == true and count(config('app.web_lang'))>1)
            <x-admin.lang.add-new-list :page-data="$pageData"/>
          @endif

          @can($pageData['AddRole'])
            @if(isset($pageData['AddPageUrl']))
              <a href="{{$pageData['AddPageUrl']}}" class="btn btn-sm btn-primary">{{$pageData['addButName']}}</a>
            @endif
          @endcan

        @endif
        @if( $pageData['Restore'] == 1 and $pageData['Trashed'] > 0 and isset($pageData['RestoreUrl']))
          @can($pageData['RestoreRole'])
            <a href="{{$pageData['RestoreUrl']}}" class="btn btn-sm btn-danger">{{ __('admin/def.delete_restor_view') }}</a>
          @endcan
        @endif

        @if( $pageData['ViewType'] == 'List' and $pageData['AddConfig'] == true and isset($pageData['ConfigRoute']))
          @can($pageData['EditRole'])
            <a href="{{$pageData['ConfigRoute']}}" class="btn btn-sm btn-dark"><i class="fas fa-cogs"></i></a>
          @endcan
        @endif
      @endif
    </div>
  </div>
  <div class="card-body card_body_New pb-5x">
    @if($errors->has([]) and $addFormError == true)
      <div class="alert alert-danger alert-dismissible">
        {{__('admin/alertMass.form_has_error')}}
      </div>
    @endif

    @if($errors->has([]) and $fullError == true )
      <div class="alert alert-danger alert-dismissible">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </div>
    @endif
    <x-admin.hmtl.confirm-massage/>
    {{$slot}}
  </div>
</div>
