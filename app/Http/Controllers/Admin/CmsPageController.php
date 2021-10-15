<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CmsPage;
use Illuminate\Support\Facades\Session;
class CmsPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cmsPages()
    {
        Session::put('page', 'cms_pages');
        $data['title'] = "Page";
        $data['cms_pages'] = CmsPage::get();
        return view('admin.pages.cms.cms_pages', $data);
    }
    public function addEditPage(Request $request, $id = null)
    {
        if ($id == "") {
            // Add CmsPage Code
            $cms = new CmsPage();
            $title = "Add Page";
            $buttonText = "Save";
            $message = "Page has been saved successfully!";
        } else {
            // Update cms
            $cms = CmsPage::findOrFail($id);
            $title = "Edit Page";
            $buttonText = "Update";
            $message = "Page has been updated successfully!";
        }
        //exit();
        if ($request->isMethod('POST')) {
            $data = $request->all();
            //echo '<pre>'; print_r($data); die;
            $rules = [
                'title' => 'required',
                'meta_title' => 'required',
                'meta_description' => 'required',
                'description' => 'required'
            ];
            //Validation message
            $customMessage = [
                'title.required' => 'Page name is required',
                'meta_title.required' => 'Meta title is required',
                'meta_description.required' => 'Meta description is required',
                'description.required' => 'Description is required'
            ];
            $this->validate($request, $rules, $customMessage);
            $cms->title = $data['title'];
            $cms->meta_title = $data['meta_title'];
            $cms->meta_description = $data['meta_description'];
            $cms->description = $data['description'];
            $cms->status = 1;
            $cms->save();
            return redirect()->route('sadmin.cms-pages')->with('success', $message);
        }
        return view('admin.pages.cms.addEditPage', compact(
            'title',
            'message',
            'buttonText','cms'
        ));
    }
    public function updatePageStatus(Request $request)
    {
        //dd($request);
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            CmsPage::where('id', $data['page_id'])->update(['status' => $status]);
            return  response()->json(['status' => $status, 'page_id' => $data['page_id']]);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CmsPage  $CmsPage
     * @return \Illuminate\Http\Response
     */
    public function deleteCmsPage($id)
    {
        try {
            $cms = CmsPage::findOrFail($id);
            if (!is_null($cms)) {
                $cms->delete();
                return response()->json(['success' => 'Page Deleted successfully!!']);
            }
        } catch (\Throwable $th) {
            //dd($th);
            return response()->json(['success' => 'Page Not Deleted!!']);
        }
    }
}
