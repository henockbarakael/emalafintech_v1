<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use ReallySimpleJWT\Token;
use Brian2694\Toastr\Facades\Toastr;

class momoController extends Controller
{
    public function generateAccessToken(){
        $userId = 12;
        $secret = 'sec!ReT423*&';
        $expiration = time() + 3600;
        $issuer = 'localhost';
        $token = Token::create($userId, $secret, $expiration, $issuer);
        return $token;
    }
    Public function debit(Request $request){
        function maisha($length = 10) {
            $characters = '0123456789';
            $charactersLength = strlen($characters);
            $randomString = 'maisha.';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }
        function equity($length = 10) {
            $characters = '0123456789';
            $charactersLength = strlen($characters);
            $randomString = 'equity.';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }

        function bgfi($length = 10) {
            $characters = '0123456789';
            $charactersLength = strlen($characters);
            $randomString = 'bgfi.';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }

         $amount=$request->input('amount');
         $action="debit";
         $currency=$request->input('currency');
         $firstname="MaishaPay";
         $lastname="MaishaPay";

         $customer_number=$request->input('phone');
         $email="contact@maishapay.net";
         $root=$request->input('root');
         $method=$request->input('method');
         if ($root == "maishapay") {
            $callback_url = "https://maishapay.online/api/v1/debit_callback.php";
            $merchant_id="j/\$x8HUQhu6):o,eb";
            $merchant_secrete = "jzcrDkcGJbqWFt0Tab";
            $reference=maisha();
        }
        elseif ($root == "equitybank") {
            $callback_url = "https://maishapay.online/api/equitybcdc/v1/debit_callback.php";
            $merchant_id = "jGNfm+@|wmK>57bYb";
            $merchant_secrete = "jzSK4JJFhYjS7G8NQb";
            $reference=equity();
        }
        elseif ($root == "bgfibank") {
            $callback_url = "https://maishapay.online/api/bgfibank/v1/debit_callback.php";
            $merchant_id = "jwid^c>]CfWZV76Cb";
            $merchant_secrete = "jzGkYDmFP2zHdNIi5b";
            $reference=bgfi();
        }
         $url = 'https://paydrc.gofreshbakery.net/api/v5/';
         $curl_post_data = [
             "merchant_id" => $merchant_id,
             "merchant_secrete"=> $merchant_secrete,
             "amount" => $amount,
             "action" => $action,
             "customer_number" => $customer_number,
             "currency" => $currency,
             "firstname" =>$firstname,
             "lastname" => $lastname,
             "email" => $email,
             "method" => $method,
             "reference" => $reference,
             "callback_url" => $callback_url
         ];
         $data = json_encode($curl_post_data);
         $ch=curl_init();
         curl_setopt($ch, CURLOPT_URL, $url);
		 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		 curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
		 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		 curl_setopt($ch, CURLOPT_POST, true);
		 curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
         curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
         $curl_response = curl_exec($ch);
         $curl_decoded = json_decode($curl_response,true);
             $comment = $curl_decoded['Comment'];
             $status = $curl_decoded['Status'];
             $transaction_id = $curl_decoded['Transaction_id'];
             $created_at = $curl_decoded['Created_At'];
             $updated_at = $curl_decoded['Updated_At'];
             DB::table('momo_transactions')->insert(
                [
                    'customer_number' => $customer_number,
                    'amount' => $amount,
                    'currency' => $currency,
                    'comment' => $comment,
                    'action' => $action,
                    'method' => $method,
                    'status' => $status,
                    'reference' => $reference,
                    'transaction_id' => $transaction_id,
                    'operator' => $root,
                    'created_at' => $created_at,
                    'updated_at' => $updated_at
                ]
            );
            if ($status == "Success") {
                Toastr::success('Transaction envoyée avec succès :)','Success');
                return redirect()->back();
            }
            else {
                Toastr::success('La transaction n\'a pas aboutie :)','Error');
                return redirect()->back();
            }

    }

    Public function credit(Request $request){
        function maishaCredit($length = 10) {
            $characters = '0123456789';
            $charactersLength = strlen($characters);
            $randomString = 'maisha.';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }
        function equityCredit($length = 10) {
            $characters = '0123456789';
            $charactersLength = strlen($characters);
            $randomString = 'equity.';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }

        function bgfiCredit($length = 10) {
            $characters = '0123456789';
            $charactersLength = strlen($characters);
            $randomString = 'bgfi.';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }


         $amount=$request->input('amount');
         $action="credit";
         $currency=$request->input('currency');
         $firstname="MaishaPay";
         $lastname="MaishaPay";

         $customer_number=$request->input('phone');
         $email="contact@maishapay.net";
         $method=$request->input('method');
         $root=$request->input('root');

         if ($root == "maishapay") {
            $callback_url = "https://maishapay.online/api/v1/credit_callback.php";
            $merchant_id="j/\$x8HUQhu6):o,eb";
            $merchant_secrete = "jzcrDkcGJbqWFt0Tab";
            $reference=maishaCredit();
         }
         elseif ($root == "equitybank") {
            $callback_url = "https://maishapay.online/api/equitybcdc/v1/credit_callback.php";
            $merchant_id = "jGNfm+@|wmK>57bYb";
            $merchant_secrete = "jzSK4JJFhYjS7G8NQb";
            $reference=equityCredit();
         }
         elseif ($root == "bgfibank") {
            $callback_url = "https://maishapay.online/api/bgfibank/v1/credit_callback.php";
            $merchant_id = "jwid^c>]CfWZV76Cb";
            $merchant_secrete = "jzGkYDmFP2zHdNIi5b";
            $reference=bgfiCredit();
         }
         $url = 'https://paydrc.gofreshbakery.net/api/v5/';
         $curl_post_data = [
             "merchant_id" => $merchant_id,
             "merchant_secrete"=> $merchant_secrete,
             "amount" => $amount,
             "action" => $action,
             "customer_number" => $customer_number,
             "currency" => $currency,
             "firstname" =>$firstname,
             "lastname" => $lastname,
             "email" => $email,
             "method" => $method,
             "reference" => $reference,
             "callback_url" => $callback_url
         ];
         $data = json_encode($curl_post_data);
         $ch=curl_init();
         curl_setopt($ch, CURLOPT_URL, $url);
		 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		 curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
		 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		 curl_setopt($ch, CURLOPT_POST, true);
		 curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
         curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
         $curl_response = curl_exec($ch);
         $curl_decoded = json_decode($curl_response,true);
             $comment = $curl_decoded['Comment'];
             $status = $curl_decoded['Status'];
             $transaction_id = $curl_decoded['Transaction_id'];
             $created_at = $curl_decoded['Created_At'];
             $updated_at = $curl_decoded['Updated_At'];
             DB::table('momo_transactions')->insert(
                [
                    'customer_number' => $customer_number,
                    'amount' => $amount,
                    'currency' => $currency,
                    'comment' => $comment,
                    'action' => $action,
                    'method' => $method,
                    'status' => $status,
                    'reference' => $reference,
                    'transaction_id' => $transaction_id,
                    'operator' => $root,
                    'created_at' => $created_at,
                    'updated_at' => $updated_at
                ]
            );
            if ($status == "Success") {
                Toastr::success('Transaction envoyée avec succès :)','Success');
                return redirect()->back();
            }
            else {
                Toastr::success('La transaction n\'a pas aboutie :)','Error');
                return redirect()->back();
            }

    }
}
