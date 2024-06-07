@if (Route::currentRouteName() === 'profile.show')
    <h2 class="fs-4 mb-3">{{ __('Edit User') }}</h2>
@endif

@if (Route::currentRouteName() === 'brands.show')
    <h2 class="fs-4 mb-3">{{ __('Edit Brand') }}</h2>
@endif

@if (Route::currentRouteName() === 'category.show')
    <h2 class="fs-4 mb-3">{{ __('Edit Category') }}</h2>
@endif

@if (Route::currentRouteName() === 'spec.show')
    <h2 class="fs-4 mb-3">{{ __('Edit Spec') }}</h2>
@endif

@if (Route::currentRouteName() === 'compatibility.show')
    <h2 class="fs-4 mb-3">{{ __('Edit Compatibility') }}</h2>
@endif

@if (Route::currentRouteName() === 'product.show')
    <h2 class="fs-4 mb-3">{{ __('Edit Product') }}</h2>
@endif
