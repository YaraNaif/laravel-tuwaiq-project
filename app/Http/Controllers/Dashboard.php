<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductDetails;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;  
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;



class Dashboard extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //logut 
    public function logout(Request $request)
{
    Auth::logout();

    return redirect('/login');
}


    public function index(Request $request)
{
    // Set session variable
    Session::put('data', 'Welcome To Tuwiaq this is Session');
     Cookie::queue('A','Here my cookie',60);
    // Fetch the currently logged-in user's email address
    $userEmail = $request->user()->email;
     
    // Pass the session data and user email to the view
    return view('dashboard.index', ['data' => Session::get('data'), 'userEmail' => $userEmail]);
}



    public function CreateProducts(Request $request)
{
    $validator = Validator::make($request->all(), [
        'ProductName' => 'required|alpha|max:255',
    ], [
        'ProductName.alpha' => 'The product name must be a string of alphabetic characters.',
    ]);

    if ($validator->fails()) {
        //inside the model in 
       return redirect()->back()->withErrors($validator)->withInput()->withInput();
        //outside the model in index
       // return redirect()->route('index')->withErrors($validator)->withInput();

    }

    $product = new Product();
    $product->ProductName = $request->ProductName; // Update field name
    
    $product->save();
    
    return redirect()->route('products'); // Redirect to the page where products are displayed
}

// red only 
/*public function GetProducts()
    {
        $products = Product::all();
        return view('dashboard.products', compact('products'));
    }*/


    //search only for a product by its name 
    /*public function searchProducts(Request $request)
    {
        $searchTerm = $request->input('searchTerm');
        $products = Product::where('ProductName', 'like', '%' . $searchTerm . '%')->get();
        return view('dashboard.products', compact('products'));
    }*/


// GetProducts read and search in one function for Products
public function GetProducts(Request $request) 
{
    $searchTerm = $request->input('searchTerm'); // retrieves the 'searchTerm' from the request data.
    $searchPerformed = false; // Initialize $searchPerformed
    if ($searchTerm) { // checks if the search term exists.
        // If the search term exists, retrieves the product name is like the search term. The '%' symbols are wildcards that match any number of characters.
        $products = Product::where('ProductName', 'like', '%' . $searchTerm . '%')->get(); 

        if ($products->isEmpty()) {
            // display a alert message  saying that there were no results for the search term
         $searchPerformed = true; // If no products match the search term,set $searchPerformed to true.
        }
    } else {
        // if no search term was provided at all , all products are retrieved
        $products = Product::all();
    }
    // Pass $searchPerformed to the view along with $products
    return view('dashboard.products', compact('products')); 
}


    //show all product
    public function allProducts()
{
    $products = Product::all();
    return view('dashboard.products', compact('products'));
}

  
    
public function editProduct(Request $request, $id)
{
    $product = Product::find($id);
    $product->ProductName = $request->input('ProductName');
    $product->save();
    return redirect('/dashboard/getproducts');
}


public function showEditProductForm($id)
{
    $product = Product::find($id);
    $product->save();
    return view('dashboard.editProduct', compact('product'));
}

    
    public function deleteProduct($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect('/dashboard/getproducts');
    }



    public function createProductDetails(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product' => 'required',
            'qty' => 'required|numeric',
            'price' => 'required|numeric',
            'color' => 'required|string|max:50',
            'description' => 'required|string|max:255',
        ]);
    
        if ($validator->fails()) {
            //inside the model in create Product Details
            return redirect()->back()->withErrors($validator)->withInput()->withInput();
            //outside the model in index 
            //return redirect()->route('index')->withErrors($validator)->withInput();

        }
    
        // Create a new ProductDetails record
        $productDetails = ProductDetails::create([
            'product_id' => $request->product,
            'qty' => $request->qty,
            'price' => $request->price,
            'color' => $request->color,
            'description' => $request->description,
        ]);
    
        $productDetails->save();
    
        return redirect('/dashboard/getProductDetails');
    }
    


public function getProductDetails()
{
    $productDetails = ProductDetails::all(); // Fetch all product details
    $products = Product::all(); // Fetch all products

    return view('dashboard.productDetails', ['productDetails' => $productDetails, 'products' => $products]);
}






public function editProductDetails(Request $request, $id)
{
    $productDetails = ProductDetails::where('product_id', $id)->first();
    if ($productDetails) {
        $productDetails->color = $request->input('color');
        $productDetails->price = $request->input('price');
        $productDetails->qty = $request->input('qty');
        $productDetails->description = $request->input('description');
        $productDetails->save();
    } else {
        // Handle the case where no matching product detail was found
    }
    return redirect('/dashboard/getProductDetails');
}


public function showEditDetailsProductForm($id)
{
    $productDetails = ProductDetails::find($id);
    return view('/dashboard/editproductDetails', compact('productDetails'));
}

//language
public function setLocale($locale)
{
    if (! in_array($locale, ['en', 'ar'])) {
        $locale = 'en';
    }

    Session::put('locale', $locale);

    return redirect()->back();
}





//public function test()
//{
 //$data = DB::select('select * from products');
    //$data = DB::table('products')->get(); // Fetch all data from the 'products' table
    //return response()->json($data);
    //output ProductName	"iPhone 14"
//}

// with 2  table 
public function test()
{
    $data = DB::table('products')
                ->join('product_details', 'products.id', '=', 'product_details.product_id')
                ->get();

    return response()->json($data);
}
}


