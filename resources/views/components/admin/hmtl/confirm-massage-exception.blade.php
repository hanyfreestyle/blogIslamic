@if(Session::has('fromModel') and Session::get('fromModel') == "Product")
  <br> {{__('admin/proProduct.pro_text_name')}} ({{print_h1(Session::get('deleteRow'))}})
  @if(intval(Session::get('deleteRow')->orders_count) > 0 )
    <br> ({{Session::get('deleteRow')->orders_count}}) {!! __('admin/proProduct.pro_del_related_orders') !!}
  @endif
@endif

@if(Session::has('fromModel') and Session::get('fromModel') == "CategoryProduct")
  <br> {{__('admin/proProduct.cat_text_name')}} ({{print_h1(Session::get('deleteRow'))}})
  @if(intval(Session::get('deleteRow')->del_category_count) > 0 )
    <br> ({{Session::get('deleteRow')->del_category_count}}) {!! __('admin/proProduct.cat_del_related_cat') !!}
  @endif
  @if(intval(Session::get('deleteRow')->del_product_count) > 0 )
    <br> ({{Session::get('deleteRow')->del_product_count}}) {!! __('admin/proProduct.cat_del_related_pro') !!}
  @endif
@endif

@if(Session::has('fromModel') and Session::get('fromModel') == "CategoryFaq")
  <br> {{__('admin/proProduct.cat_text_name')}} ({{print_h1(Session::get('deleteRow'))}})
  @if(intval(Session::get('deleteRow')->del_category_count) > 0 )
    <br> ({{Session::get('deleteRow')->del_category_count}}) {!! __('admin/faq.cat_del_related_cat') !!}
  @endif
  @if(intval(Session::get('deleteRow')->del_faq_count) > 0 )
    <br> ({{Session::get('deleteRow')->del_faq_count}}) {!! __('admin/faq.cat_del_related_faq') !!}
  @endif
@endif

@if(Session::has('fromModel') and Session::get('fromModel') == "UsersPost")
    <br> {{__('admin/config/roles.exception_user_name')}} ({{ Session::get('deleteRow')->name }})
    @if(intval(Session::get('deleteRow')->del_post_count) > 0 )
        <br> ({{Session::get('deleteRow')->del_post_count}}) {!! __('admin/config/roles.exception_user_post') !!}
    @endif
@endif




