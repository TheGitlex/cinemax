<!DOCTYPE html>
<html lang="en">


    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>404</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="icon" href="logo.png" />
        <style>
        body {
            background-color: rgb(23, 23, 23);
            color: white;
        }
       span #text-danger{
            color: cyan;
        }
        * {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    font: inherit;
  }
  header{
    height: 4.44rem !important;
  }
  #cinemaxtitle{
    margin-top: 0.9rem !important;
  }
       
    </style>
    </head>


    <body>
        <?php include("header.php"); ?>
        <div class="d-flex align-items-center justify-content-center vh-100">
            <div class="text-center">
                <h1 class="display-1 fw-bold">404</h1>
                <p class="fs-3"> <span class="text-danger">Opps!</span> Page not found.</p>
                <p class="lead">
                    The page you’re looking for doesn’t exist.
                  </p>
                <a href="main.php" class="btn btn-primary">Home</a>
            </div>
        </div>
    </body>


</html>