
<?php if(is_array($menu) && count($menu)>=1):?>
<?php foreach ($menu as $val): //dump($val);?>
<?php if(is_array($val['item'])!=0):?>
<!--category-menu-items-->
<div class="category-menu-items">
<div class="section-label menu-cat cat-<?php echo $val['category_id']?>">
    <a class="section-label-a">
      <span class="bold">
      <?php echo qTranslate($val['category_name'],'category_name',$val)?>
      </span>
      <b></b>
    </a>     
</div>    
<?php if (!empty($val['category_description'])):?>
<!--<p class="small"><?php //echo $val['category_description']?></p>-->
<!-- <p class="small"><?php //echo qTranslate($val['category_description'],'category_description',$val)?></p> -->
<?php endif;?>
<?php echo Widgets::displaySpicyIconNew($val['dish'],"dish-category")?>

<div class="menu-2 border meal-preview">

<?php $x=0?>
<?php if (is_array($val['item']) && count($val['item'])>=1):?>
<?php foreach ($val['item'] as $val_item):?>

<?php 
$atts='';
if ( $val_item['single_item']==2){
	  $atts.='data-price="'.$val_item['single_details']['price'].'"';
	  $atts.=" ";
	  $atts.='data-size="'.$val_item['single_details']['size'].'"';
}
?> 

<div class="meal-info">
   <div class="meal-details">
     <div class="food-thumbnail pic" 
        style="background:url('<?php echo FunctionsV3::getFoodDefaultImage($val_item['photo'],false)?>');">       
     </div>
     <div class="meal-particulars">
     <p class="meal-title"><?php echo qTranslate($val_item['item_name'],'item_name',$val_item)?></p>
     <p class="food-description">
     <?php echo qTranslate($val_item['item_description'],'item_description',$val_item)?>
     </p>
     <?php 
     if (strlen($val_item['item_description'])<59){
        echo '<div class="dummy-link"></div>';
     }
     ?>
     
     <?php if ( $disabled_addcart==""):?>
     <div class="top10 food-price-wrap">
     <a href="javascript:;" 
     class="dsktop orange-button inline rounded3 menu-item <?php echo $val_item['not_available']==2?"item_not_available":''?>"
     rel="<?php echo $val_item['item_id']?>"
     data-single="<?php echo $val_item['single_item']?>" 
     <?php echo $atts;?>
     data-category_id="<?php echo $val['category_id']?>"
      >
     <?php echo FunctionsV3::getItemFirstPrice($val_item['prices'],$val_item['discount']) ?>
     </a>
     
     <a href="javascript:;" 
     class="mbile orange-button inline rounded3 menu-item <?php echo $val_item['not_available']==2?"item_not_available":''?>"
     rel="<?php echo $val_item['item_id']?>"
     data-single="<?php echo $val_item['single_item']?>" 
     <?php echo $atts;?>
     data-category_id="<?php echo $val['category_id']?>"
      >
     <?php echo FunctionsV3::getItemFirstPrice($val_item['prices'],$val_item['discount']) ?>
     </a>
    
     </div>
     </div>
     <?php endif;?>
     
   </div> <!--box-grey-->
</div> <!--col-->
<?php endforeach;?>
<?php else :?>
<div class="col-md-6 border">
<p class="small text-danger"><?php echo t("no item found on this category")?></p>
</div>
<?php endif;?>
</div> 
<!--row-->
</div>
<!--category-menu-items-->
<?php endif;?>
<?php endforeach;?>

<?php else :?>
<p class="text-danger center"><?php echo t("This restaurant has not published their menu yet.")?></p>
<?php endif;?>