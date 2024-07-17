<div class="mb-10">
    @if($vcode)
        @if($view == true)
            <div id="youtube_ifram" class="mt-3">
                <div class="embed-responsive embed-responsive-16by9 mb-4">
                    <iframe  src="https://www.youtube.com/embed/{{$vcode}}?autoplay=1" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
        @else
            <div class="property-showcase bg-neutral-0 p-1 rounded-4 overflow-hidden position-relative z-1 SiteBoxShadow">
                <x-site.def.img type="DefPhotoList" :row="$DefPhotoList" def="video_photo" def-name="photo" alt="youtube" class="img-fluid w-100 rounded-4 z-n1" w="800" h="420" />
                <div  class="youtube_play_but  rounded-circle z-2">
                    <i wire:click="loadVideo" class="fa-solid fa-play "></i>
                </div>
            </div>
        @endif
    @endif
</div>

