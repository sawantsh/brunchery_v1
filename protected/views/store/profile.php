<?php
$this->renderPartial('/front/banner-receipt',array(
   'h1'=>t("Profile"),
   'sub_text'=>t("Manage your profile,address book, credit card and more")
));
echo CHtml::hiddenField('mobile_country_code',Yii::app()->functions->getAdminCountrySet(true));
?>

<?php if(Yii::app()->functions->isClientLogin()):?>
  <div class="container section-profile relative logged-in">
<?php else: ?>
  <div class='home-backdrop profile-header'></div>
  <div class="container section-profile relative">
<?php endif; ?>


  


  <div class="row">

  <!-- avatar -->
  <div class="avatar-section">
       <div class="" style="margin-top:0;">
       
                        <!-- pane -->
                        <div class="pane clearfix profile-mast ">
                        <div class="brun-logo"></div>
                        <?php if(Yii::app()->functions->isClientLogin()):?>
                        
                          <div class="avatar-thumb">
                            <img src="<?php echo $avatar;?>" class="img-circle">
                          </div>
                          <div class="avatar-det">
                            <div class="name"><?php echo $info['first_name']." ".$info['last_name']?></div>
                            <div class="medium user-contact"><?php echo $info['contact_phone']?></div>
                          </div>
                          <div class='trim-text text-right profile-link'><a class='pull-right' href='/logout'>Logout</a></div>
                        <?php else: ?>
                          <div class='trim-text text-right profile-link'><a class='pull-right' href='/checkout?redirect=profile'>Login/Signup</a></div>
                        <?php endif; ?>
                        
                        </div>
                        <!-- pane -->
                        
                        <div class="center top10 f-hide">
                        <a href="javascript:;" id="uploadavatar"><?php echo t("Browse")?></a>          
                        </div>
                        <DIV  style="display:none;" class="uploadavatar_chart_status" >
                    <div id="percent_bar" class="uploadavatar_percent_bar"></div>
                    <div id="progress_bar" class="uploadavatar_progress_bar">
                      <div id="status_bar" class="uploadavatar_status_bar"></div>
                    </div>
                    </DIV>		  
                        
                        <div class="line-top line-bottom center f-hide">
                        <?php echo t("Update your profile picture")?>
                        </div>
                        
                        <?php if ( $info['social_strategy']=="web" && $info['social_strategy']=="google" && $info['social_strategy']=="fb"):?>
                        <div class="connected-wrap">
                          <div class=" web f-hide">
                            <div class="mycol  col-1 center">
                            <i class="ion-social-dribbble i-big"></i>
                            </div> <!--col-->
                            <div class="mycol  col-2">
                              <span class="small"><?php echo t("Connected as")?></span><br/>
                              
                            </div> <!--col-->
                          </div>
                        </div> <!--connected-wrap-->
                        <?php endif;?>
                     </div>
                  </div> <!--col-->

<!-- avatar -->
  <div class="profile-nav-content">
  
  <div class="tabs-wrapper">
     
     <?php if(Yii::app()->functions->isClientLogin()):?>
     <ul id="tabs">
       <li class="pane brun-pro">
       <span><?php echo t("Profile")?></span>
       </li> 
             
       <li class="pane brun address-book" >
         <span><?php echo t("Address")?></span>
       </li>
       
       <?php if ( $disabled_cc != "yes"):?>
       <li class="pane brun-cc" >
        <span><?php echo t("Credit Cards")?></span>
       </li>
       <?php endif;?>
       
      <?php if (FunctionsV3::hasModuleAddon("pointsprogram")) :?>
      <?php PointsProgram::frontMenu(true);?>
      <?php endif;?>
    

     </ul>
<?php endif;?>

<ul class="misc-links">
      <!-- <li class="seperator"></li> -->
      <li class="pane brun-faq">
        <a href="/page-faq">
          <i class="ion-information-circled"></i> FAQ
        </a>
      </li>
      <li class="pane brun-contact">
        <a href="/contact">
          <i class="ion-ios-email"></i> Contact Us
        </a>
        </li>
      <li class="seperator"></li>
      <li class="pane brun-partner-signup">
        <a href="/store/partner-signup">
          <i class="ion-android-hand"></i> Become a Cafe Partner  
        </a>
      </li>
      <li class="pane brun-story">
        <a href="/page-our-story">
          <i class="ion-ios-book"></i> Our Story
        </a>        
      </li>
      <li class="seperator"></li>
      <li class="pane brun-terms">
        <a href="/page-terms">
          <i class="ion-ios-eye"></i> Terms &amp; Conditions of Service
        </a>
      </li>
      <li class="pane brun-privacypolicy">
        <a href="/page-privacy-policy">
          <i class="ion-android-lock"></i> Privacy Policy
        </a>
        </li>
    </ul>

    
  </div> <!--tabs-wrapper--> 
  
      
    </div> <!--col-->
    
    
    
  </div> <!--row-->
  <!-- tab -->

 <ul id="tab" class="<?php echo isset($_GET['do']) ? "" : "f-hide" ?>">
       <li class="">
       <div class="store-topbar">
					<div class="resto-info">
						<?php echo "<div class='trim-text text-center'><a class='pull-left' href='/profile'><i class='ion-ios-arrow-back'></i></a>Profile</div>" ?>
          </div>
          </div>
          <?php $this->renderPartial('/front/profile',array(
            'data'=>$info           
          ));?>
          
       </li>
       <li class="<?php echo $tabs==2?"active":''?>">
       <div class="store-topbar">
					<div class="resto-info">
						<?php echo "<div class='trim-text text-center'><a class='pull-left' href='/profile'><i class='ion-ios-arrow-back'></i></a>Address</div>" ?>
          </div>
          </div>
		     <?php $this->renderPartial('/front/address-book',array(
            'client_id'=>Yii::app()->functions->getClientId(),
            'data'=>Yii::app()->functions->getAddressBookByID( isset($_GET['id'])?$_GET['id']:'' ),
            'tabs'=>$tabs
          ));?>
				
         
       </li>
       <?php if ( $disabled_cc != "yes"):?>
       <li class="<?php echo $tabs==4?"active":''?>" >
       <div class="store-topbar">
					<div class="resto-info">
						<?php echo "<div class='trim-text text-center'><a class='pull-left' href='/profile'><i class='ion-ios-arrow-back'></i></a>Credit Cards</div>" ?>
          </div>
          </div>
        <?php 
          if (isset($_GET['do']) && $tabs == 4){
            $this->renderPartial('/front/manage-credit-card-add',array(
              'data'=>Yii::app()->functions->getCreditCardInfo(isset($_GET['id'])?$_GET['id']:''),
              'tabs'=>$tabs
            ));
          } else {
          $this->renderPartial('/front/manage-credit-card',array(
            'tabs'=>$tabs
          ));
          }
      ?>     
      
       </li>
       <?php endif;?>
       
     </ul>
<!-- tab -->



  </div> <!--container-->  

