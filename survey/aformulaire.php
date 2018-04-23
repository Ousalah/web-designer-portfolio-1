
                <h2>Your Form</h2>
                <hr>
                    
                <form class="form-horizontal" action="controller/XML.php?a=add&amp;t=xml" method="POST">
                                            
                        <!--start Select SurveyName & delegueName -->
                        <div class="row">
                            <div class="col-md-6">
                                <input name="link" id="link" placeholder="Survey Name" type="text" class="form-control input-md">
                            </div>

                            <div class="col-md-6">
                                <select name="delegue_id" id="delegue_id" class="form-control" style="border-color: rgb(128, 128, 128); border-width: 1px;">
                                    <option value="0" selected="selected">select delegue</option>
                                                                      <option value="7">fgfh gfhgh</option>
                                                                      <option value="6">TY FGFG</option>
                                                                      <option value="5">Soufiane Ail</option>
                                                                      <option value="4">Ayoub Abmlk</option>
                                                                      <option value="3">Hamza Saber</option>
                                                                      <option value="2">Karim Jamali</option>
                                                                      <option value="1">Mohamed Ousalah</option>
                                                                  </select>
                            </div>
                        </div>
                        <hr>
                        <!--end Select SurveyName & delegueName -->                        
                    <fieldset id="form-zone" style="min-height: 200px;" class="ui-sortable">

                    <div class="form-group ui-draggable ui-draggable-handle" data-tag="input">
                            <label class="col-md-4 control-label" for="City">Your City ?</label>
                            <div class="col-md-6" data-type="radio" data-dbtype="varchar(20)" name="City" id="City">
                                
                                
                            <div class="radio"><label for="City-0"><input type="radio" name="City" id="City-0" value="Casa">Casa</label></div><div class="radio"><label for="City-1"><input type="radio" name="City" id="City-1" value="Rabat">Rabat</label></div><div class="radio"><label for="City-2"><input type="radio" name="City" id="City-2" value="Agadir">Agadir</label></div><div class="radio"><label for="City-3"><input type="radio" name="City" id="City-3" value="Tanger">Tanger</label></div></div>
                        </div><div class="form-group ui-draggable ui-draggable-handle" data-tag="input">
                            <label class="col-md-4 control-label" for="checkboxes_1">Multi-Checkboxes</label>
                            <div class="col-md-6" data-type="checkbox" data-dbtype="varchar(255)" name="checkboxes_1" id="checkboxes_1">
                                <div class="checkbox">
                                    <label for="checkboxes_1_0">
                                        <input type="checkbox" name="checkboxes_1" id="checkboxes_1_0" value="1" disabled="" style="cursor: pointer; background-color: rgb(255, 255, 255);">
                                        Option one
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label for="checkboxes_1_1">
                                        <input type="checkbox" name="checkboxes_1" id="checkboxes_1_1" value="2" disabled="" style="cursor: pointer; background-color: rgb(255, 255, 255);">
                                        Option two
                                    </label>
                                </div>
                            </div>
                        </div><div class="form-group ui-draggable ui-draggable-handle" data-tag="input">
                            <label class="col-md-4 control-label" for="Hobbies">Your hobbies ?</label>
                            <div class="col-md-6" data-type="checkbox" data-dbtype="varchar(255)" name="Hobbies" id="Hobbies">
                                
                                
                            <div class="checkbox"><label for="Hobbies-0"><input type="checkbox" name="Hobbies" id="Hobbies-0" value="sport">sport</label></div><div class="checkbox"><label for="Hobbies-1"><input type="checkbox" name="Hobbies" id="Hobbies-1" value="whatch TV">whatch TV</label></div><div class="checkbox"><label for="Hobbies-2"><input type="checkbox" name="Hobbies" id="Hobbies-2" value="Video Game">Video Game</label></div></div>
                        </div><div class="form-group ui-draggable ui-draggable-handle" data-tag="input">
                            <label class="col-md-4 control-label" for="radios_3">Multiple Radios</label>
                            <div class="col-md-6" data-type="radio" data-dbtype="varchar(20)" name="radios_3" id="radios_3">
                                <div class="radio">
                                    <label for="radios_3_0">
                                        <input type="radio" name="radios_3" id="radios_3_0" value="1" checked="checked" disabled="" style="cursor: pointer; background-color: rgb(255, 255, 255);">
                                        Option one
                                    </label>
                                </div>
                                <div class="radio">
                                    <label for="radios_3_1">
                                        <input type="radio" name="radios_3" id="radios_3_1" value="2" disabled="" style="cursor: pointer; background-color: rgb(255, 255, 255);">
                                        Option two
                                    </label>
                                </div>
                            </div>
                        </div></fieldset>

                    <!-- Button (Double) -->
                    <div class="form-group">
                        <span class="col-md-1"></span>
                         <span class="col-md-5 btn btn-success" id="copyHTML">Create XML file</span>
                        <!-- <button id="createXML" class="col-md-5 btn btn-success">Create XML file</button> -->
                        <span class="col-md-1"></span>
                        <span id="button2id" class="col-md-3 btn btn-danger" onclick="window.location.reload()">Cancel
                    </span></div>
                </form>
            