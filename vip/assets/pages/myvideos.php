 <!-- contents -->
        <div class="main_content" align="center">
<br>
              <div class="uk-card-default  p-6 uk-width-1-2@m rounded" style="padding: 10px; margin-top: 10px" align="left" >
<?php

$vid_title='';
$vid_amount='';
$vid_desc='';
$newname='';
$uploadedVideoPath='';
$image='';
$video='';
$msg='';
$cnt=0;

if(isset($_GET['delete'])){
  $postid=$_GET['postid'];

  $sql2 = mysqli_query($db,"DELETE from  tbl_vip_videos  where video_id='$postid'");
if($sql2){

$msg= "<div class='uk-alert-success fade in' uk-alert> Successfully Deleted </div>";
  $chkmsg="success";
}else{
   $msg= "<div class='uk-alert-danger fade in' uk-alert> failed <br> An error occured, Kindly try again later</div>";
      $chkmsg="error";
}
}


if(isset($_POST['deleteusernow'])){
   $postid=$_POST['postid'];
  $msg= "<div class='uk-alert-danger fade in' uk-alert> If you continue, the video will be permanently deleted<br>
 <a href='".SITE_VIP."/index.php?p=myvideos&postid=".$postid."&delete=1' class='button warning'> CONTINUE</a></div>";
  

  }elseif(isset($_POST['editusernow'])){


$vauthor=$_COOKIE['userid'];
$msg='';

$vcat=mysqli_real_escape_string($db,$_POST['vcat']);
$vid_title=mysqli_real_escape_string($db,$_POST['vid_title']);
$vid_desc=mysqli_real_escape_string($db,$_POST['vid_desc']);
$vid_amount=mysqli_real_escape_string($db,$_POST['vid_amount']);
$postid=mysqli_real_escape_string($db,$_POST['postid']);
$vactor=$_COOKIE['userid'];
$error=0;


 
    
$name = $_FILES['video']['name'];
$coverimage = $_FILES['image']['name'];

if($name!=''){
if ($_FILES["video"]["error"] > 0)
    {
        $msg.= "<div class='uk-alert-danger fade in' uk-alert>Invalid Video</div>";
        $error++;
    }
    else
    {
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

  if($coverimage!='' && $name!=''){
      $sql3 = mysqli_query(
                    $db,"UPDATE tbl_vip_videos set  vid_title='$vid_title',vid_desc='$vid_desc',video='$uploadedVideoPath', coverimage='$newname',video_amount='$vid_amount' where video_id='$postid'");
  }else
  if($coverimage!='' && $name==''){
      $sql3 = mysqli_query(
                    $db,"UPDATE tbl_vip_videos set  vid_title='$vid_title',vid_desc='$vid_desc', coverimage='$newname',video_amount='$vid_amount' where video_id='$postid'");
  }else
  if($coverimage=='' && $name!=''){
      $sql3 = mysqli_query(
                    $db,"UPDATE tbl_vip_videos set  vid_title='$vid_title',vid_desc='$vid_desc',video='$uploadedVideoPath',video_amount='$vid_amount' where video_id='$postid'");
  }else
  if($coverimage=='' && $name==''){
      $sql3 = mysqli_query(
                    $db,"UPDATE tbl_vip_videos set  vid_title='$vid_title',vid_desc='$vid_desc',video_amount='$vid_amount' where video_id='$postid'");
  }






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
                <div class=" mt-12">
                    <div>
                            <h1> Update Videos </h1>




   
                        </div>
                 
        <?php 

        if($msg!=''){echo $msg;}
        $userid=$_COOKIE['userid'];

        if(isset($_POST['edituser'])){
          $postid=$_POST['postid'];
          echo "<br>";
include("editvideo.php");
        }else{

$query=mysqli_query($db,"SELECT * FROM tbl_vip_videos INNER JOIN tbl_users
    ON tbl_vip_videos.actor_id = tbl_users.userid  where userid='$userid' order by video_id desc limit 30 ");      
          

while($row=mysqli_fetch_array($query))
  {
    ?>
    <div class="videoinfo" style="float: left; left:10px; padding:10px;">
      <video id="video" src="<?php echo SITE_URL; ?>/uploads/vipvideos/<?php echo $row['video']; ?>"  controls="controls" preload="none" width="250px" height="190px"></video>
     <div style="padding: 4px">
         <?php echo $row['vid_title']; ?> <br><?php echo $row['username']; ?> |
    
     | 
      <?php echo $row['likes']; ?> likes

       <?php /*if($_COOKIE['level']=='2'){ ?>

        <form method="POST" action="?p=viewlikes">
          <input type="hidden" name="postername" value="<?php  echo $row['fname']; ?> <?php echo $row['lname']; ?>">
<button type="submit" class="btn btn-info" name="trendit"><span class="fa fa-thumbs-up"></span> View Likes</button> 
<input type="hidden" name="postid" value="<?php echo $row['postid']; ?>">
</form>
       <?php } */ ?> 

</div>

<form method="POST" action="?p=myvideos">
  <input type="hidden" name="postername" value="<?php  echo $row['fname']; ?>; ?>">
  <input type="hidden" name="postid" value="<?php echo $row['video_id']; ?>">
  <!-- <button type="submit" class="btn btn-success" name="edituser"><span class="fa fa-eye"></span> View</button> -->


 <button type="submit" class="button primary"  name="edituser"><span class="fa fa-edit"></span> Edit</button>
 <?php if($row['showit']=='0'){   ?> <button type="submit" class="button success" name="activatenow"><span class="fa fa-check"></span>  Activate </button>  <?php }else{ ?>
  <button type="submit" class="button warning" name="deleteusernow"><span class="fa fa-trash"></span>  Delete</button>
<?php } ?>


</form>
</div>
            

    <?php
    $cnt++;
  }
}

?>

                    </div>
 <br clear="all"><br>
  
                

                </div>



            