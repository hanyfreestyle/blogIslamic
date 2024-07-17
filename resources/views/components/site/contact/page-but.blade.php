<div class="row g-4 contact_us_but">

    <a href="tel:{{$WebConfig->phone_call}}">
        <div class="col-md-6 col-xl-12">
            <div class="d-flex align-items-center gap-4  bg-neutral-0 rounded-4 p-6 box-shadow">
                <div class="d-grid place-content-center w-15 h-15 rounded-circle bg-primary-300 clr-neutral-0 flex-shrink-0">
                    <i class="fa-solid fa-phone-volume"></i>
                </div>
                <div class="flex-grow-1">
                    <h3 class="mb-2"> {{__('web/contact.icon_call')}} </h3>
                    <span class="span_info clr-neutral-500"> {{$WebConfig->phone_num}}</span>
                </div>
            </div>
        </div>
    </a>

    <div class="col-md-6 col-xl-12">
        <div class="d-flex align-items-center gap-4 bg-neutral-0 rounded-4 p-6 box-shadow">
            <div class="d-grid place-content-center w-15 h-15 rounded-circle bg-secondary-300 clr-neutral-700 flex-shrink-0">
                <i class="fa-brands fa-whatsapp"></i>
            </div>
            <div class="flex-grow-1">
                <h3 class="mb-2"> {{__('web/contact.icon_whatsapp')}} </h3>
                <span class="span_info clr-neutral-500">{{$WebConfig->whatsapp_num}}</span>
            </div>
        </div>
    </div>
    <a href="#">
        <div class="col-md-6 col-xl-12">
            <div class="d-flex align-items-center gap-4 bg-neutral-0 rounded-4 p-6 box-shadow">
                <div class="d-grid place-content-center w-15 h-15 rounded-circle bg-info clr-neutral-700 flex-shrink-0">
                    <i class="fa-solid fa-headset"></i>
                </div>
                <div class="flex-grow-1">
                    <h3 class="mb-2"> {{__('web/contact.icon_zoom')}} </h3>
                </div>
            </div>
        </div>
    </a>
    <div class="col-md-6 col-xl-12">
        <div class="d-flex align-items-center gap-4 bg-neutral-0 rounded-4 p-6 box-shadow">
            <div class="d-grid place-content-center w-15 h-15 rounded-circle bg-tertiary-300 clr-neutral-700 flex-shrink-0">
                <i class="fa-solid fa-envelope"></i>
            </div>
            <div class="flex-grow-1">
                <h3 class="mb-2"> {{__('web/contact.icon_email')}} </h3>
                <span class="span_email clr-neutral-500">{{$WebConfig->email}}</span>
            </div>
        </div>
    </div>

</div>
