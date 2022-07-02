<?php
session_start();

echo '
<nav class="fixed-top navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">iTravel</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/forum">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/forum/#categories">Categories</a>
        </li>
        <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="/forum/#fourth">Social-Handles</a>
      </li>
        <li class="nav-item">
        <a class="nav-link" href="contact.php">Contact</a>
        </li>
      </ul>';
      if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
        echo '
        <p class="text-light mb-0 pb-0 mx-2">Welcome' . $_SESSION['useremail'].'</p>
        
      
      <a href="partials/_logout.php" class="btn btn-dark">Log Out</a>
      ';
      }
      else{
        echo '<div class="mx-2">
        <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
        <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#signupModal">Signup</button>

      </div>';
      }
      
      
      
    echo '</div>
  </div>
</nav>
';

include 'partials/_loginModal.php';
include 'partials/_signupModal.php';
if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']=='true'){
  echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
            <strong>Success!</strong> You can now login
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
}

?>