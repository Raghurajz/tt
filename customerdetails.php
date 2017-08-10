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
                        <h1 class="page-head-line">Customer Details</h1>
                        

                    </div>
                </div>
                <!-- /. ROW  -->
                <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
               <div class="panel panel-info">
                        <div class="panel-heading">
                         Customer Details
                        </div>
                        <div class="panel-body"> <div class="table-responsive">      <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>CustomerName</th>
                                            <th>CustomerMobile</th>
                                            <th>Email</th>
											 <th>Address</th>
                                            <th>Pincode</th>
                                            <th>Region</th>
                                            <th>GST</th>
											 
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php  $result1 = $db->query("SELECT * FROM customer");
	
		while ($lin = $db->fetchNextObject($result1)) {
			     echo "<tr><td>".$lin->CustomerId."</td>
                                            <td>".$lin->CustomerName."</td>
                                            <td>".$lin->CustomerMobile."</td>
                                            <td>".$lin->Email."</td>                                       
                                            <td>".$lin->Address."</td>
                                            <td>".$lin->Pincode."</td>
                                            <td>".$lin->sales_area."</td>
                                            <td>".$lin->Tinno."</td>
											
                                        </tr>";
		 }?>  
                                    </tbody>
                                </table>
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