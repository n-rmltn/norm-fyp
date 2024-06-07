<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductUpdateRequest;
use App\Http\Requests\ProductThumbUpdateRequest;
use App\Models\Product;
use App\Models\Product_Brand;
use App\Models\Product_Category;
use App\Models\Product_Spec;
use App\Models\Compatibility;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProductController extends Controller
{
    // Shows list
    public function dashboard(Request $request)
    {
        $query = Product::where('product_quantity', '<', 6);
        $product = $query->paginate(10);

        return view('dashboard', [
            'product' => $product
        ]);
    }

    public function product(Request $request)
    {
        $query = Product::query();
        $categories = Product_Category::all();

        $product = $query->paginate(10);

        return view('product', [
            'product' => $product,
            'categories' => $categories
        ]);

    }

    public function searchProduct(Request $request)
    {
        $searchQuery = trim($request->input('search'));
        $category = $request->input('category');
        $availability = $request->input('availability');
        $lowStock = $request->input('lowStock');

        $query = Product::query();
        if ($searchQuery) {
            $query->where(function ($q) use ($searchQuery) {
                $q->where('product_name', 'like', "%{$searchQuery}%");
            });
        }

        if ($category) {
            $query->where('product_category_id', $category);
        }

        if ($availability) {
            $query->where('product_availability', true);
        }
        if ($lowStock) {
            $query->where('product_quantity', '<', 6);
        }
        $product = $query->get();

        return view('ajax.product_search_results', compact('product'));
    }

    // Retrieve data and display
    public function show(Product $id)
    {
        $categories = Product_Category::all();
        $brands = Product_Brand::all();
        $specs = Product_Spec::all();
        $partials = ['product.partials.update-product-form', 'product.partials.update-productThumb-form'];
        return view('edit', [
            'product' => $id,
            'partials' => $partials,
            'categories' => $categories,
            'brands' => $brands,
            'specs' => $specs
        ]);
    }

    // Update the compatibility's information.
    public function update(ProductUpdateRequest $request, $id): RedirectResponse
    {
        $product = Product::findOrFail($id);

        $validatedData = $request->validated();

        $categoryRequiresSpec = in_array($validatedData['product_category_id'], [1, 2, 3]);

        if (!$categoryRequiresSpec) {
            $validatedData['product_spec_id'] = null;
        }

        $product->fill($validatedData);

        $product->save();

        return Redirect::route('product.show', ['id' => $id])->with('status', 'product-updated');
    }

    public function updateThumb(ProductThumbUpdateRequest $request, $id): RedirectResponse
    {

        $product = Product::findOrFail($id);

        $request->validated();

        $slug = strtolower($product->product_name);
        $slug = preg_replace('/[^a-z0-9]+/', '-', $slug);
        $slug = trim($slug, '-');

        $filePath = public_path('assets/images/product/' . $product->product_cart_image_name);

        DB::beginTransaction();
        try {
            if (File::exists($filePath)) {
                File::delete($filePath);
            }

            $imageName = $slug . '-cart.' . $request->file('product_cart_image_name')->extension();
            $request->file('product_cart_image_name')->move(public_path('assets/images/product'), $imageName);

            $product->fill([
                'product_cart_image_name' => $imageName
            ]);

            $product->save();

            DB::commit();

            return Redirect::route('product.show', ['id' => $id])->with('status', 'productThumb-updated');
        } catch (\Exception $e) {
            DB::rollBack();
            return Redirect::back()->with('error', 'There was an error updating the product thumbnail.');
        }
    }

    public function createProductForm()
    {
        $categories = Product_Category::all();
        $brands = Product_Brand::all();
        $specs = Product_Spec::all();
        $partials = ['product.partials.create-product-form'];
        return view('edit', [
            'partials' => $partials,
            'categories' => $categories,
            'brands' => $brands,
            'specs' => $specs
        ]);
    }

    public function create(ProductUpdateRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        $categoryRequiresSpec = in_array($validatedData['product_category_id'], [1, 2, 3]);

        if (!$categoryRequiresSpec) {
            $validatedData['product_spec_id'] = null;
        }

        $product = new Product();
        $product->fill($validatedData);
        $product->save();

        return Redirect::route('product.show', ['id' => $product->id])->with('status', 'product-created');
    }

    /**
     * Delete the compatibility.
     */
    // public function destroy(Request $request, $id): RedirectResponse
    // {
    //     $request->validateWithBag('compatibilityDeletion', [
    //         'password' => ['required', 'current_password'],
    //     ]);

    //     $compatibility = Compatibility::findOrFail($id);

    //     $compatibility->delete();

    //     return Redirect::route('product.compatibility')->with('status', 'compatibility-deleted');
    // }
    public function index()
    {
        $comparison = Cookie::get('comparison_list');
        if ($comparison) {
            $comparisonList = json_decode($comparison, true);
        } else {
            $comparisonList = [];
        }
        return response()->json($comparisonList);
    }
    public function store(Request $request, $id)
    {

        $product = Product::find($id);
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        // Retrieve comparison list from cookie
        $comparison_data = Cookie::get('comparison_list') ? json_decode(stripslashes(Cookie::get('comparison_list')), true) : [];

        // Check if the product already exists in the comparison list
        foreach ($comparison_data as $item) {
            if ($item['id'] == $product->id) {
                return response()->json(['error' => 'Product already exists in comparison list'], 422);
            }
        }

        // Check if the limit (3 items) has been reached
        if (count($comparison_data) >= 3) {
            return response()->json(['error' => 'You can only compare up to 3 items'], 422);
        }

        // Prepare comparison item data
        $comparison_item = [
            'id' => $product->id,
            'name' => $product->product_name,
            'category' => $product->product_category_id,
            'category_name' => $product->category->product_category_name,
            'spec' => $product->product_spec_id,
            'spec_name' => $product->spec->product_spec_name,
            'image' => $product->product_cart_image_name,
        ];

        // Add the product to the comparison list
        $comparison_data[] = $comparison_item;

        // Encode the comparison data and store it in the cookie
        $item_data = json_encode($comparison_data);
        $minutes = 1440; // 24 hours
        Cookie::queue(Cookie::make('comparison_list', $item_data, $minutes));

        return response()->json(['success' => 'Product added to comparison list']);
    }

    public function destroy($id)
    {
        $comparison = Cookie::get('comparison_list');
        if ($comparison) {
            $comparisonList = json_decode($comparison, true);
            foreach ($comparisonList as $key => $item) {
                if ($item['id'] == $id) {
                    unset($comparisonList[$key]);
                    // Reindex array if needed
                    $comparisonList = array_values($comparisonList);
                    Cookie::queue(Cookie::make('comparison_list', json_encode($comparisonList), 1440));
                    return response()->json(['message' => 'Product removed from comparison list']);
                }
            }
            // If the item with the given ID is not found
            return response()->json(['message' => 'Product not found in comparison list'], 404);
        }
        // If comparison list cookie does not exist
        return response()->json(['message' => 'Comparison list is empty'], 404);
    }

    public function checkCompatibility(Request $request)
    {
        $comparisonItems = $request->input('comparison');

        if (empty($comparisonItems)) {
            return response()->json([
                'message' => 'No items in the cart to check compatibility'
            ], 400);
        }

        $specs = Product::whereIn('id', $comparisonItems)->with('spec')->get()->pluck('spec');

        $incompatibleSpecId = null;
        $incompatibleSpecName = null;

        // Check compatibility for each combination of specs
        for ($i = 0; $i < count($specs); $i++) {
            for ($j = $i + 1; $j < count($specs); $j++) {
                $spec1 = $specs[$i];
                $spec2 = $specs[$j];

                // Check compatibility for each pair in the combination
                $compatibility = Compatibility::where(function ($query) use ($spec1, $spec2) {
                    $query->where(function ($q) use ($spec1) {
                        $q->where('motherboard', $spec1->id)
                            ->orWhere('cpu', $spec1->id)
                            ->orWhere('ram', $spec1->id);
                    })->where(function ($q) use ($spec2) {
                        $q->where('motherboard', $spec2->id)
                            ->orWhere('cpu', $spec2->id)
                            ->orWhere('ram', $spec2->id);
                    });
                })->exists();

                if (!$compatibility) {
                    $incompatibleSpecId = $spec2->id; // The second spec in the pair is incompatible
                    break 2; // Exit both loops once the first incompatibility is found
                }
            }
        }

        if (!is_null($incompatibleSpecId)) {
            $incompatibleSpecName = Product_Spec::where('id', $incompatibleSpecId)->value('product_spec_name');
        }

        if (is_null($incompatibleSpecName)) {
            return response()->json(['message' => 'All items in the cart are compatible']);
        } else {
            return response()->json([
                'message' => 'Some items in the cart are not compatible',
                'incompatible_spec_name' => $incompatibleSpecName
            ], 400);
        }
    }

    public function checkLowStock(Request $request)
    {
        try {
            // Fetch low stock products
            $lowStockProducts = Product::where('product_quantity', '<', 6)->select('id', 'product_name', 'product_cart_image_name', 'updated_at')->get();

            // Retrieve dismissed notifications from cookie
            $dismissedNotifications = json_decode($request->cookie('dismissedNotifications', '[]'));

            // Filter out dismissed notifications
            $lowStockProducts = $lowStockProducts->reject(function ($product) use ($dismissedNotifications) {
                return in_array($product->id, $dismissedNotifications);
            });

            // Return JSON response
            return response()->json($lowStockProducts);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function dismissNotifications(Request $request)
    {
        try {
            // Get dismissed notification IDs
            $dismissedNotifications = $request->input('dismissedNotifications', []);

            // Store dismissed notification IDs in cookie
            return response()->json(['success' => true])->cookie('dismissedNotifications', json_encode($dismissedNotifications), 60);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
