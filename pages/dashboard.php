<?php 
if(!isset($_COOKIE['userid'])){ 
  include('inc/checklogin.php');
}else
{
  $uid=$_COOKIE['userid'];
}

  ?><style>
li {

 display: inline;
}

.scrolling img{
  border-radius:5px;
}

.scrolling{
    width:100%;
    overflow-x: scroll;
    overflow-y: hidden;
    white-space: nowrap;
}



</style>
<?php
$d='';
?>
<div class="main-panel" >
        <div class="">
          <div class="row ">
            <div class="col-lg-12"> <div align='right'><marquee onmouseover='stop()' onmouseout='start()'>
                <h3 style="color:yellow; padding: 10px">Enter The Blind Date House Reality TV Dating Game Show. Click View Gallery to match your date.</h3></marquee></div>
<h3 style="color: #ffffff; padding: 10px"> Welcome to ShufflesTV </h3>

<div class="row">
            <div class="col-lg-12">
     <div align="center"> <br clear="all">
   <?php if(!isset($_COOKIE['userid']))
     {
?><a href="<?php echo SITE_URL; ?>/register.php" class="btn btn-primary" style="background-color: red">Register / Login</a>
<?php }else{
  ?>
  <!--<a href="<?php echo SITE_URL; ?>/index.php?p=livestream" class="btn btn-primary" style="background-color: red">Watch LiveStream</a>  -->
       <a href="<?php echo SITE_URL; ?>/index.php?p=gallery" class="btn btn-primary" style="background-color: red">View Gallery</a>
       <a href="<?php echo SITE_URL; ?>/index.php?p=episodes" class="btn btn-primary" >View Episodes</a>
<?php
} ?>
</div>
              <div class=" " >
                  
                <div class="card-body" >
                <div >
                <form method="post" action="index.php?p=allvideos">
                  <table width="100%"><tr><td > <input type="text" class="form-control" placeholder="Search Video Title, Ref Id or Description etc" aria-label="search" aria-describedby="search" name="table_search" ></td><td><input type="submit" name="search" value="SEARCH" class="btn btn-success"></td></tr></table>
               
                 </form>
                <br>
              </div>
                       <div id="video-gallery" align="left" >
                          
                               <br>

                   <?php

                   /*
   $cnt=1;

$query=mysqli_query($db,"SELECT * FROM tbl_vip_videos INNER JOIN tbl_users on tbl_vip_videos.video_id=tbl_users.userid where tbl_vip_videos.xrating='7' and tbl_vip_videos.showit='1' order by tbl_vip_videos.video_id desc limit 1"); 
      

while($r=mysqli_fetch_array($query))
  {
    ?>

  
   
   
     
      <?php 
 $vcat=$r['vcat'];
$xrating=$r['xrating'];
 $video_amount=$r['video_amount'];
 $mainvid=$r['video'];
      


      ?>
  <div class="" style="padding: 5px;" >
<div class="" align="">
  <video id="video1" width="480" height="320"   preload="auto" autoplay    playsinline allowfullscreen uk-responsive controls controlslist="nodownload" >
    <source src="<?php echo SITE_URL; ?>/uploads/vipvideos/<?php echo $mainvid; ?>" type="video/mp4" >
    Your browser does not support HTML5 video.
  </video>
</div> 
          <br>


                     <div style="padding: 5px; text-align: left;"><?php echo $r['vid_title']; ?></div>
 </div>

    <?php
    $cnt++;
  }
*/
                ?>
                <!--
<div class="" align="">
  
  <video id="video1" width="100%" height="auto"   preload="auto" autoplay    playsinline allowfullscreen uk-responsive controls controlslist="nodownload" >
    <source src="<?php echo SITE_URL; ?>/uploads/llb.m4v" type="video/mp4" >
    Your browser does not support HTML5 video.
  </video>

<iframe width="560" height="315" src="https://www.youtube.com/embed/a_GvhzlPfmM" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
<br>
<iframe width="560" height="315" src="https://www.youtube.com/embed/baaKCyAqinY" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->
</div> 


                  </div>
                  <br><br>
                  <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<style>


h1, h2, p { text-align: center; }

h1 { font-size: 3em; }

h2 {
  font-size: 2em;
  margin: 40px 0 0;
}

/* Begin Scroller Rules */

.horiz-scroll {
  display: flex;
  display: -webkit-flex;
  flex-direction: column;
  -webkit-flex-direction: column;
  overflow: visible;
  position: relative;
}

.horiz-scroll h2 { font-weight: 600; }

.horiz-scroll .scroller {
  max-height: 30vw;
  position: relative;
  display: flex;
  display: -webkit-flex;
  flex: 1;
  -webkit-flex: 1;

}

.horiz-scroll .scroller .left-scroll { left: 0; }

.horiz-scroll .scroller .right-scroll { right: 0; }

.horiz-scroll .scroller .left-scroll, .horiz-scroll .scroller .right-scroll {
  display: flex;
  display: -webkit-flex;
  flex-direction: column;
  -webkit-flex-direction: column;
  padding: 0 2vw;
  overflow-x: hidden;
  z-index: 1;
  justify-content: center;
  -webkit-justify-content: center;
  position: absolute;
  height: 100%;
}

.horiz-scroll .scroller .left-scroll p, .horiz-scroll .scroller .right-scroll p {
  font-size: 3em;
  color: white;
  text-shadow: 0 0 10px #333;
  margin: 0;
}
 @media only screen and (max-width: 480px) {

.horiz-scroll .scroller .left-scroll p,  .horiz-scroll .scroller .right-scroll p { color: black; }
}

.horiz-scroll .scroller .scrollable-x {
  white-space: nowrap;
  overflow-x: scroll;
  overflow-y: hidden;
}
 .horiz-scroll .scroller .scrollable-x::-webkit-scrollbar {
 display: none;
}
 .horiz-scroll .scroller .scrollable-x::-webkit-scrollbar {
 width: .375em;
 max-width: 12px;
}
 .horiz-scroll .scroller .scrollable-x::-webkit-scrollbar-track {
 background-color: transparent;
}
 .horiz-scroll .scroller .scrollable-x::-webkit-scrollbar-thumb {
/* background-color: rgba(255, 255, 255, 0.25); */
 border-radius: 1em;
}

.horiz-scroll .scroller .scroll-images {
  position: relative;
  flex: 8;
  -webkit-flex: 8;
  order: 2;
  -webkit-order: 2;
  z-index: 0;
  font-size: 0;
  overflow-y: visible;
  padding: 10% 0;
  margin: -10% 0;
  text-align: center;
}

.horiz-scroll .scroller .scroll-images img {
 /* width: 25%; */width: 200px; height:250px;

 object-fit:contain; ;
  top: 0;
  z-index: 0;
  -webkit-transition: all 100ms;
  transition: all 100ms;
  position: relative;
}
/*
 @media only screen and (max-width: 960px) {

.horiz-scroll .scroller .scroll-images img { width: 33.333%; }
}
 @media only screen and (max-width: 720px) {

.horiz-scroll .scroller .scroll-images img { width: 50%; }
}
 @media only screen and (max-width: 480px) {

.horiz-scroll .scroller .scroll-images img {
  width: 50%;
  margin: 0 25%;
}
}
*/
.horiz-scroll .scroller .scroll-images img.focused {
  z-index: 2;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.25);
  transform: scale(1.25);
  height: 200%;
  transition: all 250ms ease-in-out, drop-shadow 0.5s;
}

.invisible {
  opacity: 0;
  transition: .5s ease-in-out;
}
</style>
<h4>Blind Date Matches</h4>
<div id="scroll-feature" class="horiz-scroll">
  <div class="scroller">
    <div class="left-scroll invisible">
      <p class="fa fa-angle-left"></p>
    </div>
    <div class="right-scroll">
      <p class="fa fa-angle-right"></p>
    </div>
     <div class="scroll-images scrollable-x">

<?php
//// get profile of those that are trendinghave public profile
$sql = mysqli_query($db,"SELECT * FROM tbl_users WHERE profile_type='" . PROFILE_ON_DATE . "' order by rand() limit 8");
$num=mysqli_num_rows($sql);

if($num=='0'){
/// do nothing
}else{

while($rows=mysqli_fetch_array($sql))
{

 $photo=$rows['photo'];
 $name=$rows['username'];
  $uid=$rows['userid'];
  $make_trend=$rows['make_trend'];
$nam=substr($name,0,15);


?>

<a href="index.php?p=dgallery&u=<?php echo $uid; ?>">
  <img src="uploads/profile/<?php echo $photo; ?>" alt="" style='width: 200px; height:250px; padding: 10px; object-fit:cover; border-radius:5px'></a>
  <!--<h5 class="this-title" align="" style="padding: 10px"><?php 

  if($name==''){echo "...";}else{echo $nam; if (strlen($name) > 15){echo "...";}}?></h5>-->


<?php
}

}
?>
        </div>
  </div>
</div>

                </div>

<br><br><br><BR>
            </div>
          </div>
        </div>
<br clear="all">
</div>
</div>


<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script> 
<script>
// The HorizontalScroller Class accepts a jQuery object as its only argument
// The argument is the parent container of the scrolling element
// The element requires an ID to differentiate HorizontalScroller instances

function HorizontalScroller(elem) {
  this.scrollbox = elem; // The scrollers viewable area
  this.scrollImages = this.scrollbox.find("img");
  this.leftScrollControl = this.scrollbox.siblings(".left-scroll");
  this.rightScrollControl = this.scrollbox.siblings(".right-scroll");

  // Listener to change visibility of left and right controls
  // when at scroll extremes
  this.scrollbox.on("scroll", this.evaluateControlVisibility.bind(this));
};

HorizontalScroller.prototype = {
  
  scrollboxWidth: function() {
    return this.scrollbox.outerWidth(true);
  }, 

  currentScrollPosition: function() {
    return this.scrollbox.scrollLeft();
  },

  currentRightPosition: function() {
    return this.currentScrollPosition() + this.scrollboxWidth() - this.totalWidths();
  },

  // Maps the image width of each image in the scroller
  imageWidths: function() {
    return $.map(this.scrollImages, function(img) { 
      return $(img).outerWidth(true);
    })
  },

  // Returns the total width of all the images, that is,
  // the total of the visible and overflow content.
  totalWidths: function() {
    return this.imageWidths().reduce(function(a,b) { return a+b});
  },

  // Returns the average width of all the images
  avgWidth: function() {
    return this.totalWidths() / this.imageWidths().length;
  },

  // Determines the number of images in view area.
  // Number of images changes with responsive CSS
  imagesAcross: function() {
    return Math.round( this.scrollboxWidth() / this.avgWidth() );
  },

  // maps the offset x-distance of each image
  // from the left edge of the view area
  imageOffsets: function() {
    return $.map(this.scrollImages, function(img) { 
      return Math.round($(img).position().left);
    }); 
  },

  // Returns the index of the first number in the given array
  // greater than the given value, or, returns the index of
  // the first positive number in the array
  indexOfFirst: function(array, value) {
    value = value || 0;
    var firstIndex;
    var i = 0;
    while (firstIndex === undefined && array.length > i) {
      if (array[i] >= value)
        firstIndex = i; 
      i += 1;
    }
    return firstIndex; 
  },

  // Returns the index of first image that is completely in view
  // within the scrollbox
  firstVisibleImageIndex: function() {
    return this.indexOfFirst(this.imageOffsets());
  },

  // Returns the first image that is completely in view 
  // within the scrollbox
  firstVisibleImage: function() {
    return this.scrollImages[this.firstVisibleImageIndex()];
  },

  // Returns the index of the last image with its left edge in view 
  // within the scrollbox
  lastVisibleImageIndex: function() {
    return this.firstVisibleImageIndex() + this.imagesAcross();
  },

  // Returns the last image with its left edge in view 
  // within the scrollbox
  lastVisibleImage: function() {
    return this.scrollImages[this.lastVisibleImageIndex()];
  },

  // Returns the difference between the scrollboxes left edge
  // and the left edge of the first fully visible image, that is,
  // how far in the first fully visible image is
  offset: function() {
    var offset = $(this.firstVisibleImage()).position().left;
    return Math.round(offset);
  },
  
  // Returns the combined scroll amount that the images have to travel
  // in order to land evenly within the scroll window. The resulting
  nextScrollPosition: function(direction) {
    var nextScrollPosition = this.currentScrollPosition() + this.offset();

    switch(direction) {
      case "left":
        nextScrollPosition -= this.scrollboxWidth();
        if (($(this.firstVisibleImage()).outerWidth(true) - this.offset()) < 0) {
          nextScrollPosition -= $(this.firstVisibleImage()).outerWidth(true);
        }
        break;
      case "right":
        nextScrollPosition += this.scrollboxWidth();
        if (this.offset() > 0) {
          nextScrollPosition -= $(this.firstVisibleImage()).outerWidth(true);
        }
        break;
    }
    return nextScrollPosition;
  },

  // Triggers the animation
  animateScroll: function(direction) {
    resetFocusedImg();
    var scroller = this;
    setTimeout(function() {
      scroller.scrollbox.animate({
        scrollLeft: scroller.nextScrollPosition(direction)
      }, this.scrollboxWidth())
    }.bind(this), 100);
  },

  hideScrollControl: function(control) {
    control.addClass("invisible");
  },

  showScrollControl: function(control) {
    control.removeClass("invisible");
  },

  scrollControlVisibility: function(control) {
    return control.hasClass("invisible");
  },
  
  scrollAtZero: function() {
    return this.currentScrollPosition() == 0;
  },

  scrollAtMax: function() {
    return this.currentRightPosition() >= -1;
  },

  evaluateControlVisibility: function() {
    var left = this.leftScrollControl;
    var right = this.rightScrollControl;
    var leftIsInvisible = this.scrollControlVisibility(left);
    var rightIsInvisible = this.scrollControlVisibility(right);

    if (this.scrollAtZero()) this.hideScrollControl(left);
    if (this.scrollAtMax()) this.hideScrollControl(right);
    if (!this.scrollAtZero() && leftIsInvisible) this.showScrollControl(left);
    if (!this.scrollAtMax() && rightIsInvisible) this.showScrollControl(right);
  }
};

// End HorizontalScroller.prototype

var scrollers = {};

// Detects scrollers in the DOM
function detectScrollers() {
  return $.map($(".horiz-scroll"), function(scroller) {
    return $(scroller).attr("id");
  });
}

// Generates a new HorizontalScroller for each scroller in DOM
function mapScrollers(scrollerIds) {
  scrollerIds.forEach(function(elem, i , arr) {
    var scroller = "#" + elem + " .scroll-images";
    scrollers[elem] = new HorizontalScroller( $(scroller) );
  });
}

// Gets the scroll direction to pass to animation function
function getScrollDirection(button) {
  return (button.hasClass("left-scroll")) ? "left" : "right"
}

// Triggers the scroll animation for specific scroller
// in a specific direction
function triggerAnimation(button) {
  var scrollId = button.closest(".horiz-scroll").attr("id");
  var scrollDirection = getScrollDirection(button);
  scrollers[scrollId].animateScroll(scrollDirection);
}

// Scroll buttons listener
function listenForScroll() {
  $(".left-scroll, .right-scroll").on("click", function() {
    var button = $(this);
    triggerAnimation(button);
  });
}

function resetFocusedImg() {
  $(".focused").removeClass("focused");
}

// listener for click, slides up
var horizontalScrollImg = $(".horiz-scroll .scroll-images img");
horizontalScrollImg.on("click", function() {
  if (!$(this).hasClass("focused"))
    resetFocusedImg();
  $(this).toggleClass("focused");
});

// Registers scrollers and initiates listeners 
function scrollerInit() {
  var scrollerIds = detectScrollers();
  mapScrollers(scrollerIds);
  listenForScroll();
}

// Begins the fun
scrollerInit();
</script>