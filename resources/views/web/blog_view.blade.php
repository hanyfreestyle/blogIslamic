@extends('web.layouts.app')
@section('content')
    <x-admin.hmtl.test-meta/>
    <div class="area_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    {!! Breadcrumbs::render('BlogView',$blog->categories->first(),$blog) !!}
                </div>

                <div class="col-md-8 col-sm-8 col-xs-12">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12 BlogView">
                            <h1>{{$blog->name}}
                                @if(\Illuminate\Support\Facades\Auth::user())
                                    <a target="_blank" href="{{route('admin.Blog.BlogPost.edit',$blog->id)}}" style="font-size: 15px">تعديل</a>
                                @endif
                            </h1>
                            <div class="blogViewDiv">

                                <div class="dateInfo">
                                    <span class="user_id">{{__('web/def.user_name')}} : <span class="info"><a
                                                href="{{route('AuthorView',$blog->userName->slug)}}">{{$blog->userName->name}}</a> </span> | </span>
                                    <span class="printDate">{{__('web/def.published_at')}} : <span class="info">{{$blog->getHomeFormatteDate()}}</span> | </span>
                                    @if($review['hasReview'])
                                        <span class="user_id">{{__('web/def.user_review')}} : <span class="info"><a
                                                    href="{{route('AuthorView',$blog->userName->slug)}}">{{$review['userName']}}</a> </span> | </span>
                                    @endif
                                    @if($review['hasUpdate'])
                                        <span class="printDate">{{__('web/def.last_update')}} : <span class="info">{{$blog->getUpdateFormatteDate()}}</span> </span>
                                    @endif
                                </div>

                                @if(!empty($contents))
                                    <div class="table_of_contents">
                                        @include('web.blog_table_of_contents', $contents)
                                    </div>
                                @endif
                                <div class="blog_des_view_div">
                                    {!! (CleanBlogDes($blogBody)) !!}
                                </div>

                                @if(count($blog->tags)>0)
                                    <div class="tag_div">
                                        <div class="title">{{__('web/def.tags')}}</div>
                                        @foreach($blog->tags as $tag)
                                            <a href="{{route('TagView',$tag->slug)}}" class="tag_name">#{{$tag->name}}</a>
                                        @endforeach
                                    </div>
                                @endif

                                <div class="tag_div">
                                    <div class="title">{{__('web/def.user_div')}}</div>
                                    <p class="user_info_p">{!! $blog->userName->des !!}</p>
                                </div>

                            </div>
                        </div>
                    </div>
                    {!! $printSchema->Article($blog,'blog_view') !!}
                </div>

                <div class="col-lg-4 col-md-4">

                    <div class="single-blog-page">
                        <div class="left-blog">
                            <h4>{{__('web/menu.main_category')}}</h4>
                            <ul class="blog_view_cat_list">
                                @foreach($categories as $category)
                                    <li><a href="{{route('CategoryView',$category->slug)}}">{{$category->name}} <span class="number">({{$category->count}})</span></a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="single-blog-page">
                        <div class="left-blog">
                            <h4>{{__('web/def.related_blog')}}</h4>
                            <div class="recent-post">
                                @foreach($ReletedBlog as $blog)
                                    <div class="recent_single_post">
                                        <a href="{{route('blog_view',$blog->slug)}}">
                                            <div class="post_img">
                                                <x-site.def.img :row="$blog" def="blog" class="" w="400" h="240"/>
                                            </div>
                                        </a>
                                        <div class="pst_content">
                                            <p><a href="{{route('blog_view',$blog->slug)}}"> {{$blog->name}}</a></p>
{{--                                            <p><a href="{{route('blog_view',[$blog->slug,'.html'])}}"> {{$blog->name}}</a></p>--}}
                                        </div>
                                    </div>
                                    {!! $printSchema->Article($blog,'blog_view') !!}
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="single-blog-page">
                        <div class="left-tags blog-tags">
                            <div class="popular-tag left-side-tags left-blog">
                                <h4>{{__('web/def.popular_tags')}}</h4>
                                <ul>
                                    @foreach($popularTags as $tag)
                                        <li><a href="{{route('TagView',$tag->slug)}}">{{$tag->name}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
