<?php $pageTitle = "DELEGUE LIST"; ?>

<?php require 'model/DelegueModel.php'; ?>
<?php require 'fragment/header-admin.php'; ?>

<div id="page-inner">
  <div class="row">
    <div class="col-md-12">
      <h2  align="center"><?= $pageTitle; ?> </h2>   
    </div>
  </div>              
  <!-- /. ROW  -->
  <hr>

    <!-- start table -->
        <div class="panel panel-primary filterable">
            <div class="panel-heading">
                <h3 class="panel-title"> * </h3>
                <div class="pull-right">
                    <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                </div>
            </div>
            <table class="table">
                <thead>
                    <tr class="filters">
                        <th>image</th>
                        <th><input type="text" class="form-control" placeholder="firstname" disabled></th>
                        <th><input type="text" class="form-control" placeholder="lastname" disabled></th>
                        <th><input type="text" class="form-control" placeholder="email" disabled></th>
                        <th>survey</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                      $delegues = Utils::get_all("delegue");
                       
                      foreach ($delegues as $delegue) :
                    ?>
                    <tr>
						<td><img src="uploads/<?= (!empty($delegue->image)) ? $delegue->image : 'default_image.png'; ?>" width="50" height="50" alt=""></td>
                        <td><?= $delegue->firstname ?></td>
                        <td><?= $delegue->lastname ?></td>
                        <td><?= $delegue->email ?></td>
                        <td><a href="delegue-servey.php?d=<?= $delegue->id; ?>">[ <?php 

	                        	$table = "xml";
	                        	$condition = array(
									"delegue_id" => $delegue->id
								);
	                        	echo Utils::get_count($table, $condition);
	                        	?> ]
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

