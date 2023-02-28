<?php 
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Purchase;
use Illuminate\Http\Request; 
use Stripe\Stripe;
class PaymentController extends Controller {
    
      public function payment(Request $request) { 
      Stripe::setApiKey('sk_test_51HzOMSBvnNTFpcxYRQkZu2ZEG3XsYybVYxY29AZ9NmnmCAEKJwbUpzb2DtSOSrKa8k8oXGMelf5u0nwlvCbqHyK100AGj97DDm'); 
      $stripe = new \Stripe\StripeClient(

      'sk_test_51HzOMSBvnNTFpcxYRQkZu2ZEG3XsYybVYxY29AZ9NmnmCAEKJwbUpzb2DtSOSrKa8k8oXGMelf5u0nwlvCbqHyK100AGj97DDm' 
      );
      $customer= $stripe->customers->create([ 'description' => 'My First Test Customer (created for 
      API docs)',
      ]); $key = \Stripe\EphemeralKey::create( ['customer' => $customer->id], ['stripe_version' => 
      '2020-08-27']
      );
      return \Response::json($key);



      $charge=\Stripe\Charge::create([ 'amount'=>200, "currency"=>'usd', 'description'=>'test', 
      'source'=>$token->id,
      ]); 
      return \Response::json(['message'=> 'Payment Sent successfully'],200);

      }

    public function paymentIntent(Request $request) { 

    $content = json_decode($request->getContent()); 
    Stripe::setApiKey('sk_test_51HzOMSBvnNTFpcxYRQkZu2ZEG3XsYybVYxY29AZ9NmnmCAEKJwbUpzb2DtSOSrKa8k8oXGMelf5u0nwlvCbqHyK100AGj97DDm'); 
    $stripe = new \Stripe\StripeClient(

    'sk_test_51HzOMSBvnNTFpcxYRQkZu2ZEG3XsYybVYxY29AZ9NmnmCAEKJwbUpzb2DtSOSrKa8k8oXGMelf5u0nwlvCbqHyK100AGj97DDm' 
    ); $intent = \Stripe\PaymentIntent::create([
    'customer' => $content->customer,
    'amount' =>$content->amount*100, 'currency' => 'usd', ]); $client_secret 
    = $intent->client_secret; 
    return \Response::json(['secret'=> $client_secret ],200);

    }

    public function purchase(Request $request) { 
      $user=auth('api')->user();
      $article=Article::find($request->article_id);
      if($article)
      {
        $pay=Purchase::create(['user_id'=>$user->id,'article_id'=>$request->article_id,'cost'=>$article->cost]);
        return response()->json([
          'message' => 'Payment Done Successfully',
          'success'=>true
        
          ], 200);

      }
      else
      {
        return response()->json([
          'message' => 'This Article Doesnt Exist',
          'error'=>true
  
          ], 500);
      }

    }



   
    
}
