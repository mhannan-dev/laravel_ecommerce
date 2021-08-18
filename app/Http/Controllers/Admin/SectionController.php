<?php
namespace App\Http\Controllers\Admin;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SectionRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sections()
    {
        Session::put('page', 'sections');
        $data['title'] = "Section";
        $sections = Section::orderBy('created_at', 'desc')->get();
        $data['sections'] = json_decode(json_encode($sections), true);
        return view('admin.pages.section.sections', $data);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function update_section_status(Request $request)
    {
            if ($request->ajax()) {
                $data = $request->all();
                //dd($data);
                if ($data['status'] == "Active") {
                    $status = 0;
                } else {
                    $status = 1;
                }
                Section::where('id', $data['section_id'])->update(['status'=> $status]);
                return  response()->json(['status' => $status, 'section_id'=>$data['section_id']]);
            }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $data['title']      = "Section";
        $data['section']   = new Section();
        return view("admin.pages.section.add", $data);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SectionRequest $request, Section $section)
    {
        try {
            $sectionFillable        = $request->only($section->getFillable());
            $section->fill($sectionFillable)->save();
            toast('Section has been saved!','success','top-right');
            return Redirect::to('sadmin/sections');
        } catch (\Throwable $th) {
            toast('Section has not been saved!','success','top-right');
            return redirect()->route('section.index');
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['title'] = "Update";
        $data['section'] = Section::find($id);
        if (!is_null($data['section'])) {
            return view('admin.pages.section.edit', $data);
        } else {
            return redirect()->route('admin.pages.section.index');
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Section $section)
    {
        try {
            $sectionFillable = $request->only($section->getFillable());
            $section->fill($sectionFillable)->update();
            toast('Your section has been updated!','success','top-right');
            //return redirect()->url('sadmin/sections');
            return Redirect::to('sadmin/sections');
        } catch (\Throwable $th) {
            dd($th);
            toast('Section has not been updated!','success','top-right');
            return redirect()->back();
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Section $section)
    {
        try {
            $section->delete();
            toast('Your section has been deleted.','success','top-right');
            return redirect()->back();
        } catch (\Throwable $th) {
            return redirect()->back();
        }
    }
}
