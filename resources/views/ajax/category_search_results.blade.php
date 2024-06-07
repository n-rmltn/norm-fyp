@forelse ($categories as $category)
<tr>
    <td>
        <div class="d-flex justify-content-start align-items-start">
            <button class="btn-icon bg-primary-faded text-primary fw-bolder me-3">{{ ucfirst(substr($category->product_category_name, 0, 1)) }}</button>
            <div>
                <p class="fw-bolder mb-1 d-flex align-items-center lh-1"><span>{{ ucwords(trans($category->product_category_name)) }}</span></p>
            </div>
        </div>
    </td>
    <td class="text-muted">{{ $category->id }}</td>
    <td>
        <div class="dropdown">
            <button class="btn btn-link dropdown-toggle dropdown-toggle-icon fw-bold p-0" type="button" id="dropdownOrder-0" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="ri-more-2-line"></i>
            </button>
            <ul class="dropdown-menu dropdown" aria-labelledby="dropdownOrder-0">
                <li><a class="dropdown-item" href="{{ route('category.show', $category->id) }}">Edit</a></li>
            </ul>
        </div>
    </td>
</tr>
@empty
<tr>
    <td colspan="3" class="text-muted">No categories found</td>
</tr>
@endforelse
