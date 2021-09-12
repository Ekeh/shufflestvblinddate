<div class="main-panel" >
        <div class="content-wrapper">
          <div class="row ">
            <div class="col-lg-12">
<h3> Live Results</h3>
      <br clear="all">

<div class="row">
            <div class="col-lg-12">

              <div class="card " >
                <div class="card-body">
                
                      
                        <div align='center'  >
                         
<?php
$cnt=1;
$sum=0;
$result = mysqli_query($db,"SELECT * FROM tbl_finalist where status='1'"); 
while($rod=mysqli_fetch_array($result))
  { 
     ////totalvotes 
     $sum=$sum+$rod["votes_received"];  
         /////use this for weekly votes
       /////$sum_weekly=$sum_weekly+($rod["vote"]-$rod["previous_week_vote"]); 
  }


   $getresult=mysqli_query($db,"SELECT * FROM tbl_finalist where status='1' order by rand()");
   $n=mysqli_num_rows($getresult);
   
$array = array();
while($rod=mysqli_fetch_array($getresult))
  { 
      $val=$rod["votes_received"];
       $username=$rod["fname"];
         $selection_id=$rod["refid"];
          /// $previous_week_vote=$rod["previous_week_vote"];
           ///$newval=$val-$previous_week_vote;
           /////use this for weekly votes
     //////$percentage=round(($newval/$sum_weekly)*100,2);
     
     
     //////use this for total votes 
     $percentage=round(($val/$sum)*100,2);
     
     
    $array[] = array("label"=> "$cnt", "y"=> $percentage);
  
    $cnt++;                          
  }
  ///$msg.=");";

$dataPoints = $array;
/*array(

  array("label"=> "1", "y"=> 18),
  array("label"=> "2", "y"=> 20),
  array("label"=> "3", "y"=> 48),
  array("label"=> "4", "y"=> 30),
  array("label"=> "5", "y"=> 35),
  array("label"=> "6", "y"=> 18),
  array("label"=> "7", "y"=> 12),
  array("label"=> "8", "y"=> 10),
  array("label"=> "9", "y"=> 13),
  array("label"=> "10", "y"=> 12),
    array("label"=> "11", "y"=> 19),
  array("label"=> "12", "y"=> 11),
  array("label"=> "13", "y"=> 13),
  array("label"=> "14", "y"=> 12),
    array("label"=> "15", "y"=> 10),
  array("label"=> "16", "y"=> 17),
  array("label"=> "17", "y"=> 13)


);
  */  
?>
<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function() {
 
var chart = new CanvasJS.Chart("chartContainer", {
  animationEnabled: true,
  title:{
    text: "Final Live voting results"
  },
  theme: "theme2",
  axisY: {
    title: "Percentage Vote",
    prefix: "",
    suffix:  "%"
  },
  data: [{
    type: "bar",
    yValueFormatString: "",
    indexLabel: "{y}%",
    indexLabelPlacement: "inside",
    indexLabelFontWeight: "bolder",
    indexLabelFontColor: "white",
    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
  }]
});
chart.render();
 
}
</script>
</head>
<body>
    <div align='center' style='padding-top:30px;'><br><br>
     <?php if($sum=='0'){echo "<h3>No results yet</h3>";} ?>
<div id="chartContainer" style="height: 370px; width: 90%;"></div>
</div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>                

                         </div>


</div>





                </div>

              </div>


          </div>
        </div>
<br clear="all">
</div>
</div>
