<?php
$msg = '';
if(!isset($_COOKIE['userid'])){
    ?>
    <script type="text/javascript">
        alert("You Must Login to view this page");
        setTimeout(function(){
         window.location.href = '<?=SITE_MAIN?>index.php?p=login';
        }, 1000);
    </script>
    <?php
    exit;
}
if(isset($_POST['unmatch'])) {
    $request_id = mysqli_real_escape_string($db,$_POST['request_id']);
    $user_id = mysqli_real_escape_string($db,$_POST['user_id']);
    $to_user_id = mysqli_real_escape_string($db,$_POST['to_user_id']);
    $q = mysqli_query($db,"UPDATE tbl_blind_date_request SET status = '" . BLIND_DATE_STATUS_UNMATCHED ."' WHERE id = '$request_id'");
    if(mysqli_affected_rows($db) > 0) {
        mysqli_query($db, "UPDATE tbl_users SET profile_type = '" . PROFILE_FREE . "' WHERE userid='$userid'");
        mysqli_query($db, "UPDATE tbl_users SET profile_type = '" . PROFILE_FREE . "' WHERE userid='$to_user'");
        $msg= "Users unmatched successfully.";
        unset($_POST);
    }else {
        $msg= "Error occurred while sending your request.";
        $is_error = true;
    }
}

$sql4 = mysqli_query($db,"SELECT bdr.*, fromu.userid AS fromuserid, fromu.fname AS fromfname, fromu.lname AS fromlname,
tou.userid AS touserid, tou.fname AS tofname, tou.lname AS tolname  FROM  tbl_blind_date_request AS bdr
JOIN `tbl_users` AS fromu ON bdr.user_id = fromu.userid
JOIN `tbl_users` AS tou ON bdr.to_user_id = tou.userid WHERE bdr.status = '" . BLIND_DATE_STATUS_ACCEPTED ."'");
$total_users = mysqli_num_rows($sql4);


?>



<div class="main-panel" >
        <div class="content-wrapper">
          <div class="row ">
            <div class="col-lg-12">
<h3>Blind Date</h3>
      <br clear="all">

<div class="row">
            <div class="col-lg-12">

              <div class="card px-3" >
                <div class="card-body" >
                
                       <div id="video-gallery" class="row ">
                       	<div align='center'>
                          <h4>Match Users</h4>
                           <p><?php if($msg!=''){ ?> <div class="msg <?=empty($is_error)?'text-success':'text-danger'?>"><?php echo $msg; ?></div>    <?php } ?></p>
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>To First Name</th>
                                        <th>To Last Name</th>
                                        <th>Date Matched</th>
                                        <th></th>
                                    </tr>

                                    </thead>
                                    <tbody>
                                    <?php
                                    if($total_users > 0) {
                                     while($row = mysqli_fetch_array($sql4,MYSQLI_ASSOC)) {
                                         ?>
                                         <tr>
                                             <td>S/N</td>
                                             <td><?=$row['fromfname']?></td>
                                             <td><?=$row['fromlname']?></td>
                                             <td><?=$row['tofname']?></td>
                                             <td><?=$row['tolname']?></td>
                                             <td><?=$row['created_at']?></td>
                                             <td>
                                                 <form action="<?= $_SERVER['PHP_SELF'] . "?" . $_SERVER['QUERY_STRING'] ?>"
                                                       method="post">
                                                     <input type="hidden" name="request_id"
                                                            value="<?=$row['id'] ?>"/>
                                                     <button type="submit" name="unmatch" value="1"
                                                             class="btn btn-danger"
                                                             style="float: left; position: relative; left: 10px;">Unmatch<i class="fa fa-arrow-right"></i>
                                                     </button>
                                                 </form>
                                             </td>
                                         </tr>
                                         <?php
                                     }
                                    }else {
                                        ?>
                                        <tr>
                                            <td colspan="5">No matched users</td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>


</div>





                </div>

              </div>


            </div>
          </div>
        </div>
<br clear="all">
</div>
</div>
</div>