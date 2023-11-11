<div class="child-category-load">
     @if ($childCategory ?? null)
     <label class="form-label">Child Category</label>
     <select name="child_category" class="form-control">
         <option value="">Choose Child Category</option>
         @foreach ( $childCategory as $item)
         <option value="{{ $item->id }}">{{ $item->name }}</option>
         @endforeach
     </select>
     @else
     <label class="form-label">Child Category</label>
     <select name="child_category" class="form-control">
        <option value="">Choose Child Category</option>
    </select>
    @endif
</div>
