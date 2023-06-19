{{-- TODO 連打時にエラーが出ないように --}}
<meta name="csrf-token" content="{{ csrf_token() }}">
@if($item->is_favorite)
<button 
    class="btn btn-primary toggle_favorite" 
    type="submit" 
    is_favorite="{{ $item->is_favorite}}" 
    item_id="{{ $item->id }}" 
    >⭐️
</button>
@else
<button 
    class="btn btn-primary toggle_favorite" 
    type="submit" 
    is_favorite="{{ $item->is_favorite }}" 
    item_id="{{ $item->id }}" 
    >☆
</button>
@endif
