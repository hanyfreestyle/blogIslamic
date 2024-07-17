<div class="col-lg-3 col-6">
    <form action="{{route('config.update.DB'.$key)}}" method="post">
        @csrf
        <div class="small-box {{$color}}">
            <div class="inner">
                <h3>{{$date}}</h3>
                <p>{{$title}}</p>
            </div>
            <div class="icon"><i class="{{$icon}}"></i></div>
            <input class="btn btn-block btn-dark btn-flat" type="submit" value="{{__('admin/config/cash.btn_update')}}" >
        </div>
    </form>
</div>

