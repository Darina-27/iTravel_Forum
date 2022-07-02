<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>iDiscuss</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@1,100&display=swap" rel="stylesheet">

<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@500&display=swap" rel="stylesheet">

<!-----------------CSS FILES------------------------------------------->
<link rel="stylesheet" type="text/css" href="styles.css">

</head>

<body>
    <?php include 'partials/_header.php';?>
    <?php include 'partials/_dbconnect.php';?>
    <?php
    $id= $_GET['catid'];
    $sql= "SELECT * FROM `categories` WHERE category_id=$id";
    $result=mysqli_query($conn,$sql);

    while($row=mysqli_fetch_assoc($result)){
        $catname=$row['category_name'];
        $catdesc=$row['category_description'];
    }
    ?>

    <!-----------======INSERTION OF THREAD INSIDE THE DB=======------------------>
    <?php
    $showAlert=false;
    $method= $_SERVER['REQUEST_METHOD'];
    if($method=='POST'){
        //INSERT THREAD INTO DB
        $th_title = $_POST['title'];
        $th_desc = $_POST['desc'];

        $th_title=str_replace("<","&lt",$th_title); // to save from XSS attack
        $th_title=str_replace(">","&gt",$th_title);

        $th_desc=str_replace("<","&lt",$th_desc);
        $th_desc=str_replace(">","&gt",$th_desc);

        $sno=$_POST['sno'];
        $sql= "INSERT INTO `threads`(`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('$th_title','$th_desc','$id','$sno',current_timestamp())";
        $result=mysqli_query($conn,$sql);
        $showAlert=true;
        if($showAlert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Your thread has been added. Please wait for community to respond
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
    }
    ?>

    <div class="container my-4">
        <div class="jumbotron" style="margin-top:5rem;">
            <h1 class="display-4">Welcome to <?php echo $catname;?> Forums</h1>
            <p class="lead"><?php echo $catdesc;?></p>
            <hr class="my-4">
            <p>This is a peer to peer forum for sharing knowledge with each other. No Offensive Material No posting any harmful, threatening, abusive, harassing, defamatory, vulgar, obscene, hateful, or racially, ethnically or otherwise objectionable content</p>
            
        </div>
    </div>
    <hr>

    <!---======ASK A QUESTION - FORM=======---->
    <?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
        echo '<div class="container">
        <h2 class="my-3">Start a Discussion</h2>
        <form action="'.$_SERVER["REQUEST_URI"].'"  method="post">
            <div class="form-group mb-3">
                <label for="exampleInputEmail1" class="form-label">Problem Title</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">Keep your title as short and crisp as possible</div>
            </div>
            <div class="form-group mb-3">
                <label for="exampleFormControlTextarea1">Problem Description</label>
                <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
                <input type="hidden" name="sno" value="'.$_SESSION["sno"].'">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <hr>';
    }
    else{
        echo '<div class="container">
        <div class="alert alert-danger" role="alert">
        You are not logged in. Please <b>Log In</b> to start a discussion
</div>    </div>';
    }
   
    ?>
    
    <!----======= BROWSE QUESTIONS======----->

    <div class="container">
        <h2 class="my-3">Browse Questions</h2>
        <?php
        $id=$_GET['catid'];
        $sql="SELECT * FROM `threads` WHERE thread_cat_id=$id";
        $result=mysqli_query($conn,$sql);
        $noResult=true; // no questions posted or in DB
        while($row=mysqli_fetch_assoc($result)){
            $noResult=false;
            $id=$row['thread_id'];
            $title=$row['thread_title'];
            $desc=$row['thread_desc'];
            $thread_time=$row['timestamp'];
            $thread_user_id=$row['thread_user_id'];

            $sql2="SELECT user_email FROM `users` WHERE sno='$thread_user_id'";
            $result2=mysqli_query($conn,$sql2);
            $row2 = mysqli_fetch_assoc($result2);
            

            echo '
            <div class="container threadlist">

            <div class="row justify-content-center my-3">
            <div class="col-5 border border-secondary p-2">
            <h5><a href="thread.php?threadid='.$id.'">'.$title.'</a></h5>
            '.$desc.'
            </div>
            <div class="col-3 border border-secondary p-2">
            <div class="d-flex align-self-center">            <p class="fw-bold">Asked by: '  .$row2['user_email'].'  </p>
            </div>

                
            </div>
        </div>
        </div>';
        }
        if($noResult){
            echo "<b>Be the first person to start a thread</b>";
        }
        ?>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
        integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js"
        integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous">
    </script>
</body>

</html>