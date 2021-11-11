<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Intervention\Image\ImageManagerStatic as Image;

class AdminController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        Session::put('page', 'dashboard');
        $data['title'] = "Dashboard";
        return view('admin.pages.settings.dashboard', $data);
    }
    /**
     * Check_current_password and settings
     *
     */
    public function settings()
    {
        Session::put('page', 'settings');
        $data['title'] = "Upate password";
        $data['adminDetails'] = Admin::where('email', Auth::guard('admin')->user()->email)->first();
        return view('admin.pages.settings.settings', $data);
    }
    /**
     * Admin Form
     *
     */
    public function showLoginForm()
    {
        return view('admin.pages.settings.admin_login');
    }
    /**
     * Admin login
     *
     */
    public function login(Request $request)
    {
        if ($request->isMethod('POST')) {
            $data = $request->all();
            //Validation rules
            $rules = [
                'email' => 'required',
                'password' => 'required'
            ];
            //Validation message
            $customMessage = [
                'email.required' => 'Email is required',
                'email.email' => 'Valid Email is required',
                'password.required' => 'Password is required'
            ];
            $this->validate($request, $rules, $customMessage);
            if (Auth::guard('admin')->attempt(['email' => $data['email'], 'status' => 1, 'password' => $data['password']])) {
                //toast('Successfully logged in !','success');
                return redirect('sadmin/dashboard')->with('success', 'Login Successfully!');
            } else {
                return back()->with('error', 'Username or password is wrong');
            }
        }
        return view('admin.pages.settings.admin_login');
    }
    /**
     * Admin logout
     *
     */
    public function logout()
    {
        Auth::guard('admin')->logout();
        //return view('admin.pages.settings.admin_login');
        return redirect('/');
    }
    /**
     * Check_current_password
     *
     */
    public function check_current_pwd(Request $request)
    {
        $data = $request->all();
        if (Hash::check($data['current_password'], Auth::guard('admin')->user()->password)) {
            echo "true";
        } else {
            echo "false";
        }
    }
    /**
     * Update_current_password
     *
     */
    public function update_current_pwd(Request $request)
    {
        if ($request->isMethod('POST')) {
            $data = $request->all();
            //Check if current password is correct or not
            if (Hash::check($data['current_password'], Auth::guard('admin')->user()->password)) {
                //Check new and confirm password is matching
                if ($data['new_password'] == $data['again_new_password']) {
                    $admin = Admin::find(Auth::guard('admin')->user()->id);
                    $admin->password = bcrypt($request->new_password);
                    $admin->save();
                    return redirect()->back()->with('success', 'Password Changed successfully!');
                } else {
                    return redirect()->back()->with('error', 'New password & confirm password is not same!');
                }
            } else {
                return redirect()->back()->with('error', 'Password not updated!');
            }
            return redirect()->back();
        }
    }
    /**
     * profile_update
     */
    public function profile_update(Request $request)
    {
        Session::put('page', 'profile_update');
        $title = "Profile Update";
        if ($request->isMethod('POST')) {
            $data = $request->all();
            //Upload profile image
            if ($request->hasfile('image')) {
                $image = $request->file('image');
                if ($image->isValid()) {
                    $imageName  = time() . '.' . $image->getClientOriginalExtension();
                    $admin_image_path = 'uploads/admin_photos/' . $imageName;
                    Image::make($image)->resize(100, 100)->save($admin_image_path);
                }
            } elseif (!empty($data['current_image'])) {
                $imageName = $data['current_image'];;
            } else {
                $imageName = "default.png";
            }

            Admin::where('email', Auth::guard('admin')->user()->email)->update([
                'name' => $data['name'],
                'mobile' => $data['mobile'],
                'image' => $imageName
            ]);
            return redirect()->back()->with('success', 'Profile updated successfully!!');
        }
        return view('admin.pages.settings.profile_update', compact('title'));
    }
    public function adminSubAdmins()
    {
        if(Auth::guard('admin')->user()->type == "subAdmin"){
            return redirect('sadmin/dashboard')->with('error', 'This feature is restricted!!');
        }
        $data['title'] = "Admin";
        $a = DB::table('admins')->get();
        $data['admins'] = json_decode($a, true);
        return view('admin.pages.admin.admins', $data);
    }
    public function addEditAdminSubadmin(Request $request, $id = null)
    {
        if ($id == "") {
            // Add Coupon Code
            $adminData = new Admin;
            $title = "Add Admin/Subadmin User";
            $buttonText = "Save";
            $message = "User saved successfully!";
        } else {
            // Update Coupon Code
            $adminData = Admin::find($id);
            $title = "Edit Admin/Subadmin";
            $buttonText = "Update";
            $message = "User updated successfully!";
        }
        if ($request->isMethod('post')) {
            $data = $request->all();
            //Check admin/subadmin user is exist
            if ($id == "") {
                $adminCount = Admin::where('email', $data['email'])->count();
                //dd($adminCount);
                if ($adminCount > 0) {
                    return redirect()->with('error', 'Admin/Subadmin user already exist!!');
                }
            }
            // $rules = [
            // 	'name' => 'required',
            // 	'mobile' => 'required|numeric',
            // 	'image' => 'required'
            // ];
            // $customMessages = [
            // 	'name.required' => 'Name is required',
            // 	'name.regex' => 'Valid name is required',
            // 	'mobile.required' => 'Mobile is required',
            // 	'image.required' => 'Valid Image is required'
            // ];
            // $this->validate($request, $rules, $customMessages);

            //Upload profile image
            if ($request->hasfile('image')) {
                $image = $request->file('image');
                if ($image->isValid()) {
                    $imageName  = time() . '.' . $image->getClientOriginalExtension();
                    $admin_image_path = 'uploads/admin_photos/' . $imageName;
                    Image::make($image)->resize(100, 100)->save($admin_image_path);
                }
            } elseif (!empty($data['current_image'])) {
                $imageName = $data['current_image'];;
            } else {
                $imageName = "";
            }
            $adminData->image = $imageName;
            $adminData->name = $data['name'];
            $adminData->mobile = $data['mobile'];
            $adminData->status = 1;
            //checking if id exist
            if ($id == "") {
                //dd($id);
                $adminData->email = $data['email'];
                $adminData->type = $data['type'];
            }
            if ($data['password'] != "") {
                $adminData->password = bcrypt($data['password']);
            }
            $adminData->save();
            return redirect('sadmin/admin-subadmins')->with('success', $message);
        }
        //dd($adminData);
        return view('admin.pages.admin.addEditAdmin', compact('title', 'buttonText', 'adminData', 'message'));
    }
    public function updateRole($id)
    {
        $title = "Update Admin-SubAdmin Roles and Permission";
        $adminDetails = Admin::where('id',$id)->select('id','email')->first()->toArray();
        //dd($adminDetails);
        return view('admin.pages.admin.update_role',compact('title','adminDetails'));

    }
    public function updateAdminsStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            Admin::where('id', $data['admin_id'])->update(['status' => $status]);
            return  response()->json(['status' => $status, 'admin_id' => $data['admin_id']]);
        }
    }
    public function deleteAdmin($id)
    {
        try {
            $admin_user = Admin::findOrFail($id);
            $image_path = public_path() . '/storage/admin/' . $admin_user['image'];
            //dd($bank_image_path);
            if (!is_null($admin_user)) {
                $admin_user->delete();
                unlink($image_path);
                return response()->json(['success' => 'User has been deleted!!']);
            }
        } catch (\Throwable $th) {
            //dd($th);
            return response()->json(['error' => 'User not deleted!!']);
        }
    }
}
