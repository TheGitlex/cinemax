<?php 
include("database.php");
$user_email = isset($_COOKIE['user_email']) ? $_COOKIE['user_email'] : null;

if ($user_email) {

    $sql = "SELECT * FROM users WHERE email = '$user_email'";
    $result3 = $conn->query($sql);

    if ($result3->num_rows > 0) {

        $row = $result3->fetch_assoc();

        $user_result = $row['admin']; 

    }
}

if ( isset($_COOKIE['user_name'])) {

    header("Location: main.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добре дошли!</title>
    <link rel="stylesheet" href="register.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="icon" href="logo.png" />
</head>
<body>

<?php include("header.php") ?>
<?php include("popup.php") ?>

<div id="alignform"> 
<form class="form" method="POST" action="register.php">
    <p class="title">Регистрация</p>

    <style>
    .error{
        font-size: 1rem;
        color: white;
        font-weight: 600;

    } 
    </style>
    <?php

    if (!empty($_GET['error'])) {
        echo '<div class="error-container">';
        echo '<p class="error">' . urldecode($_GET['error']) . '</p>';
        echo '</div>';
    }
    ?>

    <label>
        <input required="" placeholder="" type="text" class="input" name="first_name">
        <span>Име</span>
    </label>

    <label>
        <input required="" placeholder="" type="text" class="input" name="last_name">
        <span>Фамилия</span>
    </label>

    <label>
        <input required="" placeholder="" type="email" class="input" name="email">
        <span>E-mail</span>
    </label>

    <label>
        <input required="" placeholder="" type="password" class="input" name="password" minlength="6">
        <span>Парола (6+)</span>
    </label>

    <label>
        <input required="" placeholder="" type="password" class="input" name="confirm_password">
        <span>Потвърди парола</span>
    </label>

    <input placeholder="Дата на раждане" required="" class="input" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" name="birth_date" style="border-radius:10px; padding:10px;">

    <div style="display: flex; color: white; gap: 5px;">
        <input type="checkbox" name="approve" id="approve" value="approved" onchange="enableButton()">
        <label for="approve" style="font-size: 15px;">Съгласен съм с <a href="">Политиката на поверителност</a></label>
    </div>

    <button disabled type="submit" class="submit">Регистрирай</button>
    <p class="signin">Имате акаунт? <a href="loginplace.php">Вход</a></p>
</form>

</div>

    <script>
         function enableButton() {
            var checkbox = document.getElementById("approve");
            var button = document.querySelector(".submit");

            button.disabled = !checkbox.checked;

        }
    </script>
</body>
</html>