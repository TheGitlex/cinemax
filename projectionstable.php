<div id="projections">
<?php
for ($i = 0; $i <= 5; $i++) {
    // Calculate the next day's date
    $nextDay = date('d.m', strtotime('+' . $i . ' day'));
    // Format the next day's date with the correct day of the week
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
// Assuming you have a database connection established

// Get the movie ID from the URL
$movieId = $_GET['id'] ?? null;

// Check if movie ID is provided
if ($movieId) {
    $projectionsFound = false; // Flag to track if any projections are found
    
    // Iterate over the next 7 days
    for ($i = 0; $i < 7; $i++) {
        $date = date('Y-m-d', strtotime("+$i days"));

        // Query projections for the current date and movie ID
        $query = "SELECT p.id_projection, DATE_FORMAT(p.time, '%H:%i') AS formatted_time, p.id_hall
                  FROM projections p
                  WHERE p.date = '$date' 
                  AND p.id_movie = $movieId
                  AND CONCAT(p.date, ' ', p.time) > NOW()  -- Filter out projections with time later than current time
                  ORDER BY p.time ASC"; // Sort by time in ascending order
        $result = $conn->query($query);

        echo '<div class="projectcolumn">';
        
        // Check if there are any projections for the current date
        if ($result->num_rows > 0) {
            // Output each projection as a button with formatted time
            while ($row = $result->fetch_assoc()) {
                $projectionsFound = true; // Set flag to true if projections are found
                if(isset($_COOKIE["user_name"]))
                echo '<button onclick="openTicket(this, \'' . $i . '\', \'' . $row['id_projection'] . '\', \'' . $row['id_hall'] . '\')">' . $row['formatted_time'] . '</button>';
            else { echo '<button onclick="test()">'. $row['formatted_time'] .'</button>';}
            }
        } else {
            // Output an empty column if there are no projections for the current date
            echo '<button style="visibility: hidden;"></button>';
        }

        echo '</div>';
    }

    // Check if any projections were found
    if (!$projectionsFound) {
        echo "<p>Няма прожекции за тези дни.</p>";
    }
} else {
    echo "<p>Няма прожекции за тези дни.<p>";
}
?>


<?php
if (isset($_COOKIE['user_name']) && $user_result == 1) {
    // User is logged in as admin
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

    // Validate input values (you can add your own validation logic here)

    // Extract date and time from datetime input
    var datetimeParts = datetime.split('T');
    var date = datetimeParts[0];
    var hour = datetimeParts[1].substring(0, 5); // Extract HH:MM format

    // Send the data to the server using AJAX
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'add_projection.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState == XMLHttpRequest.DONE) {
            if (xhr.status == 200) {
                // Projection added successfully, handle response if needed
                console.log(xhr.responseText);
                location.reload();
            } else {
                // Error occurred, handle error if needed
                console.error('Error: ' + xhr.status);
            }
        }
    };
    xhr.send('idMovie=' + idMovie + '&hour=' + hour + '&date=' + date + '&hall=' + hall);
}


</script>


        </div>