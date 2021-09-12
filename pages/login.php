<div class="main-panel" >
        <div class="content-wrapper">
          <div class="row ">
            <div class="col-lg-12">
<h3> Login</h3>
<div class="row">
            <div class="col-lg-12">
                   <div class="" align="left" style="border: 1px solid #cccccc; border-radius: 5px; padding: 15px;">
    <form action="" method="post">
    <div class="avatar" align="center">
      <img src="images/lock.png" alt="Logo" width="80px" height="80px" style="border-radius:10px; ">
    </div>

        <?php if($msg !=''){ ?> <div class="msg"><?php echo $msg; ?></div>    <?php } ?>
    
        <div class="form-group">
          <label>Email Address</label>
          <input type="text" class="form-control" name="username" placeholder="Email Address" required="required">
        </div>

    <div class="form-group">
       <label>Password</label>
            <input type="password" class="form-control" name="password" placeholder="Password" required="required">
        </div>        
        <div class="form-group">
            <input type="submit" class="btn btn-primary btn-lg btn-block" name="enter" value="Sign In">
        </div>
    <div class="clearfix">
            <label class="pull-left checkbox-inline"><input type="checkbox"> Remember me</label>
         <br>
            <label class="pull-left"><a href='register.php' >Not registered ? Register </a></label><br>
            <a href="reset.php" class="pull-right">Forgot Password?</a>
        </div>


 </form>
</div>
          </div>
        </div>
<br clear="all">
</div>
</div>
</div>