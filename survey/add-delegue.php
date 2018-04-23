<?php $pageTitle = "ADD DELEGUE"; ?>

<?php require 'modules/utils.class.php'; ?>
<?php require 'fragment/header-admin.php'; ?>

<div id="page-inner">
  <div class="row">
    <div class="col-md-12">
      <h2 align="center"><?= $pageTitle; ?></h2>   
    </div>
  </div>              
  <!-- /. ROW  -->
  <hr>
		<form class="form-horizontal" action="controller/Delegue.php?a=add&t=delegue&img=true" method="POST" enctype="multipart/form-data">
		    <fieldset>
		        <!-- Form Name -->
		        
		        <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="firstname">firstname</label>  
                    <div class="col-md-6">
                        <input id="firstname" name="firstname" type="text" class="form-control input-md">
                    </div>
                </div>                      

		        <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="lastname">lastname</label>  
                    <div class="col-md-6">
                        <input id="lastname" name="lastname" type="text" class="form-control input-md">
                    </div>
                </div>

		        <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="email">email</label>  
                    <div class="col-md-6">
                        <input id="email" name="email" type="email" class="form-control input-md">
                    </div>
                </div>

		        <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="password">password</label>  
                    <div class="col-md-6">
                        <input id="password" name="password" type="password" class="form-control input-md">
                    </div>
                </div> 

		        <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="image">image</label>  
                    <div class="col-md-6">
                        <input id="image" name="image" type="file" class="form-control input-md">
                    </div>
                </div>

		    </fieldset>

			<!--START NOTIFE-->
            <?php 
              $notice = Utils::get_notice("notice"); 
              if (!empty($notice)) {
            ?>
            <div class="form-group">
                <span class="col-md-4" for="image"></span>
	            <div class="col-md-6 alert alert-success fade in">
	              <button data-dismiss="alert" class="close close-sm" type="button">
	                <i class="icon-remove">x</i>
	              </button>
	              <strong>Good!</strong> <?= $notice; ?>
	            </div>
	        </div>
            <?php } ?>
            <!--END NOTIFE-->

		    <!-- Button (Double) -->
		    <div class="form-group">
		        <span class="col-md-4"></span>
		        <button type="submit" class="col-md-6 btn btn-success">Add</button>
		    </div>
		</form>
              
  <!-- /. ROW  -->           
</div>
<!-- /. PAGE INNER  -->

<script>
    // no spaces allowed in OldID_Name input
        $('#oldID_Name').keypress(function (key) {
            var regexpns = new RegExp("^[a-zA-Z0-9-_]+$");
            var key = String.fromCharCode(event.charCode ? event.which : event.charCode);
            if (!regexpns.test(key)) {
                event.preventDefault();
                return false;                       
            }
            
        });
</script>


<?php require 'fragment/footer.php'; ?>

