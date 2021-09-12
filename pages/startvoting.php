<style>
    .ulist li {
        display:inline;
        list-style:none;
        
        float:left;
        padding:10px 5px 10px 5px;
        margin-bottom:10px;
    }
</style><div class="main-panel" >
        <div class="content-wrapper">
          <div class="row ">
            <div class="col-lg-12" align='center'>
<h3> Vote a contestant</h3>
<i>Voting ends 2PM Saturday, 15th February 2020</i><br>
      <br clear="all"><br>

<div class="row">
            <div class="col-lg-12">

              <div class="card px-3" >
                <div class="card-body" >
                
                       <div id="video-gallery" class="row " align="center">
                       	<div align='center'>
                       	   <?php
                       	   if(isset($_COOKIE['userid'])){
                       	       $userid=$_COOKIE['userid'];
                       	  
                       	        $getcredit=mysqli_query($db,"SELECT * FROM tbl_users where userid='$userid'");
                      while($rod=mysqli_fetch_array($getcredit))
  { 
                       	     ///  echo $rod['credit'];
                       	     ///  echo " Voting Credits";
  }
                       	   }else{
                       	       echo "You must <a href='".SITE_MAIN."login.php'> register/login</a> to vote a contestant";
                       	   }
                       	   
                       	   ?>
                       	    
                       	    
           <div class="box-body no-padding" style="width:100%">
                  <ul class="ulist">
<?php 
                    $query=mysqli_query($db,"SELECT * FROM tbl_selection order by username asc");         
                

while($row=mysqli_fetch_array($query))
  { ?>
                    <li align='center'>
                     <?php 
                     $imgs="uploads/finalists/".$row['photo'].""; 
                     if(file_exists($imgs)){$img=$imgs;}else{$img='dashboard/dist/img/user1-128x128.jpg';}   ?>
                      <img src="<?php echo $img; ?>" alt="User Image" width="200px" height="200px">
                      <br>
                     <?php ////echo $row['fname']; echo $row['lname']; 
                     $users=$row['username'];
                  $user=substr($users,0,15);
                    echo $user;
 $postid=$row['selection_id'];
  $vote=$row['vote'];
                     ?>


            <br>
               
    <!-- <iframe frameborder="0" src="<?php echo SITE_MAIN;?>pages/vote_alone.php?postid=<?php echo $postid; ?>&userid=<?php echo $uid; ?>&votes=<?php echo $vote; ?>" height="auto" width="auto" style="max-width:100px" scrolling="yes">
                                
                                </iframe>-->
                            
                    
                    </li>

                  <?php } ?>
                   
                  </ul>
            
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