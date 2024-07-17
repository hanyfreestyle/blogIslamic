<footer class="main-footer">
    <div class="float-right d-none d-sm-inline">
        <b>{{ __('admin.footer_version') }}</b> {{config('adminConfig.app_version')}}
    </div>
    <strong>{{ __('admin.footer_copyright') }} &copy; {{config('adminConfig.copyright_start_date')}}-{{date("Y")}} <a href="{{config('adminConfig.copyright_url')}}">{{config('adminConfig.copyright_name')}}</a>.</strong>
</footer>
