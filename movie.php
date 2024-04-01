<?php
include("database.php");

$movieId = $_GET['id'];

// Fetch movie details
$sql = "SELECT * FROM movies WHERE id_movie = $movieId;";
$sql2 = "SELECT rating_value FROM ratings WHERE id_movie = $movieId;";
$result = $conn->query($sql);
$ratingresult = $conn->query($sql2);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $title = $row['title'];
    $genre = $row['genre'];
    $director = $row['director'];
    $duration = $row['duration'];
    $trailer = $row['trailer'];
    $description = $row['description'];
    $icon = $row['icon'];
    $age_rating = $row['age_rating'];
    $release_date = $row['release_date'];
    $active= $row['active'];
} else {
    echo "0 results";
}


$rating = 0;
$numVotes = 0;
$averageRating = 0; // Default value in case there are no ratings yet

if ($ratingresult->num_rows > 0) {
    $totalRating = 0;
    $numVotes = 0;

    // Fetch all ratings for the movie
    while ($row2 = $ratingresult->fetch_assoc()) {
        $totalRating += $row2['rating_value'];
        $numVotes++;
    }

    // Calculate the average rating
    if ($numVotes > 0) {
        $averageRating = $totalRating / $numVotes;
    }
}

// Get the user's rating for the specific movie
// Get the user's rating for the specific movie
$user_email = isset($_COOKIE['user_email']) ? $_COOKIE['user_email'] : null;




if ($user_email) {
    // SQL query to get user information for the currently logged-in user
    $sql = "SELECT * FROM users WHERE email = '$user_email'";
    $result3 = $conn->query($sql);

    if ($result3->num_rows > 0) {
        // Fetch the user information
        $row = $result3->fetch_assoc();

        // Check the user's role
        $user_result = $row['f_name'];
        $admin=$row['admin']; // Assuming the role is stored in the 'f_name' column
        $userId= $row['id_user'];

        // Now you can use $user_result to check if the user is an admin
    }
}

if ($user_email) {
    // SQL query to get user rating for the specific movie
    $user_rating_sql = "SELECT rating_value FROM ratings WHERE id_user = (SELECT id_user FROM users WHERE email = '$user_email') AND id_movie = $movieId";
    $user_rating_result = $conn->query($user_rating_sql);

    if ($user_rating_result->num_rows > 0) {
        $user_rating_row = $user_rating_result->fetch_assoc();
        $user_rating = $user_rating_row['rating_value'];
    } else {
        // User hasn't rated the movie yet
        $user_rating = null;
    }
}

	
if ( $active==0 && $admin == 0) {
    // Redirect to error.php
    header("Location: error.php");
    exit();
}
    



?>



<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <link rel="icon" href="logo.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?> - Cinemax</title>
    <link rel="stylesheet" href="movie.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vibrant.js/1.0.0/Vibrant.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->

    
</head>

<body>
<?php include("header.php") ?>

   

    <div id="aligner">
        <div id="moviepage" >
        <!-- style="background: linear-gradient(rgba(0, 0, 0, 0.75), rgb(0, 0, 0, 0.75)), url(icons/); background-repeat: no-repeat;
  background-size: cover;
  background-position: center center;border-radius:10px; filter:" -->


            <div id="title">
            <h1>
    <?php echo $title . ' ';   ?>
</h1>
<!-- <label style="color: grey; font-size: 1rem; ">(notificaciq)</label> -->
            </div>

            <div id="trailer">
                <iframe 
                    src="https://www.youtube.com/embed/<?php echo $trailer; ?>?si=5cVkP3gu_rtcFHU8"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen></iframe>
            </div>

            <!-- <div id="description">
                
            </div> -->
            <div id="combination">
                <div id="icon">
                    <img id="extract"  src="icons/<?php echo $icon; ?>" alt=""  style=" border-radius: 10px; width:70%">
                </div>
            

                <div id="div3">
                <p>
                    <?php echo $description; ?>
                </p>
                </div>

                <div id="categories">
                   
                    <p> <b> Времетраене: </b> <label> <?php echo sprintf('%dч %02dмин', $duration / 60, $duration % 60); ?> </label> </p>
                    <p> <b> Жанр: </b> <label>    <?php echo $genre; ?>  </label> </p>
                    <p> <b> Премиера: </b> <label> <?php echo date('d-m-Y', strtotime($release_date)); ?> </label> <?php if (strtotime($release_date) > strtotime("now") && $user_email ) {
        $isSubscribed = false;

        // Check if the user is subscribed to notifications for this movie
        if ($user_email) {
            $checkSubscriptionSql = "SELECT * FROM notifications WHERE id_user = $userId AND id_movie = $movieId";
            $subscriptionResult = $conn->query($checkSubscriptionSql);

            if ($subscriptionResult->num_rows > 0) {
                $isSubscribed = true;
            }
        }

        if ($isSubscribed) {
            echo '<i id="notifbutton" title="Напомняне: Включено" class="fa fa-bell-slash" style="color: cyan;"></i>';
        } else {
            echo '<i id="notifbutton" title="Напомняне: Изключено" class="fa fa-bell" style="color: white;"></i>';
        }
    }  ?> </p>
                    <p> <b> Aудио: </b> <label>ENG</label> </p>
                    <p><b> Субтитри: </b> <label>BG</label> </p>
                    <p> <b> Режисьор: </b> <label>  <?php echo $director; ?> </label> </p>
                    <p> <b> Години:</b> <label> <?php echo $age_rating; ?>+  </label> </p>
                    <p><b>Общ рейтинг:</b> <label><?php echo number_format($averageRating, 2); ?> <i class="fa fa-star"></i>  (<?php echo $numVotes ?>)</label></p>
                    <div id="ratingcombo" <?php if ((strtotime($release_date) > strtotime("now"))){echo "style='display:none'";} ?> >
                    <p><b> Твой рейтинг: </b><label class="<?php echo isset($user_rating) && $user_rating == '5.0' ? 'yellow' : ''; ?>"><?php echo isset($user_rating) ? $user_rating : ''; ?></label>
<?php if (isset($user_rating)) : ?> <button id="deleteRatingBtn"> <i class="fa fa-trash"></i> </button> <?php endif; ?></p>

                    <div class="rating">
            <input value="5" name="rating" id="star5" type="radio">
            <label for="star5"></label>
            <input value="4" name="rating" id="star4" type="radio">
            <label for="star4"></label>
            <input value="3" name="rating" id="star3" type="radio">
            <label for="star3"></label>
            <input value="2" name="rating" id="star2" type="radio">
            <label for="star2"></label>
            <input value="1" name="rating" id="star1" type="radio">
            <label for="star1"></label>
            <input type="hidden" id="movieId" value="<?php echo $movieId; ?>">
          </div>
          
                    
                    <?php 

// Assuming you already have a database connection ($conn)

if ($user_email) {
    // The user is logged in, show the rating stars
    echo '';
} else {
    // The user is not logged in, show the message
    echo '<p><i>Създай акаунт за гласуване</i></p>';
}
?>


<script>
    $(document).ready(function () {
        // Attach a click event handler to each star
        $('.rating input').on('click', function () {
            // Get the selected rating
            var rating = $(this).val();

            // Get the movie ID from the hidden input
            var movieId = $('#movieId').val();

            // Make an asynchronous request to rating.php
            $.ajax({
                url: 'rating.php',
                type: 'post',
                data: { rating: rating, id_movie: movieId },
                success: function (response) {
                    // Handle the response from the server (e.g., show a message)
                    console.log(response);

                    // Refresh the page
                    location.reload();
                },
                error: function (error) {
                    // Handle errors
                    console.error('Error:', error);
                }
            });
        });

        // Fetch user's existing rating from PHP
        var userRating = <?php echo isset($user_rating) ? $user_rating : 0; ?>;

        // Color stars based on the existing rating
        for (var i = 1; i <= userRating; i++) {
            $('#star' + i).next('label').css('color', '#1caef3');
        }

        // Display the user's rating next to the label
        $('#userRatingLabel').text(userRating);
    });



    $(document).ready(function () {
    // Attach a click event handler to the delete rating button
    $('#deleteRatingBtn').on('click', function () {
        // Get the movie ID from the hidden input
        var movieId = $('#movieId').val();

        // Make an asynchronous request to delete_rating.php
        $.ajax({
            url: 'delete_rating.php',
            type: 'post',
            data: { id_movie: movieId },
            success: function (response) {
                // Handle the response from the server (e.g., show a message)
                console.log(response);

                // Refresh the page
                location.reload();
            },
            error: function (error) {
                // Handle errors
                console.error('Error:', error);
            }
        });
    });
});

</script>




                    </div>
                </div>    
            </div>
            <?php 
    if ((strtotime($release_date) < strtotime("now"))) {
        include("projectionstable.php");
    } else if(isset($_COOKIE["user_name"])) 
    if($admin==1){
        include("projectionstable.php");
    }
?>
        </div>

       
<!-- projectionstable -->



  <!--  -->
    
    </div>

    <div id="ticketPopup" class="popup">
    <div class="popup-content">
    <span class="close" onclick="closeTicket()">&times;</span>
    <h2>Билет</h2> <br>

    <?php
    if(!isset($_COOKIE["user_name"])) {
        echo '<button id="wrongbookbutton"> <a id="timelink2" href="loginplace.php"> <b> Влез с акаунт</b> </a> </button> <p>за запазване на билет. </p> ';
    } else {
        echo "
        <div id='ticketContent' style='display: flex;'>
            <div class='mini-container'>
                <img src='icons/$icon' height='100px'>
                <p>$title</p>
            </div>
            <div class='mini-container'>
               <p>Дата: <span id='ticketPopupDate'></span> </p>
               <p id='selectedTime'> </p>
               <input type='hidden' id='hallId'> <!-- Hidden input field for hall ID -->
               <a id='timeLink' href=''><button id='bookbutton' > ЗАПАЗИ </button> </a>
            </div>
        </div>";
    }
?>


</div>
<!-- <button onclick="test()">Click Me</button> -->

<script>
  function test() {
    Swal.fire({
     title: "Билет",
      html: '<button id="wrongbookbutton"> <a id="timelink2" href="loginplace.php" style="font-size:1.3rem"> <b> Влез с акаунт</b> </a> </button> <p style="color:black;">за запазване на билет. </p> ',
      icon: "info",
      showCloseButton: true,
      confirmButtonColor: "#3085d6",
      onOpen: () => {
    document.body.style.overflow = 'auto';
  },
  onClose: () => {
    document.body.style.overflow = '';
  }
      
    });
  }
</script>

</div>
<script>
function openTicket(button, dayIndex, projectionId, hallId) {
    document.getElementById("ticketPopup").style.display = "block";
    var time = button.textContent.trim();
    var dateLabelId = "day_" + dayIndex;
    var dateLabelText = document.getElementById(dateLabelId).innerText;
    var trimmedDateText = dateLabelText.substring(0, 5);
    
    // Set the date in the ticket popup
    document.getElementById('ticketPopupDate').innerText = trimmedDateText;

    // Set the selected time in the ticket popup
    document.getElementById('selectedTime').textContent = "Час: " + time;

    // Construct href attribute for link with hall ID
    var movieId = "<?php echo $movieId ?>";
    var timeLink = document.getElementById('timeLink');
    timeLink.href = 'movieseats.php?id=' + movieId + '&time=' + encodeURIComponent(time) + '&date=' + encodeURIComponent(trimmedDateText) + '&hall=' + hallId + '&projection=' + projectionId;

    // Prevent default behavior of the anchor tag
    event.preventDefault();
}








function closeTicket() {
    document.getElementById("ticketPopup").style.display = "none";
}
 </script>

    <?php
if (isset($_COOKIE['user_name']) && $user_result == 1) {
    // User is logged in as admin
    echo '<div id="edit">
        <input type="hidden" id="movieId" value="' . $movieId . '">
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
    </div>';

    
}
?>

    
        <script> 
    function editMovie() {
    // Retrieve input values
    const id_movie = document.getElementById('movieId').value;
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
    // if (!id_movie) {
    //     alert('ID is a required field');
    //     return;
    // }

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
  

    <a id="backtotopbutton"></a>
    <script>
        var btn = $('#backtotopbutton');

$(window).scroll(function() {
  if ($(window).scrollTop() > 300) {
    btn.addClass('show');
  } else {
    btn.removeClass('show');
  }
});

btn.on('click', function(e) {
  e.preventDefault();
  $('html, body').animate({scrollTop:0}, '300');
});
    </script>


<script>
    
  // Load the image
 var image = document.getElementById('extract');

  // Create a vibrant.js instance with the image
  var vibrant = new Vibrant(image);
  var palette = vibrant.swatches();

  // Get the vibrant color from the palette
  var vibrantColor = palette.Vibrant.getHex() || '#021424'; // Default to #021424 if Vibrant color is not available

  // Create secondary color for the edges
  var secondaryColor = palette.DarkVibrant.getHex() || '#000000';

  // Create a gradient with vibrant color in the middle and secondary colors on both edges
  var gradient = `linear-gradient(to right, ${secondaryColor} 0%, ${vibrantColor} 50%, ${secondaryColor} 100%)`;

  // Apply the gradient to the body background
  document.body.style.background = gradient;



  
</script>

<script src="main.js"></script>

<script>
    $(document).ready(function() {
        $('#notifbutton').click(function() {
            // Make an AJAX request to handle the notification
            $.ajax({
                url: 'handle_notification.php', // Change the URL to your server-side PHP script
                type: 'POST',
                data: {
                    movieId: <?php echo $movieId; ?>, // Pass the movie ID to identify the movie
                    userId: <?php echo $userId; ?>, // Pass the user ID to identify the user
                },
                success: function(response) {
                    location.reload();
                    // Handle the response, you can update the UI here if needed
                    console.log(response);
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });
    });



  

   
</script>






<br> <br> <br>
<?php include("footer.php"); ?>
</body>

</html>