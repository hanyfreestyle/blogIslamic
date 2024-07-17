<div class="col-xl-12 contactFormPadding">
    <div class="property-card SiteBoxShadow">
        <div class="property-card__head">
            <div class="property-card__img unit_card_img">
                <x-site.def.img :row="$row" def="units" class="blog_img rounded-4" w="400" h="300" />
            </div>
        </div>
        <div class="property-card__body">
            @if($row->locationName->name)
                <div class="d-flex align-items-center gap-1 mb-4">
                    <span class="material-symbols-outlined mat-icon clr-tertiary-400"> distance </span>
                    <span class="d-inline-block">{{$row->locationName->name}} </span>
                </div>
            @endif
            <h2 class="link d-block clr-neutral-700 :clr-primary-300 fs-20 fw-medium">
                {{$row->name}}
            </h2>
        </div>
    </div>
</div>
