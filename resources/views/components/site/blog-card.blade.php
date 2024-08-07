<div class="col-md-4 col-sm-4 col-xs-12">
    <div class="BlogListLi">
        <a href="{{route('blog_view',$row->slug)}}">
            <div class="single_blog_img">
                <x-site.def.img :row="$row" def="blog" class=" rounded-4" w="400" h="240"/>
            </div>
        </a>
        <div class="blog_date">
            <i class="far fa-calendar-alt"></i> {{$row->getHomeFormatteDate()}}
        </div>
        <div class="blog_text">
            <h3><a href="{{route('blog_view',$row->slug)}}" class="crop_line_1">{{$row->name}}</a></h3>
            <p>{{PrintShortDes($row,'200')}}</p>
        </div>
        <div class="text-left">
{{--            <a href="{{route('blog_view',[$row->slug,'.html'])}}" class="ready_btn">{{__('web/def.units_read_more')}}</a>--}}
            <a href="{{route('blog_view',$row->slug)}}" class="ready_btn">{{__('web/def.units_read_more')}}</a>
        </div>
    </div>
</div>
{!! $printSchema->Article($row,'blog_view') !!}
