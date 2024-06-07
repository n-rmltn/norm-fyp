@forelse ($users as $user => $val)
<tr>
<td>
    <div class="d-flex justify-content-start align-items-start">
        <button class="btn-icon bg-primary-faded text-primary fw-bolder me-3">{{ ucfirst(substr($val->name,0,1)) }}</button>
        <div>
            <p class="fw-bolder mb-1 d-flex align-items-center lh-1"><span>{{ ucwords(trans($val->name)) }}</span></p>
            <span class="d-block text-muted">{{ $val->email }}</span>
            <span class="d-block text-muted">{{ $val->phone }}</span>
        </div>
    </div>
</td>
@if ($val->is_admin === 1)
<td>Administrator</td>
@else
<td>User</td>
@endif
<td class="text-muted"><i class="ri-map-pin-line align-bottom"></i>
@if ($val->state === null)
Not Defined
@else
{{ $val->state }}
@endif
</td>
<td class="text-muted">@if ($val->created_at === null)
    Not Defined
    @else
    {{ $val->created_at }}
    @endif
</td>
<td>
    <div class="dropdown">
        <button class="btn btn-link dropdown-toggle dropdown-toggle-icon fw-bold p-0" type="button"
        id="dropdownOrder-0" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="ri-more-2-line"></i>
    </button>
    <ul class="dropdown-menu dropdown" aria-labelledby="dropdownOrder-0">
        <li><a class="dropdown-item" href="{{ route('profile.show', $val->id) }}">Edit</a></li>
    </ul>
</div>
</td>
</tr>
@empty
<p class="text-white">No users in database</p>
@endforelse