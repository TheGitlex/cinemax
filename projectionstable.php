<div id="projections">
<?php
for ($i = 0; $i <= 5; $i++) {

    $nextDay = date('d.m', strtotime('+' . $i . ' day'));

    $dayOfWeek = date('N', strtotime('+' . $i . ' day'));

    switch ($dayOfWeek) {
        case 1:
            $dayName = 'Понеделник';    break;
        case 2:
            $dayName = 'Вторник';   break;
        case 3:
            $dayName = 'Сряда';  break;
        case 4:
            $dayName = 'Четвъртък'; break;
        case 5:
            $dayName = 'Петък';    break;
        case 6:
            $dayName = 'Събота';  break;
        case 7:
            $dayName = 'Неделя';     break;
        default:
            $dayName = 'Invalid day';
    }
    echo '<div class="datetable"><label id="day_' . $i . '">' . $nextDay . '</br>' . $dayName . '</label></div>';
}
?>

        <!-- </div> -->
        <hr style="margin:1rem;grid-column: 1 / -1; ">

        <?php

$movieId = $_GET['id'] ?? null;

if ($movieId) {
    $projectionsFound = false; 

    for ($i = 0; $i < 6; $i++) {
        $date = date('Y-m-d', strtotime("+$i days"));

        $query = "SELECT p.id_projection, DATE_FORMAT(p.time, '%H:%i') AS formatted_time, p.id_hall
                  FROM projections p
                  WHERE p.date = '$date' 
                  AND p.id_movie = $movieId
                  AND CONCAT(p.date, ' ', p.time) > NOW()  -- Filter out projections with time later than current time
                  ORDER BY p.time ASC"; // Sort by time in ascending order
        $result = $conn->query($query);

        echo '<div class="projectcolumn">';

        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                $projectionsFound = true; 
                if(isset($_COOKIE["user_name"]))
                echo '<button onclick="openTicket(this, \'' . $i . '\', \'' . $row['id_projection'] . '\', \'' . $row['id_hall'] . '\')">' . $row['formatted_time'] . '</button>';
            else { echo '<button onclick="test()">'. $row['formatted_time'] .'</button>';}
            }
        } else {

            echo '<button style="visibility: hidden;"></button>';
        }

        echo '</div>';
    }

    if (!$projectionsFound) {
        echo "<p>Няма прожекции за тези дни.</p>";
    }
} else {
    echo "<p>Няма прожекции за тези дни.<p>";
}
?>

<?php
if (isset($_COOKIE['user_name']) && $user_result == 1) {

    echo '<div class="edit" style="margin-top:76rem; left:0">
    <input type="hidden" id="idmovie" value="' . $movieId . '">
    <input id="datetime" type="datetime-local" placeholder="Date and Time">
    <input id="hall" placeholder="hall 1-12" >
    <button style="width: 50px; height: 50px; font-size:2rem;" onclick="addProjection()">+</button>
</div>';
}
?>
<script>
function addProjection() {
    var idMovie = document.getElementById('idmovie').value;
    var datetime = document.getElementById('datetime').value;
    var hall = document.getElementById('hall').value;

    var datetimeParts = datetime.split('T');
    var date = datetimeParts[0];
    var hour = datetimeParts[1].substring(0, 5); 

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'add_projection.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState == XMLHttpRequest.DONE) {
            if (xhr.status == 200) {

                console.log(xhr.responseText);
                location.reload();
            } else {

                console.error('Error: ' + xhr.status);
            }
        }
    };
    xhr.send('idMovie=' + idMovie + '&hour=' + hour + '&date=' + date + '&hall=' + hall);
}

</script>

        </div>