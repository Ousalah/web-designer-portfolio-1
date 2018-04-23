<?php if(empty($_SESSION)) session_start(); ?>

<?php $pageTitle = "Dashboard"; ?>

<?php require 'modules/utils.class.php'; ?>
<?php
  if(!empty($_SESSION["id_admin"]) && isset($_SESSION["id_admin"])){
    require 'fragment/header-admin.php';
  }elseif (!empty($_SESSION["id_delegue"]) && isset($_SESSION["id_delegue"])) {
    require 'fragment/header-delegue.php';
  }else{ header("location:login.php");  } // if no SESSION send user to login page
?>

<div id="page-inner">
  <div class="row">
    <div class="col-md-12">
      <h2  align="center"><?= $pageTitle; ?></h2>   
    </div>
  </div>              
  <!-- /. ROW  -->
  <hr>

  <!--START NOTIFE-->
  <?php 
    $error = Utils::get_notice("error"); 
    if (!empty($error)) {
  ?>
  <div class="alert alert-danger fade in">
    <button data-dismiss="alert" class="close close-sm" type="button">
      <i class="icon-remove">x</i>
    </button>
    <strong>Oh snap!</strong> <?= $error; ?>
  </div>
  <?php } ?>
  <!--END NOTIFE-->


  <!--START NOTIFE-->
  <?php 
    $notice = Utils::get_notice("notice"); 
    if (!empty($notice)) {
  ?>
  <div class="alert alert-success fade in">
    <button data-dismiss="alert" class="close close-sm" type="button">
      <i class="icon-remove">x</i>
    </button>
    <strong>Good!</strong> <?= $notice; ?>
  </div>
  <?php } ?>
  <!--END NOTIFE-->
              
  <!-- /. ROW  -->           
</div>
<!-- /. PAGE INNER  -->


<?php require 'fragment/footer.php'; ?>

