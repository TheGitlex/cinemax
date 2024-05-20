<?php include("database.php");

    $user_email = isset($_COOKIE['user_email']) ? $_COOKIE['user_email'] : null;
    $userId = $_GET["uid"] ;

    if ($user_email) {

        $sql = "SELECT * FROM users WHERE id_user = '$userId'";
        $result3 = $conn->query($sql);

        if ($result3->num_rows > 0) {

            $row = $result3->fetch_assoc();

            $f_name2 = $row['f_name'];
            $l_name = $row['l_name'];
            $email = $row['email'];
            $birth = $row['birth'];
            $joined = $row['joined'];
            $password=$row['password'];
            $pfp2 = $row['pfp'];
            $access = $row['access'];
            $formattedDate = date('d/m/Y', strtotime($joined));
            $birth = date('d/m/Y', strtotime($birth)); 

        }
    }

if ($user_email) {

    $sql = "SELECT * FROM users WHERE email = '$user_email'";
    $result36 = $conn->query($sql);

    if ($result36->num_rows > 0) {

        $row = $result36->fetch_assoc();

        $user_result = $row['admin']; 

    }
}

if ( $user_result == 0) {

    header("Location: error.php");
    exit();
}

    $sql = "SELECT 
    t.id_ticket, 
    t.price, 
    t.seat_number, 
    t.purchase_date, 
    m.title, 
    m.icon, 
    p.date, 
    p.time, 
    h.id_hall  -- Select the id_hall from the halls table
FROM 
    tickets t
JOIN 
    movies m ON t.id_movie = m.id_movie
JOIN 
    projections p ON t.id_projection = p.id_projection  -- Join based on id_projection
JOIN 
    halls h ON p.id_hall = h.id_hall
WHERE 
    t.id_user = {$_GET['uid']}
GROUP BY 
    t.id_ticket
ORDER BY 
    t.purchase_date DESC;
";

$result = $conn->query($sql);
    ?>

<!DOCTYPE html>
<html lang="en">
<head>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Профил - <?php echo $f_name2 ?></title>
  <link rel="stylesheet" href="profile.css">

    <link rel="icon" href="logo.png" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js" integrity="sha512-mPzlofW5JGDVcc0MYWiXz0vI20v0+IwBU0BZnLkfHIdqTruPRvYyNDmy2Oz0zIPOXB6RpdGhZzF+YoHu+4d8QA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  </head>

  <body style="background: radial-gradient(circle, <?php echo ($access == 1) ? 'rgb(10, 90, 46)' : 'rgb(90, 10, 10)'; ?>, rgb(0, 0, 0));">

<?php include("header.php") ?>

<!-- <div id="aligner" >
    <div id="box">

    </div>
    <div id=" profile">

     <p>  </p>

    </div>

</div> -->

<div class="container">
<p class="menutitle"><?php echo $f_name2;?> профил </p>
    <div class="main-body">

          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                  <div class="profile-picture-container" >
    <img src="<?php echo $pfp2; ?>" alt="грешен линк" class="rounded-circle" width="150">
    <div class="overlay2">
        <!-- <div class="overlay2-text">Промени</div> -->
    </div>
</div> <br>

<div id="linkInputContainer" class="file-input" style="display: none;">
    <input type="text" id="linkInput" placeholder="Адрес на изображение">
    <button  id="insertlinkbutton" onclick="insertLink()" style= "background-color:rgb(51, 51, 51); color:white; border:2px solid black;">Запази</button>
    <span class="close" onclick="closeLinkInput()">&times;</span>
</div>
                    <div class="mt-3">
                      <h4><?php echo $f_name2;?> <?php echo $l_name;?></h4>
                      <p class="text-secondary mb-1" style="color: rgb(141 141 141) !important;">Създаден <?php echo $formattedDate;?></p>
                      <!-- <p class="text-muted font-size-sm">Bay Area, San Francisco, CA</p> -->
                      <!-- <button class="btn btn-primary">Edit</button>
                      <button class="btn btn-outline-primary">Message</button> -->

                    </div>
                  </div>
                </div>
              </div>

            </div>
            <div class="col-md-8">
    <div class="card mb-3">
        <div class="card-body">
            <form id="profileForm" >
                <div class="row">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Име</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <input type="text" class="form-control" id="inputName" value="<?php echo $f_name2;?>" placeholder="<?php echo $f_name;?>" disabled>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Фамилия</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <input type="text" class="form-control" id="inputLastName" value="<?php echo $l_name;?>" placeholder="<?php echo $l_name;?>" disabled>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <input type="text" class="form-control" id="inputEmail" value="<?php echo $email;?>" placeholder="<?php echo $email;?>" disabled>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Рожден ден</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <input type="text" class="form-control" id="inputBirth" value="<?php echo $birth;?>" placeholder="<?php echo $birth;?>" disabled >
                    </div>
                </div>
                <hr>
                <div class="row">
    <div class="col-sm-3">
        <h6 class="mb-0">Парола</h6>
    </div>
    <div class="col-sm-9 text-secondary">
    <input type="password" class="form-control" id="inputPassword" value="********" placeholder="Нова Парола" disabled>
</div>

</div>

                <hr>

                <div class="row">
                    <div class="col-sm-12">
                        <!-- <button type="button" id="editButton" class="btn btn-info"><i class="fa fa-pencil" style="color: white"></i></button> -->
                        <!-- <button type="button" id="saveChangesButton" class="btn btn-success" style="display: none;">Запази Промени</button> -->
                           <button type="button" id="deleteAcc" class="btn btn-info" onclick="test()">ИЗТРИЙ</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

          </div>

        </div>
    </div>

    <div class="container" style="margin-top: 10px !important;">
    <p class="menutitle"> За Него </p>
    <div class="main-body">
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card"style="height:60vh;overflow: auto;overflow-x: hidden;">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">

                    <div class="mt-3" >
                      <h4>РЕЙТИНГИ:</h4>
                      <hr>
                      <?php

if ($userId) {

    $sql3 = "SELECT r.rating_value, m.title,m.icon, m.id_movie, m.active
            FROM ratings r
            JOIN movies m ON r.id_movie = m.id_movie
            WHERE r.id_user = {$_GET['uid']} AND active=1 ORDER BY rating_value DESC" ;

    $result3 = $conn->query($sql3);

    if ($result3->num_rows > 0) {

        while ($row = $result3->fetch_assoc()) {
            $rating = $row['rating_value'];
            $movieTitle = $row['title'];
            $icon = $row['icon'];
            $id_movie = $row['id_movie'];

           ?>
                <div class="row">
                    <div class="col-md-3 mt-3">
                        <a href='movie.php?id=<?php echo $id_movie; ?>'>
                            <img src='icons/<?php echo $icon; ?>' alt="" style="border: 2px solid black; border-radius: 3px; width:100%;" class="movie-icon" >
                        </a>
                    </div>
                    <div class="col-md-9 mt-3">
                        <p style="font-size:1.2rem;"><?php echo $movieTitle; ?></p>
                        <p style="font-size:1.3rem;"> <?php echo $rating; ?> <i class='fa fa-star'></i></p>

                    </div>
                </div>
                <hr>
    <?php
            }
        } else {
            echo "<div class='mt-3'><p>Няма активни рейтинги.</p></div>";
        }
    }
    ?>

                    </div>   
                  </div>
                </div>
              </div>

            </div>
            <div class="col-md-8">
    <div class="card mb-3" style="height:60vh;overflow: auto;">
        <div class="card-body">
        <form>
        <div class="row">
    <div class="col-md-6">
        <h6>История</h6>
    </div>
    <div class="col-md-6 text-md-end">
        <?php

        $totalPriceQuery = "SELECT SUM(price) AS total_price FROM tickets WHERE id_user = {$_GET['uid']}";

        $totalPriceResult = $conn->query($totalPriceQuery);

        if ($totalPriceResult) {

            $totalPriceRow = $totalPriceResult->fetch_assoc();
            $totalPrice = $totalPriceRow['total_price'];

            if($totalPrice>0.00)
            echo "<h6>Общо: $totalPrice</h6>"; 
        else echo "<h6>Общо: 0.00</h6>";
        }
        ?>
    </div>
</div>

         <hr>
    <!-- Ticket History Section -->
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $ticket_id = $row['id_ticket'];
            $price = $row['price'];
            $seat_number = $row['seat_number'];
            $purchase_date = $row['purchase_date'];
            $movie_title = $row['title'];
            $icon_url = $row['icon'];
            $date = $row['date'];
            $time = $row['time'];
            $hall = $row['id_hall'];

            $formatted_purchase_date = date('d/m/Y', strtotime($purchase_date));
    ?>
            <div class="row ticket-item">

                <div class="col-sm-2">
                    <!-- Movie Icon -->
                    <img src="icons/<?php echo $icon_url; ?>" alt="Movie Icon" class="movie-icon" style="width:100%;border: 4px solid black; border-radius:5px;">
                </div>
                <div class="col-sm-10">
                    <!-- Ticket Information -->
                    <p>Билетен номер: <?php echo $ticket_id; ?>   </p>
                    <p>Филм: <?php echo $movie_title; ?></p>
                    <p>От: <?php echo  date('H:i', strtotime($time))?></p>
                    <p>Нa: <?php echo date('d/m/Y', strtotime($date)); ?></p>
                    <p>Зала: <?php echo $hall; ?>, Място: <?php echo implode(', ', explode(',', $seat_number)); ?></p>
                    <p>Цена: <?php echo $price; ?></p>
                    <p class="text-secondary mb-1">Платено на: <?php echo $formatted_purchase_date; ?></p>
                </div>
            </div>
            <hr>
    <?php
        }
    } else {
        echo "<p>Няма закупени билети.</p>";
    }
    ?>
    <!-- End of Ticket History Section -->
</form>

        </div>
    </div>
</div>

          </div>

        </div>
    </div>

   <br> <br> <br><br><br>
<?php include("footer.php"); ?>

<script>
    function openLinkInput() {
    document.getElementById('linkInputContainer').style.display = 'block';
}

function closeLinkInput() {
    document.getElementById('linkInputContainer').style.display = 'none';
}

function insertLink() {
    const linkInput = document.getElementById('linkInput');
    const imageURL = linkInput.value.trim();

    if (imageURL) {

        updateProfilePicture(imageURL);
    } else {
        alert('Please enter a valid image link.');
    }

    closeLinkInput();
}

function updateProfilePicture(imageURL) {
    const formData = new FormData();
    formData.append('imageURL', imageURL);

    fetch('updatePfp.php', {
        method: 'POST',
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {

           location.reload();
        } else {

            console.error('Error updating profile picture:', data.message);
        }
    })
    .catch(error => {
        console.error('Error updating profile picture:', error);
    });
}

document.addEventListener("DOMContentLoaded", function() {
    const editButton = document.getElementById("editButton");
    const saveChangesButton = document.getElementById("saveChangesButton");

    function toggleEditMode() {
        const inputFields = document.querySelectorAll(".form-control");

        inputFields.forEach(function(field, index) {
            if (index === 0 || index === 1 || index === 4) {
                field.disabled = !field.disabled; 
                if (field.disabled) {
                    field.setAttribute("data-placeholder", field.value); 
                    field.value = field.getAttribute("placeholder"); 
                } else {
                    field.value = field.getAttribute("data-placeholder"); 
                    field.removeAttribute("data-placeholder"); 
                }
            }
        });

        editButton.style.display = editButton.style.display === "none" ? "inline" : "none";
        saveChangesButton.style.display = saveChangesButton.style.display === "none" ? "inline" : "none";
    }

    editButton.addEventListener("click", function() {
        toggleEditMode();
    });

    saveChangesButton.addEventListener("click", function() {

    const newFirstName = document.getElementById("inputName").value;
    const newLastName = document.getElementById("inputLastName").value;
    const newPassword = document.getElementById("inputPassword").value;

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "updateProfile.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {

                console.log(xhr.responseText);
                location.reload();

            } else {

                console.error("Error updating profile:", xhr.responseText);
            }
        }
    };
    xhr.send("&newFirstName=" + encodeURIComponent(newFirstName) + "&newLastName=" + encodeURIComponent(newLastName) + "&newPassword=" + encodeURIComponent(newPassword));

    toggleEditMode();
});

});

function scrollToBottom() {
  const documentHeight = document.documentElement.scrollHeight;
  window.scrollTo({ top: documentHeight, behavior: "smooth" });
}

</script>

<script>
function test() {
    Swal.fire({
        title: "Сигурни ли сте?",
        showDenyButton: true,
        showConfirmButton: false,
        showCancelButton: true,
        cancelButtonText: 'Отказ',
        html: '<p> Това ще изтрие всичко за Вас </p>',
        denyButtonText: `Изтрий`
    }).then((result) => {
        if (result.isDenied) {
            var user_id = <?php echo isset($_GET['uid']) ? json_encode($_GET['uid']) : 'null'; ?>;
            if (user_id !== null && user_id !== '') {
                $.ajax({
                    url: 'delete_user.php',
                    type: 'POST',
                    data: { uid: user_id },
                    success: function(response) {
                        if (response.trim() === 'success') {
                            Swal.fire({
                                title: "Акаунтът е изтрит.",
                                icon: 'info'
                            }).then(() => {
                                window.location.href = "adminplace.php";

                            });
                        } else {
                            Swal.fire({
                                title: "Грешка при изтриване на акаунта.",
                                text: response,
                                icon: 'error'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        Swal.fire({
                            title: "Грешка при изтриване на акаунта.",
                            icon: 'error'
                        });
                    }
                });
            } else {
                console.error("User ID is missing or invalid.");
                Swal.fire({
                    title: "Грешка при изтриване на акаунта.",
                    icon: 'error'
                });
            }
        }
    });
}
</script>

</body>
</html>