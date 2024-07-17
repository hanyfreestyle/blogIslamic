<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" {!!htmlArDir()!!} >
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="author" content="Awaiken Theme">
  <meta name='robots' content='noindex,nofollow'/>
  {!! SEO::generate() !!}
  <x-site.def.fav-icon/>
  <link href="{{ underAssets('css/bootstrap.min.css') }}" rel="stylesheet" media="screen">
  <link href="{{ underAssets('css/custom.css') }}" rel="stylesheet" media="screen">
<body>


<div class="comming-soon">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="coming-soon-box">

          <div class="logo">
            <img src="{{getDefPhotoPath($DefPhotoList,'light_logo')}}" alt="image" class="">
          </div>


          <div class="coming-text">
            <h2>{{$WebConfig->name}}</h2>
            <div class="typing-titleX">
              <p>{!! nl2br($WebConfig->closed_mass) !!}</p>
            </div>
          </div>

          <div class="countdown-timer-wrapper">
            <div class="timer" id="countdown"></div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
<script src="{{ underAssets('js/jquery-1.12.4.min.js') }}"></script>
<script src="{{ underAssets('js/countdown-timer.js') }}"></script>
<script src="{{ underAssets('js/SmoothScroll.js') }}"></script>
<script src="{{ underAssets('js/bootstrap.min.js') }}"></script>
<script src="{{ underAssets('js/function.js') }}"></script>
<script>
    $(document).ready(function () {
        //var myDate = new Date("2024/02/02");
        var myDate = new Date();
        myDate.setDate(myDate.getDate() + 5);
        $("#countdown").countdown(myDate, function (event) {
            $(this).html(
                event.strftime(
                    '<div class="timer-wrapper">' +
                    '<div class="time">%D</div><span class="text">{{__('under.days')}}</span></div>' +
                    '<div class="timer-wrapper"><div class="time">%H</div><span class="text">{{__('under.hours')}}</span></div>' +
                    '<div class="timer-wrapper"><div class="time">%M</div><span class="text">{{__('under.minutes')}}</span></div>' +
                    '<div class="timer-wrapper"><div class="time">%S</div><span class="text">{{__('under.seconds')}}</span></div>'
                )
            );
        });
    });
</script>
</body>
</html>
