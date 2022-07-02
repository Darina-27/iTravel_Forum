<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>iTravel</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <script src="https://kit.fontawesome.com/879d043470.js" crossorigin="anonymous"></script>

    <!-------------====GOOGLE FONTS===------------------>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@1,100&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed&display=swap" rel="stylesheet">

    <!-----=====------CSS FILE=====------------------------->
    <link rel="stylesheet" type="text/css" href="styles.css">

</head>

<body>
    <?php include 'partials/_header.php';?>
    <?php include 'partials/_dbconnect.php';?>

    <!--------========MAIN PAGE========-------------->

    <section id="main">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="container first">
                        <h1><b>T</b>ravel <b>T</b>he</h1><br>
                        <h1><b>W</b>orld <b>W</b>isely</h1><br>

                        <p> <b>Join the discussion</b><br> Your Pocket Travel Guide. Lorem, ipsum dolor sit amet
                            consectetur adipisicing elit. Enim, similique!</Guide>
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="container second">
                        <div class="row row-cols-2">
                            <div class="col"><img
                                    src="https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Nnx8dHJhdmVsfGVufDB8fDB8fA%3D%3D&auto=format&fit=crop&w=500&q=60"></img>
                            </div>
                            <div class="col"><img
                                    src="https://images.unsplash.com/photo-1519500099198-fd81846b8f03?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MTU0fHx0cmF2ZWx8ZW58MHx8MHx8&auto=format&fit=crop&w=500&q=60"></img>
                            </div>
                            <div class="col"><img
                                    src="https://images.unsplash.com/photo-1534067783941-51c9c23ecefd?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8OXx8bW91bnRhaW58ZW58MHx8MHx8&auto=format&fit=crop&w=500&q=60"></img>
                            </div>
                            <div class="col"><img
                                    src="https://images.unsplash.com/photo-1512757776214-26d36777b513?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MTIwfHx0cmF2ZWx8ZW58MHx8MHx8&auto=format&fit=crop&w=500&q=60"></img>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <hr>

    <!-------======-2nd  - CAROUSEL=====---------------->

    <section id="second">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">

            <div class="carousel-inner black">

                <!-- first slide -->
                <div class="carousel-item active skyblue">
                    <div class="carousel-caption d-md-block">
                        <h3> WORK, TRAVEL </h3>
                        <h1> Save, Repeat</h1>
                    </div>
                </div>

                <!-- second slide -->
                <div class="carousel-item skyblue">
                    <div class="carousel-caption d-md-block">
                        <h3> Have Stories</h3>
                        <h1>TO TELL</h1>
                    </div>
                </div>
            </div>

            <!-- controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>
    <hr>

    <!--===========CATEGORIES==========-->
<section id="categories">
    <div class="container">
        <h2 class="text-center">iTravel - Categories</h2>
        <div class="row">
            <!---fetch all the categories and Using Loop to iterate through categories----->
            <?php
            $sql="SELECT * FROM `categories`";
            $result=mysqli_query($conn,$sql);

            while($row=mysqli_fetch_assoc($result)){
                $id=$row['category_id'];
                $cat=$row['category_name'];
                $desc=$row['category_description'];

                echo '<div class="col-md-4 my-2">
                <div class="card" style="width: 18rem;">
                    <img src="img/'.$id.'.jpg"
                        class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><a href="threadlist.php?catid='  .$id.  '">'  .$cat.  '</a></h5>
                        <p class="card-text">'.substr($desc,0,70).'....</p>
                        <a href="threadlist.php?catid='  .$id.  '" class="btn btn-primary">View</a>
                    </div>
                </div>
            </div>';
            }
            ?>

        </div>
    </div>
        </section>
    <!---================== FOLLOW US ON =====---------->
    <section  id="fourth">          
        <div class="container-fluid footer-social-icons">
          <h3 class="_14">Follow us on</h3>
          <ul class="social-icons">
            <li><a href="https://www.facebook.com/" target="_blank" class="social-icon"> <i class="fa fa-facebook"></i></a></li>
            <li><a href="https://twitter.com/" target="_blank" class="social-icon"> <i class="fa fa-twitter"></i></a></li>
            <li><a href="https://www.instagram.com/" target="_blank" class="social-icon"> <i class="fa fa-instagram"></i></a></li>
            <li><a href="https://www.youtube.com/" target="_blank" class="social-icon"> <i class="fa fa-youtube"></i></a></li>
          </ul>
        </div>     
      </section>
      <hr>
    <!---==============BOOTSTRAP JS SCRIPTS============----->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous">
    </script>
</body>

</html>