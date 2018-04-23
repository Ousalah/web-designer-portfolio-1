<?php $pageTitle = "EXCEL DETAILS"; ?>

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

<?php

// get csv file
$file = file("excel/".$_GET["excel"]);
foreach ($file as $k) {
	// convert csv to Array()
	$csv[] = explode(",", $k);
}

?>
<!-- start table -->
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
                 
                  foreach ($csv[0] as $column) :
                  ?>

                  <th><input type="text" class="form-control" placeholder="<?= $column; ?>" disabled></th>

                <?php endforeach ?>
              </tr>
          </thead>
          <tbody>

              <?php

                $columnNumber = count($csv[0]);
                 
                foreach (array_slice($csv, 1) as $row) :
              ?>
              <tr>
                  <?php
                  for ($i=0; $i < $columnNumber; $i++) { 
                  ?> 
                  <td><?= str_replace('"', '', $row[$i]); ?></td>

                  <?php } ?>
              </tr>
            <?php endforeach ?>
          </tbody>
      </table>
    </div>

    <!-- end table -->

  <!-- /. ROW  -->           
</div>
<!-- /. PAGE INNER  -->    
<?php require 'fragment/footer.php'; ?>