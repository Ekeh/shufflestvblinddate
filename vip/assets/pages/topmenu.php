        <div id="main_header" class="uk-light bg-dark">
            <header>

                <!-- Logo-->
                <i class="header-traiger uil-bars"
                    uk-toggle="target: #wrapper ; cls: collapse-sidebar mobile-visible"></i>

                <!-- Logo-->
                <div id="" style="display: inline;">
                 
                    <a href="<?php echo SITE_VIP; ?>"> <img src="assets/images/logo-light.png" alt="" width="50px" height="auto" ></a>
                </div>

                <!-- form search-->
                <div class="head_search">
                    <form method="post" action="<?php echo SITE_VIP; ?>/?p=search">
                        <div class="head_search_cont">
                            <input value="" type="text" class="form-control"
                                placeholder="Search for Videos and more.." autocomplete="off" name="searchit" required>
                            <i class="s_icon uil-search-alt"></i>
                        </div>

                        


                    </form>
                </div>

                <!-- user icons -->
                <div class="head_user">
<?php 

if(isset($_GET['k'])){
    if($_GET['k']=='premium'){ if($_COOKIE['membership']=='premium'){ ?><script type="text/javascript">alert("You are already a premium member");</script>  <?php }else{ include("assets/pages/upgrade.php");  }
  }
}


/*
if($_COOKIE['membership']=='basic'){ ?>
 <a href="<?php echo SITE_VIP; ?>/?k=premium" class="btn-upgrade uk-visible@s" style='border-radius:10px'> <i class="uil-bolt-alt"></i> Upgrade to Premium </a>
  <?php 

 }else{ ?>    
    <a href="#" class="btn-upload uk-visible@s" style='border-radius:10px'> <i class="uil-star"></i> Premium Member</a> <?php }
    */


?>
 <a href="<?php echo SITE_VIP; ?>/index.php?p=live" class="btn-upgrade uk-visible@s" style='border-radius:10px'> <i class="uil-play"></i> Watch Live Videos </a>
                  <!--  <a href="https://shufflestv.com/index.php?p=makepayment" class="btn-upgrade uk-visible@s" target="_blank"> <i class="uil-bolt-alt"></i> Fund Wallet </a>
                    <a href="#" class="btn-upload uk-visible@s"> <i class="uil-cloud-upload"></i> Upload</a>

                
                    <div uk-dropdown="pos: top-right;mode:click ; animation: uk-animation-slide-bottom-small"
                        class="dropdown-notifications">

                        <div class="dropdown-notifications-headline">
                            <h4>Upload Video</h4>
                        </div>

                       
                        <div class="dropdown-notifications-content uk-flex uk-flex-middle uk-flex-center text-center">
  <h3 style="color: #000000">Coming Soon</h3>

                            <div class="uk-flex uk-flex-column choose-upload  text-center">
                              
                                <img src="assets/images/upload.png" width="70" class="m-auto" alt="">
                                <p class="my-3"> Do you have a video wants to share us <br> please upload her ..
                                </p>
                                <div uk-form-custom>
                                    <input type="file">
                                    <a href="#" class="button soft-warning small"> Choose file</a>
                                </div>

                                <a href="#" class="uk-text-muted mt-3 uk-link"
                                    uk-toggle="target: .choose-upload ;  animation: uk-animation-slide-right-small, uk-animation-slide-left-medium; queued: true">
                                    Or Import Video </a>
                            </div>

                            <div class="uk-flex uk-flex-column choose-upload" hidden>
                                <i class="uil-import icon-large text-muted"></i>
                                <p class="my-3"> Import videos from YouTube <br> Copy / Paste your video link here </p>
                                <form class="uk-grid-small" uk-grid>
                                    <div class="uk-width-expand">
                                        <input type="text" class="uk-input uk-form-small" placeholder="Paste link">
                                    </div>
                                    <div class="uk-width-auto"> <button type="submit" class="button soft-warning">
                                            Import </button> </div>
                                </form>
                                <a href="#" class="uk-text-muted mt-3 uk-link"
                                    uk-toggle="target: .choose-upload ; animation: uk-animation-slide-left-small, uk-animation-slide-right-medium; queued: true">
                                    Or Upload Video </a>
                            </div>



                        </div>
                      <hr class="m-0">
                        <div class="text-center uk-text-small py-2 uk-text-muted"> Your Video size Must be Maxmium 999MB
                        </div>
                    </div>
-->

                   

                   
                    <!-- profile -image -->
                    <a class="opts_account"> <img src="assets/images/avatars/avatar-1.jpg" alt=""></a>

                    <!-- profile dropdown-->
                    <div uk-dropdown="pos: top-right;mode:click ; animation: uk-animation-slide-bottom-small"
                        class="dropdown-notifications small">

                        <!-- User Name / Avatar -->
                        <a href="#">

                            <div class="dropdown-user-details">
                                <div class="dropdown-user-avatar">
                                    <img src="assets/images/avatars/avatar-1.jpg" alt="">
                                </div>
                                <div class="dropdown-user-name">
        <?php if(!isset($_COOKIE['username'])){ echo $_COOKIE['fname'];  }else{echo $_COOKIE['username']; } ?> <span> verified <i class="uil-check"></i> </span>
                                </div>
                            </div>

                        </a>

                        <!-- User menu -->
                        <?php 
                        $userid=$_COOKIE['userid'];

 $s=mysqli_query($db,"SELECT * from tbl_users where userid='$userid' "); 
 while($rw=mysqli_fetch_array($s))
  {

$credit= $rw['credit'];

}
                        ?>

                        <ul class="dropdown-user-menu">
                 <!-- <?php   if($_COOKIE['membership']=='basic'){ ?>
                  <li><a href="<?php echo SITE_VIP; ?>/?k=premium" target="" style="color:#ff8400"" > <i class="uil-bolt-alt"></i> Upgrade to Premium</a>  </li> 
                      <?php } ?> -->
                        <li><a href="<?php echo SITE_VIP; ?>/index.php?p=fundwallet" target="_blank" > <i class="uil-money-bill"></i> N <?php echo $credit; ?></a>  </li> 
                         <li><a href="<?php echo SITE_VIP; ?>/index.php?p=fundwallet" target="_blank" > <i class="uil-wallet"></i> Fund Wallet</a>  </li>
                       <!-- <li><a href="" target="_blank" > <i class="uil-user"></i>  <?php echo ucfirst($_COOKIE['membership']); ?> </a>  </li> 
                            <li>-->
                                <a href="#" id="night-mode" class="btn-night-mode">
                                    <i class="icon-feather-moon"></i> Night mode
                                    <span class="btn-night-mode-switch">
                                        <span class="uk-switch-button"></span>
                                    </span>
                                </a>
                            </li>
                            <li class="menu-divider">
                            <li><a href="https://wa.me/2348035729461?text=Hi%2C%20I%20would%20love%20to%20make%20an%20enquiry%20about%20shufflesTV%20VIP." target="_blank"> <i class="icon-feather-help-circle"></i> Help</a>
                            </li>
                            <li><a href="<?php echo SITE_VIP; ?>/logout.php"> <i class="icon-feather-log-out"></i> Sign Out</a>
                            </li>
                        </ul>


                    </div>

                </div>

            </header>

        </div>