<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\Contact;
use App\Models\ChMessage;
use App\Models\shipping_info;
use App\Models\sub_shipping_statue;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class User_ctrl extends Controller
{
    // the main user page
    public function index()
    {
        if (auth()->check()) {
        $user = auth()->user();
        $new_messages = ChMessage::where('to_id', $user->id)
        ->where('seen', false)
        ->get();
        return view('users_pages.index',compact('new_messages'));
        }else{

        }return view('users_pages.index');
    }
    //shipping from page
    public function shipping_from()
    {
        if (auth()->check()) {
            $user = auth()->user();
            $new_messages = ChMessage::where('to_id', $user->id)
            ->where('seen', false)
            ->get();}
        return view('users_pages/shipping_from',compact('new_messages'));
    }
    //shipping function handle , this function handle the shippinhg from in user side which user send its shippment data to admin  

    public function shipping_data(Request $request)
    {
        try {
            if (auth()->check()) {
                $user = auth()->user();
                $new_messages = ChMessage::where('to_id', $user->id)
                ->where('seen', false)
                ->get();}
            // Validate the request data
            $validator = Validator::make($request->all(), [
                'departure' => 'required',
                'delivery' => 'required',
                'weight' => 'required',
                'dimensions' => 'required',
                'name' => 'required',
                'email' => 'required|email',
                'phone' => 'required|numeric',
                'message' => 'nullable',
            ]);
    
            // Redirect back if validation fails
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
    
            $shipping_data = new shipping_info();
            $shipping_data->departure = $request->departure;
            $shipping_data->delivery = $request->delivery;
            $shipping_data->weight = $request->weight;
            $shipping_data->dimensions = $request->dimensions;
            $shipping_data->name = $request->name;
            $shipping_data->email = $request->email;
            $shipping_data->phone = $request->phone;
            $shipping_data->message = $request->message;
            $user = auth()->user();
            $shipping_data->user_id = $user->id;
            $shipping_data->user_email = $user->email;
            $shipping_data->order_type = 0;
            $shipping_data->tracking_no = rand(10000, 99999999);
            $shipping_data->save();
           
            $tracking_no = $shipping_data->tracking_no;

            // Encrypt the tracking number
            $encrypted_tracking_no = Crypt::encryptString($tracking_no);
            return redirect()->route('confrmed', ['tracking_no' => $encrypted_tracking_no])->with('success_message', 'Data Sent Successfully, we will contact you to confirm your order',compact('new_messages'));
        } catch (\Exception $e) {
            // Handle any exceptions or errors that occur
            return redirect()->back()->with('error', 'An error occurred during the shipping data process. Please try again.');
        }
    }
    public function order_confrmed($encrypted_tracking_no)
    {
        // Decrypt the tracking number
        try {
            if (auth()->check()) {
                $user = auth()->user();
                $new_messages = ChMessage::where('to_id', $user->id)
                ->where('seen', false)
                ->get();}
        $tracking_no = Crypt::decryptString($encrypted_tracking_no);
    
        return view('users_pages/order_confirm', ['tracking_no' => $tracking_no],compact('new_messages'));
       } catch (\Exception $e) {
        return redirect('/')->with('error', 'An error occurred during the shipping data process. Please try again.',compact('new_messages'));

       }
    }
    //user profile , the user profile page 
    public function user_profile($encrypted_id)
    {
        try {
            $id = Crypt::decryptString($encrypted_id);
            $user = User::findOrFail($id);
            $user_data = auth()->user();
            $new_messages = ChMessage::where('to_id', $user_data->id)
            ->where('seen', false)
            ->get();
            $orders = shipping_info::where('user_id', $id)->get();
            return view('users_pages.user_profile', compact('user', 'orders','new_messages'));
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            // Handle decryption error
            return view('users_pages/errors-404');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Handle model not found error
            return view('users_pages/errors-404');
        } catch (\Exception $e) {
            // Handle other unexpected errors
            return view('users_pages/errors-404');
        }
    }
    //oreder details , function handle all oreders that user make 
    public function order_details($encrypted_id)
    {
        try {
            if (auth()->check()) {
                $user = auth()->user();
                $new_messages = ChMessage::where('to_id', $user->id)
                ->where('seen', false)
                ->get();}
            $id = Crypt::decryptString($encrypted_id);
            $order = shipping_info::findOrFail($id);
            $shipping_status = sub_shipping_statue::where('tracking_no', $order->tracking_no)->get();
            return view('users_pages.order_details', compact('order', 'shipping_status','new_messages'));
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            // Handle decryption error
            return view('users_pages/errors-404');;
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Handle model not found error
            return view('users_pages/errors-404');
        } catch (\Exception $e) {
            // Handle other unexpected errors
            return view('users_pages/errors-404');
        }
    }
    public function tracking_no_search(Request $request)
    {
        try {
            if (auth()->check()) {
                $user = auth()->user();
                $new_messages = ChMessage::where('to_id', $user->id)
                ->where('seen', false)
                ->get();}
            $tracking_number = $request->input('tracking_number');
            $tracking_no_details = shipping_info::where('tracking_no', $tracking_number)->firstOrFail();
            $shipping_status = sub_shipping_statue::where('tracking_no', $tracking_number)->latest()->get();
            return view('users_pages.track_no_search', compact('tracking_no_details', 'shipping_status','new_messages'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Handle model not found error
            return view('users_pages/errors-404');
        } catch (\Exception $e) {
            // Handle other unexpected errors
            return view('users_pages/errors-404');
        }
    }
    // public function about_page()
    // {
    //     return view('users_pages/about');
    // }
    // public function contact_page()
    // {
    //     return view('users_pages/contact');
    // }
    public function sendEmail(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'subject' => 'required',
                'message' => 'required|string',
            ]);
    
            $details = [
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'subject' => $validatedData['subject'],
                'message' => $validatedData['message'],
            ];
    
            Mail::to('osama.ceo.nkl@gmail.com')->send(new Contact($details));
    
            return back()->with('success_message', 'Message Sent');
        } catch (\Exception $e) {
            return back()->with('error_message', 'An error occurred while sending the email: ' . $e->getMessage());
        }
    }
}
