<section class="content">
    <div class="modal fade" id="modal_{{$id}}">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{__('admin/leadsContactUs.model_title')}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body leadInfo">

                    <div class="row">
                        <div class="col-lg-3 title">{{__('admin/leadsContactUs.t_date_add')}}</div>
                        <div class="col-lg-9 des">{{$row->getFormatteDate()}}</div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3 title">{{__('admin/leadsContactUs.t_name')}}</div>
                        <div class="col-lg-9 des">{{$row->name}}</div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3 title">{{__('admin/leadsContactUs.t_country')}}</div>
                        <div class="col-lg-9 des">{!! TablePhotoFlag($row->countryName) !!} {{$row->countryName->name ?? ''}}</div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3 title">{{__('admin/leadsContactUs.t_phone')}}</div>
                        <div class="col-lg-9 des phone_number">{{$row->phone}}</div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3 title">{{__('admin/leadsContactUs.t_full_number')}}</div>
                        <div class="col-lg-9 des phone_number">{{$row->full_number}}</div>
                    </div>

                    @if($row->request_type == 1)
                        <div class="row">
                            <div class="col-lg-3 title">{{__('admin/leadsContactUs.t_subject')}}</div>
                            <div class="col-lg-9 des">{{$row->subject}}</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 title">{{__('admin/leadsContactUs.t_message')}}</div>
                            <div class="col-lg-9 des">{{$row->message}}</div>
                        </div>
                    @endif

                    @if($row->request_type == 3)
                        <div class="row">
                            <div class="col-lg-3 title">{{__('admin/leadsContactUs.t_meeting_date')}}</div>
                            <div class="col-lg-9 des">{{$row->getmeetingDate()}}</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 title">{{__('admin/leadsContactUs.t_meeting_time')}}</div>
                            <div class="col-lg-9 des">{{$row->meeting_time}}</div>
                        </div>
                    @endif

                    @if($row->request_type == 2 or $row->request_type == 3)
                        <div class="row">
                            <div class="col-lg-3 title">{{__('admin/leadsContactUs.t_listing_project')}}</div>
                            <div class="col-lg-9 des">{{$row->projectinfo->name ?? ''}}</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 title">{{__('admin/leadsContactUs.t_listing')}}</div>
                            <div class="col-lg-9 des">{{$row->listinginfo->name ?? ''}}</div>
                        </div>
                    @endif

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{__('admin/leadsContactUs.model_close')}}</button>
                </div>
            </div>
        </div>
    </div>
</section>
