@if(Session::has('Add.Done'))
    <div class="col-lg-12">
        <div class="alert alert-success alert-dismissible">
            {!! __('admin/alertMass.confirm_add') !!}
        </div>
    </div>
@elseif(Session::has('Update.Done'))
    <div class="col-lg-12">
        <div class="alert alert-success alert-dismissible">
            {!! __('admin/alertMass.confirm_update') !!}
        </div>
    </div>
@elseif(Session::has('Edit.Done'))
    <div class="col-lg-12">
        <div class="alert alert-success alert-dismissible">
            {!! __('admin/alertMass.confirm_edit') !!}
        </div>
    </div>
@elseif(Session::has('restore'))
    <div class="col-lg-12">
        <div class="alert alert-success alert-dismissible">
            {!! __('admin/alertMass.confirm_restore') !!}
        </div>
    </div>
@elseif(Session::has('confirmDelete'))
    <div class="col-lg-12">
        <div class="alert alert-danger alert-dismissible">
            {!! __('admin/alertMass.confirm_delete') !!}
        </div>
    </div>
@elseif(Session::has('data_not_save'))
    <div class="col-lg-12">
        <div class="alert alert-danger alert-dismissible">
            {!!  __('admin/alertMass.confirm_not_save') !!}
        </div>
    </div>
@elseif(Session::has('confirmNotDelete'))
    <div class="col-lg-12">
        <div class="alert alert-danger alert-dismissible">
            {!! __('admin/alertMass.confirm_not_delete') !!}
        </div>
    </div>
@elseif(Session::has('confirmException'))
    <div class="col-lg-12">
        <div class="alert alert-danger alert-dismissible">
            {!! __('admin/alertMass.confirm_exception') !!}
            <x-admin.hmtl.confirm-massage-exception/>
        </div>
    </div>
@endif

