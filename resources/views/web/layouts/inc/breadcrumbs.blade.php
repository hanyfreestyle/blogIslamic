@unless ($breadcrumbs->isEmpty())
    <ol class="breadcrumb breadcrumb_new justify-content-md-start" itemscope itemtype="http://schema.org/BreadcrumbList" >
        @foreach ($breadcrumbs as $breadcrumb)
            @if (!is_null($breadcrumb->url) && !$loop->last)
                <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                    <a itemprop="item" href="{!! $breadcrumb->url !!}" aria-label="{{$breadcrumb->title}}">
                    <span itemprop="name">
                        @if($loop->index == 0)
                            <span class="breadcrumbSpanName">{{__('web/menu.main_home')}}</span>
                        @endif
                        {!! $breadcrumb->title !!}
                    </span>
                    </a>
                    <meta itemprop="position" content=" {{$loop->index+1}}" />
                </li>
            @else
                <li class="breadcrumb-item active" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">{!! $breadcrumb->title !!}</span>
                    <meta itemprop="position" content=" {{$loop->index+1}}" />
                </li>
            @endif
        @endforeach
    </ol>
@endunless
