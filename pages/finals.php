<div class="main-panel" >
        <div class="content-wrapper">
          <div class="row ">
            <div class="col-lg-12">


<div class="row">
            <div class="col-lg-12">

              <div class="card px-3" >
                <div class="card-body" >
                
                       <div id="video-gallery" class="row " align="center">
                       	<div align='center'>
               
 <!-- contents -->
 <style type="text/css">
   .content-grid {
    float: left;
    left:5px;
    width: 250px;
   }
 </style>
        <div class="main_content">

            <div class="main_content_inner">

            

                <div class="section-header mt-12">
                    <div>
                            <h3>Vote your favorite contestant</h3>




   
                        </div>
                 
                </div>

         
                <div class="" style="padding: 10px">
             <?php       
$selectdata = mysqli_query($db,"SELECT * FROM tbl_finalist where status='1'  order by rand()");
$cnt=1;
while($row=mysqli_fetch_array($selectdata))
  {

      $fid=$row['fid'];
      $fname=$row['fname'];
       $refid=$row['refid'];
     $picture=$row['picture'];

if($cnt=='4'){
    $cnt=1; ?> <div class="content-grid last-grid" align="center">
<?php }else{?><div class="content-grid" align="center"><?php }
    ?>

    
                          <a  href="index.php?p=qnapage&rid=<?php echo $fid; ?>"><img src="uploads/finalists/<?php echo $picture; ?>" title="<?php echo $fname; ?>"  style='border-radius: 5px;width: 200px; height: 200px;'/></a>
          <br><br>
                   
                        <a class="btn btn-primary" href="index.php?p=qnapage&rid=<?php echo $fid; ?>" style="">Vote <?php echo $fname; ?></a><div class="clear"> Ref ID - <?php echo $refid; ?> </div><br>
                    </div>

<?php 
$cnt++;
}
        
        ?>            </div>

  
 <br><br><br clear="all"><br>
  
              
                <div class="" style="padding: 10px">
             <?php       
$selectdata = mysqli_query($db,"SELECT * FROM tbl_finalist where status='0'  order by rand()");
$noc=mysqli_num_rows($selectdata);

if($noc=='0'){

}else{
$cnt=1;
?>   <br>
                <h4 style="color:#ff0000; padding: 10px; border-bottom: 2px #ffffff solid;">Evicted Contestants</h4> <?php
while($row=mysqli_fetch_array($selectdata))
  {

      $fid=$row['fid'];
      $fname=$row['fname'];
       $refid=$row['refid'];
     $picture=$row['picture'];

if($cnt=='4'){
    $cnt=1; ?> <div class="content-grid last-grid" align="center">
<?php }else{?><div class="content-grid" align="center"><?php }
    ?>
<img src="uploads/finalists/<?php echo $picture; ?>" title="<?php echo $fname; ?>"  style='border-radius: 5px; width: 200px; height: 200px;'/>
<br><br><?php echo $fname; ?>
                        <div class="clear"> Ref ID - <?php echo $refid; ?> </div><br>
                    </div><?php 
$cnt++;
}

}
?>           
        <br> <br clear="all"> <br> </div>

                </div>
</div>

              </div>


            </div>
          </div>
        </div>
<br clear="all">
</div>
</div>
