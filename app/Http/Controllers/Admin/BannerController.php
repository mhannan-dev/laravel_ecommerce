<?php
namespace App\Http\Controllers\Admin;
use Carbon\Carbon;
use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function banners()
    {
        $data['title'] = "Banner";
        $data['banners'] = Banner::get();
        return view('admin.pages.banner.index', $data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title']      = "New Banner";
        $data['banner_data']   = new Banner();
        return view("admin.pages.banner.add", $data);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Banner $banner)
    {
        try {
            $image = $request->file('banner_image');
            if (isset($image)) {
                $imageName  = time() . '.' . $image->getClientOriginalExtension();
                if (!Storage::disk('public')->exists('banner')) {
                    Storage::disk('public')->makeDirectory('banner');
                }
                $bannerImage = Image::make($image)->resize(1170, 480)->save(storage_path('banner'));
                Storage::disk('public')->put('banner/'. $imageName, $bannerImage);
            } else {
                $imageName = "default.png";
            }
            $bannerFillable           = $request->only($banner->getFillable());
            $bannerFillable['banner_image']  = $imageName;
            $banner->fill($bannerFillable)->save();
            return redirect()->to('sadmin/banners')->with('success','Banner has been saved successfully!');
        } catch (\Throwable $th) {
            //dd($th);
            return redirect()->back()->with('success','Banner has been saved successfully!');
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['title'] = "Edit";
        $banner_data = Banner::find($id);
        $data['banner_data'] = json_decode(json_encode($banner_data), true);
        return view('admin.pages.banner.edit', $data);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner)
    {
        try {
            $image = $request->file('banner_image');
            if (isset($image)) {
                $imageName  = time() . '.' . $image->getClientOriginalExtension();
                if (!Storage::disk('public')->exists('banner')) {
                    Storage::disk('public')->makeDirectory('banner');
                }
                //Delelte existiing image
                if (Storage::disk('public')->exists('banner/'.$banner->banner_image)){
                    Storage::disk('public')->delete('banner/'.$banner->banner_image);
                }
                //Saving image
                $bannerImage = Image::make($image)->resize(1170, 480)->save(storage_path('banner'));
                Storage::disk('public')->put('banner/'. $imageName, $bannerImage);
            } else {
                //If someone update without changing image
                $imageName = $banner->banner_image;
            }
            $bannerFillable           = $request->only($banner->getFillable());
            $bannerFillable['banner_image']  = $imageName;
            $banner->fill($bannerFillable)->save();
            return redirect()->to('sadmin/banners')->with('success','Banner has been updated successfully!');
        } catch (\Throwable $th) {
            //dd($th);
            return redirect()->back()->with('warning','Banner not updated successfully!');
        }
    }
    public function update_banner_status(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            Banner::where('id', $data['banner_id'])->update(['status' => $status]);
            return  response()->json(['status' => $status, 'banner_id' => $data['banner_id']]);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $banner = Banner::findOrFail($id);
            $image_path  = public_path('/storage/banner/') . $banner->banner_image;
            if (!is_null($banner)) {
                $banner->delete();
                unlink($image_path);
                return redirect()->to('sadmin/banners')->with('warning','Your banner has been deleted!');
            }
        } catch (\Throwable $th) {
           // dd($th);
            return redirect()->back()->with('success','Your banner not deleted!');
        }
    }
}
