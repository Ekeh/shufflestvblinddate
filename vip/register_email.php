<?php
$to = $email;
$subject = 'Welcome to ShufflesTV - Vix99';
$from = "<noreply@shufflestv.com>";
 
// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 
// Create email headers
$headers .= 'From: Vix99  '.$from."\r\n".
    'Reply-To: '.$from."\r\n" .
    'X-Mailer: PHP/' . phpversion();
 
// Compose a simple HTML email message
$message = '<html><body>';
$message .= '<h1 >Hi '.$fname.'!</h1>';
$message .= '<p >
Welcome to Vix99. A User Video Content Channel of ShufflesTV.com.
<br>
If you have any video that people will pay for, upload it here and EARN!
<br>
Watch “5Mins of Comic” at 9:00PM on Fridays on the subscription LIVESTREAM feed. 
<br>
You can also join in on the Livestream excitement when you take part in the Reward The Fans promo where you receive cash giveaways that is times 5 of your subscription amount (as low as N100) when/if you correctly guess and vote the answer to the Question Of The Day on the Livestream feed. 
<br>
You MUST also enter your bank details at the Reward The Fans link on the site to receive your winning.
<br>
Click on the Referral Code link on the drop down menu & enter your Bank Details if you wish to share your Referral Code with others and get 10% of their subscriptions.
<br>
All subscription are valid for only a week. Subscriptions are renewable weekly only if you wish to.
<br>
Your referral ID is '.$userid.'
<br>
Subscribe Today. 
<br>
If you have any issues, use our in-web enabled WhatsApp Chat.</p>
';
$message .= '</body></html>';
 
// Sending email
$sendmail=mail($to, $subject, $message, $headers,"-odb -f $from");
if($sendmail){
   //// echo '<div class="alert alert-block alert-success fade in">We sent your code to '.$email.'.</div>';
} else{
    echo '<div class="alert alert-block alert-danger"  id="myinfo">Unable to send email to user. Please try again.</div>';
}
?>

