 <?php
include_once("init.php");
include("db.php");

session_start();
 include("header.php"); ?>
        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
           <?php include("sidemenu.php"); ?>
        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Stock Details</h1>
                        

                    </div>
                </div>
                <!-- /. ROW  -->
                <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
               <div class="panel panel-info">
                        <div class="panel-heading">
                         Stock Details
                        </div>
                        <div class="panel-body"><div class="col-md-12">
                     <!--    Hover Rows  -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Product Details
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Product ID</th>
                                            <th>Description</th>
                                            <th>Category</th>
                                            <th>Purchase Rate</th>
											 <th>Sale Rate</th>
                                            <th>MRP Rate</th>
                                            <th>SGST</th>
                                            <th>CGST</th>
											 <th>HSN COde</th>
                                            <th>Opening Stock</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php  $result1 = $db->query("SELECT * FROM products");
	   		 
		while ($lin = $db->fetchNextObject($result1)) {
			     echo "<tr><td>".$lin->productid."</td>
                                            <td>".$lin->description."</td>
                                            <td>".$lin->category."</td>
                                            <td>".$lin->BasicCost."</td>                                       
                                            <td>".$lin->retailprice."</td>
                                            <td>".$lin->MRP."</td>
                                            <td>".$lin->s_gst."</td>
                                            <td>".$lin->c_gst."</td>
											<td>".$lin->Hsn_code."</td>
                                            <td>".$lin->stock."</td>
                                        </tr>";
		 }?>  
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- End  Hover Rows  -->
                </div>
                  </div>
                        </div>
                            </div>
 </div>

            
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
  <?php include("footer.php"); ?>