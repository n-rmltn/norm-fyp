@forelse ($order as $o)
    <tr>
        <td>
            <div class="d-flex justify-content-start align-items-start">
                @if ($o->product->product_cart_image_name !== null)
                    <div class="avatar avatar-xs me-3 flex-shrink-0">
                        <picture>
                            <img class="f-w-10 rounded-circle"
                                src="{{ asset('/assets/images/product/' . $o->product->product_cart_image_name) }}"
                                alt="Product Image">
                        </picture>
                    </div>
                @else
                    <button
                        class="btn-icon bg-primary-faded text-primary fw-bolder me-3">{{ ucfirst(substr($o->product->product_name, 0, 1)) }}</button>
                @endif
                <div>
                    <p class="fw-bolder mb-1 d-flex align-items-center lh-1">
                        {{ $o->product->product_name }}
                    </p>
                    <span class="d-block text-muted">{{ $o->product->brand->product_brand_name }}</span>
                    @if ($o->product->product_spec_id !== null)
                        <span class="d-block text-muted">{{ $o->product->spec->product_spec_name }}</span>
                    @endif
                </div>
            </div>
        </td>
        <td class="text-muted">
            {{ $o->created_at }}
        </td>
        <td class="text-muted">
            {{ $o->user->name }}
        </td>
        <td class="text-muted">{{ $o->order_quantity }}</td>
        <td class="text-muted">{{ $o->order_status }}</td>
        <td>
            <div class="dropdown">
                <button class="btn btn-link dropdown-toggle dropdown-toggle-icon fw-bold p-0" type="button"
                    id="dropdownOrder-0" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ri-more-2-line"></i>
                </button>
                <ul class="dropdown-menu dropdown" aria-labelledby="dropdownOrder-0">
                    @if (Auth::user()->id == $o->users_id && $o->order_status === 'Pending')
                        <li>
                            <form action="{{ route('orders.cancel', $o->id) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="dropdown-item">Cancel
                                    Order</button>
                            </form>
                        </li>
                    @endif
                    @if (Auth::user()->is_admin && $o->order_status === 'Pending' && $o->order_status !== 'Cancelled')
                        <li>
                            <form action="{{ route('orders.accept', $o->id) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="dropdown-item">Accept</button>
                            </form>
                        </li>
                        <li>
                            <form action="{{ route('orders.reject', $o->id) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="dropdown-item">Reject</button>
                            </form>
                        </li>
                    @endif
                    @if ($o->order_status !== 'Pending' || $o->order_status === 'Cancelled')
                        <li><span class="dropdown-item text-muted">No action
                                available</span></li>
                    @endif
                </ul>
            </div>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="3" class="text-muted">No orders found</td>
    </tr>
@endforelse