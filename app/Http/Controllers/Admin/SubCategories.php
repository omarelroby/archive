<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategories extends Controller
{
    public function index()
    {
        $subCat = SubCategory::all();
        return view('ajax-sub-categories.index', compact('subCat'));
    }

    public function all()
    {
        $subCat = SubCategory::all();
        return view('ajax-sub-categories.index', compact('subCat'));
    }

    public function create()
    {
        return view('ajax-sub-categories.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'subCategory_name' => 'required|unique',
            'photo' => 'required|mimes:jpg,png,jpeg,webp'];
        $messages = [
            'subCategory_name.required' => 'must enter category name',
            'photo.required' => 'must enter product photo'];

        $validation = validator()->make($rules, $messages, $request->all());
        if (!$validation) {
            return $validation->errors()->first();
        }

        if ($request->has('photo')) {
            $file_extension = $request->photo->getClientOriginalExtension();
            $file_name = time() . '.' . $file_extension;
            $path = 'images/subcategory';
        }
        $subcat = SubCategory::create([
            'subCategory_name' => $request->subCategory_name,
            'subCategory_types' => $request->subCategory_types,
            'photo' => $request->photo->move($path, $file_name)

        ]);
        if ($subcat) {
            return response()->json([
                'status' => true,
                'msg' => 'تم الحفظ بنجاح',
                'data' => $request->id
            ]);
        } else {
            return response()->json([
                'status' => false,
                'msg' => 'فشل الحفظ',
            ]);
        }


    }

    public function delete(Request $request)
    {
        $category = SubCategory::find($request->id);
        if (!$category)
            return redirect()->back()->with(['error' => __('messages.offer not exist')]);
        $category->delete();
        return response()->json([
            'status' => true,
            'msg' => 'تم الحذف بنجاح',
            'id' => $request->id
        ]);

    }

    public function edit(Request $request)
    {
        $sub_cat = SubCategory::find($request->id);
        if (!$sub_cat) {
            return response()->json([
                'status' => false,
                'msg' => 'هذا القسم غير موجود',
            ]);
        }
        return view('ajax-sub-categories.edit', compact('sub_cat'));

    }

    public function update(Request $request)
    {
        $subcat = SubCategory::find($request->sub_cat_id);
        if (!$subcat) {
            return response()->json([
                'status' => false,
                'msg' => 'هذا القسم غير موجود',
            ]);}
        if ($request->has('photo')) {
            $file_extension=$request->photo->getClientOriginalExtension();
            $file_name=time().'.'.$file_extension;
            $path='images/categories';
        }
            $subcat->update([
                $request->all(),
                'photo'=>$request->photo->move($path,$file_name)]);
            return response()->json([
                'status' => true,
                'msg' => 'تم التحديث بنجاح',
            ]);



    }
}
