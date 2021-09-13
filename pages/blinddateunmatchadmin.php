<?php
$msg = '';
if(!isset($_COOKIE['userid']) || base64_decode($_COOKIE['role']) !== ROLE_ADMIN){
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
if(isset($_POST['matchusers'])) {
    $is_error = false;
    $from_email = mysqli_real_escape_string($db,$_POST['fromemail']);
    $to_email = mysqli_real_escape_string($db,$_POST['toemail']);
    $sql_from = mysqli_query($db,"SELECT userid FROM `tbl_users` WHERE email = '$from_email'");
    $sql_to = mysqli_query($db,"SELECT userid FROM `tbl_users` WHERE email = '$to_email'");
    if(mysqli_num_rows($sql_from) == 0) {
        $msg= "<b>Failed:</b><br> User with the mail '$from_email' was not found.";
        $is_error = true;
    }else if(mysqli_num_rows($sql_to) == 0) {
        $msg= "<b>Failed:</b><br> User with the mail '$to_email' was not found.";
        $is_error = true;
    }else {
        $from_row = mysqli_fetch_array($sql_from, MYSQLI_ASSOC);
        $to_row = mysqli_fetch_array($sql_to, MYSQLI_ASSOC);
        $userid = $from_row['userid'];
        $to_user = $to_row['userid'];
//TODO: Is the send on a date
            $checkUserOnDate = mysqli_query($db,"SELECT  id FROM tbl_blind_date_request WHERE (user_id='$userid' OR to_user_id = '$userid') AND status='" . BLIND_DATE_STATUS_ACCEPTED . "'");
//TODO: Is the friend on a date with this user
            $checkUserAndFriend = mysqli_query($db,"SELECT  id FROM tbl_blind_date_request WHERE ((user_id='$userid' AND to_user_id = '$to_user') OR (user_id='$to_user' AND to_user_id = '$userid')) AND (status='" . BLIND_DATE_STATUS_PENDING . "' OR status='" . BLIND_DATE_STATUS_ACCEPTED . "')");
            $friendOnDate = mysqli_query($db,"SELECT  id FROM tbl_blind_date_request WHERE (user_id='$to_user' OR to_user_id = '$to_user') AND status='" . BLIND_DATE_STATUS_ACCEPTED . "'");
            if(mysqli_num_rows($checkUserOnDate) > 0) {
                $msg= "The user '$from_email' is already on a date.";
                $is_error = true;
            }else if(mysqli_num_rows($checkUserAndFriend) > 0) {
                $msg= "The user '$from_email' already have an active request with this user.";
                $is_error = true;
            }else if(mysqli_num_rows($friendOnDate) > 0) {
                $msg= "The user '$to_email' is already on a date.";
                $is_error = true;
            }else{
                $q = mysqli_query($db,"INSERT into tbl_blind_date_request SET user_id='$userid', to_user_id='$to_user', created_at = '" . date('Y-m-d H:i:s', time()) . "', status = '" . BLIND_DATE_STATUS_ACCEPTED ."'");
                if(mysqli_affected_rows($db) > 0) {
                    mysqli_query($db, "UPDATE tbl_users SET profile_type = '" . PROFILE_ON_DATE . "' WHERE userid='$userid'");
                    mysqli_query($db, "UPDATE tbl_users SET profile_type = '" . PROFILE_ON_DATE . "' WHERE userid='$to_user'");
                    $msg= "Users matched successfully.";
                    unset($_POST);
                }else {
                    $msg= "Error occurred while sending your request.";
                    $is_error = true;
                }

            }
    }



}

if(isset($_POST['unmatch'])) {
    $request_id = mysqli_real_escape_string($db,$_POST['request_id']);
    $user_id = mysqli_real_escape_string($db,$_POST['user_id']);
    $to_user_id = mysqli_real_escape_string($db,$_POST['to_user_id']);
    $q = mysqli_query($db,"UPDATE tbl_blind_date_request SET status = '" . BLIND_DATE_STATUS_UNMATCHED ."' WHERE id = '$request_id'");
    if(mysqli_affected_rows($db) > 0) {
        mysqli_query($db, "UPDATE tbl_users SET profile_type = '" . PROFILE_FREE . "' WHERE userid='$user_id'");
        mysqli_query($db, "UPDATE tbl_users SET profile_type = '" . PROFILE_FREE . "' WHERE userid='$to_user_id'");
        $msg= "Users unmatched successfully.";
        unset($_POST);
    }else {
        $msg= "Error occurred while sending your request.";
        $is_error = true;
    }
}

$sql4 = mysqli_query($db,"SELECT bdr.*, fromu.userid AS fromuserid, fromu.fname AS fromfname, fromu.lname AS fromlname, fromu.username AS fromusername,
tou.userid AS touserid, tou.fname AS tofname, tou.lname AS tolname, tou.username AS tousername  FROM  tbl_blind_date_request AS bdr
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
                
                       <div id="video-gallery">
                       	<div align='center'>
                          <h4>Match Users</h4>
                           <p><?php if($msg!=''){ ?> <div class="msg <?=empty($is_error)?'text-success':'text-danger'?>"><?php echo $msg; ?></div>    <?php } ?></p>
                            <form  action="<?=$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']?>" method="post">
                              <section class="float-left">
                                  <div class="form-group">
                                      <label>From User</label>
                                      <input type="text" class="form-control" name="fromemail" value="<?=!empty($_POST['fromemail'])?$_POST['fromemail']:''?>" placeholder="From Email Address" required="required">
                                  </div>
                              </section>
                                <section class="float-left">
                                    <div class="form-group">
                                        <label>To User</label>
                                        <input type="text" class="form-control" name="toemail" value="<?=!empty($_POST['toemail'])?$_POST['toemail']:''?>" placeholder="To Email Address" required="required">
                                    </div>
                                </section>
                                <section class="float-left">
                                    <div class="form-group" style="margin-top: 30px;">
                                        <input type="submit" class="btn btn-primary btn-lg btn-block" name="matchusers" value="Match">
                                    </div>
                                </section>
                             </form>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>User Name</th>
                                    <th>To First Name</th>
                                    <th>To Last Name</th>
                                    <th>To User Name</th>
                                    <th>Date Matched</th>
                                    <th></th>
                                </tr>

                                </thead>
                                <tbody>
                                <?php
                                if($total_users > 0) {
                                    $sn = 0;
                                    while($row = mysqli_fetch_array($sql4,MYSQLI_ASSOC)) {
                                        $sn++;
                                        ?>
                                        <tr>
                                            <td><?=$sn?></td>
                                            <td><?=$row['fromfname']?></td>
                                            <td><?=$row['fromlname']?></td>
                                            <td><?=$row['fromusername']?></td>
                                            <td><?=$row['tofname']?></td>
                                            <td><?=$row['tolname']?></td>
                                            <td><?=$row['tousername']?></td>
                                            <td><?=$row['created_at']?></td>
                                            <td>
                                                <form action="<?= $_SERVER['PHP_SELF'] . "?" . $_SERVER['QUERY_STRING'] ?>"
                                                      method="post">
                                                    <input type="hidden" name="request_id"
                                                           value="<?=$row['id'] ?>"/>
                                                    <input type="hidden" name="to_user_id"
                                                           value="<?=$row['touserid'] ?>"/>
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
                                        <td colspan="7">No matched users</td>
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