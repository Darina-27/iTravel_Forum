<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>iDiscuss</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="styles.css">



</head>

<body>
    <?php include 'partials/_dbconnect.php';?>
    <?php include 'partials/_header.php';?>

    <?php
    $showAlert=false;
    $method= $_SERVER['REQUEST_METHOD'];
    if($method=='POST'){
        //INSERT comment INTO DB
        $P_name = $_POST['P_name'];
        $P_email = $_POST['P_email'];
        $P_where = $_POST['P_where'];
        $sql= "INSERT INTO `booktrip`(`Person_name`, `Person_email`, `Person_visit`) VALUES ('$P_name','$P_email','$P_where')";
        
        $result=mysqli_query($conn,$sql);
        $showAlert=true;
        if($showAlert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Your message has been sent. The Team will shortly reach you</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
    }
    ?>

    <div class="container" id="bookTrip">
    <div>
  <div class="contact-form-wrapper d-flex justify-content-center">
    <form action="<?php $_SERVER['REQUEST_URI']?>" method="post" class="contact-form">
      <h5 class="title">BOOK YOUR GUIDE FOR THE NEXT TRIP</h5>
      <p class="description">Fill in the details below
      </p>
      <div>
        <input type="text" class="form-control rounded border-white mb-3 form-input" id="name" name="P_name" placeholder="Name" required>
      </div>
      <div>
        <input type="email" class="form-control rounded border-white mb-3 form-input" name="P_email" placeholder="Email" required>
      </div>
      <div>
        <textarea id="message" name="P_where" class="form-control rounded border-white mb-3 form-text-area" rows="5" cols="30" placeholder="Where do you want to go?" required></textarea>
      </div>
      <div class="submit-button-wrapper">
        <input type="submit" value="Send">
      </div>
    </form>
  </div>
</div>
    </div>


    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
</body>

</html>