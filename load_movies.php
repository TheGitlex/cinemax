<?php
include("database.php");

if (isset($_POST['category'])) {
    $category = $_POST['category'];

    switch ($category) {
        case 'all':
            $sql = "SELECT * FROM movies WHERE active = 1 AND release_date <= CURRENT_DATE";
            break;
            case 'admin':
                $sql = "SELECT * FROM movies order by id_movie desc" ;
                break;
        case 'animations':
                $sql = "SELECT * FROM movies WHERE genre LIKE '%Анимация%' AND active = 1 AND release_date <= CURRENT_DATE";
                break;
        case 'action':
                    $sql = "SELECT * FROM movies WHERE genre LIKE '%Екшън%' AND active = 1 AND release_date <= CURRENT_DATE";
                    break;
        case 'horror':
                    $sql = "SELECT * FROM movies WHERE (genre LIKE '%Хорър%' OR genre LIKE '%Ужас%') AND active = 1 AND release_date <= CURRENT_DATE";

                        break;
          case 'comedy':
                            $sql = "SELECT * FROM movies WHERE genre LIKE '%Комедия%' AND active = 1 AND release_date <= CURRENT_DATE";

                                break;
         case 'a-z':
                            $sql = "SELECT * FROM movies WHERE active = 1 AND release_date <= CURRENT_DATE order by title";
                            break;
         case 'date':
                                $sql = "SELECT * FROM movies WHERE active = 1 AND release_date <= CURRENT_DATE order by release_date DESC";
                                break;
        case 'fav':
                            $sql = "SELECT *, AVG(r.rating_value) as avg_rating
                                    FROM movies m
                                    JOIN ratings r ON m.id_movie = r.id_movie
                                    WHERE m.active = 1 AND release_date <= CURRENT_DATE
                                    GROUP BY m.id_movie
                                    ORDER BY avg_rating DESC" ;
                            break;
        case 'premieres':
                $sql = "SELECT * FROM movies WHERE release_date => DATE_SUB(CURRENT_DATE, INTERVAL 14 DAY) AND active = 1 ";
                break;    
        case 'coming_soon':
                $sql = "SELECT * FROM movies WHERE release_date > CURRENT_DATE AND active = 1 ORDER BY release_date ASC" ;
                break;
        default:
        $sql = "SELECT * FROM movies WHERE active = 1 AND release_date <= CURDATE()";

    }

    $result = mysqli_query($conn, $sql);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            foreach ($result as $movie) {
                $releaseDate = strtotime($movie['release_date']);
                $currentDate = time();
                $twoWeeksLater = strtotime('+2 weeks', $currentDate);
                $text = '';
                $backgroundColor = '';

                if ($movie['active'] == 1 && $releaseDate <= $currentDate) {
                    if (($currentDate - $releaseDate) <= (14 * 24 * 60 * 60)) {
                        $text = 'Премиера';
                        $backgroundColor = 'purple';
                    } else {
                        $text = 'В продажба';
                        $backgroundColor = 'green';
                    }

                } elseif ($movie['active'] == 0) {
                    $text = 'not available';
                    $backgroundColor = 'red';
                } else {
                    $text = 'Очаквайте скоро';
                    $backgroundColor = 'rgb(0, 161, 236);';
                }
                ?>
                <a class="menuitem" href="movie.php?id=<?php echo $movie['id_movie'] ?>">
                    <p class="nalichnost" style="background-color: <?php echo $backgroundColor ?>;width: 195px;">
                        <?php echo $text ?>
                    </p>
                    <div style="overflow:hidden;">
                    <img src="icons/<?php echo $movie['icon']; ?>" alt="" width="195" height="300">
                    </div>
                    <p>
                        <?php echo $movie['title']; ?>
                    </p>
                </a>
            <?php }
        }
    } else {
        echo 'Error executing query: ' . mysqli_error($conn);
    }
} else {
    echo 'Invalid request';
}

mysqli_close($conn);
?>