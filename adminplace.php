<?php include("database.php"); ?>
<?php $sql = "SELECT * FROM movies order by id_movie desc";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	$result->fetch_assoc(); 
}

$user_email = isset($_COOKIE['user_email']) ? $_COOKIE['user_email'] : null;

if ($user_email) {
    // SQL query to get user information for the currently logged-in user
    $sql = "SELECT * FROM users WHERE email = '$user_email'";
    $result3 = $conn->query($sql);

    if ($result3->num_rows > 0) {
        // Fetch the user information
        $row = $result3->fetch_assoc();

        // Check the user's role
        $user_result = $row['admin']; // Assuming the role is stored in the 'f_name' column

        // Now you can use $user_result to check if the user is an admin
    }
}

if ( $user_result == 0) {
    // Redirect to error.php
    header("Location: error.php");
    exit();
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>CINEMAX</title>
	<link rel="icon" href="logo.png" />
	<link href="adminplace.css" rel="stylesheet" />
	
    
</head>

<body>

<?php include("header.php") ?>
   

	

	<div id="full_body" style="display: flex; ">
		<div id="left_side" style="margin-top: 500px">

        <div style=" position: fixed; margin-left:5rem;background-color:rgba(132, 132, 132, 0.407); padding:10px; border-radius:5px; border: 5px solid black;">
        <div id="addremove"> 
        <input placeholder="id" id="addInput" style="width: 120px; "> <br> 
        <div style="display:flex; justify-content:space-between;">
        <button style="width: 60px;height:60px;" onclick="addmovie()"> active </button> </br> 
         <button onclick="removemovie()"> remove </button>
    </div>
        </div> <br>

        <label style="color:white"> add New </label><br>
        <button style="width:50px; height:50px" onclick="addNewMovie()">+</button>
        </div>

        <script>
           
        function addmovie(){
           let i =  document.getElementById("addInput").value;
           updateStatus(i, 1);
        }
        function removemovie(){
            let i =  document.getElementById("addInput").value;
            updateStatus(i, 0);

        }
        function addNewMovie() {
        // Perform AJAX request to the server-side script that executes the SQL query
        $.ajax({
            type: 'POST',
            url: 'addMovie.php', // Replace with the actual server-side script
            success: function (response) {
                location.reload();
            },
            error: function (error) {
                console.log('Error:', error);
            }
        });
    }

        function updateStatus(id_movie, status) {
            fetch('update_menu.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'id_movie=' + encodeURIComponent(id_movie) + '&status=' + encodeURIComponent(status),
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text();
            })
            .then(data => {
            
                location.reload(); // Reload the page
            })
            .catch(error => {
                console.error('Error updating status:', error);
                alert('Error updating status.');
            });
        }
        </script>

        </div>

		<div id="middle_side" style="width: 60%">
			<br />
			<br />
			<br />
			<br />
			<br>
			<br>

			
			<div id="tagsdiv">
			<button id="btnAllAdmin"  onclick="toggleButton('btnAllAdmin')" >Всички <i class="fa fa-list"></i></button>
   			<button id="btnAnimations"  onclick="toggleButton('btnAnimations')">Анимация</button>
   			<button id="btnPremieres"  onclick="toggleButton('btnPremieres')">Екшън</button>
    		<button id="btnHorror"  onclick="toggleButton('btnHorror')">Ужас</button>
			<button id="btnComedy"  onclick="toggleButton('btnComedy')">Комедия</button>
			<button id="btnFav"  onclick="toggleButton('btnFav')">Любими <i class="fa fa-star"></i></button>
			<button id="btnAZ"  onclick="toggleButton('btnAZ')">A-Z <i class="fa fa-sort"></i></button>
			<button id="btnDate"  onclick="toggleButton('btnDate')">Дата <i class="fa fa-calendar"></i></button>
    		<button id="btnComingSoon" onclick="toggleButton('btnComingSoon')">Очаквайте <i class="fa fa-clock-o"></i></button>
			</div> 

			<div id="menu">
			<?php 
			foreach ($result as $movie) {
			 $releaseDate = strtotime($movie['release_date']);
    			$currentDate = time();
   				 $twoWeeksLater = strtotime('+2 weeks', $currentDate);
    			$text = '';
    			$backgroundColor = '';

				if ($movie['active'] == 1 && $releaseDate <= $currentDate) {
					if ( ($currentDate - $releaseDate) <= (14 * 24 * 60 * 60)) {
						$text = 'Премиера';
						$backgroundColor = 'purple';
					} else {$text = 'В продажба';
						$backgroundColor = 'green';}
					
				} elseif ($movie['active'] == 0) {
					$text = 'not available';
					$backgroundColor = 'red';
				} 
				 else {
					$text = 'Очаквайте скоро';
					$backgroundColor = 'rgb(0, 161, 236);';
				}
				
		?>
				<a class="menuitem" href="movie.php?id=<?php echo $movie['id_movie'] ?>">
					<p class="nalichnost" style="background-color: <?php echo $backgroundColor?>;" > <?php echo $text ?> </p> 
					<img src="icons/<?php echo $movie['icon']; ?>" alt="" width="195" height="300">
					<p> <?php echo $movie['title'] . '</br>' . $movie['id_movie']; ?> </p>
				</a>
				<?php }
			?>
			</div>
		</div>

		<div id="right_side">

        <div style="position: fixed; margin-left:5rem; margin-top: 10rem; background-color:rgba(132, 132, 132, 0.407); padding:10px; border-radius:5px; border: 5px solid black;">
    <div id="addremove">
        <input placeholder="email" id="addInput2" style="width: 200px;"> <br>
        <div style="display:flex">
            <button style="width: 100px;height:50px; background-color:antiquewhite" onclick="updateAdmin('add')"> Add admin </button> </br>
            <button onclick="updateAdmin('remove')" style="width:100px; background-color:antiquewhite"> Remove </button>
        </div>
    </div> <br>
    <?php
$adminsql = "SELECT * FROM users WHERE admin=1 ORDER BY email ASC";
$adminresult = $conn->query($adminsql);
echo '<div style="height:100px;overflow:auto">';
if ($adminresult->num_rows > 0) {
    // Output data of each row
    while ($row = $adminresult->fetch_assoc()) {
       
        // Echo the code and amount within <p> tags
        echo "<p style='color: white;'> " . $row["email"]. "</p>";
       
    }
} 
echo '</div>';
?>
    </div>

<div style="position: fixed; margin-left:5rem; margin-top: 30rem;background-color:rgba(132, 132, 132, 0.407); padding:10px; border-radius:5px; border: 5px solid black;"> 

<div>
    <input id="codeInput" placeholder="CODE" style="width: 200px;">  
    <input id="amountInput" placeholder="amount%" >  
    <br>
    <div style="display:flex">
        <button id="addCodeButton" style="width: 100px;height:50px; background-color:antiquewhite"> + </button> 
        <button id="removeCodeButton" style="width:100px; background-color:antiquewhite"> - </button>
    </div>
</div>
<br>
<?php
$codesql = "SELECT * FROM discounts WHERE active=1 ORDER BY code ASC";
$coderesult = $conn->query($codesql);
echo '<div style="height:200px;overflow:auto">';
if ($coderesult->num_rows > 0) {
    // Output data of each row
    while ($row = $coderesult->fetch_assoc()) {
        // Echo the code and amount within <p> tags
        echo "<p style='color: white;'> " . $row["code"] . "  " . $row["amount"] . "%</p>";

    }
} else {
    echo "No discounts available.";
}
echo '</div>';
?>
</div>

<script>
document.getElementById('addCodeButton').addEventListener('click', function() {
    let code = document.getElementById('codeInput').value.trim();
    let amount = document.getElementById('amountInput').value.trim();

    if (code !== '' && amount !== '') {
        // AJAX call to add the discount
        let xhr = new XMLHttpRequest();
        xhr.open('POST', 'add_discount.php');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                // Refresh the table
                location.reload(); // Reload the page
            }
        };
        xhr.send('code=' + encodeURIComponent(code) + '&amount=' + encodeURIComponent(amount));
    }
});


document.getElementById('removeCodeButton').addEventListener('click', function() {
    let code = document.getElementById('codeInput').value.trim();
    
    if (code !== '') {
        // AJAX call to remove the discount
        let xhr = new XMLHttpRequest();
        xhr.open('POST', 'remove_discount.php');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                // Refresh the table
                location.reload(); // Reload the page
            }
        };
        xhr.send('code=' + encodeURIComponent(code));
    }
});



</script>

    <script>
   function updateAdmin(action) {
    var email = $("#addInput2").val().trim();

    // Check if the email is "admin@gmail.com"
    if (email.toLowerCase() === 'admin@gmail.com' && action === 'remove') {
        alert("Cannot remove admin status for 'admin@gmail.com'");
        
        return;
    }

        // Make an AJAX request to the PHP script
        $.ajax({
            type: "POST",
            url: "updateAdmin.php",
            data: { email: email, action: action },
            success: function(response) {
                // Handle the response from the server
                alert(response);
                location.reload(); // Reload the page
            }
        });
    }


</script>

        <!-- <div id="edit">
    <input placeholder="id" id="idInput">
    <input placeholder="title" id="titleInput">
    <input placeholder="yyyy-mm-dd" id="dateInput">
    <input placeholder="genre" id="genreInput">
    <input placeholder="duration" id="durationInput">
    <textarea rows="4" cols="23" placeholder="description" id="descriptionInput"></textarea>
    <input placeholder="director" id="directorInput">
    <input placeholder="trailer" id="trailerInput">
    <input placeholder="icon" id="iconInput">
    <input placeholder="age_rating" id="ageRatingInput">
    <button style="width: 100px; height: 50px" onclick="editMovie()">Edit</button>
        </div> -->
        <script> 
    function editMovie() {
    // Retrieve input values
    const id_movie = document.getElementById('idInput').value;
    const title = document.getElementById('titleInput').value;
    const release_date = document.getElementById('dateInput').value;
    const genre = document.getElementById('genreInput').value;
    const duration = document.getElementById('durationInput').value;
    const description = document.getElementById('descriptionInput').value;
    const director = document.getElementById('directorInput').value;
    const trailer = document.getElementById('trailerInput').value;
    const icon = document.getElementById('iconInput').value;
    const ageRating = document.getElementById('ageRatingInput').value;

    // Check if required fields are not empty
    if (!id_movie) {
        alert('ID is a required field');
        return;
    }

    // Create a FormData object and append the values
    const formData = new FormData();
    formData.append('id_movie', id_movie);
    formData.append('title', title);
    formData.append('release_date', release_date);
    formData.append('genre', genre);
    formData.append('duration', duration);
    formData.append('description', description);
    formData.append('director', director);
    formData.append('trailer', trailer);
    formData.append('icon', icon);
    formData.append('age_rating', ageRating);

    // Make an AJAX request to the server
    fetch('editmovie.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        location.reload(); // Reload the page
    })
    .catch(error => console.error('Error:', error));
}

</script>


	

	</div>
    </div>


	

	<a id="backtotopbutton"></a>
    <script>
        var btn = $('#backtotopbutton');

$(window).scroll(function() {
  if ($(window).scrollTop() > 100) {
    btn.addClass('show');
  } else {
    btn.removeClass('show');
  }
});

btn.on('click', function(e) {
  e.preventDefault();
  $('html, body').animate({scrollTop:0}, '300');
});
function scrollToBottom() {
  const documentHeight = document.documentElement.scrollHeight;
  window.scrollTo({ top: documentHeight, behavior: "smooth" });
}


$(document).ready(function () {
  // Initial load


  // Button click events
  $("#btnAll").click(function () {
    loadMovies("all");
  });
  $("#btnAllAdmin").click(function () {
    loadMovies("admin");
  });

  $("#btnAnimations").click(function () {
    loadMovies("animations");
  });

  $("#btnPremieres").click(function () {
    loadMovies("action");
  });

  $("#btnHorror").click(function () {
    loadMovies("horror");
  });
  $("#btnComedy").click(function () {
    loadMovies("comedy");
  });

  $("#btnFav").click(function () {
    loadMovies("fav");
  });
  $("#btnAZ").click(function () {
    loadMovies("a-z");
  });
  $("#btnDate").click(function () {
    loadMovies("date");
  });

  $("#btnComingSoon").click(function () {
    loadMovies("coming_soon");
  });

  function loadMovies(category) {
    $.ajax({
      type: "POST",
      url: "load_movies.php", // Create this PHP file to handle database queries
      data: { category: category },
      success: function (response) {
        // Update the movies container with the new data
        $("#menu").html(response);
      },
      error: function () {
        alert("Error loading movies.");
      },
    });
  }
});



    </script>

<br> <br><br>
<?php include("footer.php") ?>



</body>

</html>