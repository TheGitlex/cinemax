<?php include("database.php"); ?>
<?php $sql = "SELECT * FROM movies order by id_movie desc";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	$result->fetch_assoc(); 
}

$user_email = isset($_COOKIE['user_email']) ? $_COOKIE['user_email'] : null;

if ($user_email) {

    $sql = "SELECT * FROM users WHERE email = '$user_email'";
    $result3 = $conn->query($sql);

    if ($result3->num_rows > 0) {

        $row = $result3->fetch_assoc();

        $user_result = $row['admin']; 

    }
}

if ( $user_result == 0) {

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

        $.ajax({
            type: 'POST',
            url: 'addMovie.php', 
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

                location.reload(); 
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
            <div style=" margin-top: 1rem; background-color:rgba(132, 132, 132, 0.407); padding:10px; border-radius:5px; border: 5px solid black;">
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

    while ($row = $adminresult->fetch_assoc()) {

        echo "<p style='color: white;'> " . $row["email"]. "</p>";

    }
} 
echo '</div>';
?>
    </div>

            <div id="userList" style="margin-top: 1rem; background-color:rgba(132, 132, 132, 0.407); padding:10px; border-radius:5px; border: 5px solid black;">
            <input type="text" id="searchInput" onkeyup="filterUsers()" placeholder="Search for users..."> <br>
    <?php
   $userssql = "SELECT * FROM users ORDER BY access ASC, email ASC"; 
   $result = mysqli_query($conn, $userssql);

   if (mysqli_num_rows($result) > 0) {

       while ($row = mysqli_fetch_assoc($result)) {

           $color = ($row['access'] == 0) ? "yellow" : "white";

           echo '<a class="usera" style="color: ' . $color . ';" href="profileadmin.php?uid=' . $row['id_user'] . '">' . $row['email'] . '</a><br>';
       }
   } else {
       echo "No users found.";
   }
    ?>
</div>
<script>
        function filterUsers() {
            var input, filter, userList, users, email, i;
            input = document.getElementById('searchInput');
            filter = input.value.toLowerCase();
            userList = document.getElementById('userList');
            users = userList.getElementsByClassName('usera');

            for (i = 0; i < users.length; i++) {
                email = users[i].textContent || users[i].innerText;
                if (email.toLowerCase().indexOf(filter) > -1) {
                    users[i].style.display = "";
                } else {
                    users[i].style.display = "none";
                }
            }
        }
    </script>

		</div>

		<div id="right_side">

<div style=" margin-left:3rem; margin-top: 30rem;background-color:rgba(132, 132, 132, 0.407); padding:10px; border-radius:5px; border: 5px solid black;"> 

<div>
    <input id="codeInput" placeholder="CODE" style="width: 200px;">  
    <input id="amountInput" placeholder="amount%" autocomplete="none">  
    <br>
    <div style="display:flex">
        <button id="addCodeButton" style="width: 80px;height:50px; background-color:antiquewhite"> + </button> 
        <button id="removeCodeButton" style="width:80px; background-color:antiquewhite"> - </button>
        <button id="generateCodeButton" style="width:40px; background-color:antiquewhite" onclick="generateCode()"> <i class="fa fa-rotate-left"></i> </button>
    </div>
</div>
<br>
<script>
function generateCode() {

  const generatedCode = generateRandomCode(4);

  $("#codeInput").val(generatedCode);
  $("#amountInput").val(5);

}

function generateRandomCode(length) {
  const characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
  let randomCode = "";

  for (let i = 0; i < length; i++) {
    const randomIndex = Math.floor(Math.random() * characters.length);
    randomCode += characters.charAt(randomIndex);
  }

  return randomCode;
}

</script>
<?php
$codesql = "SELECT * FROM discounts WHERE active=1 ORDER BY amount DESC";
$coderesult = $conn->query($codesql);
echo '<div style="height:200px;overflow:auto">';
if ($coderesult->num_rows > 0) {

    while ($row = $coderesult->fetch_assoc()) {

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

    if (code !== '' && amount !== '' && amount>=0) {

        let xhr = new XMLHttpRequest();
        xhr.open('POST', 'add_discount.php');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {

                location.reload(); 
            }
        };
        xhr.send('code=' + encodeURIComponent(code) + '&amount=' + encodeURIComponent(amount));
    }
});

document.getElementById('removeCodeButton').addEventListener('click', function() {
    let code = document.getElementById('codeInput').value.trim();

    if (code !== '') {

        let xhr = new XMLHttpRequest();
        xhr.open('POST', 'remove_discount.php');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {

                location.reload(); 
            }
        };
        xhr.send('code=' + encodeURIComponent(code));
    }
});

</script>

    <script>
   function updateAdmin(action) {
    var email = $("#addInput2").val().trim();

    if (email.toLowerCase() === 'admin@gmail.com' && action === 'remove') {
        alert("Cannot remove admin status for 'admin@gmail.com'");

        return;
    }

        $.ajax({
            type: "POST",
            url: "updateAdmin.php",
            data: { email: email, action: action },
            success: function(response) {

                alert(response);
                location.reload(); 
            }
        });
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
      url: "load_movies.php", 
      data: { category: category },
      success: function (response) {

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