<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\send_email;
use App\Models\ChMessage;
use App\Models\Login_history;
use App\Models\mails;
use App\Models\shipping_info;
use App\Models\sub_shipping_statue;
use App\Models\Suppliers;
use App\Models\User;
use App\Models\visit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\ValidationException;

class admin_ctrl extends Controller
{
    //main page
    /**
     * The index function retrieves various data related to sales, customers, emails, and visitors, and
     * passes them to the view for display.
     * 
     * @return a view called 'admin_pages/index' with various data passed to it. The data being passed
     * includes sales data, new shipping orders, orders for the current month, number of new customers,
     * number of emails sent, number of customers for the current month, total cost of orders for the
     * current month, x-axis categories for the orders, days of the week and visitor counts for the
     */
    public function index()
    {
        $currentMonth = Carbon::now()->month;
        $new_shipping_orders = shipping_info::where('order_type', 0)->get();
        $orderss = shipping_info::whereMonth('created_at', $currentMonth)->where('order_type', 0)->get();
        $salesData = [];
        $salesData2 = [];
        $newCustomers = 0; // Variable to store the number of new customers
        $emailsSent = 0; // Variable to store the number of emails sent

        $today = Carbon::today();
        // Loop through thedelete data and populate the arrays
        foreach ($orderss as $order) {
            array_push($salesData, $order->tracking_no);
            array_push($salesData2, $order->cost);
        }
        $users = new User();
        $mails = new mails();

        // Count the number of new users added today
        $newCustomers = $users->whereDate('created_at', $today)->count();

        // Count the number of mails sent today
        $emailsSent = $mails->whereDate('created_at', $today)->count();


        $customer_this_month = shipping_info::whereMonth('created_at', $currentMonth)->where('order_type', 0)->count();
        $total_cost = shipping_info::whereMonth('created_at', $currentMonth)->where('order_type', 0)->sum('cost');

        $user_this_month = User::whereMonth('created_at', $currentMonth)->where('role_as', 0)->count();

        $xAxisCategories = $orderss->pluck('created_at')->map(function ($createdAt) {
            return \Carbon\Carbon::parse($createdAt)->format('d/m/y H:i');
        });
        $Visitors_count = visit::whereMonth('created_at', $currentMonth)->count();
        $days = [];
        $visitors = [];
        $this_week = Carbon::now()->startOfWeek(); // Assuming you want to get the start of the current week
        $end_of_week = Carbon::now()->endOfWeek(); // Assuming you want to get the end of the current week

        $visitor = visit::whereBetween('created_at', [$this_week, $end_of_week])->get();

        foreach ($visitor as $item) {
            $day = $item->created_at->format('D'); // Format the date to get the day abbreviation (e.g., Mon, Tue, etc.)
            $count = visit::whereDate('created_at', $item->created_at)->count();

            array_push($days, $day);
            array_push($visitors, $count);
        }
        $user = auth()->user();
        $new_messages = ChMessage::where('to_id', $user->id)
            ->where('seen', false)
            ->get();

        return view('admin_pages/index', [
            'salesData' => json_encode($salesData),
            'salesData2' => json_encode($salesData2),
            'new_shipping_orders' => $new_shipping_orders,
            'orderss' => $orderss,
            'user_this_month' => $user_this_month,
            'newCustomers' => $newCustomers,
            'emailsSent' => $emailsSent,
            'customer_this_month' => $customer_this_month,
            'total_cost' => $total_cost,
            'xAxisCategories' => $xAxisCategories,
            'days' => $days,
            'visitors' => $visitors,
            'Visitors_count' => $Visitors_count,
            'new_messages' => $new_messages,
        ]);
    }
    /**
     * The function "show_order_details" retrieves order details, user information, new messages, and
     * shipping status based on an encrypted order ID and returns a view with the retrieved data.
     * 
     * @param encrypted_id The parameter "encrypted_id" is a string that represents the encrypted ID of
     * an order. It is used to retrieve the order details from the database.
     * 
     * @return a view called 'admin_pages.order_details' with the variables 'order_details',
     * 'shipping_status', and 'new_messages'.
     */
    //order details
    public function show_order_details($encrypted_id)
    {
        $id = Crypt::decryptString($encrypted_id);
        $order_details = shipping_info::findOrFail($id);
        $user = auth()->user();
        $new_messages = ChMessage::where('to_id', $user->id)
            ->where('seen', false)
            ->get();
        $shipping_status = sub_shipping_statue::where('tracking_no', $order_details->tracking_no)->get();
        return view('admin_pages.order_details', ['order_details' => $order_details, 'shipping_status' => $shipping_status, 'new_messages' => $new_messages]);
    }
    //add new shipping status
    /**
     * The function `add_new_shipping_statue` in PHP creates a new shipping status entry with the
     * provided tracking number, date, location, time, and process, and saves it to the database.
     * 
     * @param Request request The  parameter is an instance of the Request class, which is used
     * to retrieve data from the HTTP request. It contains information such as the request method,
     * headers, and input data. In this case, it is used to retrieve the values of the tracking_no,
     * date, location, time,
     * 
     * @return a JSON response with a status of 'success'.
     */
    public function add_new_shipping_statue(Request $request)
    {
        $data = new sub_shipping_statue();
        $data->tracking_no = $request->tracking_no;
        $user = auth()->user();
        // $data->data_entry=$user->email;
        $data->date = $request->date;
        $data->location = $request->location;
        $data->time = $request->time;
        $data->process = $request->process;
        $data->save();
        return response()->json([
            'status' => 'success',
        ]);
    }
    //edite shipping order info
    public function edite_shipping_info($encrypted_id)
    {
        $user = auth()->user();
        $new_messages = ChMessage::where('to_id', $user->id)
            ->where('seen', false)
            ->get();
        $id = Crypt::decryptString($encrypted_id);
        $order_details = shipping_info::findOrFail($id);
        return view('admin_pages.edite_shipping_info', compact('order_details', 'new_messages'));
    }
    //edite info function
    public function update_shipping_info(Request $request)
    {
        $shipping_data = shipping_info::find($request->id);
        $shipping_data->status = $request->status;
        $shipping_data->user_address = $request->user_address;
        $shipping_data->cost = $request->cost;
        $shipping_data->Supplier = $request->supplier;
        $shipping_data->user_payment = $request->user_payment;
        $shipping_data->shipping_describetion = $request->shipping_describetion;
        $shipping_data->delivery_time = $request->input('delivery_time');
        $shipping_data->save();
        return response()->json([
            'status' => 'success',
        ]);
    }
    //Shipping Orders page
    public function Shipping_Orders()
    {
        $user = auth()->user();
        $new_messages = ChMessage::where('to_id', $user->id)
            ->where('seen', false)
            ->get();
        $shipping_orders = shipping_info::latest()->where('order_type', 0)->get();
        return view('admin_pages.Shipping_Orders', compact('shipping_orders', 'new_messages'));
    }
    //send message to spacific user
    public function Send_mail($encrypted_id)
    {
        try {
            $user = auth()->user();
            $new_messages = ChMessage::where('to_id', $user->id)
                ->where('seen', false)
                ->get();
            $id = Crypt::decryptString($encrypted_id);
            $User_email = User::findOrFail($id);
            $email = $User_email->email;
            return view('admin_pages.send_email', compact('email', 'new_messages'));
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            // Handle decryption exception
            return redirect()->back()->with('error', 'Invalid encrypted ID.');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Handle model not found exception
            return redirect()->back()->with('error', 'User not found.');
        } catch (\Exception $e) {
            // Handle other exceptions
            return redirect()->back()->with('error', 'An error occurred.');
        }
    }
    //send message to any user
    public function Send_mail2()
    {
        $user = auth()->user();
        $new_messages = ChMessage::where('to_id', $user->id)
            ->where('seen', false)
            ->get();
        return view('admin_pages.send_email_2', compact('new_messages'));
    }
    //send message function
    public function Send_email_fun(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'message' => 'required',
        ]);

        $get_email = $request->email;
        $get_message = $request->message;
        $data = new mails();
        $data->sender_id = auth()->user()->id;
        $get_id = User::where('email', $request->email)->first();

        if ($get_id) {
            $data->receiver_id = $get_id->id; // Access the 'id' property of the user
            $data->message = $get_message;
            $data->save();

            Mail::to($request->email)->send(new send_email($get_email, $get_message));

            return redirect()->back()->with('success_message', 'Message Sent');
        } else {
            return redirect()->back()->with('error_message', 'Receiver not found.')->withInput();
        }
    }
    //change user status
    public function change_user_to_supplier($encrypted_id)
    {
        $random_number = rand(10, 100000000);
        $link = url('supplier/' . $random_number);
        $id = Crypt::decryptString($encrypted_id);
        $user = User::findOrFail($id);
        $get_email = $user->email;
        $get_message = 'Hello ' . $user->name . ', this is your activation code: ' . $user->code . ' Please enter this link ' . $link . ' to activate your account';
        $data = new Mails();
        $data->sender_id = auth()->user()->id;
        $get_receiver = User::where('email', $get_email)->first();

        if ($get_receiver) {
            $data->receiver_id = $get_receiver->id;
            $data->message = $get_message;
            $data->save();
            Mail::to($get_email)->send(new send_email($get_email, $get_message));
            return redirect()->back()->with('success_message', 'Message Sent');
        } else {
            return redirect()->back()->with('error_message', 'Receiver not found.')->withInput();
        }
    }
    //

    public function user_list()
    {
        $users = User::where('role_as', '0')->get();
        $shipping_requset = shipping_info::all();
        $user = auth()->user();
        $new_messages = ChMessage::where('to_id', $user->id)
            ->where('seen', false)
            ->get();
        return view('admin_pages.User_list', compact('users', 'shipping_requset', 'new_messages'));
    }
    //delete user
    public function delete_user($encrypted_id)
    {
        $id = Crypt::decryptString($encrypted_id);
        $User_info = User::findOrFail($id);
        $User_info->delete();
        return redirect()->back()->with('success', 'User deleted');
    }
    public function delete_user2($encrypted_id)
    {
        $id = Crypt::decryptString($encrypted_id);
        $User_info = User::findOrFail($id);
        $User_info->delete();
        return redirect()->back()->with('success', 'User deleted');
    }
    //user details
    public function user_details($encrypted_id)
    {
        $id = Crypt::decryptString($encrypted_id);
        $User_info = User::findOrFail($id);
        $shipping_data = shipping_info::where('user_id', $id)->get();
        $mails = mails::where('receiver_id', $id)->get();
        $user = auth()->user();
        $new_messages = ChMessage::where('to_id', $user->id)
            ->where('seen', false)
            ->get();
        if (!$User_info->exists()) {
            return redirect('/admin/user/list');
        } else {
            return view('admin_pages/user_details', compact('User_info', 'shipping_data', 'mails', 'new_messages'));
        }
    }
    //mail_reports
    public function mail_reports()
    {
        $stuff_auth_report = mails::all();
        $users = User::all();
        $user = auth()->user();
        $new_messages = ChMessage::where('to_id', $user->id)
            ->where('seen', false)
            ->get();
        return view('admin_pages/mail_reports', compact('stuff_auth_report', 'users', 'new_messages'));
    }
    //delete mail
    public function delete_mail($id)
    {
        $mails = mails::findOrFail($id);
        $mails->delete();
        return redirect()->back()->with('success', 'Mail deleted');
    }
    //stuff list
    public function stuff_list()
    {
        $stuff = User::where('role_as', '@1$0S')->orwhere('role_as', '%2_1@s')->get();
        $user = auth()->user();
        $new_messages = ChMessage::where('to_id', $user->id)
            ->where('seen', false)
            ->get();
        return view('admin_pages/stuff_list', compact('stuff', 'new_messages'));
    }
    //stuff_reports
    public function stuff_reports()
    {
        $login_history = Login_history::all();
        $user = auth()->user();
        $new_messages = ChMessage::where('to_id', $user->id)
            ->where('seen', false)
            ->get();
        return view('admin_pages/stuff_reports', compact('login_history', 'new_messages'));
    }
    //stuff details
    public function stuff_details($encrypted_id)
    {
        $id = Crypt::decryptString($encrypted_id);
        $User_info = User::findOrFail($id);
        $users = User::all();
        $mails = mails::where('sender_id', $id)->get();

        $login_history = Login_history::where('user_email', $User_info->email)->get();
        $user = auth()->user();
        $new_messages = ChMessage::where('to_id', $user->id)
            ->where('seen', false)
            ->get();
        return view('admin_pages/stuff_details', compact('User_info', 'login_history', 'mails', 'users', 'new_messages'));
    }
    //delete status 
    public function delete_status($encrypted_id)
    {
        $id = Crypt::decryptString($encrypted_id);
        $status = sub_shipping_statue::findOrFail($id);
        $status->delete();
        return redirect()->back()->with('success', 'statu deleted');
    }
    public function edite_status(Request $request)
    {
        $data = sub_shipping_statue::findOrFail($request->id);
        $data->tracking_no = $request->tracking_no;
        $user = auth()->user();
        // $data->data_entry=$user->email;
        $data->date = $request->date;
        $data->location = $request->location;
        $data->time = $request->time;
        $data->process = $request->process;
        $data->save();
        return response()->json([
            'status' => 'success',
        ]);
    }
    //search 
    public function search_admin(Request $request)
    {
        $get_search = $request->input('query');
        $user = auth()->user();
        $new_messages = ChMessage::where('to_id', $user->id)
            ->where('seen', false)
            ->get();
        $shipping_orders = shipping_info::where('tracking_no', 'LIKE', '%' . $get_search . '%')
            ->orWhere('name', 'LIKE', '%' . $get_search . '%')
            ->orWhere('user_email', 'LIKE', '%' . $get_search . '%')
            ->orWhere('email', 'LIKE', '%' . $get_search . '%')
            ->orWhere('phone', 'LIKE', '%' . $get_search . '%')
            ->orWhere('Supplier', 'LIKE', '%' . $get_search . '%')
            ->get();

        if ($shipping_orders->isEmpty()) {
            return redirect()->back()->with('not_found', 'Not found');
        } else {
            return view('admin_pages.Shipping_Orders', compact('shipping_orders', 'new_messages'));
        }
    }
    //filter
    public function filter_data(Request $request)
    {
        $user = auth()->user();
        $new_messages = ChMessage::where('to_id', $user->id)
            ->where('seen', false)
            ->get();

        if ($request->query) {
            $shipping_orders = shipping_info::where('status', $request->query->get('quary'))->latest()->where('order_type', 0)->get();
        } else {
        }

        if ($shipping_orders->isEmpty()) {
            $shipping_orders = shipping_info::latest()->get();
        } else {
            return view('admin_pages.Shipping_Orders', compact('shipping_orders', 'new_messages'));
        }
    }

    //delete shipping order 
    public function delete_order($encrypted_id)
    {
        $id = Crypt::decryptString($encrypted_id);
        $order = shipping_info::findOrFail($id);
        $status_orders = sub_shipping_statue::where('tracking_no', $order->tracking_no)->get();
        foreach ($status_orders as $item) {
            $item->delete();
        }
        $order->delete();
        return redirect('/admin/Shipping/Orders')->with('success', 'order deleted');
    }
    //change stuff seting 
    public function change_staff_Prergations(Request $request)
    {

        try {
            $user = User::findOrFail($request->id);
            // Convert the checkbox value to an integer
            $customer_service = $request->has('customer_service') ? 1 : 0;
            $shipping_status = $request->has('shipping_status') ? 1 : 0;
            $edite_shipping_oreders = $request->has('edite_shipping_oreders') ? 1 : 0;
            $supplier_deals = $request->has('supplier_deals') ? 1 : 0;
            $supplier_stauts = $request->has('supplier_stauts') ? 1 : 0;

            $user->customer_service = $customer_service;
            $user->shipping_status = $shipping_status;
            $user->edite_shipping_oreders = $edite_shipping_oreders;
            $user->supplier_deals = $supplier_deals;
            $user->supplier_stauts = $supplier_stauts;
            $user->save();

            return redirect()->back()->with('success', 'Information added successfully');
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'User not found');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred');
        }
    }
    public function change_supplier_role_to_user($encrypted_id)
    {
        $id = Crypt::decryptString($encrypted_id);

        $user = User::findOrFail($id);
        $user->role_as = "0";
        $user->save();
        $supplier = Suppliers::where('user_id', $id)->first();
        $uploadpath = 'suppliers_image';
        if ($supplier->image) {
            $oldImagePath = $uploadpath . '/' . $supplier->image;
            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }
        }
        $supplier->delete();
        return redirect('/admin/Suppliers/List')->with('success', 'Supplier information deleted successfully');
    }

    //change_to_support
    public function change_to_support($encrypted_id)
    {
        $id = Crypt::decryptString($encrypted_id);

        $user = User::findOrFail($id);
        $user->role_as = "%2_1@s";
        $user->save();

        return redirect('/admin/user/list')->with('success', 'Data Updated Successfully');
    }
}
