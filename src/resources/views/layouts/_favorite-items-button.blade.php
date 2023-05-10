@if($item->is_favorite)
<form action="{{ route('favorite-items.destroy',$item->id) }}" method="post">
    @csrf
    @method('DELETE')
    <button type="submit"  class="btn btn-primary ">⭐️</button>
</form>
@else
<form action="{{ route('favorite-items.store') }}" method="post">
    @csrf
    <input type="hidden" name="item_id" value="{{ $item->id }}">
    <button type="submit" class="btn btn-primary ">☆</button>
</form>
@endif