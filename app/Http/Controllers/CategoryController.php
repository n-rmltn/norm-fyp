<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Product_Category;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CategoryController extends Controller
{
    // Shows category list
    public function product_category(Request $request)
    {
        $query = Product_Category::query();

        if ($request->has('searchCategory')) {
            $query->where('product_category_name', 'like', '%' . $request->input('searchCategory') . '%');
        }

        $category = $query->paginate(10);

        return view('category', compact('category'));
    }

    public function searchCategory(Request $request)
    {
        $searchQuery = trim($request->input('search'));
        $categories = Product_Category::where('product_category_name', 'like', "%{$searchQuery}%")
        ->get();

        return view('ajax.category_search_results')->with('categories', $categories);
    }
    
    // Retrieve category data and display
    public function show(Product_Category $id)
    {
        $partials = ['product.partials.update-category-form', 'product.partials.delete-category-form'];
        return view('edit', [
            'category' => $id,
            'partials' => $partials,
    ]);
    }

    // Update the category's information.
    public function update(CategoryUpdateRequest $request, $id): RedirectResponse
    {
        $category = Product_Category::findOrFail($id);

        $category->fill($request->validated());

        $category->save();

        return Redirect::route('category.show', ['id' => $id])->with('status', 'category-updated');
    }

    public function createCategoryForm()
    {
        
        $partials = ['product.partials.create-category-form'];
        
        return view('edit', [
            'partials' => $partials,
        ]);
    }
    
    public function create(Request $request): RedirectResponse
    {
        $request->validate([
            'product_category_name' => ['required', 'string', 'max:255'],
        ]);

        $category = Product_Category::create([
            'product_category_name' => $request->product_category_name,
        ]);

        event(new Registered($category));

        return redirect(route('product.category', absolute: false))->with('status', 'category-added');
    }
    
    /**
     * Delete the category.
     */
    public function destroy(Request $request, $id): RedirectResponse
    {
        $request->validateWithBag('categoryDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $category = Product_Category::findOrFail($id);
        
        $category->delete();
        
        return Redirect::route('product.category')->with('status', 'category-deleted');
    }

}
