@if ($paginator->hasPages())
    <div class="container">
        <div class="row g-4">
            <div class="col-12">
                <nav>
                    <ul class="pagination gap-3 justify-content-center">
                        @if ($paginator->onFirstPage())
{{--                            <li class="disabled"><span>«</span></li>--}}
                        @else
{{--                            <li class="page-item">--}}
{{--                                <a href="{{ $paginator->previousPageUrl() }}" aria-label="previous" class="page_link " rel="prev">--}}
{{--                                    @if(app()->getLocale() == 'ar')--}}
{{--                                        <i class="fa-solid fa-angles-right"></i>--}}
{{--                                    @else--}}
{{--                                        <i class="fa-solid fa-angles-left"></i>--}}
{{--                                    @endif--}}
{{--                                </a>--}}
{{--                            </li>--}}
                        @endif

                        @if($paginator->currentPage() > 2)
                            <li class="page-item hidden-xs"><a href="{{ $paginator->url(1) }}" aria-label="pagin" class="page_link " >1</a></li>
                        @endif
                        @if($paginator->currentPage() > 3)
{{--                            <li class="page-item"><span class="page_link " >...</span></li>--}}
                        @endif
                        @foreach(range(1, $paginator->lastPage()) as $i)
                            @if($i >= $paginator->currentPage() - 1 && $i <= $paginator->currentPage() + 1)
                                @if ($i == $paginator->currentPage())
                                    <li class="page-item"><span class="page_link active-bg">{{ $i }}</span></li>
                                @else
                                    <li class="page-item"><a href="{{ $paginator->url($i) }}" aria-label="pagin" class="page_link " >{{ $i }}</a></li>
                                @endif
                            @endif
                        @endforeach
                        @if($paginator->currentPage() < $paginator->lastPage() - 2)
{{--                            <li class="page-item"><span class="page_link ">...</span></li>--}}
                        @endif
                        @if($paginator->currentPage() < $paginator->lastPage() - 1)
                            <li class="page-item hidden-xs"><a href="{{ $paginator->url($paginator->lastPage()) }}" aria-label="lastPage" class="page_link " >{{ $paginator->lastPage() }}</a></li>
                        @endif

                        {{-- Next Page Link --}}
                        @if ($paginator->hasMorePages())
{{--                            <li class="page-item">--}}
{{--                                <a href="{{ $paginator->nextPageUrl() }}" aria-label="nextPageUrl"  class="page_link "  rel="next">--}}
{{--                                    @if(app()->getLocale() == 'ar')--}}
{{--                                        <i class="fa-solid fa-angles-left"></i>--}}
{{--                                    @else--}}
{{--                                        <i class="fa-solid fa-angles-right"></i>--}}
{{--                                    @endif--}}
{{--                                </a>--}}
{{--                            </li>--}}
                        @else
{{--                            <li class="disabled"><span>»</span></li>--}}
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </div>
@endif
