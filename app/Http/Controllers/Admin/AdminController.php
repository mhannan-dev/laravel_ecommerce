<?php
namespace App\Http\Controllers\Admin;
use Carbon\Carbon;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
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
			if ($request->has('image')) {
				$image = $request->file('image');
				$currentDate = Carbon::now()->toDateString();
				$imageName = $currentDate . '-' . rand(1, 100) . '.' . $image->getClientOriginalExtension();
				if (!Storage::disk('public')->exists('admin')) {
					Storage::disk('public')->makeDirectory('admin');
				}
				$postImage = Image::make($image)->resize(150, 150)->save(storage_path('admin'));
				Storage::disk('public')->put('admin/' . $imageName, $postImage);
			} else if (!empty($data['current_image'])) {
				$imageName = $data['current_image'];
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
		$data['title'] = "Admin";
		$a = DB::table('admins')->get();
		$data['admins'] = json_decode($a, true);
		return view('admin.pages.admin.admins', $data);
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
}
