<?php

namespace App\Http\Controllers\Frontend;

use App\Models\CmsPage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    public function cms_page(Request $request)
    {
        $currentRoute = url()->current();
        $currentRoute = Str::replace('http://127.0.0.1:8000/', '', $currentRoute);
        $cmsRoutes = CmsPage::where('status', 1)->get()->pluck('slug')->toArray();
        if (in_array($currentRoute, $cmsRoutes)) {
            $cmsPageDetails = CmsPage::where('slug', $currentRoute)->first()->toArray();
            //dd($cmsPageDetails);
            return view('frontend.pages.cms.cms_page', compact('cmsPageDetails'));
        } else {
            abort(404);
        }
    }

    public function contactUs(Request $request)
    {
        $data['title'] = "Contact";
        if ($request->isMethod('POST')) {
            //Receive contact form data
            $c = $request->all();
            //dd($c);
            $rules = [
                'name' => 'required',
                'email' => 'required|email',
                'subject' => 'required',
                'user_message' => 'required',
            ];
            //Validation message
            $customMessage = [
                'name.required' => 'Name is required',
                'email.email' => 'Email is required',
                'subject.required' => 'Subject is required',
                'user_message.required' => 'Message is required',
            ];
            $validator = Validator::make($c, $rules, $customMessage);
            // Check validation failure
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $email = 'aa8403997@gmail.com';
            $messageData = [
                'name' => $c['name'],
                'email' => $email,
                'subject' => $c['subject'],
                'user_message' => $c['user_message'],
            ];
            //Send mail to admin email
            Mail::send('emails.enquiry', $messageData, function ($message) use ($email) {
                $message->to($email);
                $message->subject('Enquiry eCommerce website');
            });
            return redirect()->back()->with('success', 'Thanks for your enquiry. We will get back to you soon');
        }
        return view('frontend.pages.products.contact', $data);
    }
}
