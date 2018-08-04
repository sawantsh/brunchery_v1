
<div class="sections section-order-history">

<div class="bottom10 f-hide">
<?php //echo FunctionsV3::sectionHeader('Your Recent Order');?>
</div>

<div class="container bruncherry-container section-recent-orders">
<div class="store-topbar">
    <div class="resto-info">
      <div class="trim-text text-center"><a class="pull-left" href="/profile"><i class="ion-ios-arrow-back"></i></a>Past Orders</div>
    </div>
</div>

<?php if ($data=Yii::app()->functions->clientHistyOrder(Yii::app()->functions->getClientId())):?>
<?php if (is_array($data) && count($data)>=1):?>

<?php //$payment_list=FunctionsV3::PaymentOptionList();?>
<div class="row">
  <div class="profile-nav-content">
  
  <div class="tabs-wrapper">
  <ul id="recent-orders-list">       
     <?php foreach ($data as $val):?>     
     <li class="clearfix">
        <div class="rol-col">
          <p class="brun-merchant-name"><b><?php echo clearString($val['merchant_name'])?></b></p> 
          <!-- <a href="<?php //echo Yii::app()->createUrl('/ajax/viewreceipt',array('order_id'=>$val['order_id'],'post_type'=>'get'))?>"
          class="view-receipt-mobile"  >
            <p><?php //echo t("Order")?># <?php //echo $val['order_id']?></p>
          </a> -->
          
            <p class="brun-order-date">
            <?php echo Yii::app()->functions->translateDate(prettyDate($val['date_created']))?></p>

            <p class="brun-order-total"><b><?php echo FunctionsV3::prettyPrice($val['total_w_tax'])?></b></p>
        </div>
      <div class="rol-col">
        <a class="add-to-cart" href="javascript:;" data-id="<?php echo $val['order_id']?>" ></a>
    </div>
        <!-- <td> 
        <p><?php //echo t("TOTAL")?></p>
        <p><?php //echo FunctionsV3::prettyPrice($val['total_w_tax'])?></p>         
        </td> -->
        
        <!-- <td>
          <p><?php //echo t("PAYMENT")?></p>
		  <p><?php 
		  /*if (array_key_exists($val['payment_type'],$payment_list)){  
		     echo $payment_list[$val['payment_type']];
		  } else echo $val['payment_type'];*/
		  //echo FunctionsV3::prettyPaymentTypeTrans($val['trans_type'],$val['payment_type'])
		  ?></p>
        </td> -->
        
        <!-- <td>
          <a href="javascript:;" class="view-order-history" data-id="<?php //echo $val['order_id'];?>">
          <p class="green-text top10 "><?php //echo t($val['status'])?></p>
          </a>
        </td> -->
        <div class="rol-col  text-right" style="float: right; width: 10%;">
          <a href="javascript:;" class="view-receipt-front" data-id="<?php echo $val['order_id']?>" >
            <i style="font-size: 30px;" class="ion-ios-arrow-forward"></i>
          </a>
        </div>
      </li>    
      <!-- <tr class="order-order-history show-history-<?php //echo $val['order_id']?>"> 
        <td colspan="5">
         <?php //if ( $resh=FunctionsK::orderHistory($val['order_id'])):?>     
         <table class="table table-striped" >
           <thead>
             <tr>
             <th><?php //echo t("Date/Time")?></th>
             <th><?php //echo t("Status")?></th>
             <th><?php //echo t("Remarks")?></th>
             </tr>
           </thead>
           <tbody>
           <?php //foreach ($resh as $valh):?>
           <tr style="font-size:12px;">
             <td><?php                       
              //echo FormatDateTime($valh['date_created'],true);
              ?></td>
             <td><?php //echo t($valh['status'])?></td>
             <td><?php //echo $valh['remarks']?></td>
           </tr>
           <?php //endforeach;?>
         </tbody>
         </table>
         <?php //else :?>
         <p class="text-danger small-text"><?php //echo t("No history found")?></p>
         <?php //endif;?>
        </td>
      </tr>       -->
      
      <?php endforeach;?>
    </ul>
    </div>
    </div>
    </div>
<?php else :?>
  <h1>No orders found</h1>
   <p class="text-danger"><?php echo t("No order history")?></p>
<?php endif;?>
<?php else :?>
      <div class="no-orders-page">
        <h4>No orders found</h4>
        <p class="text-danger"><?php echo t("No order history, you may need to log in to see.")?></p>
      </div>
<?php endif;?>

</div> <!--box-grey-->
</div>