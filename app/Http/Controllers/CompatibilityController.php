<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompatibilityUpdateRequest;
use App\Models\Product_Spec;
use App\Models\Compatibility;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CompatibilityController extends Controller
{
    // Shows compatibility list
    public function product_compatibility(Request $request)
    {
        $query = Compatibility::query();
    
        $compatibility = $query->paginate(10);
    
        return view('compatibility', compact('compatibility'));

    }

    public function searchCompatibility(Request $request)
    {
        $searchQuery = trim($request->input('search'));
        
        $compatibility = Compatibility::whereHas('motherboardSpec', function($query) use ($searchQuery) {
            $query->where('product_spec_name', 'like', "%{$searchQuery}%");
        })
        ->orWhereHas('cpuSpec', function($query) use ($searchQuery) {
            $query->where('product_spec_name', 'like', "%{$searchQuery}%");
        })
        ->orWhereHas('ramSpec', function($query) use ($searchQuery) {
            $query->where('product_spec_name', 'like', "%{$searchQuery}%");
        })
        ->get();

        return view('ajax.compatibility_search_results')->with('compatibility', $compatibility);
    }
    
    // Retrieve compatibility data and display
    public function show(Compatibility $id)
    {
        $cpu = Product_Spec::where('product_spec_cat', 1)->get();
        $mobo = Product_Spec::where('product_spec_cat', 2)->get();
        $ram = Product_Spec::where('product_spec_cat', 3)->get();
        
        $partials = ['product.partials.update-compatibility-form', 'product.partials.delete-compatibility-form'];
        return view('edit', [
            'compatibility' => $id,
            'partials' => $partials,
            'cpu' => $cpu,
            'mobo' => $mobo,
            'ram' => $ram,
    ]);
    }

    // Update the compatibility's information.
    public function update(CompatibilityUpdateRequest $request, $id): RedirectResponse
    {
        $compatibility = Compatibility::findOrFail($id);

        $compatibility->fill($request->validated());

        $compatibility->save();

        return Redirect::route('compatibility.show', ['id' => $id])->with('status', 'compatibility-updated');
    }

    public function createCompatibilityForm()
    {
        $cpu = Product_Spec::where('product_spec_cat', 1)->get();
        $mobo = Product_Spec::where('product_spec_cat', 2)->get();
        $ram = Product_Spec::where('product_spec_cat', 3)->get();

        $partials = ['product.partials.create-compatibility-form'];
        
        return view('edit', [
            'partials' => $partials,
            'cpu' => $cpu,
            'mobo' => $mobo,
            'ram' => $ram,
        ]);
    }

    public function create(Request $request): RedirectResponse
    {
        $request->validate([
            'motherboard' => ['required', 'string', 'max:255'],
            'cpu' => ['required', 'string', 'max:255'],
            'ram' => ['required', 'string', 'max:255'],
        ]);

        $compatibility = Compatibility::create([
            'motherboard' => $request->motherboard,
            'cpu' => $request->cpu,
            'ram' => $request->ram,
        ]);

        event(new Registered($compatibility));

        return redirect(route('product.compatibility', absolute: false))->with('status', 'compatibility-added');
    }
    
    /**
     * Delete the compatibility.
     */
    public function destroy(Request $request, $id): RedirectResponse
    {
        $request->validateWithBag('compatibilityDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $compatibility = Compatibility::findOrFail($id);
        
        $compatibility->delete();
        
        return Redirect::route('product.compatibility')->with('status', 'compatibility-deleted');
    }

}
