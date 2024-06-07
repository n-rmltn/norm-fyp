@forelse ($brands as $brand)
    <tr>
        <td>
            <div class="d-flex justify-content-start align-items-start">
                <button
                    class="btn-icon bg-primary-faded text-primary fw-bolder me-3">{{ ucfirst(substr($brand->product_brand_name, 0, 1)) }}</button>
                <div>
                    <p class="fw-bolder mb-1 d-flex align-items-center lh-1">
                        <span>{{ ucwords(trans($brand->product_brand_name)) }}</span></p>
                </div>
            </div>
        </td>
        <td>
            <div class="dropdown">
                <button class="btn btn-link dropdown-toggle dropdown-toggle-icon fw-bold p-0" type="button"
                    id="dropdownOrder-0" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ri-more-2-line"></i>
                </button>
                <ul class="dropdown-menu dropdown" aria-labelledby="dropdownOrder-0">
                    <li><a class="dropdown-item" href="{{ route('brands.show', $brand->id) }}">Edit</a></li>
                </ul>
            </div>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="3" class="text-muted">No brands found</td>
    </tr>
@endforelse