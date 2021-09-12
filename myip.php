html>

<body>

<?php

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL,'http://www.ipchicken.com/');

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$contents = curl_exec ($ch);

curl_close ($ch);

echo "Your Server's IP : ".$contents;

?>

</body>

</html>