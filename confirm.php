<?php
// Get movie ID, time, and date from the URL
// $movieId = $_GET['id'] ?? null;
// $time = $_GET['time'] ?? null;
// $date = $_GET['date'] ?? null;
// $selectedSeats = $_GET['seats'] ?? null; // Get se
// $price = $_GET['price'] ?? null;
// // Redirect to send_email.php with movie details as query parameters
// if ($price <=0.00) {
//   // header("Location: error.php");
//   exit; // Stop script execution after the redirect
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Закупено!</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="logo.png" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
    * {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
  font: inherit;
}
body {
  /* width: 100vw; */
  /* height: 100%; */
  /* background-image: url(background.jpg); */
  background-repeat: repeat-y;
  background-size: cover;
  background-position: center center;
  /* Adjust as needed */
  background-color: rgb(155, 155, 155);
  
  font-family: "Poppins", sans-serif;

  background: radial-gradient(circle, rgb(10, 51, 90), rgb(0, 0, 0));
}
header{
    height: 4.44rem !important;
  }
  #cinemaxtitle{
    margin-top: 0.9rem !important;
  }
h1,p{
  color: white;
}
.btn-outline-success {
    color: rgb(43, 205, 205) !important;
    border-color: rgb(43, 205, 205) !important;
}
.btn-outline-success:hover {
    background-color: rgb(43, 205, 205) !important;
    color:white !important;
}

input,button {
  padding: 0.5rem;
  border-radius: 20px;
  background-color: rgb(37, 37, 37);
  color: white;
  border-color: rgb(0, 167, 193);
  overflow: auto;
  border-radius: 10px !important;
}
button:hover:enabled{
  background-color: rgb(43, 205, 205) !important;
}

input::placeholder {
  color: rgb(174, 174, 174);
}

input {
  width: 10vw ;
  height: 50px;
  font: bold;
  font-family: "Poppins", sans-serif;
  font-weight: 500;
}
input:-webkit-autofill{
  -webkit-background-clip: text;
    -webkit-text-fill-color: #7be5ff;
    box-shadow: inset 0 0 20px 20px #23232300;
}
#win{
  display: none;
}
 </style>
</head>
<body>
    
<?php include("header.php") ?>
<?php include("bubbles.php") ?>

<div id="win" style="width:100vw;height: 100vh; background-image:url(https://www.icegif.com/wp-content/uploads/icegif-3602.gif);position:absolute; opacity:0.1; background-size:contain"></div>

        <div class="vh-100 d-flex justify-content-center align-items-center">
            <div class="col-md-4" style="border: 5px solid black; border-top: none;">
                <div class="border border-3 border-success"></div>
                <div class="card  bg-white shadow p-5" style="background-color: #161616 !important;  background-image: url(https://static.vecteezy.com/system/resources/thumbnails/009/695/745/small/seamless-wavy-line-pattern-png.png);
  background-size: cover; filter: brightness(110%);">
                    <div class="mb-4 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="text-success" width="75" height="75"
                            fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            <path
                                d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
                        </svg>
                    </div>
                    <div class="text-center">
                        <h1>Благодарим !</h1>
                        <p style="font-size:1.15rem;">Проверете поръчката на имейл или в <a href="profile.php">профил.</a> </p>
                        <hr style=" border-top: 2.5px solid cyan;">

                        <div style="background:rgba(10, 10, 10, 0.577); padding: 10px; border: 5px solid black;border-radius:5px;">
                          <p>Играйте за промокод при следваща покупка и го използвайте преди друг!</p>
                          <div id="codegeneration">
                              <input id="codeInput" placeholder="XXXX" style="text-align: center;" autocomplete="off">
                              <p id="discount_info" style="color: white; font-size: 20px; font-weight: 500; margin-top: 10px;"></p>
                              <button id="generateButton" onclick="generateCode(), startTimer()"><i class="fa fa-rotate-left" style="color: white; font-size: 2rem; "></i></button>
                              <button id="testCodeButton" disabled onclick="testCode()" style="display: none;"><i class="fa fa-check" style="color: white; font-size: 2rem; "></i></button>
                          </div>
                        </div>
<br>
                        <button class="btn btn-outline-success" onclick="window.location.href='main.php'">Обратно</button>
                    </div>
                </div>
            </div>
        </div>

       
    </body>

</html>

	
<script>


window.onload = function() {
  Swal.fire({
  position: "top-end",
  icon: "success",
  title: " Билетът е закупен <i class='fa fa-credit-card'></i>",
  showConfirmButton: false,
  timer: 2500
});
}
//     // Extract movie details from URL
//     var urlParams = new URLSearchParams(window.location.search);
//     var movieId = urlParams.get('id');
//     var time = urlParams.get('time');
//     var date = urlParams.get('date');
//     var price = urlParams.get('price');
//     var projection = urlParams.get('projection');
//     var hall = urlParams.get('hall'); // Add this line to extract the hall parameter

//     // Extract selected seats from URL parameter
//     var seatNumbers = urlParams.get('seats');

//     // Log movie details and selected seats to the console for debugging
//     console.log('Movie ID:', movieId);
//     console.log('Time:', time);
//     console.log('Date:', date);
//     console.log('Selected Seats:', seatNumbers);
//     console.log('Price:', price);
//     console.log('Hall:', hall);

//     // Make a request to send_email.php with movie details, selected seats, and price as query parameters
//     var xhr = new XMLHttpRequest();
//     xhr.open('GET', 'send_email.php?id=' + movieId + '&time=' + time + '&date=' + date + '&seats=' + seatNumbers + '&price=' + price + '&hall=' + hall, true); // Include hall parameter in the URL
//     xhr.send();

    // Make a request to purchasedticket.php for each selected seat
    // var url = 'purchasedticket.php?id=' + movieId + '&time=' + time + '&date=' + date + '&seats=' + seatNumbers + '&price=' + price + '&projection=' + projection; // Include hall parameter in the URL
    // console.log('URL:', url); // Log the URL to the console
    // var xhr2 = new XMLHttpRequest();
    // xhr2.open('GET', url, true);
    // xhr2.send();
// };





</script>


	<script src="main.js"></script>
</body>
</html>