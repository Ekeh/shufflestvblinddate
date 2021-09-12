<style>
    .ulist li {
        display:inline;
        list-style:none;
        
        float:left;
        padding:10px 5px 10px 5px;
        margin-bottom:10px;
    }
</style>
<?php

?><div class="main-panel" >
        <div class="content-wrapper">
          <div class="row ">
            <div class="col-lg-12" align='center'>

      <br clear="all"><br>

<div class="row">
            <div class="col-lg-12">

              <div class="card" >
                <div class="card-body" >
                <h3 align="left">Most Recent Entries</h3>
                       <div id="" align="center">
                       	<div align='center'>                      	   
<div class=""> <form method="post" action="index.php?p=allvideos">
                  <table width="100%"><tr><td > <input type="text" class="form-control" placeholder="search for name, ref ID etc" aria-label="search" aria-describedby="search" name="table_search" required ></td><td><input type="submit" name="search" value="SEARCH" class="btn btn-success"></td></tr></table>
                 </form>
              </div>          	    
                       	    
           <div class="" style="width:100%" align="left">
<!-- here we go -->



           
                <?php

 
$nums2=0;
if(isset($_POST['previous']) || isset($_POST['psearch']))
{
$pcnt=$_POST['pcnt'];
$pcnt=$pcnt-10;
}elseif(isset($_POST['next']) || isset($_POST['nsearch']))
{
$pcnt=$_POST['pcnt'];
$pcnt=$pcnt+10;
}else{
$pcnt=0;
}

if(isset($_COOKIE['channel'])){
$mychannel=$_COOKIE['channel']; 
}

               
   $cnt=1;

  



$sql=mysqli_query($db,"SELECT * FROM tbl_vip_videos INNER JOIN tbl_users
    ON tbl_vip_videos.actor_id = tbl_users.userid  where  tbl_vip_videos.showit='1' and tbl_vip_videos.xrating='7' and tbl_vip_videos.xrating!='1' order by tbl_vip_videos.video_id desc");    

$query=mysqli_query($db,"SELECT * FROM tbl_vip_videos INNER JOIN tbl_users
    ON tbl_vip_videos.actor_id = tbl_users.userid  where  tbl_vip_videos.showit='1' and tbl_vip_videos.xrating='7' and tbl_vip_videos.xrating!='1'  order by tbl_vip_videos.video_id desc limit 10 offset $pcnt");      



$sqlnum=mysqli_num_rows($sql);
$nums2=mysqli_num_rows($query);

$num=$pcnt+$nums2;
           

  $cnt=0;
  
 $cnt=1;

  if($cnt=='1'){
?>
        <div style="padding: 10px" align="right"> 
                           <form method="post" action="">
        <input type="hidden" name="pcnt" value="<?php echo $pcnt; ?>">  
        <?php
if($pcnt>=10){
        ?>                  
      <input type="submit" name="previous" value="<< Previous" class="btn btn-info">
      <?php
    }


$chkit=$pcnt+10;

if($chkit<$sqlnum){
  ///echo $sqlnum;
  //echo "<br>";
   ///echo $pcnt;
        ?>  
       <input type="submit" name="next" value="Next >>" class="btn btn-info">
          <?php
    }
?>   </form> </div> <?php


  }

?>
        <div style="padding: 10px" align="right"> 
                           <form method="post" action="">
        <input type="hidden" name="pcnt" value="<?php echo $pcnt; ?>"> 
        
    

        <?php
if($pcnt>=10){
        ?>                  
      <input type="submit" name="psearch" value="<< Previous" class="btn btn-info">
      <?php
    }
    ?>
       <?php

$chkit=$pcnt+10;

if($chkit<$sqlnum){
  ///echo $sqlnum;
  //echo "<br>";
   ///echo $pcnt;
        ?>  
       <input type="submit" name="nsearch" value="Next >>" class="btn btn-info">
          <?php
    }
?>   </form>
  </div>


  <div id="video-gallery" class="row">


<?php

while($row=mysqli_fetch_array($query))
  {
    ?>
<!--<video id="video" src="<?php echo $row['video']; ?>"  controls="controls" preload="none" width="250px" height="190px"></video>-->
 <?php 
      $vote=$row['views'];
      $postid=$row['video_id'];
       $likes=$row['likes'];
       $vid_title=$row['vid_title'];
        $userid=$row['userid'];
      ?>
  <div class="" align="center" style="margin-right:5px; margin-bottom: 5px; float:left;padding:2px; width:250px;">
    <a href="<?php echo SITE_URL; ?>?p=more&vid=<?php echo $row['video_id']; ?>&aid=<?php echo $row['actor_id']; ?>" class="video-post">
 <img src="<?php echo SITE_URL; ?>/uploads/vipvideoimages/<?php echo $row["coverimage"]; ?>" alt='<?php echo $row['vid_title']; ?>' width='230px' height='190px' style='object-fit: cover; border-radius: 5px;' > 
       </a>  <br>
<div style="padding: 5px; text-align: left;"><?php echo substr($vid_title,0,60);

if(strlen($vid_title)>60){echo "...";} ?>
  <br>Ref ID: <?php echo $userid; ?>
</div>


            </div>
            

    <?php
    $cnt++;
  }





                ?>
                  </div>

                  <div style="padding: 10px" align="right"> 
                           <form method="post" action="">
        <input type="hidden" name="pcnt" value="<?php echo $pcnt; ?>">  
        <?php
if($pcnt>=10){
        ?>                  
      <input type="submit" name="previous" value="<< Previous" class="btn btn-info">
      <?php
    }
    ?>
       <?php

$chkit=$pcnt+10;

if($chkit<$sqlnum){
  ///echo $sqlnum;
  //echo "<br>";
   ///echo $pcnt;
        ?>  
       <input type="submit" name="next" value="Next >>" class="btn btn-info">
          <?php
    }
    ?>
    </form>
  </div>
<?php 


?>
        <div style="padding: 10px" align="right"> 
                           <form method="post" action="">
        <input type="hidden" name="pcnt" value="<?php echo $pcnt; ?>"> 
        
      

        <?php
if($pcnt>=10){
        ?>                  
      <input type="submit" name="psearch" value="<< Previous" class="btn btn-info">
      <?php
    }
    ?>
       <?php

$chkit=$pcnt+10;

if($chkit<$sqlnum){
  ///echo $sqlnum;
  //echo "<br>";
   ///echo $pcnt;
        ?>  
       <input type="submit" name="nsearch" value="Next >>" class="btn btn-info">
          <?php
    }
?>   </form>
  </div>
  <?php

    ?>
    

                </div>
                <!-- /.box-body -->
                <br clear='all'>
                <br><!--
                <div class="box-footer text-center">
                  <a href="?p=viewfinalists" class="uppercase">View All Users</a>
                </div> -->
                <!-- /.box-footer -->
              </div>
              <!--/.box -->
            </div>
                       	    
 




              </div>


            </div>
          </div>
        </div>
<br clear="all">
</div>
</div>
</div>