<!DOCTYPE html>
<html lang="en"><head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Bitcoin Jukebox by Paralelní Polis">
	<title>Bitcoin Jukebox</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="author" content="">


	<!--	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">-->
	<link rel="stylesheet" href="/bitcoinJukebox/desktopQueue/www/bootstrap.min.css">
	<link rel="stylesheet" href="/bitcoinJukebox/desktopQueue/www/css/style.css">
	<link rel="stylesheet" href="/bitcoinJukebox/desktopQueue/www/css/mediaelementplayer.css">

	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->

	<style>
		* {
			max-font-size: 5px;
			min-font-size: 5px;
		}
	</style>

</head>

<body>

<div id="wrapper">

	<script id="songTemplate" type="text/x-jsrender" data-jsv-tmpl="jsvTmpl">
		<div class="panel panel-default" style="margin-bottom: 0px;">
			<div class="panel-body">
				<div class="row">
					<div class="col-md-9 col-sm-9">
						<a data-url="{{:location}}" data-duration="{{:duration}}">
							<p>Title: {{:title}}</p>
							<p>Author: {{:author}}</p>
						</a>
					</div>
					<div class="col-md-3 col-sm-3 album-icon-wrapper">
						<img class="album-icon" src="{{:album_cover}}">
					</div>
				</div>
			</div>
		</div>
	</script>

	<!-- Sidebar -->
	<div id="sidebar-wrapper">
		<h2>Current playlist</h2>
		<div class="panel panel-default" style="margin-bottom: 0">
			<div class="panel-body" style="padding: 0; text-indent: 5px">
				<div id="audio-container">
					<div id="mep_0" class="mejs-container mejs-audio" style="width: 100%; height: 30px;">
						<div class="mejs-inner">
							<div class="mejs-mediaelement">
								<audio id="player" preload="none" src="http://localhost/bitcoinJukebox/desktopQueue/../songs/7c2c537d-aa36-4bcd-a02e-f08aa8e8b5b7.mp3"></audio>
							</div>
							<div class="mejs-controls">
								<div class="mejs-time-rail" style="width: 245px;">
									<span class="mejs-time-total" style="width: 240px;">
										<span class="mejs-time-loaded" style="width: 238px;"></span>
										<span class="mejs-time-current" style="width: 54.3087px;"></span>
									</span>
								</div>
								<div class="mejs-time">
									<span class="mejs-currenttime">00:00</span>
									<span> / </span>
									<span class="mejs-duration">2:29</span>
								</div>
							</div>
							<div class="mejs-clear"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="queue-list">

			<div class="panel panel-default" style="margin-bottom: 0px;">
				<div class="panel-body">
					<div class="row">
						<div class="col-md-9 col-sm-9">
							<a data-url="songs/7c2c537d-aa36-4bcd-a02e-f08aa8e8b5b7.mp3" data-duration="2:29">
								<p>Title: Yep</p>
								<p>Author: Jahzzar</p>
							</a>
						</div>
						<div class="col-md-3 col-sm-3 album-icon-wrapper">
							<img class="album-icon" src="" style="display: none;">
						</div>
					</div>
				</div>
			</div>

			<div class="panel panel-default" style="margin-bottom: 0px;">
				<div class="panel-body">
					<div class="row">
						<div class="col-md-9 col-sm-9">
							<a data-url="songs/60572891-fb1c-47c8-986c-a02e13fb0ac8.mp3" data-duration="2:03">
							</a>
							<p>Title: Broken Pipe Basement Surf</p>
							<p>Author: Phil Reavis</p>
						</div>
						<div class="col-md-3 col-sm-3 album-icon-wrapper">
							<img class="album-icon" src="" style="display: none;">
						</div>
					</div>
				</div>
			</div>

			<div class="panel panel-default" style="margin-bottom: 0px;">
				<div class="panel-body">
					<div class="row">
						<div class="col-md-9 col-sm-9">
							<a data-url="songs/5b5bcab6-2c32-4ba0-ab94-bb5af38be039.mp3" data-duration="5:11">
								<p>Title: The long and quiet flight of the pelican</p>
								<p>Author: Ending Satellites</p>
							</a>
						</div>
						<div class="col-md-3 col-sm-3 album-icon-wrapper">
							<img class="album-icon" src="" style="display: none;">
						</div>
					</div>
				</div>
			</div>

			<div class="panel panel-default" style="margin-bottom: 0px;">
				<div class="panel-body">
					<div class="row">
						<div class="col-md-9 col-sm-9">
							<a data-url="songs/583c1083-3bab-4f04-acc3-6b3e326a46d2.mp3" data-duration="2:35">
								<p>Title: Copenhagen</p>
								<p>Author: The New Mystikal Troubadours</p>
							</a>
						</div>
						<div class="col-md-3 col-sm-3 album-icon-wrapper">
							<img class="album-icon" src="" style="display: none;">
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
	<!-- /#sidebar-wrapper -->

	<!-- Page Content -->
	<div id="page-content-wrapper">
		<div class="container-fluid">
			<h1>Bitcoin Jukebox</h1>
			<h3>Step 1: Read QR code with your mobile phone.</h3>
			<h3>Step 2: Order songs you like.</h3>
			<h3>Step 3: Pay them with bitcoin.</h3>
			<img src="data:image/png;&#10;&#9;&#9;&#9;base64,iVBORw0KGgoAAAANSUhEUgAAAPoAAAD6CAIAAAAHjs1qAAAE30lEQVR4nO3dwXbbNhRAQdsn///JPt11VbKlCgiA7sw2CSlLN1g8weD37+/vFzT8rH4B8D5yJ0TuhMidELkTIndC5E6I3An5c/NnPz9n/Gd4+k3Z1c+12zduo17n08/x6vof0MMZPwAMIXdC5E6I3AmROyFyJ0TuhNzN3a+smk8/nfuOmhOvmluPep9nf16n9PBldSdF7oTInRC5EyJ3QuROiNwJeWXufmXUnHv2vPnqdc6ei6/al79qf/9uPXxZ3UmROyFyJ0TuhMidELkTIndCRs7dd7Pb+SpP599PX89u5+RsyOpOiNwJkTshcidE7oTInRC5E/LJc/fZ+8Jn748fda6O+f3frO6EyJ0QuRMid0LkTojcCZE7ISPn7rvNa2fPlWfP0Wf71HPfb+z1AcBUcidE7oTInRC5EyJ3QuROyCtz993mx6uMmuuP2o8+e3/80+ts6JgXCv+f3AmROyFyJ0TuhMidELkT8r3hpuRT7HYuzZVV992Q1Z0QuRMid0LkTojcCZE7IXIn5G6/+6p9zLOfb/rUbvu/T9lnv+rv37C6EyJ3QuROiNwJkTshcidE7oS8st991Fx59px1t/3ls/fB7/a5bPg9idWdELkTIndC5E6I3AmROyFyJ2THufuo+37w/HiIVfP+hefwWN0JkTshcidE7oTInRC5EyJ3Qu7m7gPP93h0/Sunz8UXnq/ykV54f6zuhMidELkTIndC5E6I3AmROyErn6s6e16+23nkV3ab35/+/tywuhMid0LkTojcCZE7IXInRO6EvGO/+25z3KdW7Uff7X24csr782V1J0XuhMidELkTIndC5E6I3AkZeb77qvPIF85xh1znlO8NVj3v9orz3eGO3AmROyFyJ0TuhMidELkT8o5zZnY7p3zVfH3VdZ7a7XyYgf1Y3QmROyFyJ0TuhMidELkTIndCRu53v3L6fuvZ+9R3O7dnNue7wzvInRC5EyJ3QuROiNwJkTshr5zvfsXc9/76q/avz+Z8d9iR3AmROyFyJ0TuhMidELkTMvK5qrudc7LKbufDjLrvKb+HcHeLp/8AziV3QuROiNwJkTshcidE7oTsOHe/Mvu8mlGv58pu993tc3wDqzshcidE7oTInRC5EyJ3QuROyJ833GO352vOnjfvdo7NKb8/YL87jCR3QuROiNwJkTshcidE7oS88lzVU8x+/uiq+frs68/+nuSpgefbWN0JkTshcidE7oTInRC5EyJ3Qu72u++2H/rKqnnzKXP0UVb9vsHA7wfOCBqGkDshcidE7oTInRC5EyJ3Ql45Z2bVFvk3nEPyyOzzXmbvR39q9n3f8P2J1Z0QuRMid0LkTojcCZE7IXInZOT57queG3pl1dx61fkqo66zat/8G1jdCZE7IXInRO6EyJ0QuRMid0Le8VzVU4zavz7K7Pn0Kd9vDHwfrO6EyJ0QuRMid0LkTojcCZE7Iebu/272/vJRdnte7G7Pqf2yupMid0LkTojcCZE7IXInRO6EjJy7rzp3fJRR8+NRTtlPv9u5Ojes7oTInRC5EyJ3QuROiNwJkTshr8zdF57PPdXTn2v2c1VH3ffKqrn+wufjfma48I/kTojcCZE7IXInRO6EyJ2Q79M3qcN/Z3UnRO6EyJ0QuRMid0LkTojcCZE7IX8Bu0ZQvqJSSGQAAAAASUVORK5CYII=&#9;&#9;&#9;" class="qr-image">
		</div>
	</div>
	<!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->


<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jsrender/0.9.72/jsrender.min.js"></script>

<?php
require_once '../vendor/autoload.php';
?>

<?php if (\Nette\Utils\Strings::contains($_SERVER['REQUEST_URI'], 'www') || !($_SERVER['SERVER_NAME'] == 'localhost' || \Nette\Utils\Strings::startsWith($_SERVER['SERVER_NAME'], '192.168'))) { ?>
<script src="js/appStatic.js"></script>
<?php } else { ?>
<script src="www/js/appStatic.js"></script>
<?php } ?>





</body></html>