@for($i = 0; $i < 5; $i++)
    @if($i < (int)$evaluation)
    <img src="{{ asset('images/star-on.png') }}" alt="Image" class="hidden-xs"/>
    @else
    <img src="{{ asset('images/star-off.png') }}" alt="Image" class="hidden-xs"/>
    @endif
@endfor