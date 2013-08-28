<?php 

// Include Functions
require_once app_path().'/libraries/functions.php';
require_once app_path().'/libraries/swift_required.php';
require_once app_path(). '/libraries/postmark_swiftmailer.php';

class Oauth2Controller extends BaseController
{

    // namespace OAuth2\OAuth2;
    // namespace OAuth2\Token_Access;
    // namespace OAuth2\Exception as OAuth2_Exception;

    public function getIndex($provider) {


        $provider = OAuth2::provider($provider, array(
        'id' => '182024725307187',
        'secret' => '7812599b4ecfde73c953bfb051094e9c',
        ));

        if(! isset($_GET['code'])) {

            return $provider->authorize();

        }

        else
        {
            // Howzit?
            try
            {
                $params = $provider->access($_GET['code']);

                    $token = new Token_Access(array(
                        'access_token' => $params->access_token
                    ));
                    $user = $provider->get_user_info($token);

                // Here you should use this information to A) look for a user B) help a new user sign up with existing data.
                // If you store it all in a cookie and redirect to a registration page this is crazy-simple.
                echo "<pre>";
                var_dump($user);
            }

            catch (OAuth2_Exception $e)
            {
                show_error('That didnt work: '.$e);
            }
        }

    }
    
    public function email()
    {


        Mail::send('emails.auth.mail', array('token'=>'SAMPLE'), function($message){
            

            $transport = Swift_PostmarkTransport::newInstance('dbc54f11-c0d0-4004-a7b1-cfc576bf43a8');

            $mailer = Swift_Mailer::newInstance($transport);
            //Send the message

            $email = $_POST['email']; $name = $_POST['name']; $subject = $_POST['subject']; $msg = $_POST['msg']; 
            $message = Swift_Message::newInstance('Wonderful Subject')
                ->setFrom(array(Input::get('lee@trascope.com') => Input::get('Lee Test')))
                ->setTo(array(Input::get('leeibrah@gmail.com') => Input::get('Lee Kassim')))
                ->setBody($msg);
            
                $result = $mailer->send($message);
            if($result){                
                 return Redirect::to('contactus')->with('success', 'You have posted successfully');
            }else{
                return Redirect::to('contactus')->with('fail', 'Your details were not submitted');
            }
        });
        return Redirect::back();
    }

    public function email2()
    {
        

        $data = array(
            'name' => 'Lee Ibrah'
         );
        Mail::send('emails.auth.mail', $data, function($message)
        {
            $email = 'leeibrah@gmail.com';
        $name = 'Lee Ibrahim';
          //$message->from('leeibrah@gmail.com', 'Lee Site Admin');
          $message->to($email, $name)->subject('Welcome to My Site app!');            
           
        }); 
        return 'Sent';
        //return Redirect::back();
    }



    public function payment(){

        $querystring = '';
        $paypal_email = 'paypal@example.com';
        $return_url = 'http://example.com/payment-successful.htm';
        $cancel_url = 'http://example.com/payment-cancelled.htm';
        $notify_url = 'http://example.com/paypal/payments.php';

        $item_name = 'Test Item';
        $item_amount = 5.00;

        // Include Functions
        // include("functions.php");

        //Database Connection
        // $link = mysql_connect($host, $user, $pass);
        // mysql_select_db($db_name);

        $querystring;
        // Check if paypal request or response
        if (!isset($_POST["txn_id"]) && !isset($_POST["txn_type"]) && !isset($_POST["querystring"])){

            // Firstly Append paypal account to querystring
            $querystring .= "?business=".urlencode($paypal_email)."&";  
            
            // Append amount& currency (£) to quersytring so it cannot be edited in html
            
            //The item name and amount can be brought in dynamically by querying the $_POST['item_number'] variable.
            $querystring .= "item_name=".urlencode($item_name)."&";
            $querystring .= "amount=".urlencode($item_amount)."&";
            
            //loop for posted values and append to querystring
            foreach($_POST as $key => $value){
                $value = urlencode(stripslashes($value));
                $querystring .= "$key=$value&";
            }
            
            // Append paypal return addresses
            $querystring .= "return=".urlencode(stripslashes($return_url))."&";
            $querystring .= "cancel_return=".urlencode(stripslashes($cancel_url))."&";
            $querystring .= "notify_url=".urlencode($notify_url);
            
            // Append querystring with custom field
            //$querystring .= "&custom=".USERID;
            
            // Redirect to paypal IPN
            header('location:https://www.sandbox.paypal.com/cgi-bin/webscr'.$querystring);
            // header('location:https://www.paypal.com/cgi-bin/webscr'.$querystring);
            exit();

        }else{
            
            // Response from Paypal

            // read the post from PayPal system and add 'cmd'
            $req = 'cmd=_notify-validate';
            foreach ($_POST as $key => $value) {
                $value = urlencode(stripslashes($value));
                $value = preg_replace('/(.*[^%^0^D])(%0A)(.*)/i','${1}%0D%0A${3}',$value);// IPN fix
                $req .= "&$key=$value";
            }
            
            // assign posted variables to local variables
            $data['item_name']          = $_POST['item_name'];
            $data['item_number']        = $_POST['item_number'];
            $data['payment_status']     = $_POST['payment_status'];
            $data['payment_amount']     = $_POST['mc_gross'];
            $data['payment_currency']   = $_POST['mc_currency'];
            $data['txn_id']             = $_POST['txn_id'];
            $data['receiver_email']     = $_POST['receiver_email'];
            $data['payer_email']        = $_POST['payer_email'];
            $data['custom']             = $_POST['custom'];
                
            // post back to PayPal system to validate
            $header = "POST /cgi-bin/webscr HTTP/1.0\r\n";
            $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
            $header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
            
            $fp = fsockopen ('ssl://www.sandbox.paypal.com', 443, $errno, $errstr, 30); 
            
            if (!$fp) {
                // HTTP ERROR
            } else {    

                fputs ($fp, $header . $req);
                while (!feof($fp)) {
                    $res = fgets ($fp, 1024);
                    if (strcmp($res, "VERIFIED") == 0) {
                    
                        // Used for debugging
                        //@mail("you@youremail.com", "PAYPAL DEBUGGING", "Verified Response<br />data = <pre>".print_r($post, true)."</pre>");
                                
                        // Validate payment (Check unique txnid & correct price)
                        $valid_txnid = check_txnid($data['txn_id']);
                        $valid_price = check_price($data['payment_amount'], $data['item_number']);
                        // PAYMENT VALIDATED & VERIFIED!
                        if($valid_txnid && $valid_price){               
                            $orderid = updatePayments($data);       
                            if($orderid){                   
                                // Payment has been made & successfully inserted into the Database                              
                            }else{                              
                                // Error inserting into DB
                                // E-mail admin or alert user
                            }
                        }else{                  
                            // Payment made but data has been changed
                            // E-mail admin or alert user
                        }                       
                    
                    }else if (strcmp ($res, "INVALID") == 0) {
                    
                        // PAYMENT INVALID & INVESTIGATE MANUALY! 
                        // E-mail admin or alert user
                        
                        // Used for debugging
                        //@mail("you@youremail.com", "PAYPAL DEBUGGING", "Invalid Response<br />data = <pre>".print_r($post, true)."</pre>");
                    }       
                }       
            fclose ($fp);
            }   
        }

    }

}