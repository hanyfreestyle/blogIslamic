<nav class="main-header navbar navbar-expand navbar-white navbar-light {{ navBarStyle() }}">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.ChangeCollapse')}}" role="button">{!! sidebarCollapseIcon() !!}</a>
        </li>

        @if(config('app.puzzle_active') and File::isFile(base_path('routes/AppPlugin/appCore.php')))
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.AppPuzzle.Config.IndexModel')}}" role="button">
                    <i class="fas fa-puzzle-piece"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.adminlang.edit')}}" role="button">
                    <i class="fas fa-language"></i>
                </a>
            </li>
        @endif
    </ul>

    <ul class="navbar-nav ml-auto">
        @include('admin.layouts.inc.topNav.search')


        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.AdminMenu.index')}}" role="button">
                <i class="fas fa-list-ul"></i>
            </a>
        </li>

        <li class="nav-item dropdown">
            <a href="#" class="nav-link" data-toggle="dropdown">
                {!! AdminHelper::detectFlag(LaravelLocalization::getSupportedLocales()[LaravelLocalization::getCurrentLocale()]['regional'])['flagIcon'] !!}
            </a>
            <div class="dropdown-menu dropdown-menu-right p-0">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    @if (thisCurrentLocale() != $localeCode)
                        <a class="dropdown-item" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                            {!! AdminHelper::detectFlag($properties['regional'])['flagIcon'] !!} {{ $properties['native'] }}
                        </a>
                    @endif
                @endforeach
            </div>
        </li>

        @include('admin.layouts.inc.topNav.messages')
        @include('admin.layouts.inc.topNav.user_profile')
        @include('admin.layouts.inc.topNav.notifications')

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.logout') }}"
               onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i>
            </a>
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>

        <li class="nav-item">
            <a class="nav-link" target="_blank" href="{{ route('page_index') }}"><i class="fas fa-home"></i></a>
        </li>

        @if(config('adminConfig.top_navbar_fullscreen') == true)
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
        @endif

        @if(config('adminConfig.top_navbar_control') == true)
            <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                    <i class="fas fa-th-large"></i>
                </a>
            </li>
        @endif

    </ul>
</nav>
