<?php
  
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Session;
use Exception;
  
class RazorpayPaymentController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index(Request $request)
    {        
        // dd($request->id);
        $data=Product::find($request->id);
        $amount=($data->amount*100);

        return view('razorpayView',compact('data','amount'));
    }
  
    /**
     * Write code on Method
     *
     * 
     */
    public function store(Request $request)
    {
        // dd('fsdfds');

        $input = $request->all();
        
        $api = new Api("rzp_test_BHbtdhRAvN4syq", "obnVKDKdCZB3GmZtzueW6SqZ");
        
        $payment = $api->payment->fetch($input['razorpay_payment_id']);

        $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount'])); 
  
        if(count($input)  && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount'])); 
  
            } catch (Exception $e) {
                return  $e->getMessage();
                Session::put('error',$e->getMessage());
                return redirect()->back();
            }
        }
          
        Session::put('success', 'Payment successful');
        return redirect()->back();
    }
}