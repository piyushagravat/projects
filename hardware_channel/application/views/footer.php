<footer class="main-footer">
        
        <strong>Hardware | Dashboard
      </footer>

    </div><!-- ./wrapper -->

	
	
  
    
	
	
	
	
	
    <!-- jQuery 2.1.3 -->
 
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url(); ?>bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='<?php echo base_url(); ?>plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url(); ?>dist/js/app.min.js" type="text/javascript"></script>

    <!-- daterangepicker
    <script src="plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script> -->
    <!-- datepicker -->
    <script src="<?php echo base_url(); ?>plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
	<script src="//cdn.ckeditor.com/4.4.7/full/ckeditor.js"></script>

    <!-- iCheck -->
    <script src="<?php echo base_url(); ?>plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="<?php echo base_url(); ?>plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    
   
   
    <script type="text/javascript">
      $(function () {
	    	
       		$('#seldate').datepicker({
				format: 'yyyy-mm-dd'
			});
			$('#joindate').datepicker({
				format: 'yyyy-mm-dd'
			});
			$('#confdate').datepicker({
				format: 'yyyy-mm-dd'
			});
			$('#txtstartdate').datepicker({
				format: 'yyyy-mm-dd'
			});
			$('#txtenddate').datepicker({
				format: 'yyyy-mm-dd'
			});
			$('#txtdailydate').datepicker({
				format: 'yyyy-mm-dd',
				startDate: '-7d',
			});


      });
    </script>
    
    <script type="text/javascript">
		
		$("#txtnote").focus(function(){
		
			var start = $("#txtstartdate").val();		
			var end = $("#txtenddate").val();
			var date1 = new Date(start); 
			var date2 = new Date(end);
			var timeDiff = Math.abs(date2.getTime() - date1.getTime());
			var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)+1); 
			
			$("#txttotaldays").val(diffDays);
		});
	</script>
    
    <script type="text/javascript">
      $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('txtdetails');

      });
    </script>
    
    <script type="text/javascript">

	function getStandard(board_id)
	{
		  if (window.XMLHttpRequest)
		  {
		  	xmlhttp=new XMLHttpRequest();
		  }
		  else
		  {
		  	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		  }
		  
		  xmlhttp.onreadystatechange=function()
		  {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
			document.getElementById("txtsubcategories").innerHTML = xmlhttp.responseText;
			}
		  }
		 xmlhttp.open("GET","getboard.php?board_id="+board_id,true);
		 xmlhttp.send();
	}
	
</script>
   <script type="text/javascript">

	function getStandard(board_id)
	{
		  if (window.XMLHttpRequest)
		  {
		  	xmlhttp=new XMLHttpRequest();
		  }
		  else
		  {
		  	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		  }
		  
		  xmlhttp.onreadystatechange=function()
		  {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
			document.getElementById("selbrand").innerHTML = xmlhttp.responseText;
			}
		  }
		 xmlhttp.open("GET","getboard.php?board_id="+board_id,true);
		 xmlhttp.send();
	}
	
</script> 
<script type="text/javascript">			
	function validation() {
			var mname = document.forms["manuf"]["searchmanufacturer"].value;
			if (mname.value == "")
		{
			window.alert("Please enter Manufacturer name.");
			name.focus();
			return false;
		}
		return true;
	}
</script> 

    
  </body>
</html>