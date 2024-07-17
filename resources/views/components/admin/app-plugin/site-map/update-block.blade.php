<div class="col-lg-3">
    <div class="card">
        <div class="card-header border-0 bg-primary">
            <h3 class="card-title">{{$title}}</h3>
        </div>


        <div class="card-body table-responsive p-0">
            <table class="table table-striped table-valign-middle">
                <tbody>
                <tr>
                    <td>{{__('admin/configSitemap.f_last_update')}}</td>
                    @if(isset($row[$catid]))
                        <td>{{$row[$catid]['updated_at']}} </td>
                    @else
                        <td></td>
                    @endif

                </tr>
                <tr>
                    <td></td>
                    <td>
                        <form action="{{route('config.SiteMap.'.$route)}}" method="post">
                            @csrf
                            <input type="hidden" name="cat_id" value="{{$catid}}">
                            <button type="submit" class="btn btn-block btn-primary">{{__('admin/configSitemap.f_but_update')}}</button>
                        </form>
                    </td>
                </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>
