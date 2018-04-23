<?php $pageTitle = "ALL EXCELS DETAILS"; ?>

<?php require 'model/DelegueModel.php'; ?>
<?php require 'fragment/header-admin.php'; ?>

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

<!-- start table -->
<div style="text-align: center;">
	<a href="controller/Excel.php?a=export&did=<?= $_GET['did']; ?>&xid=<?= $_GET['xid']; ?>" class="btn btn-success btn-sm">
		<span class="glyphicon glyphicon-export"></span>
		Export
	</a>
</div>

    <div class="panel panel-primary filterable">
      <div class="panel-heading">
          <h3 class="panel-title">
          	<?php
				$table = "delegue";
				$data = array('id' => $_GET["did"]);
				$delegues = Utils::get_by($table, $data);
				$delegue = $delegues[0];

				echo $delegue->firstname." ".$delegue->lastname;
			 ?>
          </h3>
          
          <div class="pull-right">
              <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
          </div>
      </div>
      <table class="table">
          <thead>
              <tr class="filters">
              	<?php
              		$table = "excel";
					$data = array(
						'delegue_id' => $_GET["did"],
						'xml_id'	=> $_GET["xid"]
					);
					$excels = Utils::get_by($table, $data);
					$excel = $excels[0];
					// get csv file
					$file = file("excel/".$excel->link);
					foreach ($file as $k) {
						// convert csv to Array()
						$csv[] = explode(",", $k);
					}
                 

                 	// show Header Title
                  	foreach ($csv[0] as $column) :
                ?>

                  <th><input type="text" class="form-control" placeholder="<?= $column; ?>" disabled></th>

                <?php endforeach ?>
              </tr>
          </thead>
          <tbody>

            <?php

                $columnNumber = count($csv[0]);
                 
                foreach ($excels as $ex) {
                	// reset table of data befor have new values 
                	$csvFile = "";

                	$allFiles = file("excel/".$ex->link);
                	foreach ($allFiles as $k) {
						// convert csv to Array()
						$csvFile[] = explode(",", $k);
					}
                

                	foreach (array_slice($csvFile, 1) as $row) :
            ?>
	            <tr>
	                <?php for ($i=0; $i < $columnNumber; $i++) { ?>

	                  <td><?= str_replace('"', '', $row[$i]); ?></td>

	                <?php } ?>
	            </tr>
            <?php 
	        		endforeach;
        		} 

            ?>
          </tbody>
      </table>
    </div>

    <!-- end table -->

  <!-- /. ROW  -->           
</div>
<!-- /. PAGE INNER  -->    
<?php require 'fragment/footer.php'; ?>