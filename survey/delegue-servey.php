<?php $pageTitle = "SERVEY OF DELEGUE"; ?>

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

    <!-- start table -->
        <div class="panel panel-primary filterable">
            <div class="panel-heading">
                <h3 class="panel-title"> 
					<?php
						$table = "delegue";
						$data = array('id' => $_GET["d"]);
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
                        <th></th>
                        <th><input type="text" class="form-control" placeholder="surveys" disabled></th>
                        <th>N°</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
						$table = "xml";
						$data = array('delegue_id' => $_GET["d"]);
                      	$xmls = Utils::get_by($table, $data);
                       
                      	foreach ($xmls as $xml) :
                    ?>
                    <tr>
						<td><img src="uploads/xml_image.png" width="25" height="25" alt=""></td>

                        <?php
                            $table = "excel";
                            $condition = array(
                                "delegue_id" => $delegue->id,
                                "xml_id"    => $xml->id
                            );
                            $countExcel = Utils::get_count($table, $condition);
                            if ($countExcel > 1){ $showAll = true; }
                            else {$showAll = false; }
                        ?>

                        <td>
                        	<!-- xid = xml_id    &&  did = delegue_id -->
                        	<a href="delegue-excel.php?xid=<?= $xml->id; ?>&did=<?= $delegue->id; ?>&showAll=<?= $showAll; ?>">
                        		<?= $xml->link ?>
                        	</a>
                        </td>

                        <td>
                            <a href="delegue-excel.php?xid=<?= $xml->id; ?>&did=<?= $delegue->id; ?>&showAll=<?= $showAll; ?>">
                                [ <?=$countExcel; ?> ]
                        	</a>
                        </td>	
                    </tr>
                  <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
    <!-- end table -->
              
  <!-- /. ROW  -->           
</div>
<!-- /. PAGE INNER  -->


<?php require 'fragment/footer.php'; ?>

