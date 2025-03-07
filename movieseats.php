<?php

include 'database.php';

$movieId = $_GET['id'] ?? null;
$projectionId = $_GET['projection'] ?? null;
$time = $_GET['time'] ?? null;
$date = $_GET['date'] ?? null;
$hall = $_GET['hall'] ?? null;

if ($movieId && $projectionId && $time && $date) {

  $query = "SELECT seat_number FROM tickets WHERE id_movie = $movieId AND id_projection = $projectionId";
  $result = $conn->query($query);

  if ($result->num_rows > 0) {

      $takenSeats = [];
      while ($row = $result->fetch_assoc()) {

          $seatNumbers = explode(',', $row['seat_number']);

          foreach ($seatNumbers as $seatNumber) {
              $takenSeats[] = $seatNumber;
          }
      }
  } else {

      $takenSeats = [];
  }
} else {

  $takenSeats = [];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Билет</title>
<link rel="icon" href="logo.png" />

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="movieseats.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>
<?php include("header.php") ?>

  <div id="aligner">

  <div style="margin-top: 7rem; background-color:grey; padding:5px; border: 5px solid black; border-radius: 5px;user-select: none;">
        <div class="labelseat"></div> <label> Свободно </label>
        <div class="labelseat" style=" background-color: rgb(151, 17, 17) !important;"></div> <label> Заето </label>
        <div class="labelseat " style="background-color: rgb(208, 135, 0);"></div> <label> Избрано (до 10) </label>

      </div>

      <div class="cinema-container">
        <div class="hall-info">
       <p>Зала</p>   
        <p><?php echo $hall; ?> </p>

      </div>

          <div class="screen"><img src="screen.webp"> </div>
          <?php  
if ($hall) {

    $query = "SELECT seats FROM halls WHERE id_hall = ?";

    $stmt = $conn->prepare($query);

    $stmt->bind_param("i", $hall);

    $stmt->execute();

    $stmt->bind_result($totalSeats);

    $stmt->fetch();

    $stmt->close();

    $rows = ceil($totalSeats / 16); 
    $seatsPerRow = ceil($totalSeats / $rows);
}
?>

<div id="halldiv" style="display: flex; justify-content: center; gap: 6rem;">
    <!-- Left section -->
    <div class="section" style="float: left;">
        <?php
        $seatNumber = 1;

        for ($i = 0; $i < $rows; $i++) { 
            echo '<div class="row">';
            $startSeat = $seatNumber + ($i * 16); 
            for ($j = 0; $j < 8; $j++) { 
                $currentSeat = $startSeat + $j;
                if ($currentSeat <= $totalSeats) { 
                    $seatClass = in_array($currentSeat, $takenSeats) ? 'taken' : 'available';
                    echo '<div class="seat ' . $seatClass . '" onclick="toggleSeat(' . $currentSeat . ')">' . $currentSeat . '</div>';
                }
            }
            echo '</div>';
        }
        ?>
    </div>

    <!-- Right section -->
    <div class="section" style="float: right;">
        <?php
        $startRightSection = $seatNumber + 8; 

        for ($i = 0; $i < $rows; $i++) { 
            echo '<div class="row">';
            $startSeat = $startRightSection + ($i * 16); 
            for ($j = 0; $j < 8; $j++) { 
                $currentSeat = $startSeat + $j;
                if ($currentSeat <= $totalSeats) { 
                    $seatClass = in_array($currentSeat, $takenSeats) ? 'taken' : 'available';
                    echo '<div class="seat ' . $seatClass . '">' . $currentSeat . '</div>';
                }
            }
            echo '</div>';
        }
        ?>
    </div>
</div>

          <div style="clear: both;"></div>

      </div>

<div class="container" style="margin-top: 5rem;">
    <div class="row">
      <!-- Left -->
      <div class="col-lg-9">
        <div class="accordion" id="accordionPayment">
          <!-- Credit card -->
          <div class="accordion-item mb-3">
            <h2 class="h5 px-4 py-3 accordion-header d-flex justify-content-between align-items-center">
              <div class="form-check w-100 collapsed" >
                <input class="form-check-input" type="radio" name="payment" id="payment1"data-bs-toggle="collapse" data-bs-target="#collapseCC" aria-expanded="false">
                <label class="form-check-label pt-1" for="payment1">
                  Кредитна карта
                </label>
              </div>
              <span style="display:flex; gap:10px;">
                <i class="fa fa-cc-visa" style="font-size:2rem; color:rgb(77, 77, 77)"></i>
                <i class="fa fa-cc-mastercard" style="font-size:2rem; color:rgb(77, 77, 77)"></i>
                  <g fill-rule="nonzero" fill="#333840">
                    <path d="M29.418 2.083c1.16 0 2.101.933 2.101 2.084v16.666c0 1.15-.94 2.084-2.1 2.084H4.202A2.092 2.092 0 0 1 2.1 20.833V4.167c0-1.15.941-2.084 2.102-2.084h25.215ZM4.203 0C1.882 0 0 1.865 0 4.167v16.666C0 23.135 1.882 25 4.203 25h25.215c2.321 0 4.203-1.865 4.203-4.167V4.167C33.62 1.865 31.739 0 29.418 0H4.203Z"></path>
                    <path d="M4.203 7.292c0-.576.47-1.042 1.05-1.042h4.203c.58 0 1.05.466 1.05 1.042v2.083c0 .575-.47 1.042-1.05 1.042H5.253c-.58 0-1.05-.467-1.05-1.042V7.292Zm0 6.25c0-.576.47-1.042 1.05-1.042H15.76c.58 0 1.05.466 1.05 1.042 0 .575-.47 1.041-1.05 1.041H5.253c-.58 0-1.05-.466-1.05-1.041Zm0 4.166c0-.575.47-1.041 1.05-1.041h2.102c.58 0 1.05.466 1.05 1.041 0 .576-.47 1.042-1.05 1.042H5.253c-.58 0-1.05-.466-1.05-1.042Zm6.303 0c0-.575.47-1.041 1.051-1.041h2.101c.58 0 1.051.466 1.051 1.041 0 .576-.47 1.042-1.05 1.042h-2.102c-.58 0-1.05-.466-1.05-1.042Zm6.304 0c0-.575.47-1.041 1.051-1.041h2.101c.58 0 1.05.466 1.05 1.041 0 .576-.47 1.042-1.05 1.042h-2.101c-.58 0-1.05-.466-1.05-1.042Zm6.304 0c0-.575.47-1.041 1.05-1.041h2.102c.58 0 1.05.466 1.05 1.041 0 .576-.47 1.042-1.05 1.042h-2.101c-.58 0-1.05-.466-1.05-1.042Z"></path>
                  </g>
                </svg>
              </span>
            </h2>
            <div id="collapseCC" class="accordion-collapse collapse" data-bs-parent="#accordionPayment">
              <div class="accordion-body">
                <div class="mb-3">
                  <label class="form-label">Номер на карта</label>
                  <input type="text" class="form-control" placeholder="">
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="mb-3">
                      <label class="form-label">Име на карта</label>
                      <input type="text" class="form-control" placeholder="">
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="mb-3">
                      <label class="form-label">Валидна до</label>
                      <input type="text" class="form-control" placeholder="MM/YY">
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="mb-3">
                      <label class="form-label" >CVV код</label>
                      <input type="password" class="form-control" maxlength="3" >
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- PayPal -->
          <div class="accordion-item mb-3 border">
            <h2 class="h5 px-4 py-3 accordion-header d-flex justify-content-between align-items-center">
              <div class="form-check w-100 collapsed" >
                <input class="form-check-input" type="radio" name="payment" id="payment2" data-bs-toggle="collapse" data-bs-target="#collapsePP" aria-expanded="false">
                <label class="form-check-label pt-1" for="payment2">
                  PayPal
                </label>
              </div>
              <span>
                <svg width="103" height="25" xmlns="http://www.w3.org/2000/svg">
                  <g fill="none" fill-rule="evenodd">
                    <path d="M8.962 5.857h7.018c3.768 0 5.187 1.907 4.967 4.71-.362 4.627-3.159 7.187-6.87 7.187h-1.872c-.51 0-.852.337-.99 1.25l-.795 5.308c-.052.344-.233.543-.505.57h-4.41c-.414 0-.561-.317-.452-1.003L7.74 6.862c.105-.68.478-1.005 1.221-1.005Z" fill="#009EE3"></path>
                    <path d="M39.431 5.542c2.368 0 4.553 1.284 4.254 4.485-.363 3.805-2.4 5.91-5.616 5.919h-2.81c-.404 0-.6.33-.705 1.005l-.543 3.455c-.082.522-.35.779-.745.779h-2.614c-.416 0-.561-.267-.469-.863l2.158-13.846c.106-.68.362-.934.827-.934h6.263Zm-4.257 7.413h2.129c1.331-.051 2.215-.973 2.304-2.636.054-1.027-.64-1.763-1.743-1.757l-2.003.009-.687 4.384Zm15.618 7.17c.239-.217.482-.33.447-.062l-.085.642c-.043.335.089.512.4.512h2.323c.391 0 .581-.157.677-.762l1.432-8.982c.072-.451-.039-.672-.38-.672H53.05c-.23 0-.343.128-.402.48l-.095.552c-.049.288-.18.34-.304.05-.433-1.026-1.538-1.486-3.08-1.45-3.581.074-5.996 2.793-6.255 6.279-.2 2.696 1.732 4.813 4.279 4.813 1.848 0 2.674-.543 3.605-1.395l-.007-.005Zm-1.946-1.382c-1.542 0-2.616-1.23-2.393-2.738.223-1.507 1.665-2.737 3.206-2.737 1.542 0 2.616 1.23 2.394 2.737-.223 1.508-1.664 2.738-3.207 2.738Zm11.685-7.971h-2.355c-.486 0-.683.362-.53.808l2.925 8.561-2.868 4.075c-.241.34-.054.65.284.65h2.647a.81.81 0 0 0 .786-.386l8.993-12.898c.277-.397.147-.814-.308-.814H67.6c-.43 0-.602.17-.848.527l-3.75 5.435-1.676-5.447c-.098-.33-.342-.511-.793-.511h-.002Z" fill="#113984"></path>
                    <path d="M79.768 5.542c2.368 0 4.553 1.284 4.254 4.485-.363 3.805-2.4 5.91-5.616 5.919h-2.808c-.404 0-.6.33-.705 1.005l-.543 3.455c-.082.522-.35.779-.745.779h-2.614c-.417 0-.562-.267-.47-.863l2.162-13.85c.107-.68.362-.934.828-.934h6.257v.004Zm-4.257 7.413h2.128c1.332-.051 2.216-.973 2.305-2.636.054-1.027-.64-1.763-1.743-1.757l-2.004.009-.686 4.384Zm15.618 7.17c.239-.217.482-.33.447-.062l-.085.642c-.044.335.089.512.4.512h2.323c.391 0 .581-.157.677-.762l1.431-8.982c.073-.451-.038-.672-.38-.672h-2.55c-.23 0-.343.128-.403.48l-.094.552c-.049.288-.181.34-.304.05-.433-1.026-1.538-1.486-3.08-1.45-3.582.074-5.997 2.793-6.256 6.279-.199 2.696 1.732 4.813 4.28 4.813 1.847 0 2.673-.543 3.604-1.395l-.01-.005Zm-1.944-1.382c-1.542 0-2.616-1.23-2.393-2.738.222-1.507 1.665-2.737 3.206-2.737 1.542 0 2.616 1.23 2.393 2.737-.223 1.508-1.665 2.738-3.206 2.738Zm10.712 2.489h-2.681a.317.317 0 0 1-.328-.362l2.355-14.92a.462.462 0 0 1 .445-.363h2.682a.317.317 0 0 1 .327.362l-2.355 14.92a.462.462 0 0 1-.445.367v-.004Z" fill="#009EE3"></path>
                    <path d="M4.572 0h7.026c1.978 0 4.326.063 5.895 1.45 1.049.925 1.6 2.398 1.473 3.985-.432 5.364-3.64 8.37-7.944 8.37H7.558c-.59 0-.98.39-1.147 1.449l-.967 6.159c-.064.399-.236.634-.544.663H.565c-.48 0-.65-.362-.525-1.163L3.156 1.17C3.28.377 3.717 0 4.572 0Z" fill="#113984"></path>
                    <path d="m6.513 14.629 1.226-7.767c.107-.68.48-1.007 1.223-1.007h7.018c1.161 0 2.102.181 2.837.516-.705 4.776-3.793 7.428-7.837 7.428H7.522c-.464.002-.805.234-1.01.83Z" fill="#172C70"></path>
                  </g>
                </svg>
              </span>
            </h2>

            <div id="collapsePP"  data-bs-parent="#accordionPayment" data-toggle="collapse" data-target="#demo" class="accordion-collapse collapse" > 
              <div class="accordion-body">
                <div class="px-2 col-lg-6 mb-3" >
                  <label class="form-label">Email</label>
                  <input type="email" class="form-control">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Right -->
      <div class="col-lg-3">
    <div class="card position-sticky top-0">
        <!-- Box 1: Before the "Потвърди" button -->
        <div class="p-3 bg-light bg-opacity-10 box1">
            <h6 class="card-title mb-3">Поръчка</h6>
            <!-- Content of Box 1 -->
            <div class="d-flex justify-content-between mb-1 small">
                <span>Цена</span><span id="totalLabel">0 BGN</span>
            </div>
            <!-- More content of Box 1 -->
            <div class="d-flex justify-content-between mb-1 small">
                <span>Места</span> <span id="seatsLabel">0</span>
            </div>
            <!-- Even more content of Box 1 -->
            <div class="d-flex justify-content-between mb-1 small">
                <span>Код: 
                  <input id="codeInput" style="border-radius:3px; width:55px; border-color: rgba(161, 161, 161, 0.874); " >
                  <button onclick="testCode()" class="btn btn-primary" id="testcodebutton" type="button">+</button>
                </span> 
                 <span class="text-danger" id="discountAmount">-0.00</span>

              </div>
            <!-- Content of Box 1 -->

        </div>
        <!-- End of Box 1 -->

        <!-- Box 2: From the "Потвърди" button till the "PURCHASE" button -->
        <div > <!-- class="collapse" id="collapseExample" -->
          <div class="p-3 bg-light bg-opacity-10 box2"  >
              <!-- Content of Box 2 -->
              <hr>
              <div class="d-flex justify-content-between mb-4 small">
                  <span>ОБЩО</span> <strong id="totalLabel2" class="text-dark">0.00 BGN</strong>
              </div>
              <!-- More content of Box 2 -->
              <!-- <div class="form-check mb-1 small">
                  <input class="form-check-input" type="checkbox" value="" id="tnc">
                  <label class="form-check-label" for="tnc">
                      Съласен съм с <a href="#">условията за поверителност</a>
                  </label>
              </div> -->

              <!-- More content of Box 2 -->
              <button class="btn btn-primary w-100 mt-2" onclick="purchaseTickets()">КУПИ </button>
          </div>
        </div>
        <!-- End of Box 2 -->
    </div>
</div>

    </div>
  </div>

<script>
   let originalTotalPrice = 0; 
let discountAmount = 0; 
let discountApplied = false; 

function testCode() {
    const enteredCode = document.getElementById("codeInput").value;

    validateCodeOnServer(enteredCode)
        .then((response) => {
            if (response.valid && !discountApplied) {
                discountAmount = response.discountAmount || 0; 
                document.getElementById("codeInput").style.border = "2px solid green";

                const totalPriceElement = document.getElementById("totalLabel");
                const totalPrice = parseFloat(totalPriceElement.textContent.split(" ")[0]); 
                originalTotalPrice = totalPrice; 
                applyDiscount(); 

            } else {
              document.getElementById("codeInput").style.border = "";
        document.getElementById("totalLabel2").textContent = `${totalPrice.toFixed(2)} BGN`;
            }
        })
        .catch((error) => {
            console.error("Error validating code:", error);

        });

}

function applyDiscount() {
    const totalPriceElement = document.getElementById("totalLabel2");
    var totalPrice = originalTotalPrice; 
    const discountedPrice = totalPrice * (1 - discountAmount / 100); 
    totalPriceElement.textContent = `${discountedPrice.toFixed(2)} BGN`; 

    const discountAmountElement = document.getElementById("discountAmount");
    const discount = totalPrice - discountedPrice;
    discountAmountElement.textContent = `-${discount.toFixed(2)} BGN`;

}

function validateCodeOnServer(enteredCode) {
    const endpoint = "codecheck.php"; 

    return fetch(endpoint, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({ code: enteredCode }),
    }).then((response) => response.json());
}

const seatsLabel = document.getElementById('seatsLabel');
const totalLabel = document.getElementById('totalLabel');
const totalLabel2 = document.getElementById('totalLabel2'); 
let numSeats = 0;
let totalPrice = 0; 

document.addEventListener('click', function(event) {
  if (event.target.classList.contains('seat') && !event.target.classList.contains('taken')) {
    if (event.target.classList.contains('selected')) {
      event.target.classList.remove('selected');
      numSeats--;
    } else if (numSeats < 10) {
      event.target.classList.add('selected');
      numSeats++;

    }

    seatsLabel.textContent = numSeats;
    totalPrice = numSeats * 12.50; 
    totalLabel.textContent = totalPrice.toFixed(2) + ' BGN';
    totalLabel2.textContent = totalPrice.toFixed(2) + ' BGN'; 
    document.getElementById("discountAmount").textContent = `-0.00`;
  }
});

  </script>

<script>

 function purchaseTickets() {
    var selectedSeats = document.querySelectorAll('.seat.selected');
    var seatNumbers = Array.from(selectedSeats).map(seat => seat.textContent).join(',');

    var priceWithCurrency = document.getElementById('totalLabel2').textContent;
    var price = priceWithCurrency.slice(0, -4); 

    fetch('purchasedticket.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            seatNumbers: seatNumbers,
            price: price,
            movieId: <?php echo $_GET['id']; ?>,
            projection: <?php echo $_GET['projection']; ?>,
            hall: <?php echo $_GET['hall']; ?>,
            time: '<?php echo $_GET['time']; ?>',
            date: '<?php echo $_GET['date']; ?>'
        })
    })
    .then(response => {
        if (response.ok) {

            sendEmail();
            updateCodeInput();
        } else {
            console.error('Error inserting data');
        }
    })
    .catch(error => console.error('Error:', error));

    function sendEmail() {

        fetch('send_email.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                seatNumbers: seatNumbers,
                price: price,
                movieId: <?php echo $_GET['id']; ?>,
                projection: <?php echo $_GET['projection']; ?>,
                hall: <?php echo $_GET['hall']; ?>,
                time: '<?php echo $_GET['time']; ?>',
                date: '<?php echo $_GET['date']; ?>'
            })
        })
        .then(response => {
            if (response.ok) {

                window.location.href = 'confirm.php';
            } else {
                console.error('Error sending email');
            }
        })
        .catch(error => console.error('Error:', error));
    }
    var codeValue = document.getElementById('codeInput').value;

    function updateCodeInput() {

    fetch('check_discount.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'code=' + encodeURIComponent(codeValue)
    })
    .then(response => response.text())
    .then(response => {
        if (response === 'success') {

        } else {

        }
    })
    .catch(error => console.log('Error updating code input: ' + error));
}

}

</script>

</body>
</html>