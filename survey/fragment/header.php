<?php if(empty($_SESSION)) session_start(); ?>

<?php 
if(empty($_SESSION["id_admin"]) && empty($_SESSION["id_delegue"])){
    header("location:login.php");
}    
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?= $pageTitle; ?></title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">


    <script src="js/jquery-3.2.1.min.js"></script>

    <!-- tableFilter -->
    <link href="css/tableFilter.css" rel="stylesheet">

    <!-- used to test frag and drop in test2.html  -->
    <link href="css/jquery-ui.min.css" rel="stylesheet" />
    <script src="js/jquery-ui.min.js"></script>



    <link href="css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />


    <?php if(isset($_SESSION["id_delegue"]) && !empty($_SESSION["id_delegue"])){ ?>
    
    <style>
        .sidebar-collapse > .nav > li > a {
            color: #5cb85c;
        }

        .navbar-inverse, .footer {
            background-color: #5cb85c; 
        }
        
    </style>
    
    <?php } ?>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
     
           
          
    <div id="wrapper">
         <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="adjust-nav">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">
                        <!-- LOGO <img src="assets/img/logo.png" /> -->
                    </a>
                </div>
              
                 <span class="logout-spn" >
                <?php if(!empty($_SESSION["id_admin"])): ?>

                    <a href="controller/Admin.php?a=logout" style="color:#fff;">LOGOUT</a>

                <?php elseif(!empty($_SESSION["id_delegue"])): ?>

                  <a href="controller/Delegue.php?a=logout" style="color:#fff;">LOGOUT</a>  
                
                <?php endif ?>
                </span>
            </div>
        </div>
        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation" style="position: fixed;">
            <div class="sidebar-collapse">
                
                <!-- Strat Nav Bar Admin  -->
                <?php if(!empty($_SESSION["id_admin"])): ?> 
                <ul class="nav" id="main-menu">
                    <li>
                        <a href="index.php" ><i class="glyphicon glyphicon-home"></i>Dashboard</a>
                    </li>
                   

                    <li>
                        <a href="creation.php"><i class="glyphicon glyphicon-list-alt"></i>Create XML</a>
                    </li>
                    <li>
                        <a href="add-delegue.php"><i class="glyphicon glyphicon-plus"></i>Add Delegue</a>
                    </li>
                    <li>
                        <a href="delegue-list.php"><i class="glyphicon glyphicon-user"></i>Delegue List</a>
                    </li>
                </ul>
                <!-- end Nav Bar Admin  -->


                <!-- Strat Nav Bar Delegue  -->
                <?php elseif(!empty($_SESSION["id_delegue"])): ?> 
                <ul class="nav" id="main-menu">
                    <li>
                        <a href="index.php" ><i class="glyphicon glyphicon-home"></i>Dashboard</a>
                    </li>

                    <li>
                        <a href="delegue.php"><i class="glyphicon glyphicon-list"></i>List Surveys</a>
                    </li>
                </ul>
                <?php endif ?>
                <!-- end Nav Bar Delegue  -->                


            </div>

        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >