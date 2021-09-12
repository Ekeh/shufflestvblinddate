<div class="main-panel" >
        <div class="content-wrapper">
          <div class="row ">
            <div class="col-lg-12" style="width:100%;min-height:600px">
<h3> Live Streaming</h3>

<h6>Note: Livestream Quality/Availability dependent on Network.</h6>

<?php

if(!isset($_COOKIE['userid'])){
?>
<script type="text/javascript">
alert("You Must Login to view this page");
 setTimeout(function(){
            window.location.href = 'https://shufflestv.com/register.php';
         }, 1000);
</script>
<?php
  exit;
}
?>
<!--
<div
  id="Container"
  style="padding-bottom:56.25%; position:relative; display:block; width: 100%"
>
  <iframe
    id="UstreamIframe"
    src="https://www.ustream.tv/embed/24071651"
    width="100%" height="100%"
    style="position:absolute; top:0; left: 0"
    allowfullscreen
    webkitallowfullscreen
    frameborder="0"
    referrerpolicy="no-referrer-when-downgrade"
  >
  </iframe>
</div>
-->
</div>
</div>
</div>
  </div>
  <script type="text/javascript">
  var blurred = false;
window.onblur = function() { blurred = true; };
window.onfocus = function() { blurred && (location.reload()); };

</script>

