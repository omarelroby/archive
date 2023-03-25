<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories=Category::all();
        return view('dashboard.categories.index',compact('categories'));
    }
    public function create()
    {
        return view('dashboard.categories.create');
    }
    public function store(Request $request){
      try {
          $rules = ['category_name' => 'required|unique',
              'photo' => 'required|mimes:jpg,png,jpeg,webp'];
          $messages = ['category_name.required' => 'must enter category name',
              'photo.required' => 'must enter product photo'];
          $validation = validator()->make($rules, $messages, $request->all());
          if (!$validation) {
              return $validation->errors()->first();
          }

          if ($request->has('photo')) {
              $file_extension = $request->photo->getClientOriginalExtension();
              $file_name = time() . '.' . $file_extension;
              $path = 'images/categories';
          }
          $category = Category::create([
              'category_name' => $request->category_name,
              'photo' => $request->photo->move($path, $file_name)

          ]);
          $category->save();
          return redirect()->route('show.categories')->with(['success' => 'تمت الإضافة بنجاح']);
      }
      catch (\Exception $e){
          return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
      }

    }
    public function edit($id){
        $category=Category::find($id);
        return view('dashboard.categories.edit',compact('category'));
    }
    public function update($id,Request $request){
        try {
            $category = Category::find($id);
            $rules = ['category_name' => 'required|unique',
                'photo' => 'required|mimes:jpg,png,jpeg,webp'];
            $messages = ['category_name.required' => 'must enter category name',
                'photo.required' => 'must enter product photo'];
            if (!$category) {
                return redirect()->back()->with(['error' => 'ليست موجودة']);
            }
            $validation = validator()->make($rules, $messages, $request->all());
            if (!$validation) {
                return redirect()->back()->withErrors()->first();
            }
            if ($request->has('photo')) {
                $file_extension = $request->photo->getClientOriginalExtension();
                $file_name = time() . '.' . $file_extension;
                $path = 'images/categories';
            }
            $category->update([
                'category_name' => $request->name,
                'photo' => $request->photo->move($path, $file_name)
            ]);
            return redirect()->route('show.categories')->with(['success' => 'تم تحديث البيانات بنجاح']);
        }
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }
    }
    public function destroy($id){
        $category=Category::find($id);
        if(!$category){
            return redirect()->back()->with(['error'=>'هذا القسم غير موجود']);
        }
        $category->delete();
        return redirect()->route('show.categories')->with(['error'=>'تم حذف القسم بنجاح']);
    }


}
