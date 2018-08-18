

<form class="uk-form uk-form-horizontal forms" id="forms">
<?php echo CHtml::hiddenField('action','partnerSignupSettings')?>


<div class="uk-form-row">
  <label class="uk-form-label"><?php echo Yii::t('default',"Partner Signup Content")?></label>  
  <?php echo CHtml::textArea("partner_signup_email_tpl_content",yii::app()->functions->getOptionAdmin('partner_signup_email_tpl_content'),
array(
'id'=>'partner_signup_email_tpl_content',
'class'=>"uk-form-width-large",
))?>
</div>

<div class="uk-form-row">
<label class="uk-form-label"><?php echo Yii::t('default',"Subject")?></label>  
<?php echo CHtml::textField("partner_signup_email_subject",yii::app()->functions->getOptionAdmin('partner_signup_email_subject'),
array(
'class'=>"uk-form-width-large",
'placeholder'=>Yii::t("default","Subject line")
))?>
</div>

<div class="uk-form-row">
<label class="uk-form-label"><?php echo Yii::t('default',"Send To")?></label>  
<?php echo CHtml::textField("partner_signup_admin_email",yii::app()->functions->getOptionAdmin('partner_signup_admin_email'),
array(
'class'=>"uk-form-width-large",
'placeholder'=>Yii::t("default","Email address")
))?>
</div>


<div class="uk-form-row">
<label class="uk-form-label"></label>
<input type="submit" value="<?php echo Yii::t("default","Save")?>" class="uk-button uk-form-width-medium uk-button-success">
</div>

</form>