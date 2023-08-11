<?php

namespace App\Http\Controllers\Web;


use DB;
use Cart;
use Session;
use App\Visitor;
use App\Order;
use App\Payment;
use App\User;
use App\Shipping;
use App\Customer;
use App\District;
use App\Stock;
use App\Product;
use App\OrderDetail;
use Illuminate\Support\Str;
use App\Components\BulkSms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends Controller
{
    public function index(){

    	return view('frontend.checkout.checkoutContent');
    }

    public function checkCustomerMail(){
        $email=$_GET['email_address'];
        $customer=Customer::where('email_address',$email)->first();
        if($customer){
            return response()->json([
                'success'=>false
            ],201);
        }else{
            return response()->json([
                'success'=>true
            ],200);
        }

    }
    
    public function checkCustomerMobileNo(){
        $mobileNo = $_GET['mobile_no'];
        $customer = Customer::where('mobile_no', $mobileNo)->first();
        if($customer){
            return response()->json([
                'success'=>false
            ],201);
        }else{
            return response()->json([
                'success'=>true
            ],200);
        }

    }

    public function customerLoginStep2(){
        $data['mobile_no'] = Session('mobile_no');
        $data['breadcrumb'] = "You are not registered please registered now!";
        return view ('frontend.checkout.checkoutContentTwo')->with($data);
    }

    public function verifiedOtp(Request $request){

        $customMessages = [
            'mobile_no.required' => 'The mobile number field is required.',
            'mobile_no.regex' => 'The mobile number must be a valid Bangladeshi mobile number.'
        ];
        $validator = Validator::make($request->all(), [
            'mobile_no' => ['required', 'regex:/^(\\+88|88)?(01){1}[3456789]{1}(\\d){8}$/'] // Regular expression pattern for 10-digit mobile number
        ],$customMessages);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }//validation;

        $data['breadcrumb'] = "WE'VE SENT A ONE TIME OTP TO YOUR MOBILE NUMBER";
        $data['mobile_no'] = $request->mobile_no;
        session(['mobile_no' => $request->mobile_no]);
        $otp = rand(1000, 9999);
        $bulk = new BulkSms();
        $message = $otp.' is your (OTP) varification code from Atlantisdecora for Place Order.';
        $bulk->send_message($this->getPhone($request->mobile_no),$message);
        session(['mobile_no' => $request->mobile_no, 'otp' => $otp]);
        return view('frontend.checkout.check_otp',$data);

    }

    public function getPhone($phone){
        if(Str::startsWith($phone, '+880') || Str::startsWith($phone, '880')){
            return $phone;
        }else{
            return '88'.$phone;
        }
    }

    public function checkoutOrder(Request $request) {
        
        $customMessages = [
            'mobile_no.required' => 'The mobile number field is required.',
            'mobile_no.regex' => 'The mobile number must be a valid Bangladeshi mobile number.'
        ];
        $validator = Validator::make($request->all(), [
            'mobile_no' => ['required', 'regex:/^(\\+88|88)?(01){1}[3456789]{1}(\\d){8}$/'] // Regular expression pattern for 10-digit mobile number
        ],$customMessages);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }//validation;

        $data['cities'] = DB::select('select name,bn_name from districts');
        $data['upazilas'] = DB::select('select name,bn_name from upazilas');
        $data['dhkarea'] = DB::select('select area_name from dhkarea');
        
        // save visitors number
        $visitor = new Visitor;
        $visitor->phone = $request->mobile_no;
        $visitor->save();
        
        $data['mobile_no'] = $request->mobile_no;
        $data['customer'] = Customer::where('mobile_no',$data['mobile_no'])->first();
        if ($data['customer']) {
            $customer_id = $data['customer']->id;
            $customerName = $data['customer']->customer_name;
            session(['customerID'=>$customer_id,'customer_name'=>$customerName]);
            $data['shipping'] = Shipping::where('customer_id',$customer_id)->first();
            $data['shippings'] = Shipping::where('customer_id',$customer_id)->get();
            return view ('frontend.checkout.checkoutContentThree')->with($data);
        }else{
            return view ('frontend.checkout.checkoutContentTwo')->with($data);
        }
    }

    public function shippingForm(){
    	$customerID = Session::get('customerID');
    	$data['cities'] = DB::select('select name,bn_name from districts');
        $data['upazilas'] = DB::select('select name,bn_name from upazilas');
        $data['dhkarea'] = DB::select('select area_name from dhkarea');
        
    	$data['customer'] = Customer::where('id', $customerID)->first();
        $data['shipping'] = Shipping::where('customer_id', $customerID)->first();
    	$data['shippings'] = Shipping::where('customer_id', $customerID)->get();
    	return view('frontend.checkout.checkoutContentThree',$data);
    }
    public function shippingAddress(){
        $customerID = Session::get('customerID');
        $data['shipping'] = Shipping::where('customer_id',$customerID)->first();
        $data['cities'] = DB::select('select name,bn_name from districts');
        $data['upazilas'] = DB::select('select name,bn_name from upazilas');
        $data['dhkarea'] = DB::select('select area_name from dhkarea');
        
    	$customer_id = Session::get('customerID');
    	$data['customer'] = Customer::where('id', $customer_id)->first();
    	$data['shipping'] = Shipping::where('customer_id',$customer_id)->first();
        $data['shippings'] = Shipping::where('customer_id',$customer_id)->get();
        return view ('frontend.checkout.checkoutContentThree')->with($data);
    }

    public function customerUpdateShipping(Request $request){
        $validator = \Validator::make($request->all(), [
            'fullname' => 'required|string|max:255',
            'mobile_no' => 'required|numeric',
            'email' => 'required|string|email|max:255',
            'address' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(array("success" => false, "message" => $validator->getMessageBag()->toArray()), 200);
        }
        $id=$request->shipping_id;
        $update=$request->chkShipping;
        $customer=Customer::find($request->customer_id);
        $customerID = $customer->id;
        $customerName = $customer->customer_name;
        $title=$request->title;
        if($update==1){
            $shipping = Shipping::find($id);
            $shipping->fullname = $request->fullname;
            $shipping->email = $request->email;
            $shipping->mobile_no = $request->mobile_no;
            $shipping->city = $request->city;
            $shipping->thana = $request->thana;
            $shipping->postcode = $request->postcode;
            $shipping->area = $request->area;
            $shipping->address = $request->address;
            $shipping->update();
        }else{
            if($title){
                $shipping = new Shipping();
                $shipping->customer_id = $customerID;
                $shipping->title = $title;
                $shipping->fullname = $request->fullname;
                $shipping->email = $request->email;
                $shipping->mobile_no = $request->mobile_no;
                $shipping->city = $request->city;
                $shipping->thana = $request->thana;
                $shipping->postcode = $request->postcode;
                $shipping->area = $request->area;
                $shipping->address = $request->address;
                $shipping->save();
                $shippingID = $shipping->id;
            }
        }
        $city = $request->city;
        $thana = $request->thana;
        $area = $request->area;
        $postcode = $request->postcode;
        if($city=="Dhaka"){
            $coverage_id = "Inside Dhaka";
            $package_code = "#4023";
            $shipping_charge = 60;

        }else{
           $coverage_id = "Outside Dhaka";
           $package_code= "#7133";
           $shipping_charge=120;
        }
        $shippingID=$shippingID ?? $id;
        session(['city'=>$city,'thana'=>$thana,'area'=>$area,'postcode'=>$postcode,'coverage_id'=>$coverage_id, 'package_code'=>$package_code,'shippingID'=>$shippingID,'customerID'=>$customerID,'customer_name'=>$customerName, 'email'=>$request->email, 'address'=>$request->address, 'mobile_no' => $request->mobile_no,'shipping_cost'=>$shipping_charge]);
        return redirect('checkout-payment');
    }

    public function paymentForm(){
        return view('frontend.checkout.paymentContent');
    }


    public function saveOrder(Request $request)
    {
        
        // $validator = Validator::make($request->all(), [
        //     'customer_name' => 'required|string|max:255',
        //     'mobile_no'     => 'required|unique:customers',
        //     'email_address' => 'required|string|email|max:255',
        // ]);
 
        // if ($validator->fails()) {
        //     return redirect('customer-validation-redirect/' . $request->mobile_no);
        // }
        
        if(!empty(Cart::getContent())){
            
            $id=$request->shipping_id ?? "";
            $update=$request->chkShipping ?? "";
            $title=$request->title;
            $fullname=$request->fullname;
            $email=$request->email;
            $phone=$request->phone;
            if($request->customer_id){
                $customer=Customer::find($request->customer_id);
                $customerID = $customer->id;
                $customerName = $customer->customer_name;
            }else{
                $customer= new Customer;
                $customer->customer_name = $request->customer_name;
                $customer->email_address = $request->email_address;
                $customer->mobile_no = $request->mobile_no;
                $customer->address = $request->address;
                $customer->save();
                $customerID = $customer->id;
                $customerName = $customer->customer_name;
            }
            session(['customerID'=>$customerID,'customer_name'=>$customerName]);
            $city = "Dhaka";
            $area = $request->area;
            $thana = "";
            if($request->city=="Outside Dhaka"){
                $city = $request->district;
                $thana = $request->thana;
                $area = "";
            }
            $address = $request->address;
            $comments = $request->comments;
            if($update==1){
                $shipping = Shipping::find($id);
                $shipping->fullname = $fullname;
                $shipping->email = $email;
                $shipping->mobile_no = $request->mobile_no;
                $shipping->city = $city;
                $shipping->thana = $thana;
                $shipping->area = $area;
                $shipping->address = $address;
                $shipping->update();
            }else{
                if($title){
                    $shipping = new Shipping();
                    $shipping->customer_id = $customerID;
                    $shipping->title = $title;
                    $shipping->fullname = $request->fullname;
                    $shipping->email = $email;
                    if($request->customer_id){
                        $shipping->mobile_no = $request->mobile_no;
                    }else{
                        $shipping->mobile_no = $phone;
                    }
                    $shipping->city = $city;
                    $shipping->thana = $thana;
                    $shipping->area = $area;
                    $shipping->address = $address;
                    $shipping->save();
                    $shippingID = $shipping->id;
                }
            }
            if($city=="Dhaka"){
                $shipping_charge = 60;
            }else{
               $shipping_charge=120;
            }
            session(['shipping_cost'=>$shipping_charge]);
            $shippingID=$shippingID ?? $id;
    
            $total_qty=0;
            $tran_id = uniqid();
            $invoice_no = 'AD'.mt_rand(11111,99999);
            $shipping_id = $shippingID;
            $customer_id = $customerID;
            $customer_name = $customerName;
            $email_address = $request->email;
            $mobile_no = $request->mobile_no;
            $address = $request->address;
            $shipping_cost = $shipping_charge;
            $cartTotal= Cart::getSubTotal();
            $grand_total = $cartTotal + $shipping_cost;
            $carts = Cart::getContent();
    
            if ($request->payment_method == 'ssl') {
                $customerById = Customer::where('id', $customerID)->first();
                $data['shipping_id'] = $shippingID;
                $data['customer_id'] = $customerById->id;
                $data['customer_name'] = $customerById->customer_name;
                $data['email_address'] = $customerById->email_address;
                $data['mobile_no'] = $customerById->mobile_no;
                $data['address'] = $customerById->address;
                $cartTotal = $grand_total;
                $carts = Cart::getContent();
                return view('frontend.checkout.ssl_payment', compact('data', 'cartTotal', 'carts'));
            } elseif ($request->payment_method == 'paypal') {
                return 'paypal under process';
            } elseif ($request->payment_method == 'cod') {
    
                $data['tran_id'] = uniqid();
                $data['invoice_no'] = 'AD'.mt_rand(11111,99999);
                DB::table('orders')
                    ->where('transaction_id', $data['tran_id'])
                    ->updateOrInsert([
                        'customer_id' => $customer_id,
                        'shipping_id' => $shipping_id,
                        'delivery_fee' => $shipping_cost,
                        'name' => $customer_name,
                        'email' => $email_address,
                        'phone' => $mobile_no,
                        'amount' => $grand_total,
                        'payment_method' => 1,
                        'status' => 1,
                        'address' => $address,
                        'customer_comments' => $comments,
                        'transaction_id' => $tran_id,
                        'invoice_no' => $invoice_no,
                        'date' => Carbon::now()->format('Y-m-d'),
                    ]);
    
                $orderID = DB::getPdo()->lastInsertId();
                $oddata = array();
                foreach ($carts as $C_product) {
                    $oddata['orderId'] = $orderID;
                    $oddata['productId'] = $C_product->id;
                    $oddata['users_id'] = $C_product->attributes->user_id ?? 0;
                    $oddata['productName'] = $C_product->name;
                    $oddata['productPrice'] = $C_product->price;
                    $oddata['productQuantity'] = $C_product->quantity;
                    $oddata['color_name'] = $C_product->color_name;
                    $oddata['size'] = $C_product->size;
                    $oddata['productQuantity'] = $C_product->quantity;
                    $oddata['productImage'] = $C_product->attributes->image;
                    DB::table('order_details')->insert($oddata);
                    // get User ID
                    $product = Product::find($C_product->id);
                    $user_id = $product->user_id;
                    $total_qty+= $C_product->quantity;
                }
                //delete Visitor 
                $num = $request->mobile_no;
                DB::table('visitors')->where('phone',$num)->delete();
                  
                //Mailing
                $data['marchent'] = User::where('id', $user_id)->first();
                $pick_addr = $data['marchent']->pick_addr;
                $data['shipping_cost'] = $shipping_cost;
                $data['payment_method'] = 'Cash on delivery';
                $data['customer_info'] = Customer::where('id', $customer_id)->first();
                $customer_email = $data['customer_info']->email_address;
                $customer_mobile = $data['customer_info']->mobile_no;
                $data['shipping_info'] = Shipping::where('id', $shipping_id)->first();
    
                $data['marchent_email'] = $data['marchent']->email;
                $data['order_info'] = Order::where('id', $orderID)->first();
                $data['order_details_info'] = OrderDetail::where('orderId', $orderID)->get();
    
                $data['from_address'] = 'sales@atlantisdecora.com';
                $data['to_address'] = $customer_email;
                $data['subject'] = 'Order Successfully Placed To Atlantis Decora';
                $data['subject_m'] = 'New order from Atlantis Decora, Order ID#'.$orderID;
    
                $mail = Mail::send('emails.customer-order-mail', $data, function ($message) use ($data) {
                    $message->from($data['from_address'],'Atlantis Decora');
                    $message->to($data['to_address'])->subject($data['subject']);
                    $message->to($data['from_address'])->subject($data['subject']);
                });
                $mail = Mail::send('emails.marchent-order-mail', $data, function ($message) use ($data) {
                    $message->from($data['from_address'],'Atlantis Decora');
                    $message->to($data['marchent_email'])->subject($data['subject_m']);
                });
                $bulk = new BulkSms();
                $message = 'Order successfully placed to Atlantis Decora! Your Order ID : #'.$orderID;
                $bulk->send_message($this->getPhone($customer_mobile), $message);
                Cart::clear();
                $complete = true;
                return view('frontend.order_complete',compact('orderID','customer_email','grand_total','city','complete'));
                //return redirect('/')->withSuccess('Success message');
            }
        
        }else{
            return 'Your cart is empty';
        }
        
    } //saveOrder

    public function customerHome(){
        Cart::clear();
        return view('frontend.customer.customerHome');
    }
    public function sendOtp(Request $request){
        $this->validate($request,[
            'mobile_no' => 'required|regex:/(01)[0-9]{9}/',
            ]);
      $data['breadcrumb'] = "WE'VE SENT A ONE TIME OTP IN YOUR MOBILE NUMBER";
        $data['mobile_no'] = $request->mobile_no;
        session(['mobile_no' => $request->mobile_no]);
            $otp = rand(1000, 9999);
            $bulk = new BulkSms();
            $message = $otp.' is your (OTP) varification code for Atlantisdecora';
            $bulk->send_message($this->getPhone($request->mobile_no),$message);
            session(['mobile_no' => $request->mobile_no, 'otp' => $otp]);
            return view('frontend.checkout.checkOtp',$data);
    }
    public function customerLogin(Request $request){
        $email_address = $request->email_address;
        $password = $request->password;
        $result = DB::table('customers')
                ->where('email_address', $email_address)
                ->first();
        if (!Hash::check($password, $result->password)) {
            return redirect('checkout')->with('message', 'Invalid Password');
        }
        if($result){
            $customerId = $result->id;
            Session::put('customerID', $customerId);
            Session::put('customer_name', $result->customer_name);
            Session::put('shipping_cost', $request->shipping_cost);
            return redirect('checkout-shipping');
        }else{
            return redirect('checkout')->with('message', 'Invalid Email or Password');
        }

    }//customerLogin

    public function customerLogout(){
        Session::flush();
        return redirect('/');
    }

    public function ajaxGetShiping(Request $req){
        $id=$req->shipping_id;
        $shipping=Shipping::find($id);
        if($shipping){
            return response()->json([
                'success' => true,
                'data' => $shipping,
            ]);
        }else{
            return response()->json([
                'success' => false,
            ]);
        }
    }
    public function getThana(Request $req){
        $district_name= $req->district_name;
        $district = District::where('name',$district_name)->first();
        $district_id=$district->id;
       $thana = DB::select("select name,bn_name from upazilas where district_id='$district_id'");
        if($thana){
            echo "<option value=''>--Select Thana--</option>";
            foreach($thana as $value){
                echo "<option value='$value->name'>$value->name ( $value->bn_name )</option>";
            }
        }else{
            echo "<option value=''>Not Found!</option>";
        }
    }
}//CheckoutController
