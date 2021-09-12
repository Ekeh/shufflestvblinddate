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
                <h3 align="left">Search for videos</h3>
                       <div id="" align="center">
                       	<div align='center'>                      	   
<div class=""> <form method="post" action="index.php?p=allvideos">
                  <table width="100%"><tr><td > <input type="text" class="form-control" placeholder="search for name, ref ID etc" aria-label="search" aria-describedby="search" name="table_search" required ></td><td><input type="submit" name="search" value="SEARCH" class="btn btn-success"></td></tr></table>
                 </form>
              </div>          	    
                       	    
           <div class="" style="width:100%" align="left">
<!-- here we go -->



           
                <?php

              
                if(!isset($_POST['table_search'])){
                  echo "<H3>You must include a search item</h3>";
                exit; 
              }  

              $searchit=$_POST['table_search']; 
$nums2=0;
if(isset($_POST['previous']) || isset($_POST['psearch']))
{
$pcnt=$_POST['pcnt'];
$pcnt=$pcnt-20;
}elseif(isset($_POST['next']) || isset($_POST['nsearch']))
{
$pcnt=$_POST['pcnt'];
$pcnt=$pcnt+20;
}else{
$pcnt=0;
}

if(isset($_COOKIE['channel'])){
$mychannel=$_COOKIE['channel']; 
}

               
   $cnt=1;

  
$searchit = str_replace(' ', '', $searchit);


?> <div><h3> Searching for ... <?php echo $searchit; ?> </h3> </div> <?php


$sql=mysqli_query($db,"SELECT * FROM tbl_vip_videos INNER JOIN tbl_users
    ON tbl_vip_videos.actor_id = tbl_users.userid  where (tbl_vip_videos.vid_title like '%$searchit%' OR tbl_vip_videos.vid_desc like '%$searchit%'  OR tbl_vip_videos.vcat like '%$searchit%' OR tbl_users.username like '%$searchit%' OR tbl_users.fname like '%$searchit%' OR tbl_users.phone like '%$searchit%' OR tbl_users.email like '%$searchit%' OR tbl_users.userid like '%$searchit%') and tbl_vip_videos.showit='1' and tbl_vip_videos.xrating='7' and tbl_vip_videos.xrating!='1' ");    

$query=mysqli_query($db,"SELECT * FROM tbl_vip_videos INNER JOIN tbl_users
    ON tbl_vip_videos.actor_id = tbl_users.userid  where (tbl_vip_videos.vid_title like '%$searchit%' OR tbl_vip_videos.vid_desc like '%$searchit%'  OR tbl_vip_videos.vcat like '%$searchit%' OR tbl_users.username like '%$searchit%' OR tbl_users.fname like '%$searchit%' OR tbl_users.phone like '%$searchit%' OR tbl_users.email like '%$searchit%' OR tbl_users.userid like '%$searchit%') and tbl_vip_videos.showit='1' and tbl_vip_videos.xrating='7' and tbl_vip_videos.xrating!='1'  order by tbl_vip_videos.video_id desc limit 20 offset $pcnt");      



$sqlnum=mysqli_num_rows($sql);
$nums2=mysqli_num_rows($query);

$num=$pcnt+$nums2;
           

  $cnt=0;
  
 $cnt=1;

if(!isset($_POST['search']) && !isset($_POST['psearch'])  &&  !isset($_POST['nsearch'])  ){

  if($cnt=='1'){
?>
        <div style="padding: 10px" align="right"> 
                           <form method="post" action="">
        <input type="hidden" name="pcnt" value="<?php echo $pcnt; ?>">  
        <?php
if($pcnt>=20){
        ?>                  
      <input type="submit" name="previous" value="<< Previous" class="btn btn-info">
      <?php
    }


$chkit=$pcnt+20;

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

  }

    if(isset($_POST['search']) || isset($_POST['psearch'])  || isset($_POST['nsearch']) ){
?>
        <div style="padding: 10px" align="right"> 
                           <form method="post" action="">
        <input type="hidden" name="pcnt" value="<?php echo $pcnt; ?>"> 
        
            <input type="hidden" name="table_search" value="<?php echo $searchit; ?>"> 

        <?php
if($pcnt>=20){
        ?>                  
      <input type="submit" name="psearch" value="<< Previous" class="btn btn-info">
      <?php
    }
    ?>
       <?php

$chkit=$pcnt+20;

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
  }
    ?>
  

  <div id="video-gallery" class="row">


  <?php
if($nums2=='0'){
?><div style="padding:10px "><h2> No result found</h2></div><?php
      }else{


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
 <img src="<?php echo SITE_URL; ?>/uploads/vipvideoimages/<?php echo $row["coverimage"]; ?>" alt='<?php echo $row['vid_title']; ?>' style='width:190px; height: 230px; object-fit: fill; border-radius: 5px;' > 
       </a>  <br>
<div style="padding: 5px; text-align: left;"><?php echo substr($vid_title,0,60);

if(strlen($vid_title)>60){echo "...";} ?>
  <br>Ref ID: <?php echo $userid; ?>
</div>


            </div>
            

    <?php
    $cnt++;
  }


}


                ?>
                  </div>
<?php if(!isset($_POST['search'])  && $cnt=='1'  && !isset($_POST['psearch'])  &&  !isset($_POST['nsearch'])){ ?>
                  <div style="padding: 10px" align="right"> 
                           <form method="post" action="">
        <input type="hidden" name="pcnt" value="<?php echo $pcnt; ?>">  
        <?php
if($pcnt>=20){
        ?>                  
      <input type="submit" name="previous" value="<< Previous" class="btn btn-info">
      <?php
    }
    ?>
       <?php

$chkit=$pcnt+20;

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
<?php } 

    ///////if(isset($_POST['search']) || isset($_POST['psearch'])  || isset($_POST['nsearch']) ){
?>
        <div style="padding: 10px" align="right"> 
                           <form method="post" action="">
        <input type="hidden" name="pcnt" value="<?php echo $pcnt; ?>"> 
        
            <input type="hidden" name="table_search" value="<?php echo $searchit; ?>"> 

        <?php
if($pcnt>=20){
        ?>                  
      <input type="submit" name="psearch" value="<< Previous" class="btn btn-info">
      <?php
    }
    ?>
       <?php

$chkit=$pcnt+20;

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
 ////// }
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