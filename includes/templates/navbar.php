<?php include('connect.php'); ?>

<nav class="navbar navbar-light navbar-expand-md bg-faded justify-content-center">
    <h4><b><a href="index.php" class="navbar-brand d-flex w-50 mr-auto">Web coding challenge</a></h4></b>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsingNavbar3">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse collapse w-100" id="collapsingNavbar3">
      


        <?php
              if(isset($_SESSION['user'])){
           
                  $stmt = $con->prepare("SELECT * FROM user WHERE email = ?");
                  $stmt->execute(array($_SESSION['user']));
                  $userInfos = $stmt->fetch();
        ?>

            <ul class="nav navbar-nav ml-auto w-100 justify-content-end">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Nearby Shops</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="preferred_shops.php">My preferred Shops</a>
                </li>
                <li class="dropdown">
                     <a class="btn btn-default dropdown-toggle nav-link" data-toggle=dropdown>
                      <?php echo $_SESSION['user'];?></a>
                      <a class="caret"></a>
                    <ul class="dropdown-menu">
                      <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                    </ul>
                </li>

        <?php }else{ ?>

            <ul class="nav navbar-nav ml-auto w-100 justify-content-end">
                <li class="nav-item">
                    <a class="nav-link" href="sign_in.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="sign_up.php">Sign up</a>
                </li>
            </ul>

        <?php } ?>
    </div>
</nav>