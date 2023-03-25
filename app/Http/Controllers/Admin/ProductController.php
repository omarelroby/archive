<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Traits\ImageTrait;
use Dotenv\Validator;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use ImageTrait;
    public function index()
    {
        $products=Product::all();
        return view('dashboard.index',compact('products'));

    }

    public function create()
    {
        return view('dashboard.create');
    }

    public function store(Request $request)
    {
        try {

            $rules = [
                'product_name' => 'required|unique',
                'product_qty' => 'required'];
            $messages = ['product_name.required' => 'must enter product name',
                'product_qty.required' => 'must enter product quantity'];
            $validation = validator()->make($rules, $messages, $request->all());
            if (!$validation) {
                return $validation->errors()->first();
            }
            if ($request->has('photo')) {

                $file_exetension = $request->photo->getClientOriginalExtension();
                $file_name = time() . '.' . $file_exetension;
                $request->photo->move('image/product', $file_name);

            }
            $product = Product::create([
                'product_name' => $request->name,
                'category_id' => $request->category_id,
                'product_qty' => $request->qty,
                'photo' => $file_name
            ]);
            $product->save();
            return redirect()->route('show.products');
        }
    catch (\Exception $e){
        return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
    }
    }
    public function edit($id){
        $product=Product::find($id);
        return view('dashboard.edit',compact('product'));
    }
    public function update($id,Request $request){
        try {


        $product=Product::find($id);
        $rules=[
            'product_name'=>'required|unique',
            'product_qty'=>'required'];
        $messages=['product_name.required'=>'must enter product name',
            'product_qty.required'=>'must enter product quantity' ];
        if(!$product)
        {
            return redirect()->back()->with(['error' => 'ليست موجودة']);
        }
        $validation=Validator()->make($rules,$messages,$request->all());
        if(!$validation){
            return redirect()->back()->withErrors()->first();
        }
        $product->update([
            'product_name'=>$request->name,
            'category_id'=>$request->category_id,
            'product_qty'=>$request->qty
        ]);
        $product->save();
        return redirect()->route('show.products')->with(['success'=>'تم التحديث بنجاح']);
        }
    catch (\Exception $e){
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }
    }
    public function destroy($id){
        $product=Product::find($id);
        if(!$product){
            return redirect()->back()->with(['error'=>'هذا القسم غير موجود']);
        }
        $product->delete();
        return redirect()->route('show.products')->with(['error'=>'تم حذف القسم بنجاح']);


    }

}
