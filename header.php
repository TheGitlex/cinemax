<?php
include("database.php");

// Check for the user_email cookie
$user_email = isset($_COOKIE['user_email']) ? $_COOKIE['user_email'] : null;
$userId = null;
if ($user_email) {
    // SQL query to get user information for the currently logged-in user
    $sql = "SELECT * FROM users WHERE email = '$user_email'";
    $result3 = $conn->query($sql);

    if ($result3->num_rows > 0) {
        // Fetch the user information
        $row = $result3->fetch_assoc();

        // Check the user's role
        $user_result = $row['admin']; // Assuming the role is stored in the 'f_name' column
        $pfp= $row['pfp'];
        $f_name=$row['f_name'];
        $userId= $row['id_user'];
        // Now you can use $user_result to check if the user is an admin
    }
}

if ($userId) {
    $notification_query = "SELECT movies.title, movies.icon, movies.id_movie, movies.active FROM notifications INNER JOIN movies ON notifications.id_movie = movies.id_movie WHERE notifications.id_user = $userId AND movies.release_date<now() AND active =1";
    $notification_result = $conn->query($notification_query);

    $notifications = [];
    while ($notification_row = $notification_result->fetch_assoc()) {
        $notifications[] = $notification_row;
    }
}

$notification_count = 0;
if ($userId) {
    $notification_count_query = "SELECT COUNT(*) as count 
                             FROM notifications 
                             INNER JOIN movies ON notifications.id_movie = movies.id_movie 
                             WHERE notifications.id_user = $userId AND movies.release_date < NOW() AND movies.active =1";
    $notification_count_result = $conn->query($notification_count_query);

    if ($notification_count_result->num_rows > 0) {
        $notification_count_row = $notification_count_result->fetch_assoc();
        $notification_count = $notification_count_row['count'];
    }
}

?>
<head>
<link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<style>
  header a {
    position: relative;
    color: antiquewhite !important;
    font-size: 20px;
    text-decoration: none !important;
    font-weight: 500;
    cursor: pointer;
    border-radius: 5px;
    transition: 0.3s;
    
}

header a:hover {
    color: cyan !important;

}

header a::before {
    content: '';
    position: absolute;
    top: 100%;
    left: 0;
    background: cyan;
    width: 0;
    height: 2px;
    transition: 0.3s;
}

.navbar {
    display: flex;
    gap: 2rem;
}

header a:hover::before {
    width: 100%;
}

header {
    font-family: 'Poppins', sans-serif;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    padding: 5px 100px;
    background: rgba(0, 0, 0, 0.925);
    display: flex;
    justify-content: space-between;
    align-items: center;
    z-index: 1;
}

header .user-name {
    position: relative;
    display: inline-block;
}

header .user-menu {
    opacity: 0;
    height: auto;
    overflow: hidden;
    position: absolute;
    top: 100%;
    left: 50%;
    transform: translateX(-50%);
    background: rgba(0, 0, 0, 0.8);
    padding: 0.5rem;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    border-radius: 8px;
    z-index: 10;
    text-align: center;
    transition: opacity 0.3s, max-height 0.3s ease-out, left 0.3s, pointer-events 0.3s; /* Add pointer-events property for transition */
    pointer-events: none; /* Initially set pointer-events to none */
}

header .user-name:hover .user-menu {
    opacity: 1;
    max-height: 500px;
    left: calc(70% + 10px); /* Adjust the percentage and buffer zone based on your layout */
    pointer-events: auto; /* Set pointer-events to auto when hovering */
}

header .user-name:not(:hover) .user-menu {
    max-height: 0;
    opacity: 0;
    left: 50%;
    pointer-events: none; /* Set pointer-events to none when not hovering */
}

header .user-menu a {
    display: flex;
    gap: 0.5rem;
    color: white;
    text-decoration: none;
    padding: 0.5rem;
    transition: background 0.3s;
}

header .user-menu a i {
    margin-right: 8px;
}

header .user-menu a:hover {
    background: #333;
}

header .user-name:hover .user-menu {
    opacity: 1;
    max-height: 500px; /* Adjust this value based on your content height */
    left: 70%; /* Adjust the percentage based on your layout */
}

/* Add transition when not hovering */
header .user-name .user-menu {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease-out, opacity 0.3s, left 0.3s; /* Add left property for transition */
}

header .user-name:not(:hover) .user-menu {
    max-height: 0;
    opacity: 0;
    left: 50%; /* Reset the left position when not hovering */
}


.notification-name {
    position: relative;
    display: inline-block;
}

.notification-menu {

    overflow: auto !important;
    color: white;
    gap: 1rem;
    opacity: 0;
    min-width: 20rem;
    height: auto; /* Set initial height to auto */
    position: absolute;
    top: 100%;
    left: 50%;
    transform: translateX(-50%);
    background: rgba(0, 0, 0, 0.9);
    padding: 0.5rem;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    border-radius: 8px;
    z-index: 10;
    text-align: center;
    transition: opacity 0.3s, max-height 0.3s ease-out, left 0.3s; /* Add left property for transition */
}
body::-webkit-scrollbar-thumb {
  background-color: #17b3cb ; /* Set the color of the scrollbar thumb */
  border-radius: 6px; /* Set the radius of the scrollbar thumb */
}

body::-webkit-scrollbar-track {
    background-color: #050505; /* Set the color of the scrollbar track */
}
body::-webkit-scrollbar {
  width: 11px; /* Set the width of the scrollbar */
}
.notification-menu::-webkit-scrollbar {
    width: 12px; /* Set the width of the scrollbar */
}

.notification-menu::-webkit-scrollbar-thumb {
    background-color: #333; /* Set the color of the scrollbar thumb */
    border-radius: 6px; /* Set the radius of the scrollbar thumb */
}

.notification-menu::-webkit-scrollbar-track {
    background-color: #666; /* Set the color of the scrollbar track */
}

    .notification-menu p {
        color: white;
        margin: 0;
        
    }
    .notification-menu a {
        color: white;
        margin: 0;
        font-size: 1.3rem;
        
    }
    .notification-name:hover .notification-menu {
        opacity: 1;
        max-height: 500px; /* Adjust this value based on your content height */
     
    }

    /* Add transition when not hovering */
    .notification-name .notification-menu {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease-out, opacity 0.3s; /* Add max-height property here */
    }

    .notification-name:not(:hover) .notification-menu {
        max-height: 0;
        opacity: 0;
    }
    .notification-count {
        position: absolute;
        top: -5px;
        left: 13px;
        background-color: rgb(165, 0, 0);
        color: white;
        border-radius: 50%;
        padding: 1px 6px;
        font-size: 12px;
    }
    .notification-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 8px;
        border-radius: 10px;
        transition: 0.3s;
    }
    .notification-item:hover{
        background-color: rgba(255, 255, 255, 0.258);
      
        transition:0.3s;
    }

    .notification-icon {
        border-radius: 10px;
        flex-shrink: 0; /* Prevent the icon from shrinking */
        
    }

    .notification-title {
        flex-grow: 1; /* Allow the title to grow and take available space */
        color: white;
    }
    .clear-all-button {
        padding: 10px;
        text-align: center;
    }

    .clear-all-button button {
        background-color: #333;
        color: white;
        border: none;
        padding: 8px 16px;
        cursor: pointer;
        border-radius: 5px;
    }

    .clear-all-button button:hover {
        background-color: rgb(64, 180, 206);
    }
    @media screen and (max-width: 55rem) {
    .navbar {
        display: none;
        position: absolute;
        top: 100%; /* Position below the header */
        left: 0;
        width: 100%;
        background-color: rgba(0, 0, 0, 0.8);
        padding: 10px 0 !important;
      
    }
    #cinemaxtitle, #ili{
        color: rgb(0, 130, 252) !important;
        background: transparent !important;
    }
    .popup-content{
        width: 100vw !important;
        margin-top: 15rem !important;
    }
    #ticketContent{
        display: flex !important;
        flex-direction: column !important;
        justify-content: center !important;
        align-items: center !important;
    }
    #categories{
    width: 80vw !important;
  }
  #moviepage{
    width: 100vw !important;
    text-align: center !important;
    zoom: 1 !important;
  }
  #edit{
    display: none;
  }
  .edit{
    display: none;
  }
  #searchResults{
    margin-top:20rem;
    margin-left: 0rem;
  }
  #mobilenav ul{
    list-style-type: none;
  }
 #mobilenav a{
    text-decoration: none !important;
    color:white;
  }
  .bubbles{
    display:inline;
  }
  #projections label, #projections button{

    font-size: 1rem;
    
  }

  .seat:hover{
    background-color: rgb(208, 90, 0);
  }
  #alignform form{
    width: 100vw !important;
  }
    .movie-icon{
        width: 30% !important;
  }
  .cinema-container{
    width: 99vw;
    overflow: auto;

  }
  #codeInput{
    width: 50vw;
  }
  .screen{
    width: 140vw;
  }
  #halldiv{
    width: 140vw;
    overflow: auto;
  }
  .hall-info{
    display: none;
  }
  #menus{
    zoom: 0.5 !important;
  }
  
    #searchnav{
        height: inherit;
    }
    #searchnav i{
        text-align: center;
    }
    #hamburger-icon {
   
    display: block !important;
}
header{
    padding: 5px !important;
}
#tagsdiv {
    margin-top: 20px;
    padding: 5px;
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
}
}

/* Style for hamburger menu icon */
#hamburger-icon {
    background: none;
    border: none;
    font-size: 24px;
    cursor: pointer;
    color: white;
    display: none;
}
@media (max-width:1920px){
   #login-popup,#menus{
        zoom: 0.75 !important;
    }
    #extract{
        zoom: 1.35 !important;
    }
    .slider, #slideshow{
            height: 400px !important;
        } 
}
@-moz-document url-prefix() {
    @media (max-width: 1920px) {
        #menus, #menu, #moviepage, #login-popup {
          
           transform: scale(1); 
        }
        #menus .item img{
            width: 17rem;
        }
       
       
    }
}


</style>

<body>
    <header>
        <script>
            function openmain() {
                window.open('main.php', '_self');
            }
        </script>
        <div style="display: flex; align-items: center; gap: 0.5rem;">
            <img id="logo" height="40" alt="" src="logo.png" />
            <p onclick="openmain()" id="cinemaxtitle" style=" font: bold;   font-size: 40px; font-weight: 1000; text-align: center; background: linear-gradient(to right, #00fff7, #2c65f6);  background-clip: text !important; color: transparent;  cursor: pointer;">
                    CINEMAX  
            </p>
        </div>
        <div class="hamburger-menu">
        <a id="hamburger-icon" onclick="toggleMobileNav()">&#9776;</a>
    </div>
        <nav class="navbar">
        <?php
            if (isset($_COOKIE['user_name']) && $user_result == 1) {
                // User is logged in as admin
                echo '<a href="adminplace.php"> Admin </a>';
            }
            ?>
        <?php
            if (isset($_COOKIE['user_name'])) {
                // User is logged in
               
                    // User is logged in
                    echo '<div class="notification-name"><a ><i class="fa fa-bell"></i></a>';
                    if($notification_count>0)
                    echo '<div class="notification-count">' . $notification_count . '</div>';
                    echo '<div class="notification-menu">';
                    if (!empty($notifications)) {
                    foreach ($notifications as $notification) {
                        $movieIdNotif = $notification["id_movie"]; // Assuming you have a key like 'movieId' in your $notification array
                        // Display notification content (customize as needed)
                        echo '<a href="movie.php?id=' . $movieIdNotif . '"><div class="notification-item">';
                        echo '<div class="notification-icon"><img src="icons/' . $notification['icon'] . '" alt="Movie Icon" style="width: 80px;"></div>';
                        echo '<div class="notification-title">' . $notification['title'] . ' е в продажба!</div>';
                        echo '</div> </a>';
                    }
                 
                    echo '<div class="clear-all-button">';
    echo '<button onclick="clearAllNotifications()">Всички <i class="fa fa-trash"></i> </button>';
    echo '</div>';
} else { echo 'Няма нотификации';}   
                    echo '</div>';
                    echo '</div>';
                
                echo '<div class="user-name"><a href="profile.php">' . $f_name . ' <i class="fa fa-user"></i></a>';
                echo '<div class="user-menu">';
                echo '<a href="profile.php"> <img loading="lazy" height="30" style="border-radius: 60px"  src="' . $pfp . '" alt=""> Профил</a>';
                echo '<a href="logout.php"><i style="margin-top:5px; margin-left:8px;" class="fa fa-sign-out"></i> Изход</a>';
                echo '</div>';
                echo '</div>';
                
                
            } else {
                // User is not logged in
                echo '<a href="loginplace.php"> Вход <i class="fa fa-sign-in"></i> </a>';
            }
            ?>
             <a onclick="openlogin()"> Ново <i class="fa fa-newspaper-o"></i> </a>
            <a onclick="scrollToBottom()"> За нас <i class="fa fa-info-circle"></i> </a>
            
        </nav>
           
    </header>
    <nav id="mobilenav" style="margin-top:70px; display:none; background:black; position:fixed; z-index:10; width:100vw; padding:10px; font-size:1.5rem;">
        <ul >
            <?php
             if (isset($_COOKIE['user_name']) && $user_result == 1) {
                // User is logged in as admin
                echo '<li><a href="adminplace.php"> Admin </a> </li>';
            }
            if (isset($_COOKIE['user_name'])){
                echo '<li> <div class="user-name"><a href="profile.php">' . $f_name . ' <i class="fa fa-user"></i></a></li>';
                echo '<li><a href="logout.php"> Изход <i style="margin-top:5px; margin-left:8px;" class="fa fa-sign-out"></i></a></li>';
            } else echo ' <li><a href="loginplace.php"> Вход <i class="fa fa-sign-in"></i> </a></li>';
     
       echo '<li> <a onclick="openlogin(), toggleMobileNav()"> Ново <i class="fa fa-newspaper-o"></i> </a> </li>';
       echo '<li>  <a onclick="scrollToBottom(), toggleMobileNav()"> За нас <i class="fa fa-info-circle"></i> </a>';
?>
        </ul>

    </nav>
    <script>
    function toggleMobileNav() {
        var nav = document.getElementById("mobilenav");
        if (nav.style.display === "none" || nav.style.display === "") {
            nav.style.display = "block";
        } else {
            nav.style.display = "none";
        }
    }
</script>

    
    <script> function openlogin() {
  let loginform = document.getElementById("login-popup");
  let overlay = loginform.querySelector(".overlay");

  document.getElementById("login-popup").style.display = "flex";
  loginform.style.top = "-100%"; // Adjust the desired position

  // Triggering the opening animation after a short delay
  setTimeout(() => {
    loginform.style.top = "1%"; // Move the form to the center
    overlay.style.opacity = '1'; // Set overlay opacity to 1
  }, 50);
}

function closelogin() {
  let loginform = document.getElementById("login-popup");
  let overlay = loginform.querySelector(".overlay");

  overlay.style.opacity = '0'; // Set opacity to 0 before hiding
  loginform.style.top = "-100vh"; // Move the form back to the top

  // Hide the form and reset the overlay opacity after the transition duration
  loginform.addEventListener('transitionend', function handleTransitionEnd() {
    document.getElementById("login-popup").style.display = "none";
    overlay.style.opacity = '0';
    loginform.removeEventListener('transitionend', handleTransitionEnd); // Remove the event listener to prevent multiple calls
  }, { once: true }); // Use { once: true } to ensure the event listener is only called once
}
</script>

<script>
function clearAllNotifications() {
    // Create an XMLHttpRequest object
    var xhr = new XMLHttpRequest();

    // Specify the type of request and the URL
    xhr.open('GET', 'clear_notifications.php', true);

    // Define what to do on successful data submission
    xhr.onload = function () {
        if (xhr.status === 200) {
            // Reload the page or update the notification UI as needed
            location.reload();
        }
    };

    // Send the request to the server
    xhr.send();
}


// JavaScript to toggle visibility of navigation links
document.addEventListener("DOMContentLoaded", function() {
    const hamburgerIcon = document.getElementById("hamburger-icon");
    const navbar = document.querySelector(".navbar");

    // Toggle visibility of navigation links when hamburger icon is clicked
    hamburgerIcon.addEventListener("click", function() {
        navbar.classList.toggle("show");
    });
});


</script>


<?php include("popup.php") ?>

</body>
