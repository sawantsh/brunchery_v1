
<div class="box-grey rounded">

<form class="krms-forms" id="frm-cc"  onsubmit="return false;">
<?php echo CHtml::hiddenField('action','updateClientCC')?>
<?php 
if (isset($data['cc_id'])){
	echo CHtml::hiddenField('cc_id', $data['cc_id']);
}
?>

<div class="field">
  <div class="field-set clearfix fieldset-border-btm">
    <div class="col-md-3"><label><?php echo t("Card name")?></label></div>
    <div class="col-md-9">
    <?php 
	  echo CHtml::textField('card_name',isset($data['card_name'])?$data['card_name']:'',
	  array(
	    'class'=>' full-width',
      'data-validation'=>"required",
      'placeholder'=>"Card Name"
	  ));
	  ?>     
  </div>
  </div>
  
  <div class="field-set clearfix fieldset-border-btm">
    <div class="col-md-3"><label><?php echo t("Credit Card Number")?></label></div>
    <div class="col-md-9">
	<?php 
	echo CHtml::textField('credit_card_number',
	isset($data['credit_card_number'])?$data['credit_card_number']:''
	,
	array(
	'class'=>' full-width numeric_only',
	'data-validation'=>"required",
  'maxlength'=>16,
  'placeholder'=>"Card Number"
	));
	?>
  </div>
</div> <!--row-->


<div class="field">
  <div class="field-set clearfix fieldset-border-btm">
    <div class="col-md-3"><label><?php echo t("Exp. month")?></label></div><div class="col-md-9">
    <?php echo CHtml::dropDownList('expiration_month',
      isset($data['expiration_month'])?$data['expiration_month']:''
     , 
      Yii::app()->functions->ccExpirationMonth()
      ,array(
       'class'=>' full-width',
       'placeholder'=>Yii::t("default","Exp. month"),
       'data-validation'=>"required",
       'placeholder'=>"Expiration month"  
      ))?>
      </div>
  </div>
  <div class="field-set clearfix fieldset-border-btm">
    <div class="col-md-3"><label><?php echo t("Exp. year")?></label></div>
    <div class="col-md-9">
   <?php echo CHtml::dropDownList('expiration_yr',
   isset($data['expiration_yr'])?$data['expiration_yr']:''
   ,
      Yii::app()->functions->ccExpirationYear()
      ,array(
       'class'=>' full-width',
       'placeholder'=>Yii::t("default","Exp. year") ,
       'data-validation'=>"required" ,
       'placeholder'=>"Expiration year"  
      ))?>
  </div>
</div> <!--row-->

<div class="field">
  <div class="field-set clearfix fieldset-border-btm">
    <div class="col-md-3"><label><?php echo t("Billing Address")?></label></div>
    <div class="col-md-9">
    <?php 
	  echo CHtml::textField('billing_address',isset($data['billing_address'])?$data['billing_address']:'',
	  array(
	    'class'=>' full-width',
      'data-validation'=>"required",
      'placeholder'=>"Billing address"  
	  ));
	  ?>     
  </div>
  </div>
  <div class="field-set">
    <div class="col-md-3"><label><?php echo t("CVV")?></label></div>
    <div class="col-md-9">
	<?php 
	echo CHtml::textField('cvv',
	isset($data['cvv'])?$data['cvv']:''
	,
	array(
	'class'=>' full-width',
  'data-validation'=>"required",
  'placeholder'=>"CVV"
	));
	?>
  </div>
</div> <!--row-->


<div class="top10">
  <div class="">  
  <button type="submit" class="krms-forms-btn button orange-button medium rounded full-width"><?php echo t("Save")?></button>
  </div>
</div>

</form>
</div> <!--box-->