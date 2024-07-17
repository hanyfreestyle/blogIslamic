@if(Cache::get($key) != null)
    <div class="col-lg-3 col-6">
        <form action="{{route('config.update.ClearKey')}}" method="post">
            @csrf
            <input type="hidden" value="{{$key}}" name="key">

            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{count(Cache::get($key))}}</h3>
                    <p>{{$title}}</p>
                </div>
                <div class="icon"><i class="{{$icon}}"></i></div>
                <input class="btn btn-block btn-danger btn-flat" type="submit" value="{{__('admin/config/cash.btn_clear')}}" >
            </div>
        </form>
    </div>
@endif


