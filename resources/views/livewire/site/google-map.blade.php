<div>
    @if($lat != null and $long != null)
        <div class="bg-neutral-0 rounded-4 mb-10">
            @if($view == true)
                <div class="w-100">
                    <iframe class="w-100 h-400 rounded-4" src="https://maps.google.com/maps?q={{$lat}},{{$long}}&z=17&amp;output=embed"></iframe>
                </div>
            @else
                <div class="property-showcase bg-neutral-0 p-1 rounded-4 overflow-hidden position-relative z-1 SiteBoxShadow">
                    <img src="{{getDefPhotoPath($DefPhotoList,'google_map')}}" alt="image" class="img-fluid w-100 rounded-4 z-n1">
                    <div  class="google_view_but rounded-circle bg-tertiary-300 clr-neutral-900 z-2">
                        <i wire:click="loadMap" class="fas fa-map-marker-alt"></i>
                    </div>
                </div>
            @endif
        </div>
    @endif
</div>
