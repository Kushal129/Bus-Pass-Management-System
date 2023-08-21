  <?php
  session_start();
  include 'connection.php';
  include 'toaster.php';
  ?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/ico" href="img/buslogo.png">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/fontawesome.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/popup.css">
    <link rel="stylesheet" href="css/bustravel.css">

    <title>Home</title>
    <style>
      .img {
        overflow: hidden;
        position: relative;
        width: 100%;
        padding-top: 75%;

      }

      .img img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
      }
    </style>
  </head>

  <body>
    <!-- ============================== Navbar =============================== -->
    <?php
    include_once 'navbar.php';
    ?>
    <!-- ============================== Main =============================== -->
    <div class="container mt-5">
      <div class="img">
        <img src="img/bus-bg.jpg" alt="Responsive Bus Image">
      </div>
    </div>
    <!-- ============================ dodti bus ============================ -->

    <marquee behavior="" direction="right" scrollamount="30" style="margin-bottom: -5px; padding:0;">
      <img class="ml-1 bus" src="img/travel.png" style="max-width: 150px;">
    </marquee>


    <!-- ============================ footer ============================  -->
    <footer>
      <?php
      include_once 'footer.php';
      ?>
    </footer>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
  </body>

  </html>

  
  <?php

if (isset($_GET['msg'])){
  echo '<script>showToaster("Password reset successful!" , "green")</script>';
  echo "<script>console.log(000000)</script>";
}

if (isset($_GET['popup'])) {
  if ($_GET['popup'] == 'login'){
  echo "<script>document.getElementById('login_btn').click()</script>";
  echo "<script>console.log(1234)</script>";

  }
}
  ?>
