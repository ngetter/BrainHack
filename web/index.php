<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>jQuery UI Slider - Default functionality</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  <script>
  $(function() {
    $( ".slider" ).slider();
    $( "#send" ).button({
      icons: {
        primary: "ui-icon-person"
      		}
    	}).click(function(event){
    			event.preventDefault();
    			
    			var params = {
    				h1: $("#h1").slider("value"),
    				h2: $("#h2").slider("value"),
    				//e3: $("#e3").slider("value")
    			}
    			//alert("params" + params.h1 + " @ "+ params.h2 + " @ "+ params.e3 + " @ ");
    			$.get("http://ec2-54-213-248-188.us-west-2.compute.amazonaws.com/thresholds", 
    				params, function(data){ 
    					alert (data);
    				});
    	});

	     $( "#create_table" ).button({
	      icons: {
	        primary: "ui-icon-person"
	      		}
	    	}).click(function(event){
	    			event.preventDefault();
	    			$.get("ajax.php",  "",
	    				function(data){ 
	    					$( "#result" ).html( data);
	    				},
	    				"text");
	    	});
	});
  </script>

  <style>
  	.slider {width: 200px; margin: 1em 1em 1em 1em;}
  	#container {width: 50%; margin: 2em 2em 2em 2em; vertical-align: center;}
  </style>
</head>
<body>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">PTSD Rage Prevention</a>
    </div>
  </div>
</nav>
<div id="container">
	<div class="row" id="eq">
		<div class="col-md-4">
		<img class="img-rounded" alt="brainSteer" src="http://static1.squarespace.com/static/5635be21e4b0e778f323a9d2/56376a73e4b05c5c7e7b79fb/564b2671e4b04d9b27f713e6/1447765618455/neurosteer.png?format=300w" />
		</div>
		<div class="col-md-8">
		<h4>Beta</h4>
		<div  class="slider" id="h1"></div>
		<h4>Theta</h4>
		<div  class="slider" id="h2"></div>
		</div>
	</div>
	<button type="button" class="btn btn-primary" id="send">Send to patient device</button> 
	<button type="button" class="btn btn-primary" id="create_table">Get patient rage alerts</button> 

	<h3>Patient's rage attacks</h3>
	<div id="result">

	</div>
</div>
</body>
</html>