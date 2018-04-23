<?php if(empty($_SESSION)) session_start(); ?>

<?php $pageTitle = "SURVEY AREA"; ?>

<?php
include_once 'model/FormModel.php';
// include 'modules/utils.class.php';
$config = simplexml_load_file("xml/".$_GET["xml"]);

?>
<?php require 'fragment/header-delegue.php'; ?>

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

  <?php

	$data = array(
				"action" => "controller/Form.php?a=add&t=survey&xml=".$_GET["xml"]."&sid=".$_GET["sid"],
				"method" => "post"
				);
	Form::start($data);

  $db_info = array();
// echo "<pre>"; var_dump($config); echo "<pre>";
	foreach ($config as $champ) {
		$label = $champ->label;
		$tag = $champ->tag;
		$type = $champ->type;
		$name = $champ->name;
		$id = $champ->id;
		$value = $champ->value;
    $dbType = $champ->dbType;
		$options = $champ->options;

		// transfer data to generate a form
    Form::create($label, $tag, $type, $name, $id, $value, $options);
	 
    // add data type for each field
    $db_info["$name"] = "$dbType";
  }
  
  if (isset($_GET["c"]) && $_GET["c"] == 1) {
    
    // create table in database
    Utils::createTable($db_info);
  
  }
  
  // end form in add value of the validation button
	Form::end("Valider");

    ?>
    <!-- start table -->
    <br> <hr> <br>

    <div style="text-align: center;">
        <a href="controller/Excel.php?a=save&xml=<?= $_GET['xml']; ?>&sid=<?= $_GET['sid']; ?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-save"></span> Save as CSV</a>
    </div>
    
    <div class="panel panel-primary filterable">
      <div class="panel-heading">
          <h3 class="panel-title"><?= $_SESSION["firstname_delegue"]." ".$_SESSION["lastname_delegue"]?></h3>

          <div class="pull-right">
              <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
          </div>
      </div>
      <table class="table">
          <thead>
              <tr class="filters">
                  <?php
                  $columns = Utils::showColumns();
                 
                  foreach ($columns as $column) :
                  $fields[] = $column->Field;  
                  ?>

                  <th><input type="text" class="form-control" placeholder="<?= $column->Field; ?>" disabled></th>

                <?php endforeach ?>
              </tr>
          </thead>
          <tbody>
              <?php
                $surveys = Utils::getAll_noOrderBy("survey");
                 
                foreach ($surveys as $survey) :
              ?>
              <tr>
                  <?php
                  foreach ($fields as $field) :
                  ?> 
                  <td><?= $survey->$field ?></td>

                  <?php endforeach ?>
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
    