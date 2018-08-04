
<div class="box-grey rounded" style="margin-top:0;">

<form class="profile-forms forms" id="forms" onsubmit="return false;">
<?php echo CHtml::hiddenField('action','updateClientProfile')?>
<?php echo CHtml::hiddenField('currentController','store')?>
<?php 
$p = new CHtmlPurifier();
FunctionsV3::addCsrfToken();
?>

<?php //FunctionsV3::sectionHeader('Profile');?>

<div class="field">
  <div class="field-set clearfix fieldset-border-btm">
    
  <div class="col-md-3">
      <label ><?php echo t("First Name")?></label>
      </div>
    <div class="col-md-9">
    <?php 
	  echo CHtml::textField('first_name',$p->purify($data['first_name']),
	  array(
	    'class'=>' full-width',
      'data-validation'=>"required",
      'placeholder'=>"First name"
	  ));
	  ?>     </div>
  </div>
  <div class="field-set clearfix fieldset-border-btm">
    <div class="col-md-3">
    <label ><?php echo t("Last Name")?></label>
    </div><div class="col-md-9">
	<?php 
	echo CHtml::textField('last_name', $p->purify($data['last_name']),
	array(
	'class'=>' full-width',
  'data-validation'=>"required",
  'placeholder'=>"Last name"
	));
	?></div>
  </div>
</div> <!--row-->


<div class="field">
  <div class="field-set clearfix fieldset-border-btm">
    <div class="col-md-3">
    <label ><?php echo t("Email address")?></label>
    </div><div class="col-md-9">
    <?php 
	  echo CHtml::textField('email', $p->purify($data['email_address']),
	  array(
	    'class'=>' full-width',
	    'data-validation'=>"required",
      'disabled'=>true,
      'placeholder'=>"Email id"
	  ));
	  ?>   </div>  
  </div>
  <div class="field-set clearfix fieldset-border-btm">
    <div class="col-md-3">
    <label ><?php echo t("Contact phone")?></label>
    </div><div class="col-md-9">
	 <?php 
  echo CHtml::textField('contact_phone',$p->purify($data['contact_phone']),
  array(
    'class'=>' full-width mobile_inputs',
    'data-validation'=>"required",
    'placeholder'=>"Phone"
  ));
  ?>	  </div>
  </div>
</div> <!--row-->

<?php 
$one=Yii::app()->functions->getOptionAdmin('client_custom_field_name1');
$two=Yii::app()->functions->getOptionAdmin('client_custom_field_name2');
?>

<?php if (!empty($one) || !empty($two)):?>
<div class="field">

  <?php if (!empty($one)):?>
  <div class="field-set clearfix fieldset-border-btm">
    <div class="col-md-3">
    <label ><?php echo t($one)?></label>
    </div><div class="col-md-9">
     <?php
  echo CHtml::textField('custom_field1',$p->purify($data['custom_field1']),
  array(
    'class'=>' full-width',
    'data-validation'=>"required"
    
  ));
  ?></div>
  </div>
  <?php endif;?>
  
  <?php if (!empty($two)):?>
  <div class="field-set clearfix fieldset-border-btm">
    <div class="col-md-3">
    <label ><?php echo t($two)?></label>
    </div><div class="col-md-9">
	 <?php 
  echo CHtml::textField('custom_field2',$p->purify($data['custom_field2']),
  array(
    'class'=>' full-width',
    'data-validation'=>"required"
  ));
  ?></div>
  </div>
  <?php endif;?>
  
</div> <!--row-->
<?php endif;?>




<div class="field">
  <div class="field-set clearfix fieldset-border-btm">
    <div class="col-md-3">
    <label ><?php echo t("Password")?></label>
    </div><div class="col-md-9">
  <?php 
  echo CHtml::passwordField('password','',
  array(
    'class'=>' full-width',
    'placeholder'=>"Password"
  ));
  ?></div>
  </div>
  <div class="field-set clearfix fieldset-border-btm">
    <div class="col-md-3">
    <label ><?php echo t("Confirm Password")?></label>
    </div><div class="col-md-9">
	<?php 
  echo CHtml::passwordField('cpassword','',
  array(
    'class'=>' full-width',
    'placeholder'=>"Confirm password"
  ));
  ?></div>
  </div>
</div> <!--row-->

 
  <div class="top10">
	<input type="submit" value="<?php echo t("Save")?>" class="button orange-button medium rounded full-width">  
 </div>	



</form>
</div> <!--box-->