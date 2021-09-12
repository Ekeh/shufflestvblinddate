 <!-- contents -->
        <div class="main_content">

            <div class="main_content_inner" align="center">
               <div class="uk-card-default  p-6 uk-width-1-3@m rounded" style="padding: 10px" align="left" >
<?php


if(!isset($_COOKIE['username'])){
  ?>
<script type="text/javascript">
  alert("Kindly update your profile and include a username to continue.");
setTimeout(function(){
            window.location.href = '<?php echo SITE_VIP; ?>/index.php?p=profile';
         }, 500);
</script>
  <?php
  exit;
}



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
$xrating=mysqli_real_escape_string($db,$_POST['xrating']);
$vactor=$_COOKIE['userid'];
$error=0;


 
    
$name = $_FILES['video']['name'];
$coverimage = $_FILES['image']['name'];
if ($_FILES["video"]["error"] > 0)
    {
        $msg.= "<div class='uk-alert-danger fade in' uk-alert>Invalid Video</div>";
        $error++;
    }
    else
    {
if($name!=''){

$Video_file_formats = array("mp4", "3gp", "avi" , "wmv");
$filename = time();

//where you want your thumbnails to go
$filepath = '../uploads/vipvideos/';
//this should be an array of video paths
$videos = array();

$extension = substr($name, strrpos($name, '.')+1);
 $tmp = $_FILES['video']['tmp_name'];
$size = $_FILES['video']['size'];


if (in_array($extension, $Video_file_formats)) { 

if ($size < (1048576 * 120 )) {

$uploadedVideoPath=$filename.".".$extension;


if (move_uploaded_file($tmp,$filepath.$uploadedVideoPath)) { $msg.=  "<div class='uk-alert-danger fade in' uk-alert>Video Uploaded</div>";  $chkmsg="success"; }else{$msg.="<div class='uk-alert-danger fade in' uk-alert>Could not upload video</div>";  $chkmsg="error"; $error++; }


}else{
$msg.="<div class='uk-alert-danger fade in' uk-alert>Video Must be less than 120MB </div>";
 $chkmsg="error"; $error++;

}

}else{
 $msg.="<div class='uk-alert-danger fade in' uk-alert>Invalid video file </div>";
 $chkmsg="error"; $error++; 
}


}

}

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
        $folderPath = "../uploads/vipvideoimages/";
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
                $msg.= "<div class='uk-alert-danger fade in' uk-alert>Invalid Image type.</div>";
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

///echo "We got here";
if($error=='0'){


///// ends here 

  $sql3 = mysqli_query(
                    $db,"INSERT into tbl_vip_videos set actor_id='$vactor', vcat='$vcat', vid_title='$vid_title',vid_desc='$vid_desc',video='$uploadedVideoPath', coverimage='$newname',video_amount='$vid_amount',showit='1',xrating='$vrating'");

  if($sql3){

                $msg.= "<div class='uk-alert-success fade in' uk-alert>Successfully Created</div>";
                  $chkmsg="success";
                     ?><script type="text/javascript">window.location.replace("<?php echo SITE_VIP; ?>/index.php?p=myvideos");</script> <?php
                }else{
                   $msg.= "<div class='uk-alert-danger fade in' uk-alert>failed <br> An error occured, Kindly try again later</div>";
                      $chkmsg="error";
                }
                    
}else{

  $msg.="<div class='uk-alert-danger fade in' uk-alert>There was an error. Kindly check and try again.</div>";

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

if($num_chk<1){
  echo "<h3>You must refer at least 1 person before you will be approved to upload videos</h3>To refer people ask them to register using your referral ID  - ".$userid."";
}else{

        if($msg!=''){echo $msg;}
    $userid=$_COOKIE['userid']; ?>


             <h4>Username : <?php echo $_COOKIE['username'];
             ?></h4>
    
               <form class="uk-child-width-1-1 uk-grid-small" uk-grid method="POST" action="" enctype="multipart/form-data">

           <input type="hidden" name="vcat" value="basic">
     

                 <div class="uk-form-group">
                  <label for="author">Select Video Amount </label>
        <input type="number" name="vid_amount"  value="<?php echo $vid_amount; ?>" class="uk-input">
         
                </div> 


               <div class="uk-form-group">
                  <label for="fname"> Video Title</label>
                  <input type="text" class="uk-input" id="vid_title" name="vid_title" placeholder="Enter Video Title " value="<?php echo $vid_title; ?>" required >
                </div> 

                <div class="uk-form-group">
                  <label for="fname"> Video Description</label>
                  <Textarea class="uk-input" id="vid_desc" name="vid_desc" placeholder="Enter Video Description " rows='10' required ><?php echo $vid_desc; ?></Textarea>
                </div> 

                <div class="uk-form-group">
                  <label for="fname"> Video Rating</label>
                <select name="vrating" class="uk-input" required>
                       <option value="">Select Rating</option>
                  <option value="0">General</option>
                  <option value="1">Adult</option>
                </select>
                </div> 

 <div class="uk-form-group">
                  <label for="video">Video Cover Image (.jpg,.png,.gif)</label> <br>
                  <input type="file" id="image" name="image"  class="button primary" required=""><br><span class='small'>1280px by 720px</span>

                  <!--<p class="help-block">Example block-level help text here.</p>-->
             </div>
              
                 <div class="uk-form-group">
                  <label for="video">Video (.mp4,.3gp,.avi,.wmv)</label> <br>
                  <input type="file" id="video" name="video"  class="button info"  required="">

                  <!--<p class="help-block">Example block-level help text here.</p>-->
             </div>


              <div class="box-footer">
                <button type="submit" class="button success" name="adduser">Submit</button><br><br>
              </div>

  
                    </div>

<?php } ?>
 <br clear="all"><br>
  

                

                </div>



            