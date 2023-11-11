<div class="sub-category-load">
     @if ($subCategory ?? null)
     <label class="form-label">Sub Category</label>
     <select name="subcategory" class="form-control subcategory">
         <option value="">Choose Sub Category</option>
         @foreach ( $subCategory as $item)
         <option value="{{ $item->id }}">{{ $item->name }}</option>
         @endforeach
     </select>
     @else
     <label class="form-label">Sub Category</label>
     <select name="subcategory" class="form-control">
        <option value="">Choose Sub Category</option>
    </select>
    @endif
</div>
