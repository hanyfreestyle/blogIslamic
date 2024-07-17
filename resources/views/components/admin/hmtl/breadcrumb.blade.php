<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="def_breadcrumb_h1 text-lg font-weight-lighter">
                    @if($butView)<a href="{{route('admin.Dashboard')}}"><i class="fa fa-home"></i></a> @endif {{$pageData['TitlePage']}}
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right text-md">
                    @if ($pageData['ViewType'] == 'List')
                    @else
                        @if(isset($pageData['PageListUrl']))
                            <x-admin.form.action-button  url="{{$pageData['PageListUrl']}}" print-lable="{{$pageData['ListPageName']}}" size="s"  bg="p" :tip="false"   />
                        @endif
                    @endif
                </ol>
            </div>
        </div>
    </div>
</section>
