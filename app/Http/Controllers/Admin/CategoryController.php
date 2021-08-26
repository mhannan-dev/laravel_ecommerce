<?php
namespace App\Http\Controllers\Admin;
use App\Models\Section;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\Admin\CategoryRequest;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function categories()
    {
        Session::put('page', 'categories');
        $data['title'] = "Category";
        $data['categories'] = Category::with(['section', 'parent_category'])->get();
        return view('admin.pages.category.categories', $data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title']      = "Category";
        $data['category']   = new Category();
        $data['getSection']   = Section::select('id', 'title')->get();
        return view("admin.pages.category.add", $data);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function update_category_status(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            Category::where('id', $data['category_id'])->update(['status' => $status]);
            return  response()->json(['status' => $status, 'category_id' => $data['category_id']]);
        }
    }
    public function append_category_level(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $getCategories = Category::with('subcategories')->where(['section_id' => $data['section_id'], 'parent_id' => 0, 'status' => 1])->get();
            $data['getCategories'] = json_decode(json_encode($getCategories), true);
            return view('admin.pages.category._append', $data);
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request, Category $category)
    {
        try {
            $image = $request->file('image');
            if (isset($image)) {
                $imageName  = time() . '.' . $image->getClientOriginalExtension();
                if (!Storage::disk('public')->exists('category')) {
                    Storage::disk('public')->makeDirectory('category');
                }
                $categoryImage = Image::make($image)->resize(200, 200)->save(storage_path('category'));
                Storage::disk('public')->put('category/'. $imageName, $categoryImage);
            } else {
                $imageName = "default.png";
            }
            $categoryFillable           = $request->only($category->getFillable());
            $categoryFillable['image']  = $imageName;
            $category->fill($categoryFillable)->save();
            return Redirect::to('sadmin/categories')->with('success','Category has been saved successfully!!');
        } catch (\Throwable $th) {
            //dd($th);
            return redirect()->back()->with('success','Category has been saved successfully!!');
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = "Edit";
        $category_data = Category::where('id', $id)->first();
        $category_data = json_decode(json_encode($category_data), true);
        $getCategories = Category::with('subcategories')->where(['parent_id' => 0, 'section_id' => $category_data['section_id']])->get();
        $getCategories = json_decode(json_encode($getCategories), true);
        $getSection = Section::select('id', 'title')->get();
        $category = Category::find($id);
        //dd($category);
        return view('admin.pages.category.edit', compact('title', 'category_data', 'getCategories', 'getSection', 'category'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        try {
            $image = $request->file('image');
            if (isset($image)) {
                $imageName  = time() . '.' . $image->getClientOriginalExtension();
                if (!Storage::disk('public')->exists('category')) {
                    Storage::disk('public')->makeDirectory('category');
                }
                //Delelte existiing image
                if (Storage::disk('public')->exists('category/'.$category->image)){
                    Storage::disk('public')->delete('category/'.$category->image);
                }
                //Saving image
                $categoryImage = Image::make($image)->resize(200, 200)->save(storage_path('category'));
                Storage::disk('public')->put('category/'. $imageName, $categoryImage);
            } else {
                //If someone update without changing image
                $imageName = $category->image;
            }
            $categoryFillable           = $request->only($category->getFillable());
            $categoryFillable['image']  = $imageName;
            $category->fill($categoryFillable)->save();
            //return Redirect::to('sadmin/categories');
            return redirect()->route('sadmin.categories')->with('success','Category has been updated successfully!!');
            
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->back()->with('error','Category not updated successfully!!');
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $category = Category::findOrFail($id);
            $image_path  = public_path('/storage/category/') . $category->image;
            if (!is_null($category)) {
                $category->delete();
                unlink($image_path);
                return Redirect::to('sadmin/categories')->with('success','Your category has been deleted!!');
            }
        } catch (\Throwable $th) {
            //dd($th);
            return redirect()->back()->with('success','Your category not deleted!!');
        }
    }
}
