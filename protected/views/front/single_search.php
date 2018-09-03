
<div class="search-wraps single-search store-topbar">

  <h1 class="f-hide"><?php // echo t($home_search_text);?></h1>
  <p class="f-hide"><?php  //echo t($home_search_subtext);?></p>
    
  <!-- <form method="GET" class="forms-search" id="forms-search" action="<?php //echo Yii::app()->createUrl('store/searcharea')?>"> -->
  <form method="GET" class="forms-search" id="forms-search">
  <!-- <form method="GET" class="forms-search" id="forms-search" action="#"> -->
  <div class="search-input-wraps">
     <div class="row">
      <div class="col-md-10 col-sm-9 col-xs-9 relative search-textbox">
          <?php echo CHtml::textField('s',$kr_search_adrress,array(
          'placeholder'=>$placholder_search,
          // 'required'=>true
          ))?> 
        <button type="submit" class="bruncherry-search"></button>                
        </div>        
        <div class="col-md-2  col-sm-2 col-xs-2 relative search-settings-holder">
          <a href="http://www.brunchery.melbourne" target="_blank" class="mel-home">
            <i class="ion-home"></i>
          </a>   
          <a href="#" class="search-settings">
            <i class="ion-ios-settings"></i>
          </a>         
        </div>
     </div>
  </div> <!--search-input-wrap-->
  <!-- </form> -->
  <!-- search-filters -->
  <div class="search-filters">
  <div class="border search-left-content" id="">
       
       
       <div class="filter-wrap clearfix rounded2 <?php echo $enabled_search_map==""?"no-marin-top":""; ?>">
                             
          <!--FILTER DELIVERY -->
          <?php if (!empty($filter_delivery_type)):?>                      
          <a href="<?php echo FunctionsV3::clearSearchParams('filter_delivery_type')?>">[<?php echo t("Clear")?>]</a>
          <?php endif;?>
          <?php if ( $services=Yii::app()->functions->Services() ):?>
          <div class="filter-box col-md-3">
            <a href="javascript:;">	             
              <span>
              <!-- <i class="<?php //echo $fc==2?"ion-ios-arrow-thin-down":'ion-ios-arrow-thin-right'?>"></i> -->
              <?php echo t("Dine in or Dash out")?>
              </span>   
              <b></b>
            </a>
            <ul class="<?php echo $fc==2?"hide":''?>">
              <?php foreach ($services as $key=> $val):?>
              <li>	           	              
              <?php 
               echo CHtml::radioButton('filter_delivery_type[]',
               in_array($key,(array)$_GET['filter_delivery_type'])?true:false
               ,array(
               'value'=>$key,
               'class'=>" icheck filter_delivery_type"
               ));
            //   echo CHtml::radioButton('filter_delivery_type',
            //   $filter_delivery_type==$key?true:false
            //   ,array(
            //  'value'=>$key,
            //  'class'=>" filter_delivery_type icheck"
            //  ));
             ?>
             <?php echo "<span class='filter-val'>".$val."</span>";?>   
               </li>
              <?php endforeach;?> 
            </ul>
          </div> <!--filter-box-->
          <?php endif;?>
          <!--END FILTER DELIVERY -->
          
          <!--FILTER CUISINE-->
          <?php if (!empty($filter_cuisine)):?>                      
          <a href="<?php echo FunctionsV3::clearSearchParams('filter_cuisine')?>">[<?php echo t("Clear")?>]</a>
          <?php endif;?>
          <?php if ( $cuisine=Yii::app()->functions->Cuisine(false)):?>
          <div class="filter-box col-md-9">
            <a href="javascript:;">	             
              <span>
              <!-- <i class="<?php //echo $fc==2?"ion-ios-arrow-thin-down":'ion-ios-arrow-thin-right'?>"></i> -->
              <?php echo t("Cuisines")?>
              </span>   
              <b></b>
            </a>
             <ul class="<?php echo $fc==2?"hide":''?>">
              <?php foreach ($cuisine as $val): ?>
               <li class="col-md-4">
              <?php 
              $cuisine_json['cuisine_name_trans']=!empty($val['cuisine_name_trans'])?
            json_decode($val['cuisine_name_trans'],true):'';
            
              echo CHtml::checkBox('filter_cuisine[]',
              in_array($val['cuisine_id'],(array)$_GET['filter_cuisine'])?true:false
              ,array(
              'value'=>$val['cuisine_id'],
              'class'=>"icheck filter_cuisine"
              ));
             ?>
               <?php echo "<span class='filter-val'>".qTranslate($val['cuisine_name'],'cuisine_name',$cuisine_json)."</span>" ?>
               </li>
              <?php endforeach;?> 
            </ul>
          </div> <!--filter-box-->
          <?php endif;?>
          <!--END FILTER CUISINE-->
          <div>
              <input type="submit" value="Apply" class="orange-button" />
              <input type="reset" value="Clear" class="reset-frm" onclick="resetForm()"/>
          </div>
       </div> <!--filter-wrap-->
       
    </div> <!--col search-left-content-->
  </div>
  <script type="text/javascript">
    function resetForm() {
      sessionStorage.removeItem('filter_cuisine', 'filter_delivery_type');
      $(".search-filters").find('.icheckbox_minimal').each(function() {
          $(this).removeClass('checked');
      });
      window.location.href="/";
    }
</script>
<!-- search-filters -->
</div> <!--search-wrapper-->
