<div class="main-panel" >
        <div class="content-wrapper">
          <div class="row ">
            <div class="col-lg-12">
<h3> Add Video </h3>
      <br clear="all">

<div class="row">
            <div class="col-lg-12">

              <div class="card " >
                <div class="card-body">
                
                      
                        <div align='left'   >
                 <!--- Start here -->

<?php
if(!isset($_COOKIE['userid'])){
?>
<script type="text/javascript">alert('You must login to view this page!')</script>
<script type="text/javascript">window.location.replace("login.php");</script>
<?php
  exit;
}
$msg='';
$vid_title='';
$vid_amount='';
$vid_desc='';
$newname='';
$uploadedVideoPath='';
$image='';
$video='';
if(isset($_POST['adduser'])){

$msg='';

$vcat=mysqli_real_escape_string($db,$_POST['vcat']);
$vid_title=mysqli_real_escape_string($db,$_POST['vid_title']);
$vid_desc=mysqli_real_escape_string($db,$_POST['vid_desc']);
$vid_amount=mysqli_real_escape_string($db,$_POST['vid_amount']);
$vrating=mysqli_real_escape_string($db,$_POST['vrating']);
$vactor=mysqli_real_escape_string($db,$_POST['vactor']);

////$vactor=$_COOKIE['userid'];
$error=0;

if($vrating=='3'){$vid_amount=50;
  $vplace=1;
}elseif($vrating=='4'){$vid_amount=50;
  $vplace=2;
}elseif($vrating=='6'){$vid_amount=100;
  $vplace=6;
}elseif($vrating=='7'){
  $vplace=7;
}else{
  $vplace=0;
}

   echo "<span class='loading'>Loading...<br>Please Wait</span><br>";
    
$name = strtolower($_FILES['video']['name']);
$coverimage = $_FILES['image']['name'];
if ($_FILES["video"]["error"] > 0)
    {
        $msg.= "<div class='alert alert-danger  uk-alert'>Invalid Video</div>";
        $error++;
    }
    else
    {
if($name!=''){

$Video_file_formats = array("mp4", "3gp", "avi" , "wmv" , "mov");
$filename = time();

//where you want your thumbnails to go
$filepath = 'uploads/vipvideos/';
//this should be an array of video paths
$videos = array();

$extension = substr($name, strrpos($name, '.')+1);
 $tmp = $_FILES['video']['tmp_name'];
$size = $_FILES['video']['size'];


if (in_array($extension, $Video_file_formats)) { 

if ($size < (1048576 * 120 )) {

$uploadedVideoPath=$filename.".".$extension;


if (move_uploaded_file($tmp,$filepath.$uploadedVideoPath)) { $msg.=  "<div class='alert-danger fade in' alert>Video Uploaded</div>";  $chkmsg="success"; }else{$msg.="<div class='alert-danger alert'>Could not upload video</div>";  $chkmsg="error"; $error++; }


}else{
$msg.="<div class='alert-danger alert'>Video Must be less than 120MB </div>";
 $chkmsg="error"; $error++;

}

}else{
 $msg.="<div class='alert-danger alert'>Invalid video file </div>";
 $chkmsg="error"; $error++; 

}


}

}

if($error=='0'){
function imageResize($imageResourceId,$width,$height) {


    $targetWidth =1280;
    $targetHeight =720;


    $targetLayer=imagecreatetruecolor($targetWidth,$targetHeight);
    imagecopyresampled($targetLayer,$imageResourceId,0,0,0,0,$targetWidth,$targetHeight, $width,$height);


    return $targetLayer;
}



if($coverimage!=''){
   $file = $_FILES['image']['tmp_name']; 
        $sourceProperties = getimagesize($file);
        $fileNewName = time();
        $folderPath = "uploads/vipvideoimages/";
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $imageType = $sourceProperties[2];
        $profile=$folderPath. $fileNewName.".". $ext;

        switch ($imageType) {


            case IMAGETYPE_PNG:
                $imageResourceId = imagecreatefrompng($file); 
                $targetLayer = imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
                imagepng($targetLayer,$profile);
                break;


            case IMAGETYPE_GIF:
                $imageResourceId = imagecreatefromgif($file); 
                $targetLayer = imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
                imagegif($targetLayer,$profile);
                break;


            case IMAGETYPE_JPEG:
                $imageResourceId = imagecreatefromjpeg($file); 
                $targetLayer = imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
                imagejpeg($targetLayer,$profile);
                break;


            default:
                $msg.= "<div class='alert-danger alert'>Invalid Image type.</div>";
          $error++;
                break;

        }

$newname= $fileNewName. ".". $ext;
  /*   $upload=   move_uploaded_file($file, $folderPath. $newname);
     if($upload){
        echo "Image Resize Successfully.";
     }else{
      echo "Failed Upload";
      exit;
     }
     */
    }

}

///echo "We got here";
if($error=='0'){


///// ends here 

  $sql3 = mysqli_query(
                    $db,"INSERT into tbl_vip_videos set actor_id='$vactor', vcat='$vcat', vid_title='$vid_title',vid_desc='$vid_desc',video='$uploadedVideoPath', coverimage='$newname',video_amount='$vid_amount',showit='0',xrating='$vrating',vplace='$vplace',promote='0',likes='0',views='0'");

  if($sql3){

                $msg.= "<div class='alert-success alert'>Successfully Created</div>";
                  $chkmsg="success";
                     ?><script type="text/javascript">window.location.replace("<?php echo SITE_URL; ?>/index.php?p=myvideos");</script> <?php
                }else{
                   $msg.= "<div class='alert-danger alert'>failed <br> An error occured, Kindly try again later</div>";
                      $chkmsg="error";
                }
                    
}else{

  $msg.="<div class='alert-danger alert'>There was an error. Kindly check and try again.</div>";

 $chkmsg="error";
}

}
?>            
                    <div>
                            <h1> Upload a  Videos </h1>




   
                        </div>

        <?php 
        $userid=$_COOKIE['userid'];
          $chk = mysqli_query(
                    $db,"SELECT * FROM tbl_users WHERE ref='$userid'");
$num_chk=mysqli_num_rows($chk);

/* remove the referral condition
if($num_chk<1){
  echo "<h3>You must refer at least 1 person before you will be approved to upload videos</h3>To refer people ask them to register using your referral ID  - ".$userid."";
}else{

*/

        if($msg!=''){echo $msg;
          ?>
<style type="text/css">.loading{display: none;} 
.uk-input{
  color: #ffffff;
}</style>

        <?php }
    $userid=$_COOKIE['userid']; 
 ?>
<form class="uk-child-width-1-1 uk-grid-small" uk-grid method="POST" action="" enctype="multipart/form-data">
<div class="uk-form-group">
                 
                  <?php

                  if($userid!='77' && $userid!='73' && $userid!='1261'){
?>
<input type="hidden" class="form-control" id="vactor" name="vactor" placeholder="User ID " value="<?php echo $userid; ?>" style="color: #ffffff;" required  >  <?php
                  }else{ ?> <label for="author">User ID</label>
                  <input type="text" class="form-control" id="vactor" name="vactor" placeholder="User ID " value="<?php echo $userid; ?>" style="color: #ffffff;" required  >  
         <span class="small" style="font-size: 11px">Change the userid only if you are uploading for someone else </span>
<?php 
}
?>                </div> 
           <input type="hidden" name="vcat" value="basic">
                <div class="uk-form-group">
                  <label for="fname"> Title of Show</label>
                <select name="vrating" class="form-control" style="color: #ffffff;" required>
                       <option value="">Select Show Title</option>  
                        <option value="7">The Roomies</option> 
                        <option value="8">The Good Gals</option>
                       <option value="9">I Want Your Ex</option>
            <!--      <option value="4">Campout Queen</option>      <option value="3">Reality TV</option> -->
          <?php 
          if($userid=='77' || $userid=='73' || $userid=='1261'){
            /*
            ?><option value="6">e30 RTC</option>
            <option value="5">Sing & Win</option>      <option value="1">Adult</option><option value="0">General</option>
           <?php 
           */
         } 
           ?>
                 
            
                
                </select>
                </div> 
<?php if($userid=='77' || $userid=='73' || $userid=='1261'){ ?>
                <div class="uk-form-group">
                  <label for="author">Enter Video Amount </label>
        <input type="number" name="vid_amount"  value="<?php echo $vid_amount; ?>"  style="color: #ffffff;" class="form-control" >
         
              </div> 
            <?php }else{?> <input type="hidden" name="vid_amount"  value="50" class="form-control" >  <?php } ?>

  <input type="hidden" class="form-control" id="vid_title" name="vid_title" placeholder="Enter Video Title " value="My Video"  style="color: #ffffff;" required >
    <input type="hidden" class="form-control" id="vid_title" name="vid_desc" placeholder="Enter Video Title " value="My Video Description"  style="color: #ffffff;" required >
<!--
               <div class="uk-form-group">
                  <label for="fname"> Video Title</label>
                  <input type="text" class="form-control" id="vid_title" name="vid_title" placeholder="Enter Video Title " value="<?php echo $vid_title; ?>"  style="color: #ffffff;" required >
                </div> 

                <div class="uk-form-group">
                  <label for="fname"> Video Description</label>
                  <Textarea class="form-control" id="vid_desc" name="vid_desc" placeholder="Enter Video Description " rows='5'  style="color: #ffffff;" required ><?php echo $vid_desc; ?></Textarea>
                </div> 

     -->

 <div class="uk-form-group">
                  <label for="video">Video Cover Image (.jpg,.png,.gif)</label> <br>
                  <input type="file" id="image" name="image"  class="form-control btn btn-primary" required=""><br><span class='small'>1280px by 720px</span>

                  <!--<p class="help-block">Example block-level help text here.</p>-->
             </div>
              
                 <div class="uk-form-group">
                  <label for="video">Video (.mp4,.3gp,.avi,.wmv,.mov)</label> <br>
                  <input type="file" id="video" name="video"  class="form-control btn btn-info"  required="">

                  <!--<p class="help-block">Example block-level help text here.</p>-->
             </div>



              <div class="box-footer" align="center"><br>
                <button type="submit" class=" btn btn-success" name="adduser">Submit</button><br><br>
              </div>

  
                    </div>

<?php ////} ?>








<!--- ENd Here -->
                         </div>


</div>





                </div>

              </div>


          </div>
        </div>
<br clear="all">
</div>
</div>
