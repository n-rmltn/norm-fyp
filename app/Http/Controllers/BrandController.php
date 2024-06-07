<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandUpdateRequest;
use App\Models\Product_Brand;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class BrandController extends Controller
{
    // Shows brand list
    public function product_brand(Request $request)
    {
        $query = Product_Brand::query();

        if ($request->has('searchBrand')) {
            $query->where('product_brand_name', 'like', '%' . $request->input('searchCategory') . '%');
        }
    
        $brands = $query->paginate(10);
    
        return view('brands', compact('brands'));

    }
    public function searchBrand(Request $request)
    {
        $searchQuery = trim($request->input('search'));
        $brands = Product_Brand::where('product_brand_name', 'like', "%{$searchQuery}%")
        ->get();

        return view('ajax.brands_search_results')->with('brands', $brands);
    }
    
    // Retrieve brand data and display
    public function show(Product_Brand $id)
    {
        $partials = ['product.partials.update-brand-form', 'product.partials.delete-brand-form'];
        return view('edit', [
            'brand' => $id,
            'partials' => $partials,
    ]);
    }

    // Update the brand's information.
    public function update(BrandUpdateRequest $request, $id): RedirectResponse
    {
        $brand = Product_Brand::findOrFail($id);

        $brand->fill($request->validated());

        $brand->save();

        return Redirect::route('brands.show', ['id' => $id])->with('status', 'brand-updated');
    }

    public function createBrandForm()
    {
        
        $partials = ['product.partials.create-brand-form'];
        
        return view('edit', [
            'partials' => $partials,
        ]);
    }

    public function create(Request $request): RedirectResponse
    {
        $request->validate([
            'product_brand_name' => ['required', 'string', 'max:255'],
        ]);

        $brand = Product_Brand::create([
            'product_brand_name' => $request->product_brand_name,
        ]);

        event(new Registered($brand));

        return redirect(route('product.brands', absolute: false))->with('status', 'brand-added');
    }
    
    /**
     * Delete the brand.
     */
    public function destroy(Request $request, $id): RedirectResponse
    {
        $request->validateWithBag('brandDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $brand = Product_Brand::findOrFail($id);
        
        $brand->delete();
        
        return Redirect::route('product.brands')->with('status', 'brand-deleted');
    }

}
