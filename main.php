<?php include("database.php"); ?>

<?php $sql = "SELECT * FROM movies where active=1 AND release_date < CURRENT_DATE";
$sql2 = "SELECT * FROM users where f_name='admin'";



$result = $conn->query($sql);
if ($result->num_rows > 0) {
	$result->fetch_assoc(); # this fetches each result as an object, aka associative array
}





?>


<!DOCTYPE html>
<html lang="en">

<head>
	<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> -->
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Cinemax</title>
	<link rel="icon" href="logo.png" />
	<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"> -->
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>

	<link href="main.css" rel="stylesheet" />
	
	
	

</head>

<body>

	<?php include("header.php") ?>
	
	<?php include("slideshow.php") ?>
	
	

	<div id="full_body" style="display: flex; ">
		<div id="left_side"> 

 


		</div>

		<div id="middle_side" style="width: 70%">
		
			<br />
			<br>
			
			<p class="menutitle"> ФИЛМИ </p>
			<br>
			<div id="searchnav">
				<select name="movies" id="movieselect" onchange="redirectToMovie()">
					<option value="x" disabled selected> Изберете филм</option>
					<?php
					// Loop through the result set
					foreach ($result as $movie) {
						echo '<option value="' . $movie['id_movie'] . '">' . $movie['title'] . '</option>';
					}
					?>
				</select>
				<label id="ili" > <i> или </i> </label>
				<input placeholder="Търсене на филм" id="searchInput"
					onkeydown="if (event.keyCode === 13) performSearch()" autocomplete="off">
				<!-- <button id="searchbutton" onclick="performSearch()"></button> -->
				 <i class="fa fa-search" style="color:white" onclick="performSearch()" id="searchbutton"></i> 
				<div id="searchResults"></div>

			</div>
			<br>


			<div id="tagsdiv">
			<button id="btnAll"  onclick="toggleButton('btnAll')" class="selected">Всички <i class="fa fa-list"></i></button>
   			<button id="btnAnimations"  onclick="toggleButton('btnAnimations')">Анимация</button>
   			<button id="btnPremieres"  onclick="toggleButton('btnPremieres')">Екшън</button>
    		<button id="btnHorror"  onclick="toggleButton('btnHorror')">Ужас</button>
			<button id="btnComedy"  onclick="toggleButton('btnComedy')">Комедия</button>
			<button id="btnFav"  onclick="toggleButton('btnFav')">Рейтинг <i class="fa fa-star"></i></button>
			<button id="btnAZ"  onclick="toggleButton('btnAZ')">A-Z <i class="fa fa-sort"></i></button>
			<button id="btnDate"  onclick="toggleButton('btnDate')">Дата <i class="fa fa-calendar"></i></button>
    		<button id="btnComingSoon" onclick="toggleButton('btnComingSoon')">Очаквайте <i class="fa fa-clock-o"></i></button>
			</div> 
			<!-- <hr style="border: 1px solid rgb(38, 185, 185);"> -->

			<div id="menu">
					<!-- the entire menu in load-movies.php-->
			</div>
			

			<p class="menutitle"> МЕНЮТА </p>
		</div>

		<div id="right_side">
		</div>
	</div>
	
	<div id="awards" style=" display:flex; justify-content: center; gap:2rem"> 
	

	



	
	</div>	

	<div id="menus" >
			
			<div class="item" title="5.00лв">
				<p>Стандартно</p>
			<img src="normalmenu.png" alt="" > <br> <br> 
			<label>0.5L Cola + Средни пуканки</label>
		</div>
	
	<div class="item" title="8.50лв"> 
		<p>МЕГА</p>
	<img src="bigmenu.png" alt=""> <br> <br>
	<label>0.75L Cola + Големи пуканки</label>
	</div>
	
	<div class="item" title="12.50лв">
		<p>За Двама</p>
	<img src="doublemenu.png" alt=""> <br> <br>
	<label>2х 0.5L Cola + Големи пуканки</label>
	 </div>
	
		</div> <br>

	</div>

	
	<?php include("footer.php") ?>

	<a id="backtotopbutton"></a>


	<script src="main.js"></script>
</body>

</html>