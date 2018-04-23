</div>
         <!-- /. PAGE WRAPPER  -->
        </div>
    <div class="footer">
      
    
             <div class="row">
                <div class="col-lg-12" >
                    &copy;  2017 Ousalah.com | Design by: <a href="http://ousalah.com" style="color:#fff;"  target="_blank">www.ousalah.com</a>
                </div>
        </div>
        </div>
          
      <!-- CUSTOM SCRIPTS -->
    <script src="js/custom.js"></script>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

    <!-- tableFilter -->
    <script src="js/tableFilter.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {           
            
            // add active class to the current page opened
            var pgurl = window.location.href.substr(window.location.href.lastIndexOf("/") + 1);
            $(".navbar-side ul.nav li a").each(function() {
                if ($(this).attr("href") == pgurl || $(this).attr("href") == '')
                    $(this).addClass("active-link");
            });

        });
    </script>    
    
   
</body>
</html>
