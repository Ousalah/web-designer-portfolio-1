<?php if(empty($_SESSION)) session_start(); ?>

<?php 
if(empty($_SESSION["id_delegue"])){
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


    <style>
        .sidebar-collapse > .nav > li > a {
            color: #5cb85c;
        }

        .navbar-inverse, .footer {
            background-color: #5cb85c; 
        }
        

        @media(max-width:766px) {
    
            .navbar-side {width: 260px; background-color: #5cb85c; }

            .sidebar-collapse > .nav > li > a {color: #FFF; }
            
            .sidebar-collapse > .nav > li > a:hover {color: #5cb85c; }

            .navbar-side ul.nav li a.active-link {color: #5cb85c; }

            #page-wrapper{margin-left: 0px; }
 
        }

    </style>

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
                	<a href="controller/Delegue.php?a=logout" style="color:#fff;">LOGOUT</a>
                </span>
            </div>
        </div>
        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation" style="position: fixed; z-index: 1000;">
            <div class="sidebar-collapse">


                <!-- Strat Nav Bar Delegue  -->
                <ul class="nav" id="main-menu">
                    <li>
                        <a href="index.php" ><i class="glyphicon glyphicon-home"></i>Dashboard</a>
                    </li>

                    <li>
                        <a href="delegue.php"><i class="glyphicon glyphicon-list"></i>List Surveys</a>
                    </li>
                </ul>
                <!-- end Nav Bar Delegue  -->                


            </div>

        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >