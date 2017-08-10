
<?php
include_once("init.php");
include("db.php");
include("calc.php");

//if(!isset($_SESSION['username']) || $_SESSION['usertype'] !='admin'){ // if session variable "username" does not exist.
//header("location:index.php?msg=Please%20login%20to%20access%20admin%20area%20!"); // Re-direct to index.php
//}
//else
//{
 if($_GET['company']!=''){

	$company= $_GET['company'];
		$billno= $_GET['billno'];	
 
//}

?>
<style type="text/css">
.maintable{border-collapse:collapse;}
.maintable tr,td{border:2px solid black;}
</style>
<style type="text/css" media="print">
.hide{display:none}
</style>
<script type="text/javascript">
function printpage() {
document.getElementById('printButton').style.visibility="hidden";
window.print();
document.getElementById('printButton').style.visibility="visible";  
}
</script>
<input name="print" type="button" value="Print" id="printButton" onClick="printpage()">
<table class="maintable" style="width:100%">
<tr style="height:20px;text-align:center;">
<td colspan="2"><span style="font-weight:bold;">Invoice<span></td>
</tr>
<?php $result =$db->query("SELECT * FROM shopdetails where companyid = $company");
					 // while ($line = mysql_fetch_array($result)) {
						  while ($line = $db->fetchNextObject($result)) {
				 ?>
<tr>
<td style="width:50%;"><div align="left">
                    
                  <strong><?php echo $line->Shopname; ?></strong><br />
                  <?php echo $line->Addressline1; ?><br/>
                    <?php echo $line->Addressline2; ?><br/>
					  <?php echo $line->Addressline3; ?><br/>
             Phone<strong>:<?php echo $line->Contact1; ?></strong>
                  <br />
                
              </div>
			  
			  </td><td style="width:50%;" ><div >
                    
                  <strong>GST:<?php echo $line->CSTNO; ?></strong><br />
                 EMail <?php echo $line->Email; ?><br/>
                    <?php echo $line->PANNO; ?><br/>
					 
          
                  <br />
                
              </div></td>
</tr>
					  <?php
					} 
					  ?>

  
					 <?php $qu="SELECT * FROM customerbill where Billno = $billno";
					  
					 $result1 =$db->query($qu);
					 
						  while($billlin = $db->fetchNextObject($result1)) {
						
				 ?>  
					 
<tr>
<td>
<strong>TO:</strong><br />
 
	 <?php $custid= $billlin->CustomerId; 
	 
	 $qu="SELECT * FROM customer where CustomerId = $custid";
					  
					 $cus_result =$db->query($qu);
					 
						  while($cus_details = $db->fetchNextObject($cus_result)) {
	 
	 
	 
	 
						  
	 ?>
	 <div align="left">
                    
                  <strong><?php echo $cus_details->CustomerName;  ?></strong><br />
                  <?php echo $cus_details->Address; ?><br/>
                    <?php echo $cus_details->Pincode; ?><br/>
				Phone:	  <?php echo $cus_details->CustomerMobile; ?><br/>
             Email: <?php echo $cus_details->Email; ?>
                  <br />
                
              </div>
	 <?php 
						  }
?>
</td><td>
 <div align="left">
                    
                  <strong>Invoice No:</strong><?php echo $billlin->Billno  ?><br />
				    <strong>Invoice Date:</strong><?php echo $billlin->Billdate  ?><br />
                  
                  <br />
                
              </div>

</td>
</tr>
						
<tr>
<td colspan="2">

<table style="border-collapse:collapse;width:100%">
<tr>
<td colspan="6"></td><td colspan="2">IGST</td><td colspan="2">CGST</td><td colspan="2">SGST</td><td></td>
</tr>
<tr>
<td><strong>S.No</strong></td><td><strong>Description</strong></td><td><strong>Hsn Code</strong></td><td><strong>Qty</strong></td><td><strong>Rate</strong></td><td><strong>Discount</strong></td>
<td><strong>%</strong></td><td><strong>Amt</strong></td><td><strong>%</strong></td><td><strong>Amt</strong></td><td><strong>%</strong></td><td><strong>Amt</strong></td><td><strong>Total</strong></td>
</tr>

<?php $bill= $billlin->Billno; 
$billqu="SELECT * FROM bill where billno =$bill";
					  
					 $bill_result =$db->query($billqu);
					 $i=0;
					 $s_gstcal=0; $c_gstcal=0;
						  while($bill_details = $db->fetchNextObject($bill_result)) {
							  $i++;
							   ?>
						   
	 
<tr>
<?php $stock= $bill_details->stockid;

 $stock_result =$db->query("SELECT * FROM products where productid =$stock");
   while($stock_details = $db->fetchNextObject($stock_result)) {?>
<td><?php echo $i;?></td>
<td><?php echo $stock_details->description; ?></td>
<td><?php echo $stock_details->Hsn_code; ?></td>
<td><?php echo $bill_details->qty; ?></td>
<td><?php echo $stock_details->retailprice; ?></td>
<td><?php echo $bill_details->discount; ?></td>
<td><?php echo $bill_details->i_gst; ?></td>
<td></td>
<td><?php echo $bill_details->s_gst; ?></td>
<td><?php
$scal=$bill_details->s_gst;
$qt=$bill_details->qty;
$cal1=$stock_details->retailprice;
$cal=(float)$qt*(float)$cal1;
$cal=((float)$cal*(float)$scal)/100;
$s_gstcal=(float)$s_gstcal+(float)$cal;
echo $cal;
?></td>
<td><?php echo $bill_details->c_gst; ?></td>
<td>
<?php
$gcal=$bill_details->c_gst;
$qt=$bill_details->qty;
$cal1=$stock_details->retailprice;
$cal=(float)$qt*(float)$cal1;
$cal=((float)$cal*(float)$gcal)/100;
$c_gstcal=(float)$c_gstcal+(float)$cal;
echo $cal;
?></td>

<td><?php echo $bill_details->Netamount; ?></td>
<?php } ?>
</tr>
<?php } ?>
<tr>
<td colspan="6">Total</td>
<td></td><td></td><td></td><td><?php echo $s_gstcal; ?></td><td></td><td><?php echo $c_gstcal; ?></td><td> <?php echo $billlin->netamount;?></td>

</tr>
<tr>
<td colspan="13"><div align="right"><strong>Round off:</strong></div></td>
</tr>
<tr>
<td colspan="13"><div align="right"><strong>Total:</strong><?php echo $billlin->netamount;?></div></td>
</tr>
</table>
						  
</td>
</tr>
<tr>
<td colspan="13"><div align="center"><strong>Amount in Words:</strong><?php 
$obj    = new toWords($billlin->netamount);
echo $obj->words;?>
</div></td>
</tr>
<tr>
<td colspan="13">
<div align="right">
<strong> For VIJESH AGENCIES</strong><br>
<br>
<br>
<br>
<strong> Authorized Signatory</strong><br>
</div></td>
</tr>
</table>
<?php 
						  }			 }
?>