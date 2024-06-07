<?php

if (!function_exists('breadcrumbs')) {
    function breadcrumbs()
    {
        $breadcrumbs = [
            'dashboard' => ['Home' => 'dashboard'],
            // Orders
            'orders' => ['Home' => 'dashboard', 'Orders' => 'orders'],
            'orders.create' => ['Home' => 'dashboard', 'Orders' => 'orders', 'Create Order' => 'orders.create'],
            // Users
            'profile.users' => ['Home' => 'dashboard', 'User Listing' => 'profile.users'],
            'profile.show' => ['Home' => 'dashboard', 'User Listing' => 'profile.users', 'Edit User' => 'profile.show'],
            // Product
            'product' => ['Home' => 'dashboard', 'Product Listing' => 'product'],
            'product.show' => ['Home' => 'dashboard', 'Product Listing' => 'product', 'Edit Product' => 'product.show'],
            'product.create' => ['Home' => 'dashboard', 'Product Listing' => 'product', 'Edit Product' => 'product.create'],
            // Brands
            'product.brands' => ['Home' => 'dashboard', 'Product Listing' => 'product', 'Brands' => 'product.brands'],
            'brands.show' => ['Home' => 'dashboard', 'Product Listing' => 'product', 'Brands' => 'product.brands', 'Edit Brand' => 'brands.show'],
            'brands.create' => ['Home' => 'dashboard', 'Product Listing' => 'product', 'Brands' => 'product.brands', 'Add Brand' => 'brands.create'],
            // Category
            'product.category' => ['Home' => 'dashboard', 'Product Listing' => 'product', 'Category' => 'product.category'],
            'category.show' => ['Home' => 'dashboard', 'Product Listing' => 'product', 'Category' => 'product.category', 'Edit Category' => 'category.show'],
            'category.create' => ['Home' => 'dashboard', 'Product Listing' => 'product', 'Category' => 'product.category', 'Add Category' => 'category.create'],
            // Spec
            'product.spec' => ['Home' => 'dashboard', 'Product Listing' => 'product', 'Spec' => 'product.spec'],
            'spec.show' => ['Home' => 'dashboard', 'Product Listing' => 'product', 'Spec' => 'product.spec', 'Edit Spec' => 'spec.show'],
            'spec.create' => ['Home' => 'dashboard', 'Product Listing' => 'product', 'Spec' => 'product.spec', 'Add Spec' => 'spec.create'],
            // Compatibility
            'product.compatibility' => ['Home' => 'dashboard', 'Product Listing' => 'product', 'Compatibility' => 'product.compatibility'],
            'compatibility.show' => ['Home' => 'dashboard', 'Product Listing' => 'product', 'Compatibility' => 'product.compatibility', 'Edit Compatibility' => 'compatibility.show'],
            'compatibility.create' => ['Home' => 'dashboard', 'Product Listing' => 'product', 'Compatibility' => 'product.compatibility', 'Add Compatibility' => 'compatibility.create'],
        ];

        $currentRoute = Route::currentRouteName();
        $breadcrumbItems = $breadcrumbs[$currentRoute] ?? [];

        $breadcrumbHtml = '';

        $index = 0;
        foreach ($breadcrumbItems as $breadcrumbName => $breadcrumbRoute) {
            $breadcrumbHtml .= '<li class="breadcrumb-item';
            if ($index === count($breadcrumbItems) - 1) {
                $breadcrumbHtml .= ' active">';
                $breadcrumbHtml .= $breadcrumbName;
            } else {
                $breadcrumbHtml .= '">';
                $breadcrumbHtml .= '<a href="' . route($breadcrumbRoute) . '">' . $breadcrumbName . '</a>';
            }
            $breadcrumbHtml .= '</li>';
            $index++;
        }

        return $breadcrumbHtml;
    }


}
