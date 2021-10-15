<?php
namespace App\Http\Controllers\Frontend;
use App\Models\CmsPage;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
class PageController extends Controller
{
	public function cms_page(Request $request)
	{
        $currentRoute = url()->current();
        $currentRoute = Str::replace('http://127.0.0.1:8000/', '', $currentRoute);

        $cmsRoutes = CmsPage::where('status',1)->get()->pluck('slug')->toArray();

        if(in_array($currentRoute, $cmsRoutes)){
            $cmsPageDetails =CmsPage::where('slug',$currentRoute)->first()->toArray();
            //dd($cmsPageDetails);
            return view('frontend.pages.cms.cms_page', compact('cmsPageDetails'));
        }else{
            abort(404);
        }
	}
}
