
<?php if(is_array($menu) && count($menu)>=1):?>

<?php 
/*dump($merchant_apply_tax);
dump($merchant_tax);*/
?>

<?php foreach ($menu as $val):?>
<div class="menu-1" style="margin-top:0;">

  <div class="menu-cat meal-preview cat-<?php echo $val['category_id']?>" id="cat-<?php echo $val['category_id']?>">
     <!-- <a href="javascript:;">       
       <span class="bold">
          <i class="<?php// echo $tc==2?"ion-ios-arrow-thin-down":'ion-ios-arrow-thin-right'?>"></i>
         <?php //echo qTranslate($val['category_name'],'category_name',$val)?>
       </span>
       <b></b>
     </a> -->
          
     <?php $x=0?>
     
     <div class="items-row <?php echo $tc==2?"hide":''?>">
     
     <?php if (!empty($val['category_description'])):?>
     <p class="small f-hide">
       <?php echo qTranslate($val['category_description'],'category_description',$val)?>
     </p>
     <?php endif;?>
     <?php echo Widgets::displaySpicyIconNew($val['dish'],"dish-category")?>
     
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
        <div class="">
        <?php if(!empty($val_item['photo'])):?>
          <div class="food-thumbnail pic" style="background:url('<?php echo FunctionsV3::getFoodDefaultImage($val_item['photo'],false)?>');"></div>
        <?php endif;?>
        <div class="meal-particulars" style="<?php echo empty($val_item['photo']) ? 'padding-left:0px' : ''?>">
          <?php echo "<p class='food-item-title'>".qTranslate($val_item['item_name'],'item_name',$val_item)."</p>"?>
          <p><?php echo stripslashes($val_item['item_description'])?></p>
          <div class="food-price-wrap">
           <?php echo FunctionsV3::getItemFirstPrice($val_item['prices'],$val_item['discount'],$merchant_apply_tax,$merchant_tax) ?>
           <div class="pull-right relative food-price-wrap addto-cart <?php echo $val_item['not_available']==2?"item_not_available":''?>">
          <?php if ( $disabled_addcart==""):?>
          <a href="javascript:;" class="dsktop menu-item" 
            rel="<?php echo $val_item['item_id']?>"
            data-single="<?php echo $val_item['single_item']?>" 
            <?php echo $atts;?>
            data-category_id="<?php echo $val['category_id']?>"
           >
           <i class="ion-plus" style="color: #ffb49a; font-size:25px"></i>           
          </a>
         
          <a href="javascript:;" class="mbile menu-item" 
            rel="<?php echo $val_item['item_id']?>"
            data-single="<?php echo $val_item['single_item']?>" 
            <?php echo $atts;?>
            data-category_id="<?php echo $val['category_id']?>"
           >
           <i class="ion-plus" style="color: #ffb49a; font-size:25px"></i>           
          </a>
          <span class="soldout">Sold Out</span>
          
          <?php endif;?>
        </div>
          </div>
          </div>
          
          </div>
        
        
     </div> <!--row-->
     <?php $x++?>
     <?php endforeach;?>
    <?php else :?> 
      <p class="small text-danger f-hide"><?php echo t("no item found on this category")?></p>
     <?php endif;?>
    </div> 
    
  </div> <!--menu-cat-->

</div> <!--menu-1-->
<?php endforeach;?>

<?php else :?>
<p class="text-danger center"><?php echo t("This restaurant has not published their menu yet.")?></p>
<?php endif;?>