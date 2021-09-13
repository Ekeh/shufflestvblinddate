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

global $user_id;
$user_id = $_COOKIE['userid'];
if(isset($_POST['unmatch']) || isset($_GET['chargeaccepted'])) {
$check_unmatch = mysqli_query($db,"SELECT id FROM tbl_blind_date_request WHERE unmatched_request_user_id  = '$user_id'");
if(mysqli_num_rows($check_unmatch) > 0) {
    if($_GET['chargeaccepted'] === '1') {
        //TODO: charge users wallet
        $checkCredit = mysqli_query($db,"SELECT credit FROM  tbl_users  WHERE userid='$user_id'");
        $credit = 0;
        if($row = mysqli_fetch_assoc($checkCredit)) {
            $credit =  intval($row['credit']);
        }
        if($credit < AMOUNT_PER_UNMATCH) {
            $msg= "Insufficient credit. Please, fund your wallet.";
            $is_error = true;
        }else {

            $request_id = mysqli_real_escape_string($db, $_GET['request_id']);
            $to_user_id = mysqli_real_escape_string($db, $_GET['to_user_id']);
            if (empty($request_id) || empty($to_user_id)) {
                ?>
                <script type="text/javascript">
                    alert("Invalid request. Click to refresh.");
                    setTimeout(function () {
                        window.location.href = 'index.php?p=blinddateunmatch';
                    }, 1000);
                </script>
                <?php
            } else {
                if (unmatch($db, $user_id, $request_id, $to_user_id)) {
                    $debit = mysqli_query($db, "UPDATE  tbl_users set credit=credit - '" . AMOUNT_PER_UNMATCH . "'  WHERE userid='$user_id'");
                    ?>
                    <script type="text/javascript">
                        alert("Users unmatched successfully.");
                        setTimeout(function () {
                            window.location.href = 'index.php?p=blinddateunmatch';
                        }, 1000);
                    </script>
                    <?php
                } else {
                    $msg = "Error occurred while sending your request.";
                    $is_error = true;
                }
            }
        }
    }else {
        ?>
        <script>
            if (confirm("You will be charged 'NGN<?=AMOUNT_PER_UNMATCH?>' to be unmatched. Press Ok to continue.")) {
                window.location.href = 'index.php?p=blinddateunmatch&chargeaccepted=1&request_id=<?=$_POST['request_id']?>&to_user_id=<?=$_POST['to_user_id']?>';
            }
        </script>
        <?php
    }
}else {
    $request_id = mysqli_real_escape_string($db,$_POST['request_id']);
    $to_user_id = mysqli_real_escape_string($db,$_POST['to_user_id']);
    if(unmatch($db, $user_id, $request_id, $to_user_id)) {
        $msg= "Users unmatched successfully.";
    }else {
        $msg= "Error occurred while sending your request.";
        $is_error = true;
    }
}
}

function unmatch($db, $user_id, $request_id, $to_user_id) {
    $q = mysqli_query($db,"UPDATE tbl_blind_date_request SET status = '" . BLIND_DATE_STATUS_UNMATCHED ."', unmatched_request_user_id  = '$user_id' WHERE id = '$request_id'");
    if(mysqli_affected_rows($db) > 0) {
        mysqli_query($db, "UPDATE tbl_users SET profile_type = '" . PROFILE_FREE . "' WHERE userid='$user_id'");
        mysqli_query($db, "UPDATE tbl_users SET profile_type = '" . PROFILE_FREE . "' WHERE userid='$to_user_id'");
        unset($_POST);
        return true;
    }else {
        return false;
    }
}

$sql4 = mysqli_query($db,"SELECT bdr.*, fromu.userid AS fromuserid, fromu.fname AS fromfname, fromu.lname AS fromlname, fromu.username AS fromusername,
tou.userid AS touserid, tou.fname AS tofname, tou.lname AS tolname, tou.username AS tousername  FROM  tbl_blind_date_request AS bdr
JOIN `tbl_users` AS fromu ON bdr.user_id = fromu.userid
JOIN `tbl_users` AS tou ON bdr.to_user_id = tou.userid WHERE (bdr.user_id = '$user_id' OR bdr.to_user_id = '$user_id') AND bdr.status = '" . BLIND_DATE_STATUS_ACCEPTED ."'");
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

                                <div id="video-gallery" >
                                    <div align='center'>
                                        <h4>Match Users</h4>
                                        <p><?php if($msg!=''){ ?> <div class="msg <?=empty($is_error)?'text-success':'text-danger'?>"><?php echo $msg; ?></div>    <?php } ?></p>
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
                                                while($row = mysqli_fetch_array($sql4,MYSQLI_ASSOC)) {
                                                    ?>
                                                    <tr>
                                                        <td>S/N</td>
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