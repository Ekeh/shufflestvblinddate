  <?php
  
  $strphone='08066164453';
  $code='apple';
  $url = 'https://www.bulksmsnigeria.com/api/v1/sms/create?api_token=nKhQzO7kHxSXGoEv0rkfSSGF8jwTGgQkw47enlgWHsrgKWXe5Ae7XA90EKYz&from=ShufflesVIP&to=08066164453&body=Your one-time VIP Pass on shufflestv.com/vip is apple&dnd=2';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url); 
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/6.0 (Windows; U; Windows NT 5.1; en-US; rv:1.7.7) Gecko/20050414 Firefox/1.0.3");
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); 
$result = curl_exec ($ch); 
curl_close ($ch);


if($result){echo "done";}else{echo "failed";}
?>