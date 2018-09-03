
<div class="box-grey rounded section-address-book">

<?php
$do=isset($_GET['do'])?$_GET['do']:'';
?>

<?php if ( $do==="add" && $tabs==2 ) :?>

<form id="frm-addressbook" class="frm-addressbook" onsubmit="return false;">
<?php echo CHtml::hiddenField('action','addAddressBook')?>
<?php echo CHtml::hiddenField('currentController','store')?>  
<?php if (isset($_GET['id'])):?>
<?php echo CHtml::hiddenField('id',$_GET['id'])?>
<?php else :?>
<?php /*echo CHtml::hiddenField('redirect', FunctionsV3::getHostURL().Yii::app()->createUrl('store/profile',array(
  'tab'=>2,
  'do'=>'add'
)) )*/?>
<?php endif;?>

<div class="field">
  <div class="field-set clearfix fieldset-border-btm">
    <div class="col-md-3"><label><?php echo t("Address")?></label></div>
    <div class="col-md-9">
    <?php 
	  echo CHtml::textField('street',
      isset($data['street'])?$data['street']:''
      ,array(
       'class'=>' full-width',
       'data-validation'=>"required",
       'placeholder'=>"Street address"    
      ))?>	  
      </div>
  </div>
  <div class="field-set clearfix fieldset-border-btm">
    <div class="col-md-3"><label><?php echo t("City")?></label></div>
    <div class="col-md-9">
	  <?php echo CHtml::textField('city',
  isset($data['city'])?$data['city']:''
  ,array(
   'class'=>' full-width',   
   'data-validation'=>"required", 
   'placeholder'=>"City"     
  ))?>	  
  </div>
  </div>
</div> <!--row-->


<div class="field">
  <div class="field-set clearfix fieldset-border-btm">
    <div class="col-md-3"><label><?php echo t("State")?></label></div>
    <div class="col-md-9">
    <?php echo CHtml::textField('state',
          isset($data['state'])?$data['state']:''
          ,array(
           'class'=>' full-width',           
           'data-validation'=>"required",
           'placeholder'=>"State"     
          ))?></div>
  </div>
  <div class="field-set clearfix fieldset-border-btm">
    <div class="col-md-3"><label><?php echo t("Zip code")?></label></div>
    <div class="col-md-9">
	  <?php echo CHtml::textField('zipcode',
          isset($data['state'])?$data['zipcode']:''
          ,array(
           'class'=>' full-width',           
           'data-validation'=>"required",
           'placeholder'=>"Zip code"     
          ))?></div>
  </div>
</div> <!--row-->

<?php $merchant_default_country=Yii::app()->functions->getOptionAdmin('merchant_default_country'); ?>
<div class="field">
  <div class="field-set clearfix fieldset-border-btm">
    <div class="col-md-3"><label><?php echo t("Location Name")?></label></div>
    <div class="col-md-9">
    <?php echo CHtml::textField('location_name',
          isset($data['location_name'])?$data['location_name']:''
          ,array(
           'class'=>' full-width',
           'placeholder'=>"Location"                
          ))?>
          </div>
  </div>
  <div class="field-set clearfix fieldset-border-btm">
    <div class="col-md-3"><label><?php echo t("Country")?></label></div>
    <div class="col-md-9">
	 <?php 
      echo CHtml::dropDownList('country_code',
      isset($data['country_code'])?$data['country_code']:$merchant_default_country
      ,(array)Yii::app()->functions->CountryListMerchant(),array(
        'class'=>' full-width',
        'data-validation'=>"required",
        'placeholder'=>"Country"                  
      ));
      ?>
      </div>
  </div>
</div> <!--row-->

<div class="field">
<div class="field-set clearfix fieldset-border-btm">
     <div class="col-md-3"><label><?php echo t("Make address Default"); ?></label></div>
     <div class="col-md-9">
<?php 
      echo CHtml::checkBox('as_default',
      $data['as_default']==2?true:false
      ,array('class'=>"icheck",'value'=>2));
      
      ?>
      </div>
</div>
</div>

<div class=" bottom20">
  <div class="">
  <input type="submit" value="<?php echo t("Submit")?>" class="button orange-button medium rounded full-width">
  </div>  
</div>

</form>

<?php else :?>

<form id="frm_table_list" method="POST" >
<input type="hidden" name="action" id="action" value="addressBook">
<?php echo CHtml::hiddenField('currentController','store')?>

<input type="hidden" name="tbl" id="tbl" value="address_book">
<input type="hidden" name="clear_tbl"  id="clear_tbl" value="clear_tbl">
<input type="hidden" name="whereid"  id="whereid" value="id">
<input type="hidden" name="slug" id="slug" value="store/addressbook">

<?php if (!empty($count) && $count > 0):?>
<table id="table_list" class="table table-striped">
  <thead>
  <tr>
   <th width="40%" ><?php echo Yii::t("default","Address")?></th>
   <th ><?php echo Yii::t("default","Location Name")?></th>
   <th ><?php echo Yii::t("default","Default")?></th>   
  </tr>
  </thead>
</table>  
<?php endif;?>
<div class="clear"></div>
</form>

<div class="bottom10 top10">
<i class="ion-ios-plus-outline green-color bold"></i>
<a class="green-button inline rounded" href="<?php echo Yii::app()->createUrl('store/profile',array(
  'tab'=>2,
  'do'=>'add'
))?>">
<?php echo t("Add New")?>
</a>
</div>

<?php endif;?>

</div> <!--box-grey-->