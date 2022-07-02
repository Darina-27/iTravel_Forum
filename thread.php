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

    <!-----------------CSS FILE------------------------>
    <link rel="stylesheet" type="text/css" href="styles.css">

</head>

<body>
    <?php include 'partials/_header.php';?>
    <?php include 'partials/_dbconnect.php';?>
    <?php
    $id=$_GET['threadid'];
    $sql="SELECT * FROM `threads` WHERE thread_id=$id";
    $result=mysqli_query($conn,$sql);

    while($row=mysqli_fetch_assoc($result)){
        $title=$row['thread_title'];
        $desc=$row['thread_desc'];
        $thread_user_id=$row['thread_user_id'];// commented
        // Query the users table to find out the name of the one who posted
        $sql2="SELECT user_email FROM `users` WHERE sno='$thread_user_id'";
        $result2=mysqli_query($conn,$sql2);
        $row2 = mysqli_fetch_assoc($result2);
        $posted_by=$row2['user_email'];
    }
    ?>

    <?php
    $showAlert=false;
    $method= $_SERVER['REQUEST_METHOD'];
    if($method=='POST'){
        //INSERT comment INTO DB
        $comment = $_POST['comment'];
        $comment=str_replace("<","&lt",$comment);
        $comment=str_replace(">","&gt",$comment);// to save from XSS attack
        $sno = $_POST['sno'];
        $sql= "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$comment', '$id', '$sno', current_timestamp())";
        
        $result=mysqli_query($conn,$sql);
        $showAlert=true;
        if($showAlert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Your comment has been added.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
    }
    ?>

    <!-----=========- DISPLAY OF THE THREAD======------------->

    <div class='container my-4' id="thread_display">
        
        <div class='jumbotron p-2' style="
    background-image: radial-gradient( circle 400px at 6.8% 8.3%,  rgba(255,244,169,1) 0%, rgba(255,244,234,1) 100.2% ); margin-top:5rem;";>
            <h1 class='display-4 mx-3'><?php echo $title;?></h1>
            <p class='lead mx-3'><?php echo $desc;?></p>
            <hr class='my-4 mx-3'>
            <p class="mx-3">This is a peer to peer forum for sharing knowledge with each other. No Offensive Material No posting any harmful, threatening, abusive, harassing, defamatory, vulgar, obscene, hateful, or racially, ethnically or otherwise objectionable content</p>
            <p class="mx-3">
                <b>Posted by: <?php echo  $posted_by;?></b>
            </p>
        </div>
    </div>
    

    <?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
        echo '<div class="container my-3">
        <h2 class="my-3">Post a comment</h2>
        <form action="'. $_SERVER['REQUEST_URI'].'"  method="post">
            <div class="form-group mb-3">
                <label for="exampleFormControlTextarea1">Type your comment</label>
                <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                <input type="hidden" name="sno" value="'.$_SESSION["sno"].'">
            </div>
            <button type="submit" class="btn btn-dark">Post</button>
        </form>
    </div>
    <hr>';
    }
    else{
        echo '<div class="container my-3">
        <h2 class="my-3" style="">Post a comment</h2>
        <div class="alert alert-danger" role="alert">
        You are not logged in. Please <b>Log In</b> to start a post a comment
</div>
        
    </div>';
    }
   
    ?>



    <div class='container my-3'>
        <h2 class='my-3'>Discussions</h2>
        <?php
        $id=$_GET['threadid'];
        $sql="SELECT * FROM `comments` WHERE thread_id=$id";
        $result=mysqli_query($conn,$sql);
        $noResult=true;
        while($row=mysqli_fetch_assoc($result)){
            $noResult=false;
            $id=$row['comment_id'];
            $content=$row['comment_content'];
            $comment_time=$row['comment_time'];
            $thread_user_id=$row['comment_by'];

            $sql2="SELECT user_email FROM `users` WHERE sno='$thread_user_id'";
            $result2=mysqli_query($conn,$sql2);
            $row2 = mysqli_fetch_assoc($result2);

            
            echo '
            <div class="container">
            <div class="row justify-content-center my-3">
                <div class="col-1 border border-secondary p-2">
                    <img class="mx-3" src="img\userdefault.jpg" width="60%" height="80%" alt="Generic placeholder image">
                </div>
                <div class="col-7 border border-secondary p-2">
                    <p class="fw-bold my-0" style="font-size:17px;">'.$row2['user_email'].' at ' .$comment_time. ' </p>

                    '.$content.'
                </div>
            </div>
            </div>';
        }
        if($noResult){
            echo '<b>Be the first person to start a thread</b>';
        }
        
        ?>



    </div>


    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js'
        integrity='sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2' crossorigin='anonymous'>
    </script>
    <script src='https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js'
        integrity='sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk' crossorigin='anonymous'>
    </script>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js'
        integrity='sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy' crossorigin='anonymous'>
    </script>
</body>

</html>