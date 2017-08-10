<?php

include_once("init.php");
include("db.php");
function query($query)
    {
		
      $this->nbQueries++;
      $this->lastResult = mysql_query($query) or $this->debugAndDie($query);

      $this->debug($debug, $query, $this->lastResult);

      return $this->lastResult;
    }
function saveInvoice($data){

		if(!empty($data) ){ 
			
			$count = 0;
			if( isset($data['data'] )){
				foreach ($data['data'] as $value) {
					
				
					if(!empty($value['product_id']))
					{
						
						$count++;
					}
				}
			}
			
			if($count == 0)throw new Exception( "Please add atleast one product to invoice." );
			
			// escape variables for security
			if(!empty($data))
			{
				$client_id = mysql_real_escape_string($data['client_id']);
				$invoiceNo= mysql_real_escape_string($data['invoiceNo']);
				//$invoiceDate= mysql_real_escape_string(($data['invoiceDate']);
				$tax = mysql_real_escape_string($data['tax']);
				$invoice_total = mysql_real_escape_string($data['invoice_total']);				
				//$invoice_subtotal = mysql_real_escape_string(($data['invoice_subtotal']);			
				$amount_paid = mysql_real_escape_string($data['amount_paid']);
				$amount_due = mysql_real_escape_string($data['amount_due']);	

				$id = mysql_real_escape_string($data['id']);

				if(empty($id)){
					echo "Raghu".$id;
					//$uuid = uniqid();
					//$db->query("INSERT INTO customerbill (`Billno`, `Billdate`, `billstatus`, `CustomerId`, `companyid`, `OrderNo`, `Shipto`, `Shippingcost`, `AmountTendered`, `AmountReturned`, `seller_id`, `netamount`, `qty`, `tax`) VALUES ('$invoiceNo',$invoiceDate,'0','$client_id','$company_id','0','0',0,$amount_due,$amount_paid,NULL,$invoice_total,$count,$tax)");
					$sq="INSERT INTO customerbill (`Billno`)values('12')";
					
					$db->query($sq,$id);
//$db->query("INSERT INTO `customerbill` (`Billno`, `Billdate`, `billstatus`, `CustomerId`, `companyid`, `OrderNo`, `Shipto`, `Shippingcost`, `AmountTendered`, `AmountReturned`, `seller_id`, `netamount`, `qty`, `tax`, `paymentdate`) VALUES ('1', '2017-08-16 00:00:00', '0', '0', '0', '0', '0', '0', '0', NULL, '0', '0', '0', '0', NULL)");
					//$query = "INSERT INTO customerbill (`id`, `client_id`,  `invoice_total`, `invoice_subtotal`, `tax`,
					//		`amount_paid`, `amount_due`, `notes`, `created`, `uuid`)
					//		VALUES (NULL, '$client_id',  '$invoice_total', '$invoice_subtotal', '$tax', '$amount_paid', '$amount_due', 'notes','CURRENT_TIMESTAMP', '$uuid')";
echo "Item added Successfully";
				}else{
					$uuid = $data['uuid'];
					$query = "UPDATE `invoices` SET `client_id` = '$client_id', `invoice_total` ='$invoice_total',`invoice_subtotal` = '$invoice_subtotal',
							`tax` = '$tax', `amount_paid` = '$amount_paid', `amount_due` = '$amount_due', `notes` = '$notes', `updated` = 'CURRENT_TIMESTAMP'
							WHERE `id` = '$id'";
				}
				if(!mysqli_query($con, $query)){
					throw new Exception(  @mysqli_error($con) );
				}else{
					if(empty($id))$id = @mysqli_insert_id($con);
				}

				if( isset( $data['data']) && !empty( $data['data'] )){
					saveInvoiceDetail( $data['data'], $id );
				}
				return [
					'success' => true,
					'uuid' => $uuid,
					'message' => 'Invoice Saved Successfully.'
				];
			}else{
				throw new Exception( "Please check, some of the required fileds missing" );
			}
		} else{
			throw new Exception( "Please check, some of the required fileds missing" );
		}
	}


function saveInvoiceDetail(array $invoice_details, $billno = ''){ 
	global $con;
    $deleteQuery = "DELETE FROM bill WHERE billno = $billno";
    mysqli_query($con, $deleteQuery);
$invoiceNo= @mysqli_real_escape_string(trim( $data['invoiceNo']));
$invoiceDate= @mysqli_real_escape_string(trim( $data['invoiceDate'] ) );
    foreach ($invoice_details as $invoice_detail){
        $product_id = @mysqli_real_escape_string( $con, trim( $invoice_detail['product_id'] ) );
        $productName = @mysqli_real_escape_string( $con, trim( $invoice_detail['product_name'] ) );
        $quantity = @mysqli_real_escape_string( $con, trim( $invoice_detail['quantity'] ) );
		 $discount = @mysqli_real_escape_string( $con, trim( $invoice_detail['discount'] ) );
		 $discountp = @mysqli_real_escape_string( $con, trim( $invoice_detail['discountp'] ) );
		 $s_gst = @mysqli_real_escape_string( $con, trim( $invoice_detail['s_gst'] ) );
		 $c_gst = @mysqli_real_escape_string( $con, trim( $invoice_detail['c_gst'] ) );
		 $taxamount= @mysqli_real_escape_string( $con, trim($invoice_detail['taxamount']));
		 $total= @mysqli_real_escape_string( $con, trim($invoice_detail['total']));
        $price = @mysqli_real_escape_string( $con, trim( $invoice_detail['total'] ) );
       // $db->query("INSERT INTO products VALUES ('$productid','$description',1,$salerate,$mrprate,$reorder,0,$sgst,$cgst,$purchaserate,NULL,0,$stock,'$expirydate','$Mfgdate',NULL,NULL,'$hsncode')");

         $db->query("INSERT INTO bill(`billno`, `billprice`, `qty`, `discountpercentage`, `discount`, `s_gst`, `c_gst`, `i_gst`, `taxamount`,`stockid`, `Netamount`, `RefNo`, `bill_date`) VALUES ('$invoiceNo',0,$quantity,$discount,$discountp,$s_gst,$c_gst,0,$taxamount,0,NULL,$total,NULL,'invoiceDate')");
        //$query = "INSERT INTO invoice_details (`id`, `invoice_id`, `product_id`, product_name, `quantity`, `price`)
        //        VALUES (NULL, '$invoice_id', '$product_id', '$productName', '$quantity', '$price')";
       // @mysqli_query($con, $query);
    }

}

 
function getInvoices(){
	global $con;
	$data = [];
	$query = "SELECT * FROM invoices";
	if ( $result = @mysqli_query($con, $query) ){
		while($row = @mysqli_fetch_assoc($result)) {
			array_push($data, $row);
		}
	} 
	return $data;
}

