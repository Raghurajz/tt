 <?php
include_once("init.php");
include("db.php");
include("header.php");

//include("invoice-save.php");

if(!empty($_POST)){
	try{
		$_POST = $gump->sanitize($_POST);
		 
			
			$count = 0;
			if( isset($_POST['data'] )){
				foreach ($_POST['data'] as $value) {
					
				
					if(!empty($value['product_id']))
					{
						
						$count++;
					}
				}
			}
			
			if($count == 0)throw new Exception( "Please add atleast one product to invoice." );
		$client_id = mysql_real_escape_string($_POST['client_id']);
		$company_id = mysql_real_escape_string($_POST['company_id']);
				$invoiceNo= mysql_real_escape_string($_POST['invoiceNo']);
				$invoiceDate= mysql_real_escape_string($_POST['invoiceDate']);
				$tax = mysql_real_escape_string($_POST['tax']);
				$invoice_total = mysql_real_escape_string($_POST['invoice_total']);				
				$invoice_subtotal = mysql_real_escape_string($_POST['invoice_subtotal']);			
				$amount_paid = mysql_real_escape_string($_POST['amount_paid']);
				$amount_due = mysql_real_escape_string($_POST['amount_due']);	

				$id = mysql_real_escape_string($_POST['id']);

				if(empty($id)){
				
					//$uuid = uniqid();
					
					$db->query("INSERT INTO customerbill (`Billno`, `Billdate`, `billstatus`, `CustomerId`, `companyid`, `OrderNo`, `Shipto`, `Shippingcost`,`AmountTendered`, `AmountReturned`, `seller_id`, `netamount`, `qty`, `tax`) VALUES ('$invoiceNo','$invoiceDate','0','$client_id','$company_id',0,0,0,$amount_due,$amount_paid,1,$invoice_total,$count,$tax)");
							//echo "Raghu".$invoiceNo;
					$up="UPDATE `bno` SET `billno`=$invoiceNo WHERE `companyid`=$company_id";
					//echo $up;
					$db->query($up);
					//$db->query($sq);
				}else{
					$uuid = $_POST['uuid'];
					$query = "UPDATE `invoices` SET `client_id` = '$client_id', `invoice_total` ='$invoice_total',`invoice_subtotal` = '$invoice_subtotal',
							`tax` = '$tax', `amount_paid` = '$amount_paid', `amount_due` = '$amount_due', `notes` = '$notes', `updated` = 'CURRENT_TIMESTAMP'
							WHERE `id` = '$id'";
				}
				//if(!mysqli_query($con, $query)){
				//	throw new Exception(  @mysqli_error($con) );
				///}else{
				//	if(empty($id))$id = @mysqli_insert_id($con);
				//}

				if( isset($_POST['data']) && !empty($_POST['data'])){
					echo "asd".$_POST['data'];
					//saveInvoiceDetail( $_POST['data'], $id );
					$invoiceNo= mysql_real_escape_string($_POST['invoiceNo']);
				$invoiceDate= mysql_real_escape_string($_POST['invoiceDate']);
    foreach ($_POST['data'] as $invoice_detail){
        $product_id = mysql_real_escape_string( $invoice_detail['product_id']);
		//echo "Product".$product_id;
        $productName = mysql_real_escape_string($invoice_detail['product_name']);
        $quantity = mysql_real_escape_string($invoice_detail['quantity']);
		 $discount = mysql_real_escape_string($invoice_detail['discount']);
		 $discountp = mysql_real_escape_string($invoice_detail['discountp']);
		 $s_gst = mysql_real_escape_string($invoice_detail['s_gst']);
		 $c_gst = mysql_real_escape_string($invoice_detail['c_gst']);
		 $taxamount= mysql_real_escape_string($invoice_detail['taxamount']);
		 $total= mysql_real_escape_string( $invoice_detail['total']);
       
         $db->query("INSERT INTO bill(`billno`, `billprice`, `qty`, `discountpercentage`, `discount`, `s_gst`, `c_gst`, `i_gst`, `taxamount`, `Netamount`,  `bill_date`,'stockid') VALUES ('$invoiceNo',0,$quantity,$discount,$discountp,$s_gst,$c_gst,0,$taxamount,$total,'$invoiceDate',$product_id)");
      
    }
				}
			
			
	 
	
 header("Location:invoice.php?company=$company_id&billno=$invoiceNo");

		//$data = saveInvoice($_POST);
		
		if( isset($data['success']) && $data['success']){
			$_SESSION['success'] = 'Invoice Saved Successfully!';
			header('Location: invoice-list.php');exit;
		} else {
			$_SESSION['success'] = 'Invoice Save failed, try again.';
		}
	} catch (Exception $e) {
		$_SESSION['error'] = $e->getMessage();
	}
}


function saveInvoiceDetail(array $invoice_details, $billno = ''){ 
//	global $con;
  //  $deleteQuery = "DELETE FROM bill WHERE billno = $billno";
    //mysqli_query($con, $deleteQuery);
$invoiceNo= mysql_real_escape_string($_POST['invoiceNo']);
				$invoiceDate= mysql_real_escape_string($_POST['invoiceDate']);
    foreach ($invoice_details as $invoice_detail){
	}

}

 
$compid="";
?>
		        <link href="assets/css/jquery-ui.min.css" rel="stylesheet">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
           <?php include("sidemenu.php"); ?>
        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Bill</h1>
                                         </div>
                </div>
                <!-- /. ROW  -->
             <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
               <div class="panel panel-info">
                        <div class="panel-heading">
                           Bill
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal invoice-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="invoice-form" method="post" role="form" novalidate>
							<div class="col-md-12 col-sm-12 col-xs-12">
							  <div class="col-md-2 col-sm-2 col-xs-2">
                                        <div class="form-group">
                                            <label>Company</label>
                                            <select class="form-control" id="company">
											<?php $cat= $db->query("SELECT * FROM shopdetails");
			while ($lin = $db->fetchNextObject($cat)) {
				$name= $lin->Shopname;
				$id= $lin->companyid;
			
  echo "<option value='".$id."'>".$name."</option>";
} ?>
											</select>
                                          
                                        </div>
										</div>
										<div class="col-md-2 col-sm-2 col-xs-2">
                                        <div class="form-group">
                                            <label>Bill Category</label>
                                            <input class="form-control" type="text">
                                          
                                        </div>
										</div>
										<div class="col-md-2 col-sm-2 col-xs-2">
                                        <div class="form-group">
                                            <label>Tax </label>
                                            <input class="form-control" type="text">
                                          
                                        </div>
										</div>
										<div class="col-md-2 col-sm-2 col-xs-2">
                                        <div class="form-group">
                                            <label>Mode Payment</label>
                                            <input class="form-control" type="text">
                                          
                                        </div>
										</div>
										<div class="col-md-2 col-sm-2 col-xs-2">
                                        <div class="form-group">
                                            <label>Customer/Supplier</label>
                                            <input class="form-control" type="text">
                                          
                                        </div>
										</div>
										  <?php $max = $db->maxOfAll("billno", "bno","2");
					  $max=$max+1;
					  $autoid="".$max."";?>
										<div class="col-md-2 col-sm-2 col-xs-2">
                                        <div class="form-group">
                                            <label>Bill Date</label>
                                            <input class="form-control" value= "<?php echo date('Y-m-d');?>" type="text">
                                          
                                        </div>
										</div>
											</div>			
                                          
                                 
                                      

                                   
                           

			
				<hr>
				<div class="row no-margin">
					<div class='col-xs-12 col-sm-4 col-md-4 col-lg-4'>
						<h4>Invoice To</h4>
						<div class="form-group">
							<input type="email" class="form-control" name="clientCompanyName" id="clientCompanyName" placeholder="Company Name" value="Lime Software Solutions">
						</div>
						<div class="form-group">
							<textarea class="form-control" rows='3' name="clientAddress" id="clientAddress" placeholder="Your Address">No:36, Valluvar Street, Chennai-60028</textarea>
						</div>
						<input type="hidden" value="1" name="client_id">
						<input type="hidden" value="2" name="company_id">
						<input type="hidden" value="" name="id">
						<input type="hidden" value="1" name="uuid">
					</div>
					<div class='col-xs-12 col-sm-offset-3 col-md-offset-3 col-lg-offset-3 col-sm-4 col-md-4 col-lg-4'>
						<h4>&nbsp;</h4>
						<div class="form-group">
							<input type="text" class="form-control" value="<?php echo $autoid;?>" name="invoiceNo" id="invoiceNo" placeholder="Invoice No">
						</div>
						<div class="form-group">
							<input type="text" class="form-control" value= "<?php echo date('Y-m-d');?>" name="invoiceDate" id="invoiceDate" placeholder="Invoice Date">
						</div>
						<div class="form-group">
							<input type="number" class="form-control amountDue" id="amountDueTop" placeholder="Amount Due">
						</div>
					</div>
				</div>
				<hr>
				<div class='row'>
					<div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
						<table class="table table-bordered table-hover" id="invoiceTable">
							<thead>
								<tr>
									<th width="2%"><input id="check_all" class="formcontrol" type="checkbox"/></th>
									<th width="15%">Item No</th>
									<th width="20%">Item Name</th>
									<th width="8%">Price</th>
									<th width="8%">Discount</th>
									<th width="8%">Discount Price</th>
									<th width="8%">S_gst</th>
									<th width="8%">c_gst</th>
								<th width="8%">Tot.tax</th>
									<th width="8%">Quantity</th>
									<th width="20%">Total</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><input class="case" type="checkbox"/></td>
									<td><input type="text" data-type="productid" name="data[0][product_id]" id="itemNo_1" class="form-control autocomplete_txt" autocomplete="off"></td>
									<td><input type="text" data-type="description" name="data[0][product_name]" id="itemName_1" class="form-control autocomplete_txt" autocomplete="off"></td>
									<td><input type="number" name="data[0][price]" id="price_1" class="form-control changesNo" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>
									<td><input type="number" name="data[0][discount]" id="discount_1" class="form-control changesNo" autocomplete="off" value="0" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>
									<td><input type="number" name="data[0][discountp]" id="discountp_1" class="form-control changesNo" autocomplete="off" value="0" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>
									<td><input type="number" name="data[0][s_gst]" id="s_gst_1" class="form-control changesNo" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>
									<td><input type="number" name="data[0][c_gst]" id="c_gst_1" class="form-control changesNo" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>
									<td><input type="number" name="data[0][taxamount]" id="taxamount_1" class="form-control changesNo" autocomplete="off" value="0" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>
									<td><input type="number" name="data[0][quantity]" id="quantity_1" class="form-control changesNo" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>
									<td><input type="number" name="data[0][total]" id="total_1" class="form-control totalLinePrice" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				
				<div class='row'>
					<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
						<button id="delete" class="btn btn-danger delete" type="button">- Delete</button>
						<button id="addmore" class="btn btn-success addmore" type="button">+ Add More</button>
						<h2>Notes: </h2>
						<div class="form-group">
							<textarea class="form-control" rows='5' name="notes" id="notes" placeholder="Your Notes"></textarea>
						</div>
					</div>
					
					<div class='col-xs-offset-2 col-xs-9 col-sm-offset-2 col-md-offset-3 col-lg-offset-3 col-sm-4 col-md-3 col-lg-3'>
						
							<div class="form-group">
								<label>Subtotal: &nbsp;</label>
								<div class="input-group">
									<div class="input-group-addon">$</div>
									<input type="number" class="form-control" name="invoice_subtotal" id="subTotal" placeholder="Subtotal" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
								</div>
							</div>
							<div class="form-group">
								<label>Tax: &nbsp;</label>
								<div class="input-group">
									<div class="input-group-addon">$</div>
									<input type="number" class="form-control" name="tax_percent" id="tax" placeholder="Tax" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
								</div>
							</div>
							<div class="form-group">
								<label>Tax Amount: &nbsp;</label>
								<div class="input-group">
									<input type="number" class="form-control" name="tax" id="taxAmount" placeholder="Tax" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
									<div class="input-group-addon">%</div>
								</div>
							</div>
							<div class="form-group">
								<label>Total: &nbsp;</label>
								<div class="input-group">
									<div class="input-group-addon">$</div>
									<input type="number" class="form-control" name="invoice_total" id="totalAftertax" placeholder="Total" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
								</div>
							</div>
							<div class="form-group">
								<label>Amount Paid: &nbsp;</label>
								<div class="input-group">
									<div class="input-group-addon">$</div>
									<input type="number" class="form-control" name="amount_paid" id="amountPaid" placeholder="Amount Paid" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
								</div>
							</div>
							<div class="form-group">
								<label>Amount Due: &nbsp;</label>
								<div class="input-group">
									<div class="input-group-addon">$</div>
									<input type="number" class="form-control amountDue" name="amount_due" id="amountDue" placeholder="Amount Due" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
								</div>
							</div>
						
					</div>
				</div>
				
				<div class='row'>
					<div class="col-xs-12 col-sm-12">
						<div class="text-center">
							<button data-loading-text="Saving Invoice..." type="submit" name="invoice_btn" class="btn btn-success submit_btn invoice-save-bottom form-control"> <i class="fa fa-floppy-o"></i>  Save Invoice </button>
						</div>
					</div>
				</div>
				 </form>
				 
 </div>
           
           </div>
           
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
    <div id="footer-sec">
        &copy; 2014 YourCompany | Design By : <a href="" target="_blank"></a>
    </div>
    <!-- /. FOOTER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
   
    <!-- BOOTSTRAP SCRIPTS -->
	
    <!-- METISMENU SCRIPTS -->
	
    <!--  <script src="assets/js/custom.js"></script>CUSTOM SCRIPTS -->
	 <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/jquery.metisMenu.js"></script>
   
<script src="js/jquery.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
			 <!--	<script src="js/bootstrap.min.js"></script>-->
		<script src="js/bootstrap-datepicker.js"></script>
		<script src="js/auto.js"></script>

</body>
</html>
