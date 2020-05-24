<?php

    $presentweather = "";
    $found = "";
    if($_GET["city"]){
        $city = str_replace(' ', '', $_GET["city"]);
        $file = "https://www.weather-forecast.com/locations/$city/forecasts/latest";
        $file_headers = @get_headers($file);
        if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
            $found = "Invalid location, please enter a valid location";
        }
        else {
            $forecastpage = file_get_contents("https://www.weather-forecast.com/locations/$city/forecasts/latest");
            $weatherpage = explode('(1–3 days)</div><p class="b-forecast__table-description-content"><span class="phrase">', $forecastpage);
            $maincontent = explode('</span></p></td>', $weatherpage[1]);
            $presentweather = $maincontent[0];
        }
    }
    else{
        $error = "Invalid location, please enter a valid location";
    }
    

?>

<!doc type html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<title>Weather Scrapper</title>
		<style type="text/css">
			.container{
				text-align:center;
				margin-top:200px;
				width:500px;
			}
			body{
				background-image:url("scrapper.jfif");
				background-size:cover;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<form method="get">
			  <div class="form-group">
				<label for="city"><h4>Enter the location</h4></label>
				<input type="text" class="form-control" id="city" value="<? echo $city ?>" name="city" placeholder="Eg. Delhi, Mumbai">
			  </div>
			  <button type="submit" class="btn btn-primary">Submit</button>
			</form>
            <?php
            if($presentweather){
                echo '<div class="alert alert-success" role="alert">'.$presentweather.'</div>';
                   
            }
            elseif($found){
                echo '<div class="alert alert-danger" role="alert">'.$found.'</div>';
            }
            else{
                echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
            }
            ?>
		</div>
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	</body>
</html>