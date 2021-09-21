<?php
namespace App\Http\Controllers\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function users()
    {
        $data['title'] = "Users";
        $data['users'] = User::orderBy('id', 'DESC')->get();
        //dd($data['users']);
        return view('admin.pages.user.users', $data);
    }
    public function update_user_status(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            User::where('id', $data['user_id'])->update(['status' => $status]);
            return  response()->json(['status' => $status, 'user_id' => $data['user_id']]);
        }
    }
}
