<?php 
include("database.php");
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

if ( isset($_COOKIE['user_name'])) {
    // Redirect to error.php
    header("Location: main.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link href="main.css" rel="stylesheet" /> -->
    <title>Вход</title>
	<link rel="icon" href="logo.png" />
    <link href="login.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>



<body>
  
<?php include("header.php") ?>
<?php include("popup.php") ?>


<div id="aligner">
<div id="box">
    <!-- <div id="box2">
<form class="form" action="login.php" method="post">
    <div id="title">Вход<br /></div>
    
   <div class="input-container">
    <input name="email" type="email" id="email" required>
    <span class="label">Email</span>
    <div class="underline"></div>
  </div>

  <div class="input-container">
    <input name="password" type="password" id="password" required>
    <span class="label">Парола</span>
    <div class="underline"></div>
  </div>
    <input class="input" name="email" placeholder="e-mail" type="email" />
    <input class="input" name="password" placeholder="Парола" type="password"/>
   <p style="color:grey"> Нямате акаунт? <a href="registerplace.php"> Регистрация</a> </p> <br><br>
    <button type="submit" class="animated-button" name="login"><span>Вход</span><span></span></button>
</form>


    
    </div> -->
</div>
    
</div>



<section class="h-100 gradient-form" style="background-color: transparent; margin-top:8rem;" >
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100" >
      <div class="col-xl-10" >
        <div class="card rounded-3 text-black" style="border: 5px solid grey; border-radius: 10px" >
          <div class="row g-0"  >
            <div class="col-lg-12" style="background-color: rgb(10, 10, 10);">
              <div class="card-body p-md-5 mx-md-4">

                <div class="text-center">
                  <img src="logo.png" style="width: 185px;" alt="logo">
                </div>

                <form class="form" action="login.php" method="post">
                  <div class="input-container">
                    <input name="email" type="email" id="email" required>
                    <span class="label">Email</span>
                    <div class="underline"></div>
                  </div>

                  <div class="input-container">
                    <input name="password" type="password" id="password" required>
                    <span class="label">Парола</span>
                    <div class="underline"></div>
                    <br><br>
                    <?php
                    if (isset($_GET['error'])) {
                      echo '<div class="error-message" style="color:rgb(224, 79, 79); border-radius:5px;">' . htmlspecialchars($_GET['error']) . '</div>';
                    }
                    ?>
                  </div>

                  <div class="text-center pt-1 mb-5 pb-1">
                    <button type="submit" class="animated-button" name="login"><span>Вход</span><span></span></button>
                  </div>

                  <div class="d-flex align-items-center justify-content-center pb-4">
                    <p class="mb-0 me-2" style="color: rgb(163, 163, 163) !important;">Нямате акаунт?</p>
                    <a href="registerplace.php"><button type="button" class="btn btn-outline-danger">Създайте</button></a>
                  </div>

                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>



    
</body>
</html>