<?php if(empty($_SESSION)) session_start(); ?>

<?php 
if(empty($_SESSION["id_admin"])){
    header("location:signin.php");
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

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


    <style type="text/css">
    /*<!-- Style for defenent state of dragabbel - droppable - sortable -->*/
        .my-state-droppable{
            background-color: #f0f0f0;
            border: 2px dashed gray !important;
        }

        .my-state-dragabble, .my-state-sortable{
                    border: 1px dashed #999;
                    width: 100%;
                    box-sizing: border-box;
                    padding: 15px;
                    color: #000;
                    background-color: #FFF;
            -webkit-border-radius: 3px;
               -moz-border-radius: 3px;
                    border-radius: 3px;
            -webkit-box-shadow: 1px 4px 36px 3px rgba(0,0,0,0.5);
               -moz-box-shadow: 1px 4px 36px 3px rgba(0,0,0,0.5);
                    box-shadow: 1px 4px 36px 3px rgba(0,0,0,0.5);
        }

        .my-state-sortable{
            border: 1px solid #999;
            height: auto !important;
        }



        @media(max-width:766px) {
    
            .navbar-side {width: 260px; background-color: #214761; }

            .sidebar-collapse > .nav > li > a {color: #FFF; }
            
            .sidebar-collapse > .nav > li > a:hover {color: #214761; }

            .navbar-side ul.nav li a.active-link {color: #214761; }

            #page-wrapper{margin-left: 0px; }
 
        }

    </style>

    
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
                	<a href="controller/Admin.php?a=logout" style="color:#fff;">LOGOUT</a>
                </span>
            </div>
        </div>
        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation" style="position: fixed; z-index: 1000;">
            <div class="sidebar-collapse">
                
                <!-- Strat Nav Bar Admin  -->
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

            </div>

        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >