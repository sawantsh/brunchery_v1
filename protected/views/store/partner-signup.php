<div class="sections partner-signup">

  <div class="container bruncherry-container section-partner-signup">
  <div class="store-topbar">
					<div class="resto-info">
						<div class="trim-text text-center"><a class="pull-left" href="/profile"><i class="ion-ios-arrow-back"></i></a>Partner With Us</div>          </div>
          </div>
  <div class="row " style="background-color: #fff">  
    <div class="ttl-img prtnr-pg"></div>
    <div class="" style="padding-bottom: 70px;">
   
    <form class="forms" id="forms" onsubmit="return false;">
    <?php echo CHtml::hiddenField('action','partnerSignupSubmit')?>
	  <?php echo CHtml::hiddenField('currentController','store')?>
	  <?php FunctionsV3::addCsrfToken();?>

    <div class="partner-photo clearfix">
      <div class="relative">
        <h4 class="rgt-border" >Your Premier Food Photo (Optional)</h4>
        <div id="photouploader">
        <a href="javascript:;" id="uploadpartnerphoto">Browse</a> 
          <DIV  style="display:none;" class="uploadpartnerphoto_chart_status" >
            <div id="percent_bar" class="uploadpartnerphoto_percent_bar"></div>
            <div id="progress_bar" class="uploadpartnerphoto_progress_bar">
              <div id="status_bar" class="uploadpartnerphoto_status_bar"></div>
            </div>
          </DIV>
        </div>
        <div class="partner-photo-img center top10" style="width: 200px; height: 200px; border: 4px dashed #b5b5b5">
        </div>
      </div>
    </div>
    <div class="partner-basics clearfix">
   <div class="relative">
    <h4 class="rgt-border" >The Basics</h4>
      <div class="field">
      <div class="field-set clearfix fieldset-border-btm">
        <div class="col-md-3"><label><?php echo t("Name")?></label></div>
        <div class="col-md-8 ">
             <?php echo CHtml::textField('partner_rest_name',
			  ""
			  ,array(
			  'class'=>' full-width',
        'data-validation'=>"required",
        'placeholder'=>"Enter store name"
			  ))?>
        </div>
      </div>
      </div>
            
      <div class="field">
      <div class="field-set clearfix fieldset-border-btm">
        <div class="col-md-3"><label><?php echo t("Phone")?></label></div>
        <div class="col-md-8">
         <?php echo CHtml::textField('partner_rest_phone',
		  ""
		  ,array(
      'class'=>' full-width',
      'placeholder'=>"Enter store phone number"
		  ))?>    
        </div>
      </div>
      </div>
      
      <div class="field">
      <div class="field-set clearfix fieldset-border-btm">
        <div class="col-md-3"><label><?php echo t("City")?></label></div>
        <div class="col-md-9">
		  <?php echo CHtml::textField('partner_rest_city',
		  ""
		  ,array(
		  'class'=>' full-width',
      'data-validation'=>"required",
      'placeholder'=>"Enter store city"
		  ))?>           
        </div>
      </div>
      </div>

      <div class="field">
      <div class="field-set clearfix fieldset-border-btm">
        <div class="col-md-3"><label><?php echo t("State/Region")?></label></div>
        <div class="col-md-9">
		  <?php echo CHtml::textField('partner_rest_state',
		  ""
		  ,array(
		  'class'=>' full-width',
      'data-validation'=>"required",
      'placeholder'=>"Enter store state"
		  ))?>           
        </div>
      </div>
      </div>

      <div class="field">
      <div class="field-set clearfix fieldset-border-btm">
        <div class="col-md-3"><label><?php echo t("Street address")?></label></div>
        <div class="col-md-8">
		  <?php echo CHtml::textField('partner_rest_address',
		  ""
		  ,array(
		  'class'=>' full-width',
      'data-validation'=>"required",
      'placeholder'=>"Enter store address"
		  ))?>           
        </div>
      </div>
      </div>
      
      <div class="field">
      <div class="field-set clearfix fieldset-border-btm">
        <div class="col-md-3"><label><?php echo t("Post code/Zip code")?></label></div>
        <div class="col-md-9">
		  <?php echo CHtml::textField('partner_rest_post_code',
		  ""
		  ,array(
		  'class'=>' full-width',
      'data-validation'=>"required",
      'placeholder'=>"Enter store postal code"
		  ))?>           
        </div>
      </div>
      </div>
      
      <div class="field">
      <div class="field-set clearfix fieldset-border-btm">
        <div class="col-md-3"><label><?php echo t("Country")?></label></div>
        <div class="col-md-9">
		  <?php echo CHtml::dropDownList('partner_rest_country',
		  getOptionA('merchant_default_country'),
		  (array)Yii::app()->functions->CountryListMerchant(),          
		  array(
		  'class'=>' full-width',
      'data-validation'=>"required",
      'placeholder'=>"Enter store country"
		  ))?>           
        </div>
      </div>
      </div>
    </div>
    </div>

     <div class="partner-website clearfix">
      <div class="relative">
      <h4 class="rgt-border" >Website (Optional)</h4>
      <div class="field">
        <div class="field-set clearfix fieldset-border-btm">
          <div class="col-md-3"><label><?php echo t("Link")?></label></div>
          <div class="col-md-9">
            <?php echo CHtml::textField('partner_rest_website',
            ""
            ,array(
            'class'=>' full-width',
            'placeholder'=>"Enter link to website or social media page"
            ))?>           
          </div>
        </div>
      </div>
    </div>
    </div>

    <div class="partner-about-you clearfix">
      <div class="relative">
      <h4 class="rgt-border" >About You</h4>
      <div class="field">
        <div class="field-set clearfix fieldset-border-btm">
          <div class="col-md-3"><label><?php echo t("Contact name")?></label></div>
          <div class="col-md-9">
            <?php echo CHtml::textField('partner_name',
            ""
            ,array(
            'class'=>' full-width',
            'data-validation'=>"required",
            'placeholder'=>"Enter owner's full name"
            ))?>           
          </div>
        </div>
      </div>
      
      <div class="field">
      <div class="field-set clearfix fieldset-border-btm">
        <div class="col-md-3"><label><?php echo t("Contact phone")?></label></div>
        <div class="col-md-9">
		  <?php echo CHtml::textField('partner_phone',
		  ""
		  ,array(
		  'class'=>' full-width mobile_inputs',
      'data-validation'=>"required",
      'placeholder'=>"Enter owner's best contact number"
		  ))?>           
        </div>
      </div>
      </div>
      
      <div class="field">
      <div class="field-set clearfix fieldset-border-btm">
        <div class="col-md-3"><label><?php echo t("Contact email")?></label></div>
        <div class="col-md-9">
		  <?php echo CHtml::textField('partner_email',
		  ""
		  ,array(
		  'class'=>' full-width',
      'data-validation'=>"email",
      'placeholder'=>"Enter owner's email"
		  ))?>           
        </div>
      </div> 
      </div> 
    </div>
    </div> 
      
      <!-- 3 -->  
      <?php if ($kapcha_enabled==2):?>      
      <div class="top10 capcha-wrapper">        
        <div id="kapcha-1"></div>
      </div>
      <?php endif;?>
      <!-- /3 -->  
      
      <div class="top10">
        
        <div class="">
          <input type="submit" value="<?php echo t("Send Email")?>" class="button orange-button medium rounded full-width">
        </div>

      
      </form>
    </div> <!--box-grey-->
    
   <!--col-->   
   </div> <!--row--> 
  </div> <!--container-->  
</div> <!--sections-->