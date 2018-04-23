<?php $pageTitle = "EXCEL FILE OF SERVEY"; ?>

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
                <h3 class="panel-title" style="display: inline;"> 
					<?php
						$table = "delegue";
						$data = array('id' => $_GET["did"]);
						$delegues = Utils::get_by($table, $data);
						$delegue = $delegues[0];

						echo $delegue->firstname." ".$delegue->lastname;
					
                    ?>
                </h3>
                
                <div class="pull-right" style="position: relative; top: 20px; ">
                    <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                </div>
            </div>
            <table class="table">
                <thead>
                    <tr class="filters">
                        <th>
                            
                        <?php        
                            if ($_GET['showAll'] == true) {

                            ?>
                            <a href="show-all-excel.php?did=<?= $_GET['did']; ?>&xid=<?= $_GET['xid']; ?>" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-eye-open"></span> Show All</a>
                        <?php } ?>

                        </th>
                        <th><input type="text" class="form-control" placeholder="excel files" disabled></th>
                        <th>Download</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
						$table = "excel";
						$data = array(
							'delegue_id' => $_GET["did"],
							'xml_id'	=>	$_GET["xid"]
						);
                      	$excels = Utils::get_by($table, $data);
                       
                      	foreach ($excels as $excel) :
                    ?>
                    <tr>
						<td><img src="uploads/excel_image.png" width="25" height="25" alt=""></td>
                        <td>
                        	<a href="show-excel.php?did=<?= $_GET["did"]; ?>&excel=<?= $excel->link; ?>">
                        		<?= $excel->link ?>
                        	</a>
                        </td>
                        <td>
                        	<a href="excel/<?= $excel->link ?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-save"></span></a>
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

