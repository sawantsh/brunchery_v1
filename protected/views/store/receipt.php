<?php
unset($_SESSION['pts_earn']);
unset($_SESSION['pts_redeem_amt']);

$this->renderPartial('/front/banner-receipt',array(
   'h1'=>t("Thank You"),
   'sub_text'=>t("Your order has been placed.")
));

$ok=false;
//$data='';
//if ( $data=Yii::app()->functions->getOrder2($_GET['id'])){				
if (is_array($data) && count($data)>=1){
	$merchant_id=$data['merchant_id'];
	$json_details=!empty($data['json_details'])?json_decode($data['json_details'],true):false;
	if ( $json_details !=false){
		Yii::app()->functions->displayOrderHTML(array(
		  'merchant_id'=>$data['merchant_id'],
		  'delivery_type'=>$data['trans_type'],
		  'delivery_charge'=>$data['delivery_charge'],
		  'packaging'=>$data['packaging'],
		  'cart_tip_value'=>$data['cart_tip_value'],
		  'cart_tip_percentage'=>$data['cart_tip_percentage']/100,
		  'card_fee'=>$data['card_fee'],
		  'tax'=>$data['tax'],
		  'points_discount'=>isset($data['points_discount'])?$data['points_discount']:'' /*POINTS PROGRAM*/,
		  'voucher_amount'=>$data['voucher_amount'],
		  'voucher_type'=>$data['voucher_type']
		  ),$json_details,true);
		if ( Yii::app()->functions->code==1){
			$ok=true;
		}
		
		/*ITEM TAXABLE*/
		$mtid = $merchant_id;
		$apply_tax = $data['apply_food_tax'];
	    $tax_set = $data['tax'];	         	 
		if ( $apply_tax==1 && $tax_set>0){							    
		    Yii::app()->functions->details['html']=Yii::app()->controller->renderPartial('/front/cart-with-tax',array(
    		   'data'=>Yii::app()->functions->details['raw'],
    		   'tax'=>$tax_set,
    		   'receipt'=>true,    		
    		   'merchant_id'=>$mtid   
    		),true);
		}
		
		/*dump(Yii::app()->functions->details['raw']);
		die();*/
	}	
}
unset($_SESSION['kr_item']);
unset($_SESSION['kr_merchant_id']);
unset($_SESSION['voucher_code']);
unset($_SESSION['less_voucher']);
unset($_SESSION['shipping_fee']);

$print='';

$order_ok=true;

$merchant_info=Yii::app()->functions->getMerchant(isset($merchant_id)?$merchant_id:'');
$full_merchant_address=$merchant_info['street']." ".$merchant_info['city']. " ".$merchant_info['state'].
" ".$merchant_info['post_code'];

$transaction_type=$data['trans_type'];
?>

<div class="sections section-receipt">
   <div class="container bruncherry-container relative">
	 <div class="store-topbar">
      <div class="resto-info">
        <div class="trim-text text-center"><a class="pull-left" href="/"><i class="ion-ios-arrow-back"></i></a> Order Details
				<a class="pull-right" href="/"><u>Return to Home Screen</u></a></div>				
      </div>
		</div>
   <?php if ($ok==TRUE):?>
   <div class="inner" id="receipt-content">
	   <h1 class="f-hide"><?php echo t("Order Details")?></h1>
	   <div class="" style="margin-bottom: 50px;">     
		 <div class="receipt-head">
			<p>Thank you for ordering with <?php echo $data['merchant_name']?>! We are sending your order to them now!</p>	
			<p>Please ensure that you arrive <strong>on time.</strong></p>	
			<p>Keep your <strong>order number</strong> handy so that you can quote it if needed.</p>	
		 </div>
	   
		 <div class="receipt-container">
			<div class="text-center bottom10">
			<i class="ion-ios-checkmark-outline green-text"></i>
			</div>
		 
	   <table class="table table-striped">
	    <tbody>	     
	       <tr>
				 <td colspan="2" class="text-center"><span class="highlight">Ordered for: </span>
				 <?php if (isset($_SESSION['kr_delivery_options']['delivery_time'])):?>
		       <?php if ( !empty($_SESSION['kr_delivery_options']['delivery_time'])):?>		       
		         <?php echo Yii::app()->functions->timeFormat($_SESSION['kr_delivery_options']['delivery_time'],true)?>
		       <?php 	       
						$print[]=array(
						'label'=>$label_time,
						'value'=>Yii::app()->functions->timeFormat($_SESSION['kr_delivery_options']['delivery_time'],true)
						);
						?>
		       <?php endif;?>
		       <?php endif;?>
				 </td>
				 </tr>
				 <tr>
				 	<td colspan="2">
					 <table class="inner-table" style="width: 100%">
						<tr>
						<td >
								<span class="highlight">Order placed:</span>
								<?php if (isset($_SESSION['kr_delivery_options']['delivery_date'])):?>		       
								<?php echo Yii::app()->functions->FormatDateTime($_SESSION['kr_delivery_options']['delivery_date'], false) ."</td>"?>
						
								<?php 	       
									$print[]=array(
										'label'=>$label_date,
										'value'=>Yii::app()->functions->FormatDateTime($_SESSION['kr_delivery_options']['delivery_date'], false)
									);
								?>
							<?php endif;?>
						<td class="text-right"><?php //echo Yii::t("default","Reference #")?><span class="highlight">Order Number:</span>
						<?php echo Yii::app()->functions->formatOrderNumber($data['order_id'])?></td>
							<?php 	       
								$print[]=array(
									'label'=>Yii::t("default","Reference #"),
									'value'=>Yii::app()->functions->formatOrderNumber($data['order_id'])
								);
	       			?>
						</tr>
					 </table>
					 </td>
				 </tr>
				 <tr>
					<td colspan=2>
					<span class="highlight">To <?php echo Yii::t("default",$data['trans_type'] == 'dashout' ? 'Dash-Out' : 'Dine-In')?>:</span>	
				<?php 	       
					$print[]=array(
						'label'=>Yii::t("default","TRN Type"),
						'value'=>t($data['trans_type'] == 'dashout' ? 'Dash-out' : 'Dine-in')
					);
	       ?>
				 <?php if (isset($_SESSION['kr_delivery_options']['delivery_time'])):?>
		       <?php if ( !empty($_SESSION['kr_delivery_options']['delivery_time'])):?>		       
		         <?php echo Yii::app()->functions->timeFormat($_SESSION['kr_delivery_options']['delivery_time'],true)?>
		       <?php 	       
						$print[]=array(
						'label'=>$label_time,
						'value'=>Yii::app()->functions->timeFormat($_SESSION['kr_delivery_options']['delivery_time'],true)
						);
						?>
		       <?php endif;?>
		       <?php endif;?>
					</td>
				 </tr>
				
				 <tr>
	         <td>
							From <br><br>
							<?php $print[]=array( 'label'=>Yii::t("default","Customer Name"), 'value'=>$data['full_name'] );?>
							<span class="highlight"><?php echo $data['full_name']?>	       </span>
							<?php 
							if (isset($data['contact_phone1'])){
								if (!empty($data['contact_phone1'])){
									$data['contact_phone']=$data['contact_phone1'];
								}
							}
			   			?>		  <br>    
		       		<?php echo $data['contact_phone']?><?php 	       
				$print[]=array(
				  'label'=>Yii::t("default","Contact Number"),
				  'value'=>$data['contact_phone']
				);
				?>
		    	   </td>
	         <td style="width: 50%">
					 To <br><br>
					 <span class="highlight"><?php echo clearString($data['merchant_name'])?></span><br>
					 <?php echo $data['merchant_contact_phone']?>
		       <?php 	       
	       $print[]=array(
	         'label'=>Yii::t("default","Telephone"),
	         'value'=>$data['merchant_contact_phone']
	       );
	       ?>
					 <br>
				  <?php echo $full_merchant_address?>
	       <?php 	       
	       $print[]=array(
	         'label'=>Yii::t("default","Address"),
	         'value'=>$full_merchant_address
	       );
	       ?>
				 <?php $print[]=array( 'label'=>Yii::t("default","Merchant Name"), 'value'=>$data['merchant_name']); ?>
					 
					 </td>
	       </tr>

				 <tr>
				 <td colspan=2>
				 	<span class="highlight">Items</span><br><br>
							<?php //print_r($data);?>
						 <ul class="receipt-items">

						 <?php foreach (Yii::app()->functions->clientHistyOrderDetails($data['order_id']) as $row => $item):?>
							 <?php
							 	$price=$item['normal_price'];
     						if ( $item['discount']>0){
     							$price=$item['discounted_price'];
		 						}
		 					?>
				 			<li><?php echo $item['qty']." x ".qTranslate($item['item_name'],'item_name',$item['item_name_trans'])." &nbsp;&nbsp; ".displayPrice( baseCurrency(), normalPrettyPrice($price))?></li>
						 <?php endforeach;?>
						 </ul>
				 </td>
				 </tr>

				 <tr>
				 <td colspan="2">

				 <table class="inner-table" style="width: 100%">
				 	<tr>
				 		<td>
							<?php 
							$label_date=t("Pickup Date");
							$label_time=t("Pickup Time");
							if ($transaction_type=="dinein"){
									$label_date=t("Dine in Date");
									$label_time=t("Dine in Time");
							}
							?>
		       		<?php if ($data['order_change']>=0.1):?>					
		         	<?php echo displayPrice( baseCurrency(), normalPrettyPrice($data['order_change']))?>
		        <?php 	       
							$print[]=array(
								'label'=>Yii::t("default","Change"),
								'value'=>$data['order_change']
							);
						?>
					<?php endif;?>
					<?php if (isset($_SESSION['kr_delivery_options']['total_price'])):?>		       
						<span class="highlight big"><?php echo t("Total")?></span>
					</td>
					<td>
						<span class="highlight big"><?php echo "$".$_SESSION['kr_delivery_options']['total_price']?>
						 <?php 	       
							$print[]=array(
								'label'=>t("Total Price"),
								'value'=>"$".$_SESSION['kr_delivery_options']['total_price']
							);
						?><?php endif;?>
						</span>
	       </td>
				 <td class="text-right"><span class="highlight">PAID: </span>
					<?php echo FunctionsV3::prettyPaymentType('payment_order',$data['payment_type'],$_GET['id'],$data['trans_type'])?>
				</td>
	       <?php 	       
	       $print[]=array(
	         'label'=>Yii::t("default","Payment Type"),
	         'value'=>FunctionsV3::prettyPaymentType('payment_order',$data['payment_type'],$_GET['id'],$data['trans_type'])
	       );	       
	       ?>
				 </td>
				 </table>
				 </td>
				 </tr>

	       
	       <?php if (isset($data['abn']) && !empty($data['abn'])):?>	       
	       <tr>
	         <td><?php echo Yii::t("default","ABN")?></td>
	         <td class="text-right"><?php echo $data['abn']?></td>
	       </tr> 
	       <?php 	       
	       $print[]=array(
	         'label'=>Yii::t("default","ABN"),
	         'value'=>$data['abn']
	       );
	       ?>
	       <?php endif;?>
	       
	       
	       <?php $merchant_tax_number=getOption($merchant_id,'merchant_tax_number');?>
	       <?php if (!empty($merchant_tax_number)):?>
		       <tr>
		         <td><?php echo Yii::t("default","Tax number")?></td>
		         <td class="text-right"><?php echo $merchant_tax_number?></td>
		       </tr>    
		       <?php 	       
		       $print[]=array(
		         'label'=>Yii::t("default","Tax number"),
		         'value'=>$merchant_tax_number
		       );
		       ?>
	       <?php endif;?>
	       	       
	       
	       
	       	       
	       <?php if ( $data['payment_provider_name']):?>	      
	       <tr>
	         <td><?php echo Yii::t("default","Card#")?></td>
	         <td class="text-right"><?php echo $data['payment_provider_name']?></td>
	       </tr>
	       <?php 	       
	       $print[]=array(
	         'label'=>Yii::t("default","Card#"),
	         'value'=>strtoupper($data['payment_provider_name'])
	       );
	       ?>
	       <?php endif;?>	       	       
	       	       
	       <?php if ( $data['payment_type'] =="pyp"):?>
	       <?php 
	       $paypal_info=Yii::app()->functions->getPaypalOrderPayment($data['order_id']);	       
	       ?>	       
	       <tr>
	         <td><?php echo Yii::t("default","Paypal Transaction ID")?></td>
	         <td class="text-right"><?php echo isset($paypal_info['TRANSACTIONID'])?$paypal_info['TRANSACTIONID']:'';?></td>
	       </tr>
	       <?php 	       
	       $print[]=array(
	         'label'=>Yii::t("default","Paypal Transaction ID"),
	         'value'=>isset($paypal_info['TRANSACTIONID'])?$paypal_info['TRANSACTIONID']:''
	       );
	       ?>
	       <?php endif;?>
	       	       
	       
	       
	       <?php if ( !empty($data['payment_reference'])):?>	      
	       <tr>
	         <td><?php echo Yii::t("default","Payment Ref")?></td>
	         <td class="text-right"><?php echo $data['payment_reference']?></td>
	       </tr>
	       <?php
	       $print[]=array(
	         'label'=>Yii::t("default","Payment Ref"),
	         'value'=>Yii::app()->functions->formatOrderNumber($data['order_id'])
	       );
	       ?>
	       <?php endif;?>
	       	       
	       <?php if ( $data['payment_type']=="ccr" || $data['payment_type']=="ocr"):?>	       
	       <tr>
	         <td><?php echo Yii::t("default","Card #")?></td>
	         <td class="text-right"><?php echo $card=Yii::app()->functions->maskCardnumber($data['credit_card_number'])?></td>
	       </tr>
	       <?php 	       
	       $print[]=array(
	         'label'=>Yii::t("default","Card #"),
	         'value'=>$card
	       );
	       ?>
	       <?php endif;?>
	       	       
	       <!-- <tr>
	         <td><?php echo Yii::t("default","TRN Date")?></td>
	         <td class="text-right">
	         <?php 
	        	/*$trn_date=date('M d,Y G:i:s',strtotime($data['date_created']));
	         echo Yii::app()->functions->translateDate($trn_date);*/
	         ?>
	         </td>
	       </tr>
	       <?php 	       
	       /*$print[]=array(
	         'label'=>Yii::t("default","TRN Date"),
	         'value'=>$trn_date
	       );*/
	       ?> -->
	       
	       <?php if ($data['trans_type']=="delivery"):?>
		       	       
		       <?php if (isset($_SESSION['kr_delivery_options']['delivery_date'])):?>		       
		       <tr>
		         <td><?php echo Yii::t("default","Delivery Date")?></td>
		         <td class="text-right">
		         <?php 
		         $deliver_date=prettyDate($_SESSION['kr_delivery_options']['delivery_date']);
		         echo Yii::app()->functions->translateDate($deliver_date);
		         ?>
		         </td>
		       </tr>
		       <?php 	       
		       $print[]=array(
		         'label'=>Yii::t("default","Delivery Date"),
		         'value'=>$deliver_date
		       );
		       ?>
		       <?php endif;?>
		       
		       <?php if (isset($_SESSION['kr_delivery_options']['delivery_time'])):?>
		       <?php if ( !empty($_SESSION['kr_delivery_options']['delivery_time'])):?>		       
		       <tr>
		         <td><?php echo Yii::t("default","Delivery Time")?></td>
		         <td class="text-right"><?php echo Yii::app()->functions->timeFormat($_SESSION['kr_delivery_options']['delivery_time'],true)?></td>
		       </tr>
		       <?php 	       
		       $print[]=array(
		         'label'=>Yii::t("default","Delivery Time"),
		         'value'=>Yii::app()->functions->timeFormat($_SESSION['kr_delivery_options']['delivery_time'],true)
		       );
		       ?>
		       <?php endif;?>
		       <?php endif;?>
		       
		       <?php if (isset($_SESSION['kr_delivery_options']['delivery_asap'])):?>
		       <?php if ( !empty($_SESSION['kr_delivery_options']['delivery_asap'])):?>		       
		       <tr>
		         <td><?php echo Yii::t("default","Deliver ASAP")?></td>
		         <td class="text-right">
		         <?php echo $delivery_asap=$_SESSION['kr_delivery_options']['delivery_asap']==1?t("Yes"):'';?>
		         </td>
		       </tr>
			   <?php 	       
				$print[]=array(
				 'label'=>Yii::t("default","Deliver ASAP"),
				 'value'=>$delivery_asap
				);
				?>
		       <?php endif;?>
		       <?php endif;?>
		       		       
		       <tr>
		         <td><?php echo Yii::t("default","Deliver to")?></td>
		         <td class="text-right">
		         <?php 		         
		         if (!empty($data['client_full_address'])){		         	
		         	echo $delivery_address=$data['client_full_address'];
		         } else echo $delivery_address=$data['full_address'];		         
		         ?>
		         </td>
		       </tr>
				<?php 	       
				$print[]=array(
				  'label'=>Yii::t("default","Deliver to"),
				  'value'=>$delivery_address
				);
				?>
						       		      
		       <tr>
		         <td><?php echo Yii::t("default","Delivery Instruction")?></td>
		         <td class="text-right"><?php echo $data['delivery_instruction']?></td>
		       </tr>
		       <?php 	       
				$print[]=array(
				  'label'=>Yii::t("default","Delivery Instruction"),
				  'value'=>$data['delivery_instruction']
				);
				?>
		       		       
		       <tr>
		         <td><?php echo Yii::t("default","Location Name")?></td>
		         <td class="text-right">
		         <?php 
		         if (!empty($data['location_name1'])){
		         	$data['location_name']=$data['location_name1'];
		         }
		         echo $data['location_name'];
		         ?>
		         </td>
		       </tr>
		       <?php 	       
				$print[]=array(
				  'label'=>Yii::t("default","Location Name"),
				  'value'=>$data['location_name']
				);
				?>
								
		       <tr>
		         <td><?php echo Yii::t("default","Contact Number")?></td>
		         <td class="text-right">
		         <?php 
		         if ( !empty($data['contact_phone1'])){
		         	$data['contact_phone']=$data['contact_phone1'];
		         }
		         echo $data['contact_phone'];?>
		         </td>
		       </tr>       
		       <?php 	       
				$print[]=array(
				  'label'=>Yii::t("default","Contact Number"),
				  'value'=>$data['contact_phone']
				);
				?>
				
				<?php if ($data['order_change']>=0.1):?>					
		       <tr>
		         <td><?php echo Yii::t("default","Change")?></td>
		         <td class="text-right">
		         <?php echo displayPrice( baseCurrency(), normalPrettyPrice($data['order_change']))?>
		         </td>
		       </tr>     
		       <?php 	       
				$print[]=array(
				  'label'=>Yii::t("default","Change"),
				  'value'=>normalPrettyPrice($data['order_change'])
				);
				?>
				<?php endif;?>
				
								
		   <?php else :?>   
		   
		      
				 
				 <tr>
		         <td colspan="2" class="text-center">
				<a href="javascript:;" class="print-receipt"><i class="ion-ios-printer-outline"></i></a>
				</td>
		       </tr>
	       
				 <?php endif;?>
				 
	       
	       <!-- <tr>
			 <td colspan="2"></td>
			 </tr> -->
			 
			
	       	    
	    </tbody>
	   </table>
	   </div>
		 <!-- receipt-container -->
				<p style="font-size: 18px; padding: 10px; text-align: center; background:white:">You will receive a <strong>notification</strong> when the order is accepted.</p>
	    <div class="receipt-wrap order-list-wrap">
	    <?php //echo $item_details=Yii::app()->functions->details['html'];?>
	    </div>
	   
	   </div> <!--box-grey-->
	   
   </div> <!--inner-->
    
   <?php else :?>
    <p class="text-warning"><?php echo t("Sorry but we cannot find what you are looking for.")?></p>
    <?php $order_ok=false;?>
   <?php endif;?>
    
   </div> <!--container-->
</div>  <!--section-receipt-->

<?php     
$data_raw=Yii::app()->functions->details['raw'];
if ( $apply_tax==1 && $tax_set>0){	
	$receipt=EmailTPL::salesReceiptTax($print,Yii::app()->functions->details['raw']);
} else $receipt=EmailTPL::salesReceipt($print,Yii::app()->functions->details['raw']);

$to=isset($data['email_address'])?$data['email_address']:'';

if (!isset($_SESSION['kr_receipt'])){
	$_SESSION['kr_receipt']='';
}

/*dump($receipt);
dump(Yii::app()->functions->additional_details);*/

if (!in_array($data['order_id'],(array)$_SESSION['kr_receipt'])){
	if ($order_ok==true){		
		/*SEND EMAIL TO CUSTOMER*/
		FunctionsV3::notifyCustomer($data,Yii::app()->functions->additional_details,$receipt, $to);
		FunctionsV3::notifyMerchant($data,Yii::app()->functions->additional_details,$receipt);
		FunctionsV3::notifyAdmin($data,Yii::app()->functions->additional_details,$receipt);
	
	   FunctionsV3::fastRequest(FunctionsV3::getHostURL().Yii::app()->createUrl("cron/processemail"));
	   FunctionsV3::fastRequest(FunctionsV3::getHostURL().Yii::app()->createUrl("cron/processsms"));
	   
	   // SEND FAX
       Yii::app()->functions->sendFax($merchant_id,$_GET['id']);
	}
}

$_SESSION['kr_receipt']=array($data['order_id']);
