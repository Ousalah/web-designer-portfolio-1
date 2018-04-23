<?php $pageTitle = "CREATE XML FILE"; ?>

<?php require 'model/XMLModel.php'; ?>
<?php require 'fragment/header-admin.php'; ?>

<div id="page-inner">
  <div class="row">
    <div class="col-md-12">
      <h2 align="center"><?= $pageTitle; ?></h2>   
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


            <!-- start Drag &amp; Drop components -->
            <div class="col-md-6">
                <h2>Drag &amp; Drop components</h2>
                <hr> 
                <form class="form-horizontal" id="source" role="form">
                    <fieldset>
                        <!-- Text input-->
                        <div class="form-group" data-tag="input">
                            <label class="col-md-4 control-label" for="textinput">Text Input</label>  
                            <div class="col-md-6" data-type="text">
                                <input id="textinput" name="textinput" data-dbType="varchar(50)" type="text" class="form-control input-md">
                            </div>
                        </div>

                        <!-- Textarea -->
                        <div class="form-group" data-tag="textarea">
                            <label class="col-md-4 control-label" for="textarea">Text Area</label>
                            <div class="col-md-6" data-type="textarea">                     
                                <textarea data-dbType="text" class="form-control" id="textarea" name="textarea" style="resize:none"></textarea>
                            </div>
                        </div>

                        <!-- Multiple Radios -->
                        <div class="form-group" data-tag="input">
                            <label class="col-md-4 control-label" for="radios">Multiple Radios</label>
                            <div class="col-md-6" data-type="radio" data-dbType="varchar(20)" name="radioname" id="radioid">
                                <div class="radio">
                                    <label for="radios-0">
                                        <input type="radio" name="radios" id="radios-0" value="1" checked="checked">
                                        Option one
                                    </label>
                                </div>
                                <div class="radio">
                                    <label for="radios-1">
                                        <input type="radio" name="radios" id="radios-1" value="2">
                                        Option two
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Multiple Checkboxes -->
                        <div class="form-group" data-tag="input">
                            <label class="col-md-4 control-label" for="checkboxes">Multi-Checkboxes</label>
                            <div class="col-md-6" data-type="checkbox" data-dbType="varchar(255)" name="checkboxname" id="checkboxid">
                                <div class="checkbox">
                                    <label for="checkboxes-0">
                                        <input type="checkbox" name="checkboxes" id="checkboxes-0" value="1">
                                        Option one
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label for="checkboxes-1">
                                        <input type="checkbox" name="checkboxes" id="checkboxes-1" value="2">
                                        Option two
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Select Basic -->
                        <div class="form-group" data-tag="select">
                            <label class="col-md-4 control-label" for="selectbasic">Select Basic</label>
                            <div class="col-md-6" data-type="select">
                                <select data-dbType="varchar(20)" id="selectbasic" name="selectbasic" class="form-control">
                                    <option value="1">Option one</option>
                                    <option value="2">Option two</option>
                                </select>
                            </div>
                        </div>

                    </fieldset>
                </form>
            </div>
            <!-- end Drag &amp; Drop components -->
            
            <!-- start Droppable zone -->
            <div class="col-md-6" id="drop_zone" style="border: 2px solid gray; border-radius: 5px;">
                <h2>Your Form</h2>
                <hr>
                    
                <form class="form-horizontal" action="controller/XML.php?a=add&t=xml" method="POST">
                                            
                        <!--start Select SurveyName & delegueName -->
                        <div class="row">
                            <div class="col-md-6">
                                <input name="link" id="link" placeholder="Survey Name" type="text" class="form-control input-md">
                            </div>

                            <div class="col-md-6">
                                <select name="delegue_id" id="delegue_id" class="form-control">
                                    <option value="0" selected="selected">select delegue</option>
                                  <?php 
                                  $delegues = Utils::get_all("delegue");
                       
                                  foreach ($delegues as $delegue) :

                                  ?>
                                    <option value="<?= $delegue->id; ?>"><?= $delegue->firstname." ".$delegue->lastname; ?></option>
                                  <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <!--end Select SurveyName & delegueName -->                        
                    <fieldset id="form-zone" style="min-height: 200px;">

                    </fieldset>

                    <!-- Button (Double) -->
                    <div class="form-group">
                        <span class="col-md-1"></span>
                         <span class="col-md-5 btn btn-success" id="copyHTML">Create XML file</span>
                        <!-- <button id="createXML" class="col-md-5 btn btn-success">Create XML file</button> -->
                        <span class="col-md-1"></span>
                        <span id="button2id" class="col-md-3 btn btn-danger" onclick="window.location.reload()">Cancel</a>
                    </div>
                </form>
            </div>
            <!-- end Droppable zone -->
              
  <!-- /. ROW  -->           
</div>
<!-- /. PAGE INNER  -->


<script type="text/javascript">
    
    $(document).ready(function () {
        
        // start draggable
        $("#source .form-group").draggable({
            helper: 'clone',
            revert: 'invalid',
            cursor: "crosshair",
            zIndex: 100,
            start: function( event, ui ) {
                $(ui.helper).addClass("my-state-dragabble");
            }
        });
        // end draggable
        

        // start droppable
        var i = 0;
        $('#drop_zone').droppable({
            activate: function( event, ui ) {
                $( this ).addClass( "my-state-droppable" );                
            },
            deactivate: function( event, ui ) {
                $( this ).removeClass( "my-state-droppable" );
            },
            drop: function (event, ui) {
                // $('#form-zone').append(ui.draggable);
                $( this ).removeClass( "my-state-droppable" );

                var dropped = $(ui.draggable).clone().appendTo('#form-zone');
                var oldID = dropped.find("label").attr('for');
                dropped.find("label").attr('for', oldID+'_'+i);

                // for input
                dropped.find("input").attr('id', oldID+'_'+i);
                dropped.find("input").attr('name', oldID+'_'+i);

                // for textarea
                dropped.find("textarea").attr('id', oldID+'_'+i);
                dropped.find("textarea").attr('name', oldID+'_'+i);

                // for radio
                dropped.find("div[data-type='radio']").children().children()
                    .each(function(index) { 
                        $(this).children().attr('id', oldID+'_'+i+'_'+index);
                        $(this).attr('for', oldID+'_'+i+'_'+index); 
                    });
                dropped.find("div[data-type='radio']").attr('id', oldID+'_'+i);
                dropped.find("div[data-type='radio']").attr('name', oldID+'_'+i);

                // for checkbox
                dropped.find("div[data-type='checkbox']").children().children()
                    .each(function(index) { 
                        $(this).children().attr('id', oldID+'_'+i+'_'+index);
                        $(this).attr('for', oldID+'_'+i+'_'+index); 
                    });
                dropped.find("div[data-type='checkbox']").attr('id', oldID+'_'+i);
                dropped.find("div[data-type='checkbox']").attr('name', oldID+'_'+i);

                // for select
                dropped.find("select").attr('id', oldID+'_'+i);
                dropped.find("select").attr('name', oldID+'_'+i);

                i++;
                
            },
            over: function (event, ui) {
                $( this ).addClass( "my-state-droppable" );
            },
            out: function (event, ui) {
                $( this ).removeClass( "my-state-droppable" );
            }
        
        });
        // end droppable

        

        // start sortable
        $( "#form-zone" ).sortable({
            forcePlaceholderSize: false,
            cursor: "crosshair",
            start: function( event, ui ) {
                $(ui.helper).addClass("my-state-sortable");
            },
            helper: function(event, ui) {
                copyHelper = ui.clone().insertAfter(ui);
                copyHelper && copyHelper.remove();
                return ui.clone();
            },
            receive: function() { sortableIn = 1; },
            over: function () { sortableIn = 1; },
            out: function () { sortableIn = 0; },
            stop: function (event, ui) {
                // remove all hidden Fields
                $('#form-zone > .form-group[style*="display: none"]').remove();
            },
            beforeStop: function (event, ui) {
                if(sortableIn === 0) {
                    ui.item.remove();
                }
            }

        }).disableSelection();
        // end sortable


        // --- start edit attibute of the Fileds ---//
        // I)
        var parentThis = "";
        // [text, textarea, radio, checkbox, select]
        var fieldType = "";
        $("#form-zone").on("click", ".form-group", function(){

            parentThis = $(this);
            fieldType = parentThis.children("div").attr("data-type");

            // get Old ID and Name
            var oldID_Name = $(this).find("label").attr("for");
            // show value of the old ID/Name in input field["#id_name"] 
            $("#myModal form #oldID_Name").val(oldID_Name);

            // get Old label value
            var oldLabel = $(this).find("label").html();
            // show value of the old ID/Name in input field["#id_name"] 
            $("#myModal form #oldLabel").val(oldLabel);


            if (($.trim(fieldType) === "text") || ($.trim(fieldType) === "textarea")) {

                // console.log("Hidde Options == true");
                $("#myModal form #oldOptions").parent("div").attr("hidden", true);
                $("#myModal form #oldValues").parent("div").attr("hidden", true);

            }else if
            (
                ($.trim(fieldType) === "radio") || 
                ($.trim(fieldType) === "checkbox") || 
                ($.trim(fieldType) === "select")
            ) {

                // console.log("Show Options  == false");
                $("#myModal form #oldOptions").parent("div").attr("hidden", false);
                $("#myModal form #oldValues").parent("div").attr("hidden", false);

                var allOldOptionts = "";
                var allOldValues = "";

                // # To get Options and Values from ["radio", "checkbox", "select"]
                switch ($.trim(fieldType)) {
                    case "radio":
                        // pour radio
                        parentThis.find('div[data-type="radio"] > .radio').each(function() {
                            allOldOptionts += $.trim($(this).children("label").text())+"\n";
                            allOldValues += $.trim($(this).children('label').children('input').val())+"\n";
                        });
                        break;

                    case "checkbox":
                        // pour checkbox
                        parentThis.find('div[data-type="checkbox"] > .checkbox').each(function() {
                            allOldOptionts += $.trim($(this).children("label").text())+"\n";
                            allOldValues += $.trim($(this).children('label').children('input').val())+"\n";
                        });
                        break;

                    case "select":
                        // pour Select
                        parentThis.find('select > option').each(function() {
                            allOldOptionts += $.trim($(this).text())+"\n";
                            allOldValues += $.trim($(this).val())+"\n";
                        });
                        break;
                }

                // # show Options and Values of ["radio", "checkbox", "select"] in Textarea 
                $("#myModal form #oldOptions").val(allOldOptionts);
                $("#myModal form #oldValues").val(allOldValues);

            }


            // Reset Default size of Textarea 
            $("#myModal form #oldOptions").css("height", "150px");
            $("#myModal form #oldValues").css("height", "150px");
            $('#myModal').modal();

        });

        // II)
        $("#saveChangeAttr").on("click", function(){
            
            // 1) get value you want to change
            var newID_Name  = $("#myModal form #oldID_Name").val();
            var newLabel  = $("#myModal form #oldLabel").val();
            
            // 2) set new value
            //# attr "for" is same in all items fields
            parentThis.children("label").attr("for", newID_Name);

            //# label value is same in all items fields
            parentThis.children("label").html(newLabel);

            if ($.trim(fieldType) === "text") {

                //# change id and name for input
                parentThis.find("input").attr("id", newID_Name);
                parentThis.find("input").attr("name", newID_Name);

            }else if($.trim(fieldType) === "textarea"){

                //# change id and name for textarea
                parentThis.find("textarea").attr("id", newID_Name);
                parentThis.find("textarea").attr("name", newID_Name);

            }else if($.trim(fieldType) === "radio"){

                //# change id and name for radio
                parentThis.children("div[data-type='radio']").attr("id", newID_Name);
                parentThis.children("div[data-type='radio']").attr("name", newID_Name);


                // start Change Old Options and Values
                //# get nbr of new options
                var countNewOptions = $("#myModal form #oldOptions").val().split("\n").length - 1;
                //# put New Options and Values in an Array
                var newOptions = $("#myModal form #oldOptions").val().split("\n");
                var newValues = $("#myModal form #oldValues").val().split("\n");

                // console.log("N° of Values = "+(countNewOptions));

                //# Remove old Options and Values
                parentThis.children("div[data-type='radio']").children('.radio').remove();

                //# Append New Options and Values
                for (i = 0; i < countNewOptions; i++)
                { 
                    parentThis.children("div[data-type='radio']")
                            .append( '<div class="radio"><label for="'+ newID_Name +'-'+i+'"><input type="radio" name="'+ newID_Name +'" id="'+ newID_Name +'-'+i+'" value="'+newValues[i]+'">'+newOptions[i]+'</label></div>' );
                }
                // end Change Old Options and Values

            }else if($.trim(fieldType) === "checkbox"){

                //# change id and name for checkbox
                parentThis.children("div[data-type='checkbox']").attr("id", newID_Name);
                parentThis.children("div[data-type='checkbox']").attr("name", newID_Name);


                // start Change Old Options and Values
                //# get nbr of new options
                var countNewOptions = $("#myModal form #oldOptions").val().split("\n").length - 1;
                //# put New Options and Values in an Array
                var newOptions = $("#myModal form #oldOptions").val().split("\n");
                var newValues = $("#myModal form #oldValues").val().split("\n");

                // console.log("N° of Values = "+(countNewOptions));

                //# Remove old Options and Values
                parentThis.children("div[data-type='checkbox']").children('.checkbox').remove();

                //# Append New Options and Values
                for (i = 0; i < countNewOptions; i++)
                { 
                    parentThis.children("div[data-type='checkbox']")
                            .append( '<div class="checkbox"><label for="'+ newID_Name +'-'+i+'"><input type="checkbox" name="'+ newID_Name +'" id="'+ newID_Name +'-'+i+'" value="'+newValues[i]+'">'+newOptions[i]+'</label></div>' );
                }
                // end Change Old Options and Values


            }else if($.trim(fieldType) === "select"){

                //# change id and name for select
                parentThis.find("select").attr("id", newID_Name);
                parentThis.find("select").attr("name", newID_Name);


                // start Change Old Options and Values
                //# get nbr of new options
                var countNewOptions = $("#myModal form #oldOptions").val().split("\n").length - 1;
                //# put New Options and Values in an Array
                var newOptions = $("#myModal form #oldOptions").val().split("\n");
                var newValues = $("#myModal form #oldValues").val().split("\n");

                // console.log("N° of Values = "+(countNewOptions));

                //# Remove old Options and Values
                parentThis.find("select").children('option').remove();

                //# Append New Options and Values
                for (i = 0; i < countNewOptions; i++)
                { 
                    parentThis.find("select").append( '<option value="'+newValues[i]+'">'+newOptions[i]+'</option>' );
                }
                // end Change Old Options and Values

            }


            // 3) clean all input field
            $("#myModal form #id_name").val("");
            $("#myModal form #oldLabel").val("");
        });
        // --- end edit attibute of the Fileds ---//



        // no spaces allowed in OldID_Name input
        $('#oldID_Name').keypress(function (key) {
            var regexpns = new RegExp("^[a-zA-Z0-9-_]+$");
            var key = String.fromCharCode(event.charCode ? event.which : event.charCode);
            if (!regexpns.test(key)) {
                event.preventDefault();
                return false;                       
            }
            
        });


        // no special carracter allowed in #link input
        $('#link').keypress(function (key) {
            var regexpns = new RegExp("^[a-zA-Z0-9-_ ]+$");
            var key = String.fromCharCode(event.charCode ? event.which : event.charCode);
            if (!regexpns.test(key)) {
                event.preventDefault();
                return false;                       
            }
            
        });


        // to reset default background-color and cursor after disabled of the fields
        $("#source input, #source textarea, #source select")
            .prop("disabled", true)
            .css({"cursor": "pointer", "background-color": "#fff"});


        
        // start CopyHTML function
        // function copyHTML(){
        $("#copyHTML").on("click", function(){    
            // var pageContent = document.getElementById("drop_zone").innerHTML; 
            // sessionStorage.setItem("page1content", pageContent);
            // console.log(pageContent);

            var pageContent = $("#drop_zone").html(); 

            var did = $("#delegue_id option:selected").val();
            var l = $.trim($("#link").val());
            var formZone = $("#form-zone").children();
            console.log(did);

            var isValide = true;
            if(l == ""){
                $("#link").animate({ "borderColor": "red", "borderWidth": "2px" }, 250)
                        .animate({ "borderColor": "gray", "borderWidth": "1px" }, 100)
                        .animate({ "borderColor": "red", "borderWidth": "2px" }, 250)
                        .animate({ "borderColor": "gray", "borderWidth": "1px" }, 100);
                isValide = false;
            }

            if(did == 0){
                $("#delegue_id").animate({ "borderColor": "red", "borderWidth": "2px" }, 250)
                        .animate({ "borderColor": "gray", "borderWidth": "1px" }, 100)
                        .animate({ "borderColor": "red", "borderWidth": "2px" }, 250)
                        .animate({ "borderColor": "gray", "borderWidth": "1px" }, 100);
                isValide = false;
            }

            if(formZone.length == 0){
                $("#drop_zone").animate({ "borderColor": "red", "top": 7, "right": -7, "bottom": -7, "left": 7 }, 250)
                            .animate({ "borderColor": "red", "top": 0, "right": 0, "bottom": 0, "left": 0 }, 100)
                            .animate({ "borderColor": "red", "top": 7, "right": -7, "bottom": -7, "left": 7 }, 250)
                            .animate({ "borderColor": "gray", "top": 0, "right": 0, "bottom": 0, "left": 0 }, 100);
                isValide = false;
            }


            if (isValide == true) {
               $.ajax({
                    url: "controller/XML.php",
                    method: 'POST',
                    data:{a:'add', t: 'xml', delegue_id: did, link: l, d: pageContent}

                })
                  .done(function( data ) {
                    if ( console && console.log ) {
                      console.log( "ok",data );
                      window.location.reload()
                    }
                });
           }
        });   
        // }
        // end CopyHTML function    

    });
    // end Document.ready
    
    




</script>


<!-- Start Modal -->
<div id="myModal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Attributes</h4>
      </div>
      <div class="modal-body">
        

        <form class="row" role="form">
            <!-- start Old ID and Name -->
            <div class="form-group col-md-12">
                <label for="oldID_Name" class="control-label">ID/Name</label>
                <input type="text" class="form-control" id="oldID_Name" name="oldID_Name">
            </div>
            <!-- end Old ID and Name -->

            <!-- start Old Label -->
            <div class="form-group col-md-12">
                <label for="oldLabel" class="control-label">Label</label>
                <input type="text" class="form-control" id="oldLabel" name="oldLabel">
            </div>
            <!-- end Old Label -->


            <!-- start Old ID and Name -->
            <div class="form-group col-md-6">
                    <label for="oldOptions" class="control-label">Options</label>                  
                    <textarea class="form-control" id="oldOptions" name="oldOptions" 
                    style="resize: vertical; min-height: 150px;"></textarea>
            </div>
            <!-- start Old ID and Name -->

            <!-- start Old ID and Name -->
            <div class="form-group col-md-6">
                    <label for="oldValues" class="control-label">Values</label>                  
                    <textarea class="form-control" id="oldValues" name="oldValues" 
                    style="resize: vertical; min-height: 150px;"></textarea>
            </div>
            <!-- start Old ID and Name -->
            
        </form>



      </div>
      <div class="modal-footer">
        <button type="button" id="saveChangeAttr" class="btn btn-info col-md-6" data-dismiss="modal">Save</button>
        <button id="cancel" class="btn btn-danger col-md-5" data-dismiss="modal">Cancel</button>
      </div>
    </div>

  </div>
</div>
<!-- end Modal -->


<?php require 'fragment/footer.php'; ?>