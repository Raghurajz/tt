 <?php
include_once("init.php");
include("db.php");
		include("header.php");


if (isset($_POST['submit'])) {
	
		$_POST = $gump->sanitize($_POST);
	//for ($i = 0; $i < count($_POST['ques']); $i++) {
		
    $productid = mysql_real_escape_string($_POST['productid']);
    $description = mysql_real_escape_string($_POST['description']);
	$category = $_POST['category'];
	$salerate = mysql_real_escape_string($_POST['salerate']);
 $Mfgdate = mysql_real_escape_string($_POST['Mfgdate']);
 $expirydate = mysql_real_escape_string($_POST['expirydate']);
 $tax = mysql_real_escape_string($_POST['tax']);
  $purchaserate = mysql_real_escape_string($_POST['purchaserate']);
   
  $mrprate = mysql_real_escape_string($_POST['mrprate']);
   $cgst = mysql_real_escape_string($_POST['cgst']);
  $sgst = mysql_real_escape_string($_POST['sgst']);
  $stock = mysql_real_escape_string($_POST['stock']);
  $hsncode = mysql_real_escape_string($_POST['hsncode']);
   $reorder = mysql_real_escape_string($_POST['reorder']);
  

$db->query("INSERT INTO products  VALUES ('$productid','$description',1,$salerate,$mrprate,$reorder,0,$sgst,$cgst,$purchaserate,0,0,$stock,'$expirydate','$Mfgdate',NULL,NULL,'$hsncode')");

//}
 echo "Item added Successfully";
}


?>
        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
           <?php include("sidemenu.php"); ?>
        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line"> Add Stock</h1>
                        

                    </div>
                </div>
                <!-- /. ROW  -->
                <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
               <div class="panel panel-info">
                        <div class="panel-heading">
                           Add Stock
                        </div>
                        <div class="panel-body">
                            <form role="form" method='post'>
							   <div class="col-md-6 col-sm-6 col-xs-6">
							              <div class="form-group">
                                            <label>Product Id</label>
                                            <input class="form-control" name="productid" type="text">
                                            
                                        </div>
										     <div class="form-group">
                                            <label>Product Description</label>
                                            <input class="form-control" name="description" type="text">
                                            
                
										</div></div>
										<div class="col-md-6 col-sm-6 col-xs-6">
										  <div class="form-group">
                                            <label>Category</label>
                                            <select class="form-control" name="category[]">
                                              <?php $cat= $db->query("SELECT * FROM category");
			while ($lin = $db->fetchNextObject($cat)) {
				$name= $lin->CategoryName;
				$id= $lin->CategoryId;
  echo "<option value='".$id."'>".$name."</option>";
} ?></select>
                                            </select>
											  
                                        </div>
										     <div class="form-group">
                                            <label>Expiry Date</label>
                                            <input class="form-control" name="expirydate" type="date">
                                            
                                        </div></div>
										  <div class="col-md-6 col-sm-6 col-xs-6">
										<div class="form-group">
                                            <label>Mfg Date</label>
                                            <input class="form-control" name="Mfgdate" type="date">
                                            
                                        </div>
										 <div class="form-group">
                                            <label>Tax</label>
                                            <select class="form-control" name="tax">
                                                <option>One Vale</option>
                                                <option>Two Vale</option>
                                               
                                            </select>
											  
                                        </div></div>
										  <div class="col-md-6 col-sm-6 col-xs-6">
                                 <div class="form-group">
                                            <label>Purchase Rate</label>
                                            <input class="form-control" name="purchaserate" type="text">
                                     
                                        </div>
										  <div class="form-group">
                                            <label>Sale Rate</label>
                                            <input class="form-control" name="salerate" type="text">
                                     
                                        </div>
										</div>
										  <div class="col-md-6 col-sm-6 col-xs-6">
										  <div class="form-group">
                                            <label>MRP Date</label>
                                            <input class="form-control" name="mrprate" type="text">
                                     
                                        </div>
										  <div class="form-group">
                                            <label>CGST</label>
                                            <input class="form-control" name="cgst" type="text">
                                     
                                        </div>
										</div>
										  <div class="col-md-6 col-sm-6 col-xs-6">
										  <div class="form-group">
                                            <label>SGST</label>
                                            <input class="form-control" name="sgst" type="text">
                                     
                                        </div>
										  <div class="form-group">
                                            <label>Opening Stock</label>
                                            <input class="form-control" name="stock" type="text">
                                     
                                        </div>
										</div>
										  <div class="col-md-6 col-sm-6 col-xs-6">
										  <div class="form-group">
                                            <label>HSN Code</label>
                                            <input class="form-control" name="hsncode" type="text">
                                     
                                        </div>
                                            <div class="form-group">
                                            <label>ReOrder</label>
                                            <input class="form-control" name="reorder" type="text">
                                        </div>
                                  </div>
										  
                                 <div class="col-md-6 col-sm-6 col-xs-6">
								 <input type='submit' name='submit' class="btn btn-info" value='Save' class='but'/>
                                       
										 </div>
</div>
                                    </form>
                            </div>
                        </div>
                            </div>
 </div>

            
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
    <div id="footer-sec">
        &copy; 2014 Drizzle Infotech | Design By : <a href="#" target="_blank">.com</a>
    </div>
    <!-- /. FOOTER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>


</body>
</html>
