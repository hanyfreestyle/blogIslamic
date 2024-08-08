<header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex justify-content-between">

        <div class="logo">
            <a class="site_name" href="{{route('page_index')}}">{!! printBlogName($WebConfig->name ?? '') !!}</a>
        </div>

        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link {{activeMenu($pageView,'HomePage')}}" href="{{route('page_index')}}">{{__('web/menu.main_home')}}</a></li>
                @if(isset($menuCategories))
                    @foreach($menuCategories as $category)
                        <li><a class="nav-link {{activeMenu($pageView,'CategoryID'.$category->id)}}" href="{{route('CategoryView',$category->slug)}}">{{$category->name}}</a></li>
                    @endforeach
                @endif
                <li><a class="nav-link {{activeMenu($pageView,'Category')}}" href="{{route('categories_list')}}">{{__('web/menu.main_category')}}</a></li>
                <li><a class="nav-link {{activeMenu($pageView,'PageAbout')}}" href="{{route('PageAbout')}}">{{__('web/menu.main_about')}}</a></li>
                <li><a class="nav-link {{activeMenu($pageView,'PageReview')}}" href="{{route('PageReview')}}">{{__('web/menu.main_review')}}</a></li>
                <li><a class="nav-link {{activeMenu($pageView,'PagePrivacy')}}" href="{{route('PagePrivacy')}}">{{__('web/menu.privacy')}}</a></li>
            </ul>
            <i class="fas fa-bars mobile-nav-toggle"></i>
        </nav>
    </div>
</header>

<span></span>
