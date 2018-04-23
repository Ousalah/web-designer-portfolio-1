<?php
/**
* 
*/
// include_once '../modules/utils.class.php';
include dirname(__FILE__).'/../modules/utils.class.php';

class Form extends Utils
{

	/**
	*@param $data: array of form paramaeter.
	*(action, method, ...)
	*/ 
	public static function start($data){
		$form = '<form class="form-horizontal" ';
		foreach ($data as $name => $value) {
			$form .= $name.'='.'"'.$value.'" ';
		}
		$form .= ">";
		echo $form;
	}

	public static function create($label, $tag, $type="", $name, $id, $value="", $options=""){
		if($tag == "input"){
			Form::input($label, $type, $name, $id, $value="", $options);
		}
		elseif ($tag == "textarea") {
			Form::textarea($label, $name, $id, $value="");
		}
		elseif ($tag == "select") {
			Form::select($label, $type, $name, $id, $value="", $options);
		}
	}

		private static function input($label, $type, $name, $id, $value="", $options="")
		{
			if($type == "text"){
				Form::text($label, $type, $name, $id);
			}elseif ($type == "checkbox") {
				Form::checkbox($label, $type, $name, $id, $value="", $options);
			}elseif ($type == "radio") {
				Form::radio($label, $type, $name, $id, $value="", $options);
			}
		}

			private static function text($label, $type, $name, $id, $value="")
			{
				echo '<!-- '.$label.'-->
					<div class="form-group">
						<label class="col-md-4 control-label" for="'.$id.'">'.$label.'</label>
						<div class="col-md-4">
							<input id="'.$id.'" name="'.$name.'" type="'.$type.'" placeholder="'.$label.'" class="form-control input-md" value="'.$value.'"> 
						</div>
					</div>';
			}

			private static function checkbox($label, $type, $name, $id, $value="", $options)
			{
				echo '<!-- '.$label.' -->
					<div class="form-group">
		  				<label class="col-md-4 control-label" for="'.$name.'">'.$label.'</label>
		  				<div class="col-md-4">';
		  				// var_dump($options);
						if(!empty($options))
		  				foreach ($options->option as $option) {
							echo '<div class="'.$type.'">
		    					<label for="'.$option->id.'">
		      						<input type="'.$type.'" name="'.$name.'[]" id="'.$option->id.'" value="'.$option->value.'">
		      							'.$option->name.'
		    					</label>
							</div>'; 				
		  				}	

		  			echo '</div>
					</div>';

			}

			private static function radio($label, $type, $name, $id, $value="", $options)
			{
				echo '<!-- '.$label.' -->
					<div class="form-group">
		  				<label class="col-md-4 control-label" for="'.$name.'">'.$label.'</label>
		  				<div class="col-md-4">';
		  				// var_dump($options);
						if(!empty($options))
		  				foreach ($options->option as $option) {
							echo '<div class="'.$type.'">
		    					<label for="'.$option->id.'">
		      						<input type="'.$type.'" name="'.$name.'" id="'.$option->id.'" value="'.$option->value.'">
		      							'.$option->name.'
		    					</label>
							</div>'; 				
		  				}	

		  			echo '</div>
					</div>';

			}

		private static function textarea($label, $name, $id, $value="")
		{
			echo '<!-- '.$label.' -->
				<div class="form-group">
					<label class="col-md-4 control-label" for="'.$name.'">'.$label.'</label>
					<div class="col-md-4">                     
					    <textarea class="form-control" id="'.$id.'" name="'.$name.'">'.$value.'</textarea>
					</div>
			</div>';
		}

		private static function select($label, $type, $name, $id, $value="", $options)
		{
			
			echo '<!-- '.$label.' -->
				<div class="form-group">
	  				<label class="col-md-4 control-label" for="'.$name.'">'.$label.'</label>
	  				<div class="col-md-4">
	    				<select id="'.$id.'" name="'.$name.'" class="form-control">';
	    					var_dump($options);
						    if(!empty($options))
						  	foreach ($options->option as $option) {
						      echo '<option value="'.$option->value.'">'.$option->name.'</option>';
						    }
	      
	    				echo '</select>
	  				</div>
				</div>';
		}

	public static function end($value){
		echo '<div class="form-group">
					<label class="col-md-4 control-label"></label>
					<div class="col-md-4">
						<button id="btnSubmit" type="submit" class="btn btn-success form-control">
						'.$value.'
						</button> 
					</div>
			</div>
		</form>';
	}

} ?>