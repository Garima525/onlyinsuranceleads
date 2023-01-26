<?php
// If is not empty it sets a header From in e-mail message (sets sender e-mail).
// Note: some hosting servers can block sending e-mails with custom From field in header.
//       If so, leave this field as empty.
define('FROM_EMAIL', 'info@onlyinsuranceleads.com');

// Recipient's e-mail. To this e-mail messages will be sent.
// e.g.: john@example.com
// multiple recipients e.g.: john@example.com, andy@example.com
define('TO_EMAIL', 'service@onlyinsuranceleads.com');


 /**
  * Function for sending messages. Checks input fields, prepares message and sends it.
  */
 function sendMessage()
 {
     // Variables init
     $json = array();
     $token = "9320087105434084715";

     // Retrieving content from send data by form.
     // If you don't want to use filter_input you can use direct access to variable using $_POST['<name_input_name>']
     // e.g. $_POST['email']

     $contact_name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
     $contact_email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
     $contact_tel = filter_input(INPUT_POST, 'tel', FILTER_SANITIZE_STRING);
     $contact_department = filter_input(INPUT_POST, 'department', FILTER_SANITIZE_STRING);
     $contact_sex = filter_input(INPUT_POST, 'sex', FILTER_SANITIZE_STRING);
     $salesperson_email = filter_input(INPUT_POST, 'salesperson_email', FILTER_SANITIZE_STRING);
     $salesperson_name = filter_input(INPUT_POST, 'salesperson_full_name', FILTER_SANITIZE_STRING);
     $salesperson_id = filter_input(INPUT_POST, 'salesperson_id', FILTER_SANITIZE_STRING);



     // if (empty($salesperson_email)) {
     //     $email_receivers_list = TO_EMAIL;
     // } else {
     //     $email_receivers_list = TO_EMAIL . ', '.$salesperson_email;
     // }
     $email_receivers_list = TO_EMAIL;
     // $email_receivers_list = 'hafiz.bilalahmadgondal@gmail.com';
     // $email_receivers_list = 'kkambeya@gmail.com';

     // $salesperson_email = $_REQUEST['salesperson_email'];

     // $salesperson_email = $this->input->post('salesperson_email');
     // Translation value to description
     switch ($contact_sex) {
         case "F":
             $contact_sex = "Female";
             break;
         case "M":
             $contact_sex = "Male";
             break;
         default:
             $contact_sex = "Not selected";
             break;
     }

     $contact_message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

     // This field is special, and it's used for anti bot protection.
     $contact_secret = filter_input(INPUT_POST, 'contact_secret', FILTER_SANITIZE_STRING);

     // Decode secret
     $contact_secret = strrev($contact_secret);

     // Token set in JS file have to be the same as in PHP file
     if ($contact_secret !== $token) {
         $json['result'] = 'NO_SPAM';
         header('Access-Control-Allow-Origin: *');
         echo json_encode($json);
         die();
     }

     // Adding e-mail headers
     $headers = "";
     if (FROM_EMAIL !== '') {
         $headers .= 'From: '.FROM_EMAIL."\r\n";
     }
     // $headers .= 'Reply-To: '.$contact_email."\r\n";
     if (empty($salesperson_email)) {
         $headers.= 'cc: david@onlyinsuranceleads.com,stephanie@onlyinsuranceleads.com'."\r\n";
     } else {
         $headers.= 'cc: david@onlyinsuranceleads.com,stephanie@onlyinsuranceleads.com,'.$salesperson_email."\r\n";
     }
     $headers .= 'Content-Type: text/plain; charset=UTF-8'."\r\n";

     /*
      * Formatting message.
      * It can be customizable in any way you like.
      */
     $title = 'Only Insurance Leads - New Message from '.$contact_name;
     $message = 'Hey,'."\n\n"
         .'You\'ve received a new message from your website. Check details below:'."\n\n"
         .'Sender\'s IP address: '.getIp()."\n"
         .'Name: '.$contact_name."\n"
         .'E-mail: '.$contact_email."\n"
         .'Phone number: '.$contact_tel."\n"
         .'Message:'."\n"
         .$contact_message."\n";

     if (!empty($salesperson_name)) {
         $message = $message.'PURL Name: '.$salesperson_name."\n"
             .'PURL ID: '.$salesperson_id."\n";
     }

     // Mail it!
     // $result = mail('hafiz.bilalahmadgondal@gmail.com', $title, $message, $headers);
     // $result = mail(TO_EMAIL, $title, $message, $headers);
     $result = mail($email_receivers_list, $title, $message, $headers);

     // echo "<script>
     //         if(agent) {
     //             if(agent.salesperson_phone.length > 0) {
     //                 $('#salesperson_email').val(agent.salesperson_email);
     //             }
     //         }
     //     </script>";

     // Notify contact form about result of sending.
     if ($result) {
         $json['result'] = 'OK';
     } else {
         $json['result'] = 'SEND_ERROR';
     }
     header('Access-Control-Allow-Origin: *');
     echo json_encode($json);
     die();
 }

 /**
  * Function for getting visitor's IP address
  * @return string
  */
 function getIp()
 {
     $ip = '';

     if (getenv('HTTP_CLIENT_IP')) {
         $ip = getenv('HTTP_CLIENT_IP');
     } elseif (getenv('HTTP_X_FORWARDED_FOR')) {
         $ip = getenv('HTTP_X_FORWARDED_FOR');
     } elseif (getenv('HTTP_X_FORWARDED')) {
         $ip = getenv('HTTP_X_FORWARDED');
     } elseif (getenv('HTTP_FORWARDED_FOR')) {
         $ip = getenv('HTTP_FORWARDED_FOR');
     } elseif (getenv('HTTP_FORWARDED')) {
         $ip = getenv('HTTP_FORWARDED');
     } elseif (getenv('REMOTE_ADDR')) {
         $ip = getenv('REMOTE_ADDR');
     } else {
         $ip = 'N/A';
     }

     return $ip;
 }

 /*
  * Calling a from only when post request is detected (data was sent by form).
  * Otherwise it returns OK, which can be handy with checking that the script is alive.
  */
 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     sendMessage();
     die();
 } else {
     if (function_exists('mail')) {
         die('OK');
     } else {
         die('PHP parser works, but <b>mail()</b> function seems to doesn\'t exist');
     }
 }
