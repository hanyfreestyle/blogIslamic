@if($facebook)
    <li>
        <a href="{{$links['facebook']}}" title="{{$row->name}}" rel="nofollow noopener noreferrer" class="social-button facebook_button ">
            <i class="fab fa-facebook-f"></i>
        </a>
    </li>
@endif
@if($twitter)
    <li>
        <a href="{{$links['twitter']}}" title="{{$row->name}}" rel="nofollow noopener noreferrer" class="social-button twitter_button">
            <i class="fab fa-x-twitter"></i>
        </a>
    </li>
@endif
@if($linkedin)
    <li>
        <a href="{{$links['linkedin']}}" title="{{$row->name}}" rel="nofollow noopener noreferrer" class="social-button linkedin_button">
            <i class="fab fa-linkedin-in"></i>
        </a>
    </li>
@endif
@if($whatsapp)
    <li>
        <a href="{{$links['whatsapp']}}" title="{{$row->name}}" rel="nofollow noopener noreferrer" class="social-button whatsapp_button">
            <i class="fab fa-whatsapp"></i>
        </a>
    </li>
@endif
