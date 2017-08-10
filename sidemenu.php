   <?php
include_once("init.php");
include("db.php");
		
		?>  <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li>
                        <div class="user-img-div">
                            <img src="assets/img/user.png" class="img-thumbnail" />

                            <div class="inner-text">
                               <?php echo $_SESSION['name'];?>
                            <br />
                                <small>Last Login : 2 Weeks Ago </small>
                            </div>
                        </div>

                    </li>


                    <li>
                        <a class="active-menu" href="index.php"><i class="fa fa-dashboard "></i>Dashboard</a>
                    </li>
					 <li>
                        <a class="active-menu" href="bill.php"><i class="fa fa-dashboard "></i>Billing</a>
                    </li>
					<li>
                        <a href="#"><i class="fa fa-bicycle "></i>Customer <span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level">
                           
                             <li>
                                <a href="addcustomer.php"><i class="fa fa-desktop "></i>Add Customer </a>
                            </li>
                             <li>
                                <a href="customerdetails.php"><i class="fa fa-code "></i>Customer Details</a>
                            </li>
                             
                           
                        </ul>
                    </li>
						<li>
                        <a href="#"><i class="fa fa-bicycle "></i>Stock <span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level">
                           
                             <li>
                                <a href="addstock.php"><i class="fa fa-desktop "></i>Add stock </a>
                            </li>
                             <li>
                                <a href="stockdetails.php"><i class="fa fa-code "></i>Stock Details</a>
                            </li>
                             
                           
                        </ul>
                    </li>
                  <!--  <li>
                        <a href="#"><i class="fa fa-desktop "></i>UI Elements <span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level">
                            <li>
                                <a href="panel-tabs.html"><i class="fa fa-toggle-on"></i>Tabs & Panels</a>
                            </li>
                            <li>
                                <a href="notification.html"><i class="fa fa-bell "></i>Notifications</a>
                            </li>
                             <li>
                                <a href="progress.html"><i class="fa fa-circle-o "></i>Progressbars</a>
                            </li>
                             <li>
                                <a href="buttons.html"><i class="fa fa-code "></i>Buttons</a>
                            </li>
                             <li>
                                <a href="icons.html"><i class="fa fa-bug "></i>Icons</a>
                            </li>
                             <li>
                                <a href="wizard.html"><i class="fa fa-bug "></i>Wizard</a>
                            </li>
                             <li>
                                <a href="typography.html"><i class="fa fa-edit "></i>Typography</a>
                            </li>
                             <li>
                                <a href="grid.html"><i class="fa fa-eyedropper "></i>Grid</a>
                            </li>
                            
                           
                        </ul>
                    </li>
                     <li>
                        <a href="#"><i class="fa fa-yelp "></i>Extra Pages <span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level">
                            <li>
                                <a href="invoice.html"><i class="fa fa-coffee"></i>Invoice</a>
                            </li>
                            <li>
                                <a href="pricing.html"><i class="fa fa-flash "></i>Pricing</a>
                            </li>
                             <li>
                                <a href="component.html"><i class="fa fa-key "></i>Components</a>
                            </li>
                             <li>
                                <a href="social.html"><i class="fa fa-send "></i>Social</a>
                            </li>
                            
                             <li>
                                <a href="message-task.html"><i class="fa fa-recycle "></i>Messages & Tasks</a>
                            </li>
                            
                           
                        </ul>
                    </li>
                    <li>
                        <a href="table.html"><i class="fa fa-flash "></i>Data Tables </a>
                        
                    </li>
                     <li>
                        <a href="#"><i class="fa fa-bicycle "></i>Forms <span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level">
                           
                             <li>
                                <a href="form.html"><i class="fa fa-desktop "></i>Basic </a>
                            </li>
                             <li>
                                <a href="form-advance.html"><i class="fa fa-code "></i>Advance</a>
                            </li>
                             
                           
                        </ul>
                    </li>
                      <li>
                        <a href="gallery.html"><i class="fa fa-anchor "></i>Gallery</a>
                    </li>
                     <li>
                        <a href="error.html"><i class="fa fa-bug "></i>Error Page</a>
                    </li>
                    <li>
                        <a href="login.html"><i class="fa fa-sign-in "></i>Login Page</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-sitemap "></i>Multilevel Link <span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level">
                            <li>
                                <a href="#"><i class="fa fa-bicycle "></i>Second Level Link</a>
                            </li>
                             <li>
                                <a href="#"><i class="fa fa-flask "></i>Second Level Link</a>
                            </li>
                            <li>
                                <a href="#">Second Level Link<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li>
                                        <a href="#"><i class="fa fa-plus "></i>Third Level Link</a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa fa-comments-o "></i>Third Level Link</a>
                                    </li>

                                </ul>

                            </li>
                        </ul>
                    </li>
                   
                    <li>
                        <a href="blank.html"><i class="fa fa-square-o "></i>Blank Page</a>
                    </li>-->
                </ul>

            </div>
<?php


session_start();

if($_SESSION["adminid"] != "")
{
?>
<div id="column">
      <div class="subnav">
        <h2>Admin Account</h2>
        <ul>
          <li><a href="adminaccount.php">Admin Home</a></li>
          <li><a href="admin.php">Admin Profile</a></li>
          <li><a href="adminappview.php">Appointment</a> </li>
          <li><a href="patientrecords.php">Patient Reports</a> </li>
          <li><a href="admindoc.php">Doctor</a></li>
             <li><a href="adminemp.php">Employee</a></li>
             <li><a href="employeesalary.php">Salary</a></li>
          <li><a href="expens.php">Expenses</a></li>
          <li><a href="testtype.php">Test Type</a></li>
           <li><a href="adminprescription.php">Prescription</a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </div>
    </div>
<?php
}

	?>