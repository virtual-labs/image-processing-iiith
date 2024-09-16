<?php
session_start();

if(isset($_GET["source"]) && isset($_GET["id"])) {
$_SESSION["currentS"]=$_GET["source"];
$_SESSION["id"]=$_GET["id"]; 
} else {
$_SESSION["id"]=time();
$_SESSION["state"]=0;
}

if(isset($_GET["assess"])) {
	$_SESSION["currentS"]=1;
	$_SESSION["id"]=$_GET["assess"];
	$_SESSION["state"]=time();
	}


?> 


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- This file was originally generated at http://psd2cssonline.com on September 16, 2010, 10:04 am -->
<!-- psd2css Online version 1.85 -->

<title>Virtual Lab in Image Processing</title>

<!-- Some META tags to help with Search Engine Optimization.  Please 
note however that META tags are NOT a magic bullet to get your web page
to the top of search engine rankings.  They are just part of that effort.  You 
can get more information by googling SEO or visiting the psd2css Online forums. -->
<meta name="description" content="Put the description of this page here" />
<meta name="keywords" content="Put keywords for this page here separated by commas" />
<meta name="generator" content="psd2css Online - Dynamic Web Pages from your Photoshop Design in seconds" />

<!-- The CSS Reset from Eric Meyers -->
<!-- <link rel="stylesheet" type="text/css" href="cssreset.css" media="screen" /> -->

<!-- The Primary External CSS style sheet. -->
<link rel="stylesheet" type="text/css" href="css/psd2css.css" media="screen" />

<!-- We use the jquery javascript library for DOM manipulation and
some javascript tricks.  We serve the script from Google because it's
faster than most ISPs.  Get more information and documentation
at http://jquery.com <script type="text/javascript"
			     src="js/jquery-1.4.2.min.js"> -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script> 

<!-- All the javascript generated for your design is in this file -->
<script type="text/javascript" src="js/psd2css.js"></script>

<!-- For Jquery UI-->
<script type="text/javascript" src="js/jquery-ui-1.8.4.custom.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/dark-hive/jquery-ui-1.8.4.custom.css">

<!-- For Slider - http://carpe.ambiprospect.com/slider/-->
<link type="text/css" rel="StyleSheet" href="css/carpe-slider.css" />
<script type="text/javascript" src="js/carpe-slider.js"></script>

<!--http://www.cssmenumaker.com/builder/menu_info.php?menu=057-->
<link type="text/css" rel="StyleSheet" href="menu/menu_style.css" />

<!--for ImgSelect - http://odyniec.net/projects/imgareaselect/-->
<link rel="stylesheet" type="text/css" href="css/imgareaselect-default.css" />  
<script type="text/javascript" src="js/jquery.imgareaselect.js"></script> 

<!--for Flot -->
<script type="text/javascript" src="js/jquery.flot.js"></script> 

<!--for COntent Slider - Jquery Slider/-->
 <link rel="stylesheet" type="text/css" href="css/jquery-slider.css">


<script type="text/javascript">

function blinker(i){
if(buttId!="cancel" && i>0) {
$($(buttId),"#Layer-2").toggleClass("ui-state-hover");
setTimeout("blinker("+(i-1)+")",500);
}
}

function set_state(state) {
switch (state) {
case 0: $("#nextBox").html("Start the Experiment by clicking on 'Select Image' and selecting an Input Image from the Mosaic");
buttId="button1"; 
blinker(6);
break;
case 1: $("#nextBox").html("Select appropriate parameters and click on 'Run'.");
buttId="button2";
blinker(6);
break;
case 2: $("#nextBox").html("Read the Message below the output image; try the experiment using different points.");
break;
}
jstate=state;
}
  function toggleMosaic()    {
  var ias = $('#Mosaic').imgAreaSelect({ instance: true });
      if($("#Mosaic").is(":visible")) {
        ias.setOptions({ hide: true });
        $("#Mosaic").hide("slow");
        		if($("#simple-rad").attr("checked")==true) {
			$(".simple").show();
			} else { $(".advanced").show(); }  

      } else {        		if($("#simple-rad").attr("checked")==true) {
			$(".simple").hide();
			} else { $(".advanced").hide(); }
        $("#Mosaic").show("slow", function() {
          ias.setOptions({ show: true });
          ias.update();

        
        });
      }
  }
</script>

<script tyre="text/javascript">
//

function set_crop() {
    set_state(1);


    var ias = $('#Mosaic').imgAreaSelect({ instance: true });
	var sel=ias.getSelection();

    //alert('sdfsd');

    var aurl='x=' + sel.x1 + '&y=' + sel.y1 + '&w=' + sel.width + '&h=' + sel.height + '&exp=diff';


    $.ajax({url: "crop.php" , type: "POST", data: aurl, async: false,
    dataType: "html", success: function(data) {
		$("#container").html(data);
		$("img","#Layer-4").addClass("advanced");
		$(".start",".advanced").css("display","block");
		$(".end",".advanced").css("display","block");
		
		}	
		
 
	     });
}

function pointer (event) {
pos_x = parseInt((event.pageX-document.getElementById("Layer-1").offsetLeft-document.getElementById("Layer-4").offsetLeft)*num_blocks/281);
pos_y = parseInt((event.pageY-document.getElementById("Layer-1").offsetTop-document.getElementById("Layer-4").offsetTop)*num_blocks/281);
if(pos_x>num_blocks-1) { pos_x=num_blocks-1;}
if(pos_y>num_blocks-1) { pos_y=num_blocks-1;}

if(turn=="start" && sing!="yes") {
 turn="end";
$("#ex").html("x = " + (pos_x) + "  y = " + (pos_y));
endx=pos_x;
endy=pos_y;

} else {
startx=pos_x;
starty=pos_y;
$("#st").html("x = " + (pos_x) + "  y = " + (pos_y));
turn="start"; }
$("."+turn).css("left",pos_x*281/num_blocks +document.getElementById("Layer-4").offsetLeft-2) ;
$("."+turn).css("top",pos_y*281/num_blocks +document.getElementById("Layer-4").offsetTop-2) ;

}

function def_pointer() {

num_blocks=16;
pos_x=4;
pos_y=4;

startx=pos_x;
starty=pos_y;
$("#st").html("x = " + (pos_x) + "  y = " + (pos_y));
turn="start"; 
$(".start").css("left",pos_x*281/num_blocks +document.getElementById("Layer-4").offsetLeft-2) ;
$(".start").css("top",pos_y*281/num_blocks +document.getElementById("Layer-4").offsetTop-2) ;

}
</script>


<script type="text/javascript">
function doTransform(){

    	

	var args=0;
	var fizz=2;
	var checkBoxes;

	if($("#Simple-rad").attr("checked")==true) {
	args='1&metric=';
	
	checkBoxes = $("input[name=type]")
	$.each(checkBoxes, function() {
                if ($(this).attr('checked')){
           	args = args + $(this).attr('value');
        	}	
        });
	
	checkBoxes = $("input[name=check]")
	$.each(checkBoxes, function() {
                if ($(this).attr('checked')){
           	args = args + '&type=' + $(this).attr('value');
			fizz=$(this).attr('value');
if($(this).attr("value")=="2") {
				args = args + "&dist=" + $("#dist-slider-display").attr("value");
				}
        	}	
        });
	args = args + "&sx="+ startx;
args = args + "&sy="+ starty;

if(sing=="no") {
args = args + "&ex="+ endx;
args = args + "&ey="+ endy;
}
	} else {
	
	if(jstate == 0) {
	    alert("First click on Mosaic and select the Input Image.");
            return;
    	}
	args="2&type=";
	checkBoxes = $("input[name=type2]")
	$.each(checkBoxes, function() {
                if ($(this).attr('checked')){
           	args = args + $(this).attr('value');
        	}	
        });
	
args = args + "&sx="+ startx;
args = args + "&sy="+ starty;
args = args + "&ex="+ endx;
args = args + "&ey="+ endy;
	}

if(fizz==1) {
	var aurl = "trns.php?opn=diff&exp=" + args;
	   $.ajax({ url: aurl, type: "GET", async: false, dataType: "html",
	success: function(data){
$("#Layer-5").html("<h2 style='margin-left: 10px; margin-top:100px;'>The distance between the two selected points is " + data + " units</h2>");
}
});
} else {
	if(!($('#Mosaic').is(":visible"))) {
	var aurl = "trns.php?opn=diff&exp=" + args;
	
       $("#slider").remove();	
       $.ajax({ url: aurl, type: "GET", async: false, dataType: "html",
	success: function(data){
if(parseInt( data ) !=0) { $(".content-conveyor", $("#sliderContent")).html(data);	 
} else {
alert("The start and end positions should be of same color"); 
args="fail";
}
	}});
	$("#sliderContent").append('<div id="slider"></div>');
    
	var conveyor2 = $(".content-conveyor", $("#sliderContent")),
	item2 = $(".item", $("#sliderContent"));
	
	//set length of conveyor
	conveyor2.css("width", item2.length * parseInt(item2.css("width")));
        conveyor2.css("left","-" + ((item2.length * parseInt(item2.css("width"))) - parseInt($(".viewer", $("#sliderContent")).css("width"))) + "px");
			
	//config
	var sliderOpts = {
	  max: (item2.length * parseInt(item2.css("width"))) - parseInt($(".viewer", $("#sliderContent")).css("width")),
	  value:  (item2.length * parseInt(item2.css("width"))) - parseInt($(".viewer", $("#sliderContent")).css("width")),
	  slide: function(e, ui) { 
		conveyor2.css("left", "-" + ui.value + "px");
	  }
	};
	
	//create slider
	$("#slider").slider(sliderOpts);


    if(args!="fail") { 

set_state(2);
$("#Layer-5").html('<img src="' + $("img",$(".item:last")).attr("src") + '" width="281" height="281" alt="outputLayer" />'); 

$("#mesg").html($("dt",".item:last").html());
       
var myImage = new Image();
myImage.name = $("img",$("#Layer-5")).attr("name");
myImage.src = $("img",$("#Layer-5")).attr("src");
myImage.onload = function () {
  $("dims","#imgInfo").html(this.height + " x " + this.width);}
}}}}

 
function confirmTo(url) {
	var response = confirm('You will lose Session Data: Continue?');
	if(response) {
		window.location.href=url;
	}
}
 

  $(document).ready (function() {
  
  
num_blocks=16;
   sing="no";
startx=4;
starty=4;
endx=8;
endy=8;
turn="end";
buttId="button1";
    <?php if($_GET["exp"]=="piping" || isset($_GET["assess"])) {
	echo "set_state(1);"; } else {echo "set_state(0);"; ;
	} ?>
  $(".imageFull").hide();
  $("#popUp").hide();
     $("button1","#Layer-2").button();
  $("button1","#Layer-2").click( function() {
  toggleMosaic();
  });



  $("button2","#Layer-2").button();
  $("button2","#Layer-2").click ( function () {
  doTransform();
  });

  $("button4","#Layer-2").button();
  $("button4","#Layer-2").click ( function () {
 <?php if($_GET["exp"]!="piping" && !isset($_GET["assess"])) { echo ' set_state(0);'; } 
		else { echo 'set_state(1);'; }?>
    $("dims","#imgInfo").html("____ x ____ ");
    $("img",$("#Layer-5")).attr("src","images/Layer-5.jpg");  
$("img",$("#Layer-4")).attr("src","<?php if(isset($_GET["assess"])) { echo 'images/temp/'.$_SESSION["id"].'_'.$_SESSION["currentS"].'_result.png'; } 
		else { echo 'images/Layer-4.jpg'; }?>")
$("#sliderContent").replaceWith('      <div id="sliderContent" class="ui-corner-all">		<div class="viewer ui-corner-all">	  <div class="content-conveyor ui-helper-clearfix">	    <div class="item">	      <h2><?php if(isset($_GET["assess"])) {	  echo 'Assessment';	  } else { echo 'Start'; } ?></h2>	      <img src="<?php if(isset($_GET["assess"])) {	  echo 'images/temp/'.$_SESSION["id"].'_'.$_SESSION["currentS"].'.png';	  } else { echo 'images/Mosaic.png'; } ?>" alt="picture" width="140px" height="140px"/>	      <dl class="details ui-helper-clearfix">		<dt><?php if(isset($_GET["assess"])) {	  echo 'This is the Input Image. Perform Operations to get the above result.';	  } else { echo 'Select a portion of the Mosaic on the Right and Transform... '; } ?></dt>	      </dl>	    </div>	  </div>	</div>	<div id="slider"></div>      </div>');
});
 
  
  $("#Mosaic").imgAreaSelect({ 
  handles: true, 
  movable: true,
  persistent: true,
  resizable: false,
  x1: 0, y1: 0, x2: 16, y2: 16,
  hide: false,
  imageHeight: 32,
  imageWidth: 32,
  });
  toggleMosaic();
    $("#choice").buttonset();
  $("#choice").button("refresh");
  $(".advanced").hide();
  
  <?php 
	if(isset($_GET["exp"])) {
		if($_GET["exp"]!=1) {
			echo '$("#Advanced-rad").click();';
		}
	}
	if(isset($_GET["metric"])) {
	echo '
		checkBoxes = $("input[name=type]")
		$.each(checkBoxes, function() {
			if ($(this).attr("value")=="'.$_GET["metric"].'"){
				$(this).click();
			}
        }); ';
	}
	if(isset($_GET["type"])) {
	echo '
		checkBoxes = $("input[name=check]")
		$.each(checkBoxes, function() {
			if ($(this).attr("value")=="'.$_GET["type"].'"){
				$(this).click();
			}
        }); ';
	}
	if(isset($_GET["sx"]) && isset($_GET["sy"])) {
	echo '
		startx='.$_GET["sx"].';
		starty='.$_GET["sy"].';
		$("#st").html("x = " + (startx) + "  y = " + (starty));
		$(".start").css("left",startx*281/num_blocks +document.getElementById("Layer-4").offsetLeft-2) ;
		$(".start").css("top",starty*281/num_blocks +document.getElementById("Layer-4").offsetTop-2) ;
	';
	}
	if(isset($_GET["ex"]) && isset($_GET["ey"])) {
	echo '
		endx='.$_GET["ex"].';
		endy='.$_GET["ey"].';
		$("#ex").html("x = " + (endx) + "  y = " + (endy));
		$(".end").css("left",endx*281/num_blocks +document.getElementById("Layer-4").offsetLeft-2) ;
		$(".end").css("top",endy*281/num_blocks +document.getElementById("Layer-4").offsetTop-2) ;
	';
	}
	?>
});



</script>
</head>


<body>

  <!-- This is 'Backgound_bkgnd_center_jpg' -->
  <div id="Layer-1" class="Backgound_bkgnd_center_jpg"  >
    

    <!-- This is 'Mosaic_jpg' -->
    <div id="Mosaic" class="Mosaic_jpg"  >
      <img src="images/Mosaicdiff.png" width="513" height="513" alt="Mosaic" /></div>

    <!-- This is 'Thumbnails_jpg' -->
	<div id="Layer-7" class="Thumbnails_jpg"  >
      <div id="sliderContent" class="ui-corner-all">	
	<div class="viewer ui-corner-all">
	  <div class="content-conveyor ui-helper-clearfix">
	    <div class="item">
	      <h2><?php if(isset($_GET["assess"])) {
	  echo 'Assessment';
	  } else { echo 'Start'; } ?></h2>
	      <img src="<?php if(isset($_GET["assess"])) {
	  echo 'images/temp/'.$_SESSION["id"].'_'.$_SESSION["currentS"].'.png';
	  } else { echo 'images/Mosaic.png'; } ?>" alt="picture" width="140px" height="140px"/>
	      <dl class="details ui-helper-clearfix">
		<dt><?php if(isset($_GET["assess"])) {
	  echo 'This is the Input Image. Perform Operations to get the above result.';
	  } else { echo 'Select a portion of the Mosaic on the Right and Transform... '; } ?></dt>
	      </dl>
	    </div>
	  </div>
	</div>
	<div id="slider"></div>
      </div>
   
      
      
    </div>

    <!-- This Is 'outputLayer_jpg' -->
    <div id="Layer-5" class="outputLayer_jpg">
      <img src="images/Layer-5.jpg" alt="outputLayer" width="281px" height="281px"/></div>


    <!-- This is 'InputLayer_jpg' -->
    <div id="Layer-4" class="InputLayer_jpg"  onclick="pointer(event)" >
      <div class="advanced" id="container"> <img src="<?php if(isset($_GET["source"])) {
	  echo 'images/temp/'.$_SESSION["id"].'_'.$_SESSION["currentS"].'.png';
	  } else { if(isset($_GET["assess"])) { echo 'images/temp/'.$_SESSION["id"].'_'.$_SESSION["currentS"].'_result.png'; } 
		else { echo 'images/Layer-4.jpg'; }} ?>" width="281" height="281" alt="InputLayer" /> </div>
	  </div>
	  
	  <div style="position: absolute;  left: 326px;  top: 126px;  z-index: 15;" class="grid simple" onclick="pointer(event)">    <img width="278" height="278" src="diff/overlay.png"/></div> 
	  <div style="position: absolute;  left: 326px;  top: 126px; image-rendering: -moz-crisp-edges; z-index: 15; display:none;" class="liz simple" onclick="pointer(event)">    <img width="281" height="281" src="images/BW_liz.bmp"/></div> 

<div class="advanced">
<div class="start" style="position: absolute; left: 393px; top: 192px; z-index: 20; display:none;">
<img src="diff/start.png"/>
</div>

<div class="end"   style="position: absolute; left: 463px; top: 260px; z-index: 21; display:none;">
<img src="diff/end.png"/>
</div>
</div>

<div class="simple">
<div class="start" style="position: absolute; left: 393px; top: 192px; z-index: 20; ">
<img class="liz" style="display:none;" src="diff/end2.png"/>
<img class="grid" src="diff/start.png"/>
</div>

<div class="end"   style="position: absolute; left: 463px; top: 260px; z-index: 21;">
<img src="diff/end.png"/>
</div>
</div>

    <!-- This is 'TopBar_jpg' -->
    <div id="Layer-3" class="TopBar_jpg"  >
      <img src="images/Layer-3.jpg" width="894" height="96" alt="TopBar" />
      <!-- This is 'IIIT' -->
      <div id="Layer-6" class="IIIT"  >
        <img src="images/iiit.png" width="100" height="70" alt="IIIT" class="pngimg" />
	</div>
	
			<div id="topMenu">
			<h1 style="text-align: center;">Virtual Lab for IMAGE PROCESSING</h1>
<div class="home">
<a onclick="confirmTo('index.html')">home</a>
</div>
			<div class="menu">
<ul>
<li><a href="objective.php?exp=diff" target="_self" >Objective</a>
</li>
<li><a href="intro.php?exp=diff" target="_self" >Introduction</a>
</li>
<li><a href="theory.php?exp=diff" target="_self" >Theory</a>
</li>
<li><a href="procedure.php?exp=diff" target="_self" >Procedure</a>
</li>
<li><sel><a href="diff.php" target="_self" >Experiment</a>
</sel></li>
<li><a href="#" target="_self" >Assessment</a>
				<ul>
					<li><a href="quiz.php?exp=diff">Quiz</a></li>
					<li><a href="assign.php?exp=diff">Assignment</a></li>
			   </ul>

</li>
<!--
<li><a href="references.php?exp=diff" target="_self" >References</a>
</li>
-->
<li><a href="summary.php" target="_blank" >Summary</a>
</li>
</ul>
</div>
			</div>
			
    </div>

	<div id="imgInfo">
	<table>
	<tr> <th width=180>
	Start Position
	</th> <th class="ends" width=120>
	End Position
	</th><th></th> </tr>
	<tr><td id="st" >x=4 y=4 </td>
<td class="ends" id="ex">x=8 y=8</td>
	    <th id="mesg" class="ends"></th></tr>
	</table>
	</div>	
	
    <!-- This is 'Parameters_jpg' -->
    <div id="Layer-2">

	  <h2 style="text-align: center;">Distance and Connectivity</h2>
<div id="nextBox">
</div>
 
      <?php if (!isset($_GET["assess"]))  {echo "<button1 class='advanced'>Select Image</button1>";} ?>
      <button4>Reset</button4>
      <button2>Run</button2>
      <br/><br/>

<div id="choice">
	<input type="radio" id="Simple-rad" name="choice1" value="1" checked onclick="$('.advanced').hide(); $('.simple').show(); $('#one').click();"/><label for="Simple-rad">Distance</label>
	<input type="radio" id="Advanced-rad" name="choice1" value="2" onclick="$('.simple').hide(); $('.advanced').show(); $('.ends').show(); sing='np'; def_pointer();"/><label for="Advanced-rad">Connectivity</label>
</div>

<div class="Parameters simple">

<h3>&nbsp; Select the Task</h3>
<input type="radio" name="check" value="1" checked id="one" onclick="sing='no'; $('.end','.simple').show(); $('.ends').show(); $('.type2').hide(); def_pointer(); $('.grid').show(); $('.liz').hide(); "/> Measure Distance between two points<br/>
<input type="radio" name="check" value="2" onclick="sing='yes'; $('.end','.simple').hide(); $('.ends').hide(); $('.type2').show('fast'); $('.grid').show(); $('.liz').hide();  def_pointer(); "/>Create Isodistance Plot<br/>
<div class="type2" style="display:none">	
	<b><br/>&nbsp;&nbsp;	Distance :  <input type="text" READONLY id="dist-slider-display" maxlength="10" value="10" size="10"/></b>
	  <div id="slider-dist" class="paraSlider"></div>
	<script type="text/javascript">
	$(function() {
	 
	  $("#slider-dist").slider({
		  value:<?php if(isset($_GET["dist"])) { echo $_GET["dist"]; } else {echo "10";} ?>,
			  min: 1,
			  max: 20,
			  step: 1,
			  slide: function(event, ui) {
				  $("#dist-slider-display").attr("value",ui.value); }
	});
	  	  });
	  </script>
</div>

<input type="radio" name="check" value="3" onclick="sing='yes'; $('.end','.simple').hide(); $('.ends').hide(); $('.type2').hide(); $('.grid').hide();$('.liz').show(); num_blocks=100;"/>Convert from binary to Greyscale<br/>



<h3>&nbsp; Select Type of Distance </h3>
<input type="radio" name="type" value="1" id="city" checked />City Blocks<br />
<input type="radio" name="type" value="2" />Chessboard<br/>
<input type="radio" name="type" value="3" />Eucledian<br/>

</div>

<div class="Parameters advanced">
<h3>&nbsp; Check Connectivity</h3>
<input type="radio" name="type2" value="4" checked />4 connectivity<br />
<input type="radio" name="type2" value="8" />8 connectivity<br/>
</div>
</div>

</body>


