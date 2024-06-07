<?php

namespace App\Http\Controllers;

use App\Http\Requests\SpecUpdateRequest;
use App\Models\Product_Category;
use App\Models\Product_Spec;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class SpecController extends Controller
{
    // Shows spec list
    public function product_spec(Request $request)
    {
        $query = Product_Spec::with('category'); // Eager load the category relationship

        if ($request->has('searchSpec')) {
            $search = $request->input('search');

            $query->where(function ($q) use ($search) {
                $q->where('product_spec_name', 'like', '%' . $search . '%')
                    ->orWhereHas('category', function ($q) use ($search) {
                        $q->where('product_category_name', 'like', '%' . $search . '%');
                    });
            });
        }

        $spec = $query->paginate(10);

        return view('spec', compact('spec'));
    }

    public function searchSpec(Request $request)
    {
        $searchQuery = trim($request->input('search'));
        $spec = Product_Spec::where('product_spec_name', 'like', "%{$searchQuery}%")
            ->orWhereHas('category', function ($query) use ($searchQuery) {
                $query->where('product_category_name', 'like', "%{$searchQuery}%");
            })
            ->get();

        return view('ajax.spec_search_results', compact('spec'));
    }

    // Retrieve spec data and display
    public function show(Product_Spec $id)
    {
        $categories = Product_Category::all();
        $partials = ['product.partials.update-spec-form', 'product.partials.delete-spec-form'];
        return view('edit', [
            'spec' => $id,
            'partials' => $partials,
            'categories' => $categories
        ]);
    }

    // Update the spec's information.
    public function update(SpecUpdateRequest $request, $id): RedirectResponse
    {
        $spec = Product_Spec::findOrFail($id);

        $spec->fill($request->validated());

        $spec->save();

        return Redirect::route('spec.show', ['id' => $id])->with('status', 'spec-updated');
    }

    public function createSpecForm()
    {
        $categories = Product_Category::all();
        $partials = ['product.partials.create-spec-form'];

        return view('edit', [
            'partials' => $partials,
            'categories' => $categories,
        ]);
    }

    public function create(Request $request): RedirectResponse
    {
        $request->validate([
            'product_spec_cat' => ['required', 'string', 'max:255'],
            'product_spec_name' => ['required', 'string', 'max:255'],
        ]);

        $spec = Product_Spec::create([
            'product_spec_cat' => $request->product_spec_cat,
            'product_spec_name' => $request->product_spec_name,
        ]);

        event(new Registered($spec));

        return redirect(route('product.spec', absolute: false))->with('status', 'spec-added');
    }

    /**
     * Delete the spec.
     */
    public function destroy(Request $request, $id): RedirectResponse
    {
        $request->validateWithBag('specDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $spec = Product_Spec::findOrFail($id);

        $spec->delete();

        return Redirect::route('product.spec')->with('status', 'spec-deleted');
    }

}
