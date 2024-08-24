<?php

namespace App\Http\Controllers\Suppliers;

use App\Http\Controllers\Controller;
use App\Http\Middleware\supplires;
use App\Models\ChMessage;
use App\Models\shipping_info;
use App\Models\User;
use App\Models\Suppliers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class Suppliers_Ctrl extends Controller
{
    //change stauts page for supplier
    public function return_page()
    {
        
        return view('suppliers_pages.change_status');
    }
    //change stauts to supplier functio
    public function change_statue(Request $request)
    {
        $user = auth()->user();

        if ($request->code == $user->code) {
            $user_stautue = User::where('id', $user->id)->first();
            $user_stautue->role_as = "Supplier$012!_1$";

            $supplier_profile = Suppliers::create([
                'user_id' => $user_stautue->id,
                'name' => $user_stautue->name,
                'supplier_number' => rand(10000, 99999999),
            ]);
            $user_stautue->save();
            return redirect('/');
        } else {
            return redirect()->back()->with('error', "Wrong code");
        }
    }
    //the suppliers list in admin side 
    public function suppliers_list()
    {
        $user = auth()->user();
        $new_messages = ChMessage::where('to_id', $user->id)
        ->where('seen', false)
        ->get();
        $suppliers = User::where('role_as', 'Supplier$012!_1$')->get();
        return view('suppliers_pages/Suppliers_list', compact('suppliers','new_messages'));
    }
    //the suppliers profiles in admin side 
    public function suppliers_setting($encrypted_id)
    {  
        
        $user = auth()->user();
        $new_messages = ChMessage::where('to_id', $user->id)
        ->where('seen', false)
        ->get();
        try {
            $id = Crypt::decryptString($encrypted_id);
            $supplier = User::findOrFail($id);
            $supplier_profile = Suppliers::where('user_id', $id)->first();
            return view('suppliers_pages/admin_suppliers_profile', ['supplier' => $supplier, 'supplier_profile' => $supplier_profile,'new_messages'=>$new_messages]);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            // Handle the decryption failure
            return response()->view('users_pages/errors-404', [], 400);
        } catch (\Exception $e) {
            // Handle other exceptions
            return response()->view('users_pages/errors-404', [], 500);
        }
    }
    //change suppier setting 
    public function change_setting(Request $request)
    {
        $supplier = Suppliers::findOrFail($request->id);

        if ($supplier) {
            $supplier->name = $request->name;
            $supplier->about = $request->about;
            $supplier->job = $request->job;
            $supplier->country = $request->country;
            $supplier->address = $request->address;
            $supplier->phone = $request->phone;
            $supplier->company = $request->company;
            $supplier->email = $request->email;
            $supplier->field = $request->field;
            $supplier->twitter_link = $request->twitter_link;
            $supplier->facebook_link = $request->facebook_link;
            $supplier->instagram_link = $request->instagram_link;
            $supplier->linkedin_link = $request->linkedin_link;

            $supplier->name_ar = $request->name_ar;
            $supplier->about_ar = $request->about_ar;
            $supplier->job_ar = $request->job_ar;
            $supplier->country_ar = $request->country_ar;
            $supplier->address_ar = $request->address_ar;
            $supplier->company_ar = $request->company_ar;
            $supplier->field_ar = $request->field_ar;
            
            if ($request->has('image')) {
                $imagefile = $request->file('image');
                $ext = $imagefile->getClientOriginalExtension();
                $uploadpath = 'suppliers_image';
                $filename = time() . '.' . $ext;
                $imagefile->move($uploadpath, $filename);

                // Delete old image if it exists
                if ($supplier->image) {
                    $oldImagePath = $uploadpath . '/' . $supplier->image;
                    if (File::exists($oldImagePath)) {
                        File::delete($oldImagePath);
                    }
                }

                $supplier->image = $filename;
            }

            $supplier->save();

            return redirect()->back()->with('success', 'Information Added Successfully');
        } else {
            return redirect()->back()->with('error', 'User not found');
        }
    }
    //change_permissions_setting 
    public function change_permissions_setting(Request $request)
    {
        try {
            $user = User::findOrFail($request->id);

            // Convert the checkbox value to an integer
            $communicationRole = $request->has('communication_role') ? 1 : 0;

            $user->communication_role = $communicationRole;
            $user->save();
            $supplier = Suppliers::where('user_id',$request->id)->first();

            // Convert the checkbox value to an integer
            $communicationRole = $request->has('communication_role') ? 1 : 0;

            $supplier->communication_role = $communicationRole;
            $supplier->save();

            return redirect()->back()->with('success', 'Information added successfully');
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'User not found');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred');
        }
    }
    //suppliers page user side 
    public function suppliers_page()
    {
        $supplier = Suppliers::paginate(20);
        if (auth()->check()) {
            $user = auth()->user();
            $new_messages = ChMessage::where('to_id', $user->id)
                ->where('seen', false)
                ->get();}
        return view('suppliers_pages/suppliers_page', compact('supplier','new_messages'));
    }
    public function supplier_profile($encrypted_id)
    {
        $id = Crypt::decryptString($encrypted_id);
        $supplier = Suppliers::findOrFail($id);
        if (auth()->check()) {
            $user = auth()->user();
            $new_messages = ChMessage::where('to_id', $user->id)
            ->where('seen', false)
            ->get();}
        return view('suppliers_pages/supplier_profile', compact('supplier','new_messages'));
    }
    //add request  admin side
    public function add_request()
    {
        $user = auth()->user();
        $new_messages = ChMessage::where('to_id', $user->id)
        ->where('seen', false)
        ->get();
        return view('suppliers_pages/supplier_deal_form',compact('new_messages'));
    }
    public function searchCustomer(Request $request)
    {
        $keyword = $request->input('keyword');

        // Perform a database query to fetch similar customer names based on the keyword
        $customers = User::where('role_as', '0')->where('email', 'like', '%' . $keyword . '%')->pluck('email');

        return response()->json($customers);
    }

    public function searchSupplier(Request $request)
    {
        $keyword = $request->input('keyword');

        // Perform a database query to fetch similar supplier names based on the keyword
        $suppliers = User::where('role_as', 'Supplier$012!_1$')->where('email', 'like', '%' . $keyword . '%')->pluck('email');

        return response()->json($suppliers);
    }
    public function add_request_function(Request $request)
    {
        $user = User::where('email', $request->customer_email)->first();
    
        if (!$user) {
            return response()->json(['error' => true, 'message' => 'Customer Email not found']);
        }
        $supplier_email = User::where('email', $request->supplier_email)->first();
    
        if (!$supplier_email) {
            return response()->json(['error' => true, 'message' => 'Supplier Email not found']);
        }
        $shipping_order = new shipping_info();
        // Create a new instance of the ShippingInfo model
        $shipping_order->user_id = $user->id;
        $shipping_order->order_type =1;
        // Set the properties of the model using the form data
        $shipping_order->departure = $request->input('departure');
        $shipping_order->delivery = $request->input('delivery');
        $shipping_order->dimensions = $request->input('dimensions');
        $shipping_order->weight = $request->input('weight');
        $shipping_order->cost = $request->input('cost');
        $shipping_order->user_payment = $request->input('user_payment');
        $shipping_order->deal_name = $request->input('deal_name');
        $shipping_order->shipping_describetion = $request->input('shipping_describetion');
        $shipping_order->user_address = $request->input('user_address');

        $shipping_order->status = $request->input('status');
        $shipping_order->phone = $request->input('phone');
        $shipping_order->delivery_time = $request->input('delivery_time');
        $shipping_order->email = $request->input('customer_email');
        $shipping_order->user_email=$request->input('customer_email');
        $shipping_order->name = $request->customer_name;
        $shipping_order->supplier_email = $request->input('supplier_email');
        $shipping_order->Supplier = $request->input('supplier_name');
        $shipping_order->tracking_no = rand(10000, 99999999);
        // Save the shipping order to the database
        $shipping_order->save();
    
        // Optionally, you can return a response to the client
        return response()->json(['error' => false, 'message' => 'Request added successfully']);
    }
    //supplier requsts  admin side
    public function supplier_reqests()
    {
        $user = auth()->user();
        $new_messages = ChMessage::where('to_id', $user->id)
        ->where('seen', false)
        ->get();
        $shipping_orders=shipping_info::where('order_type',1)->get();
        return view('suppliers_pages/suppliers_requst',compact('shipping_orders','new_messages'));
    }
    public function filter_data2(Request $request)
    {
        $user = auth()->user();
        $new_messages = ChMessage::where('to_id', $user->id)
            ->where('seen', false)
            ->get();
    
        if ($request->query) {
            $shipping_orders = shipping_info::where('status', $request->query->get('quary'))->latest()->where('order_type', 1)->get();        } else {

        }
    
        if ($shipping_orders->isEmpty()) {
            $shipping_orders = shipping_info::latest()->get();
        } else {
            return view('suppliers_pages/suppliers_requst',compact('shipping_orders','new_messages'));
        }
    }
    public function update_request_information(Request $request)
    {
        $user = User::where('email', $request->customer_email)->first();
    
        if (!$user) {
            return response()->json(['error' => true, 'message' => 'Customer Email not found']);
        }
        $supplier_email = User::where('email', $request->supplier_email)->first();
    
        if (!$supplier_email) {
            return response()->json(['error' => true, 'message' => 'Supplier Email not found']);
        }
        $shipping_order = shipping_info::findOrFail($request->id);
        // Create a new instance of the ShippingInfo model
        $shipping_order->user_id = $user->id;
        $shipping_order->order_type =1;
        // Set the properties of the model using the form data
        $shipping_order->departure = $request->input('departure');
        $shipping_order->delivery = $request->input('delivery');
        $shipping_order->dimensions = $request->input('dimensions');
        $shipping_order->weight = $request->input('weight');
        $shipping_order->cost = $request->input('cost');
        $shipping_order->user_address = $request->input('user_address');
        $shipping_order->phone = $request->input('phone');
        $shipping_order->user_payment = $request->input('user_payment');
        $shipping_order->deal_name = $request->input('deal_name');
        $shipping_order->shipping_describetion = $request->input('shipping_describetion');
        $shipping_order->status = $request->input('status');
        $shipping_order->delivery_time = $request->input('delivery_time');
        $shipping_order->email= $request->input('customer_email');
        $shipping_order->user_email=$request->input('customer_email');
        $shipping_order->name = $request->input('customer_name');
        $shipping_order->supplier_email = $request->input('supplier_email');
        $shipping_order->Supplier = $request->input('supplier_name');
        $shipping_order->tracking_no = rand(10000, 99999999);
        // Save the shipping order to the database
        $shipping_order->save();
    
        // Optionally, you can return a response to the client
        return response()->json(['error' => false, 'message' => 'Request added successfully']);
    }
    //supplier_profile_supplier_side
    public function supplier_profile_supplier_side($encrypted_id)
    {
        
        $id = Crypt::decryptString($encrypted_id);
        $user = User::findOrFail($id);
        $user_data = auth()->user();
        $new_messages = ChMessage::where('to_id', $user_data->id)
        ->where('seen', false)
        ->get();
        $supplier=Suppliers::where('user_id',$id)->first();
        $orders = shipping_info::where('supplier_email', $user->email)->where('order_type',1)->get();
        return view('suppliers_pages/supplier_profile_supplier_side', compact('user', 'orders','supplier','new_messages'));
    }
    public function filter_supplier(Request $request)
    {
        if (auth()->check()) {
            $user = auth()->user();
            $new_messages = ChMessage::where('to_id', $user->id)
                ->where('seen', false)
                ->get();}
      $get_search = $request->input('search');
      $supplier = Suppliers::where('name', 'LIKE', '%' . $get_search . '%')
        ->orWhere('field', 'LIKE', '%' . $get_search . '%')
        ->orWhere('company', 'LIKE', '%' . $get_search . '%')
        ->orWhere('supplier_number', 'LIKE', '%' . $get_search . '%')
        ->paginate(30);
    
      return view('suppliers_pages/suppliers_page', compact('supplier','new_messages'));
    }
}
