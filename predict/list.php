 <style>
.entry.hover {
background-color: #cccccc;
}

</style>
<script
      src="https://code.jquery.com/jquery-2.2.4.min.js"
      integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
      crossorigin="anonymous"></script>

<script>
$(document).ready(function() {

    $(".cbox").on("click", function() {
        var numberOfChecked = $('input.cbox:checkbox:checked').length;
        if (numberOfChecked > 15) {
            $(this).prop('checked', false);
            alert("You can't select more than 15 contestants");
        }
    });

});
</script>

<div class="main-panel" >
        <div class="">
          <div class="row ">
            <div class="col-lg-12">
<h3 style="color: #ffffff; padding: 10px"> Predict the 15 CAMPMATES that would be selected </h3>
<h4 style="color: yellow; padding: 10px">Win your share of N250,000:00 on February 07, 2019 at 8:00PM</h4>
<p style=" padding: 10px"><b>Once you click the submit button, your prediction will be saved. YOU HAVE ONLY ONE TRY</b></p>
      <br clear="all">

<div class="row">
            <div class="col-lg-12">

              <div class=" " >
                <div class="card-body" >
                <div id="" class=""  align='center'>
                      <?php
                      $userid=$_COOKIE['userid'];
                      if(isset($_POST['predict'])){
if(!empty($_POST['check_list'])) {
  $nt=0;
    foreach($_POST['check_list'] as $check) {
    $d.= $_POST['check_list'][$nt];
    $d.= "~";
         $nt++;
    }

    if($nt>15){
       echo "<div class='alert alert-danger'>You can't select more than 15</div>";
    }else{
   $sqlz = mysqli_query($db,"SELECT * FROM tbl_predict where userid='$userid' ");
$nums2=mysqli_num_rows($sqlz);
if($nums2>0){
  echo "<div class='alert alert-danger'>You have already made a selection</div>";
}else{

      $sql3 = mysqli_query(
    $db,"INSERT into tbl_predict set userid='$userid', selection='$d'"); 
if($sql3){echo "<div class='alert alert-success'>Your selection has been noted</div>"; }else{echo "<div class='alert alert-danger'>Failed, Kindly try again later</div>"; }

     
    }
  }
}else{
  echo "<div class='alert alert-danger'>You have not made a selection</div>";
}

}
?>

<br>


<div align="left">
 <form method="post" action="" name="form1">
 <?php if(isset($_COOKIE['userid'])){ ?>
  <input type="submit" name="predict" value="SUBMIT" class="btn btn-primary">                  <?php
}else{   echo "<div class='alert alert-danger'>You must be logged in to make a prediction. <a href='".SITE_URL."/login.php'>LOGIN NOW</a></div>";}
   $cnt=1;

    
$query=mysqli_query($db,"SELECT * FROM tbl_requests INNER JOIN tbl_contestants
    ON tbl_requests.userid = tbl_contestants.conid  where   tbl_requests.channel='campoutnaija'  order by  fname asc ");      
       

while($row=mysqli_fetch_array($query))
  {
    ?>

      <!--<video id="video" src="<?php echo $row['video']; ?>"  controls="controls" preload="none" width="250px" height="190px"></video>-->
   
   
     
      <?php 
      $vote=$row['votes'];
      $postid=$row['postid'];
       $likes=$row['likes'];
      


      ?><div class="entry" >
      
        <div style="float: left; padding: 10px"><?php echo $cnt; ?></div>
   <div style="float: left; padding: 10px; left: 2px;">
            <?php
         if(file_exists("../uploads/thumbs/".$postid.".png")){ ?>
                      <img src="<?php echo SITE_URL.'/uploads/thumbs/'.$postid; ?>.png" alt="image" width="150px" height="150px" /> <?php 
}else{ ?>
<img src="<?php echo SITE_URL; ?>/uploads/coverimage/unknown.png" alt="image" width="120px" height="100px" /> 
  <?php
}
///  ?>                  <!-- 
                     
                   <div style="padding: 5px;color: #ffffff "><iframe frameborder="0" src="<?php echo SITE_MAIN;?>pages/vote.php?postid=<?php echo $postid; ?>&userid=<?php echo $uid; ?>&votes=<?php echo $vote; ?>&likes=<?php echo $likes; ?>" height="auto" style="max-height:50px" width="100%" scrolling="yes">
                                
                                </iframe><br>
</div> -->

  



     </div> <label style="float: left; "><div style="float: left; padding: 10px; left: 2px;">
      <input type='checkbox' name='check_list[]' value='<?php echo $postid; ?>' class='cbox' id='checkbox' style='padding:10px;'></div><div style="float: left; padding: 10px; left: 2px;"><?php echo $row['fname']; ?></div>
   
</label>
   </div>
<br clear="all">
    <?php
    $cnt++;
    
    
  }

                ?>   <?php if(isset($_COOKIE['userid'])){ ?>
  <input type="submit" name="predict" value="SUBMIT" class="btn btn-primary">                  <?php
}else{   echo "<div class='alert alert-danger'>You must be logged in to make a prediction. <a href='".SITE_URL."/login.php'>LOGIN NOW</a></div>";} ?>
</div>

</form>

                  </div>





                </div>

              </div>


            </div>
          </div>
        </div>

              

<br clear="all">

</div>
</div>
