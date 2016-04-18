<?php session_start();?>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Smart Home</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li <?php if ((stripos($_SERVER[ 'REQUEST_URI'], 'index.php') !==false) OR (substr($_SERVER[ 'REQUEST_URI'], -1)=="/" )) {echo 'class="active"';} ?> ><a href="./">Welcome<?php if (stripos($_SERVER['REQUEST_URI'],'index.php') !== false) {echo '<span class="sr-only">(current)</span>';} ?></a></li>

                <li <?php if (stripos($_SERVER[ 'REQUEST_URI'], 'Controller.php') !==false) {echo 'class="active"';} ?> ><a href="./Controller.php">Controller<?php if (stripos($_SERVER['REQUEST_URI'],'Controller.php') !== false) {echo '<span class="sr-only">(current)</span>';} ?></a></li>

                <li <?php if (stripos($_SERVER[ 'REQUEST_URI'], 'Help.php') !==false) {echo 'class="active"';} ?> ><a href="./Help.php">Help<?php if (stripos($_SERVER['REQUEST_URI'],'Help.php') !== false) {echo '<span class="sr-only">(current)</span>';} ?></a></li>

                <li 
                <?php 
                if ($_SESSION['signedIn'] !== true) {
                        if (stripos($_SERVER[ 'REQUEST_URI'], 'login.php') !==false) {echo 'class="active"';} 
                        echo'><a href="./login.php">Login'; 
                        if (stripos($_SERVER['REQUEST_URI'],'login.php') !== false) {echo '<span class="sr-only">(current)</span>';} 
                        echo '</a></li>';
                    } else {
                        echo "><a href='./logout.php'>Logout</a></li>";
                } ?>


            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>