<?php
$this->renderPartial('/front/default-header',array(
   'h1'=>t("Checkout"),
   'sub_text'=>t("login to your account")
));?>

<?php 
$this->renderPartial('/front/order-progress-bar',array(
   'step'=>isset($step)?$step:4,
   'show_bar'=>true
));

echo CHtml::hiddenField('mobile_country_code',Yii::app()->functions->getAdminCountrySet(true));
?>

<div class="sections section-checkout">

<div class="container login-signups">

		<div class="store-topbar">
				<div class="resto-info">
					<div class="trim-text text-center"><a class="pull-left" href="/"><i class="ion-ios-arrow-back"></i></a> Log in</div>
					<!-- <a href="#" class="pull-right top-right-action">Sign up</a> -->
				</div>
		</div>

		<!--bruncherry-login-->		
  <div class="row bruncherry-login ">
		
  <div class="bruncherry-branding">
	  <img src="/assets/images/bruncherry-logo.png" alt="">
		<h1>BRUNCHERRY</h1>	
		<p>Dine In or Dash Out</p>
  </div>
	
	  <div class="login-variant">


	     
		  <form id="forms" class="forms" method="POST">
         <?php echo CHtml::hiddenField('action','clientLogin')?>
         <?php echo CHtml::hiddenField('currentController','store')?>
         <?php echo CHtml::hiddenField('redirect', Yii::app()->createUrl('/store/'.$_GET['redirect']) )?>
         <?php FunctionsV3::addCsrfToken(false);?>
					
				 <div class="default-login">
         <div class="fields">
		  <div class="field-set clearfix fieldset-border-btm">
		     <div class="col-md-3 ">
		     	<label>Username</label>
				 </div>
				 <div class="col-md-9">
				 <?php echo CHtml::textField('username','',
                array('placeholder'=>t("Mobile number or email"),
               'required'=>true
							 ))?>
				 </div>
		  </div> <!--row-->
		  
		  <div class="field-set clearfix">
			<div class="col-md-3 ">
		     	<label>Password</label>
				 </div>
		     <div class="col-md-9 ">
		     <?php echo CHtml::passwordField('password','',
                array('placeholder'=>t("Password"),
               'required'=>true
               ))?>
		     </div>
			</div> <!--row-->	 
			</div> 
			<div class="top15">
			<input type="submit" value="<?php echo t("Login")?>" class="button orange-button medium rounded full-width">
			</div>
			<div class="top15">		   		   
		     <a href="javascript:;" class="forgot-pass-link2 block text-center">
			     <?php echo t("Forgot Password");?> <i class="ion-help"></i>
		     </a>      
			</div>
			<h3>Don't have an Account? <a href="#bruncherry-sign-up" class="show-user-sign-up">Sign Up?</a></h3>
			</div>
			<div class="social-login">
			
			<div class="login-with-social">
							<a href="javascript:fbcheckLogin();" class="fb-button medium rounded">
							<i class="ion-social-facebook"></i><?php echo t("Login with Facebook")?>
							</a> 
						
						
						
							<div class="top10"><a href="<?php echo Yii::app()->createUrl('/store/googleLogin')?>" class="google-button  medium rounded">
								<i class="ion-social-googleplus-outline"></i><?php echo t("Login with Google")?>
							</a> </div>
							
						
						
						
          </div>

			</div>
		  
		 <?php if ($captcha_customer_login==2):?>
           <div class="top10">
             <div id="kapcha-1"></div>
           </div>
          <?php endif;?>  
	  		  
		</form>  		  		
		  
 <!--box-grey-->  
		
		
		<form id="frm-modal-forgotpass" class="frm-modal-forgotpass" method="POST" onsubmit="return false;" >
		<?php echo CHtml::hiddenField('action','forgotPassword')?>
		<?php echo CHtml::hiddenField('do-action', isset($_GET['do-action'])?$_GET['do-action']:'' )?>     
		<div class="section-forgotpass">
		    <div class="box-grey rounded">      
			  <div class="section-label bottom20">
			    <a class="section-label-a">
			       <i class="ion-unlocked i-big"></i>
			      <span class="bold" style="background:#fff;">
			      <?php echo t("Forgot Password")?></span>
			      <b></b>
			    </a>     
			  </div>    
			  
			   <div class="row top15">
		        <div class="col-md-12 ">
			     <?php echo CHtml::textField('username-email','',
	                array('class'=>'grey-fields',
	                'placeholder'=>t("Email address"),
	               'required'=>true
	               ))?>
			     </div>
			  </div> <!--row-->	
			  
			   <div class="row top10">		   		   
			   <div class="col-md-6 ">
			     <a href="javascript:;" class="back-link block orange-text text-center">
			     <?php echo t("Close");?>
			     </a>      
			   </div>
			   <div class="col-md-6 ">
			     <input type="submit" value="<?php echo t("Retrieve Password")?>" class="green-button medium full-width">
			   </div>
			  </div>  
		  
		  </div> <!--box-grey-->
		</div> <!--section-forgotpass-->
		</form>
		
	  
		</div><!--col-->
		</div> <!--row-->
	  <!--bruncherry-login-->
		<!--bruncherry-sign-up-->
		<div class="bruncherry-sign-up f-hide" id="bruncherry-sign-up">
		
	  <div class="">
	  	    
	    <div class="">      
	    
	    <form id="form-signup" class="form-signup uk-panel uk-panel-box uk-form" method="POST">
	     <?php echo CHtml::hiddenField('action','clientRegistration')?>
        <?php echo CHtml::hiddenField('currentController','store')?>
         <?php echo CHtml::hiddenField('redirect',Yii::app()->createUrl('/store/'.$_GET['redirect']))?>
         <?php FunctionsV3::addCsrfToken(false);?>
		<?php 
		$verification=Yii::app()->functions->getOptionAdmin("website_enabled_mobile_verification");	    
		if ( $verification=="yes"){
		    echo CHtml::hiddenField('verification',$verification);
		}
		if (getOptionA('theme_enabled_email_verification')==2){
	     	echo CHtml::hiddenField('theme_enabled_email_verification',2);
	    }
		?>
        
	    <!-- <?php //if ( $disabled_guest_checkout!="yes"):?>
		  <div class="section-label bottom20">
		    <a class="section-label-a">
		       <i class="ion-android-contact i-big green-color"></i>
		      <span class="bold" style="background:#fff;">
		      <?php //echo t("Guest Checkout")?></span>
		      <b></b>
		    </a>     
		  </div>    
		  
		  <p style="margin-bottom:0;">
		  <?php //echo t("Proceed to checkout, and you will have an option to create an account at the end.")?>
		  </p>
		  <a href="<?php //echo $this->createUrl('/store/guestcheckout');?>" 
	               class="text-center block orange-text bottom20"><?php //echo t("Continue as guest")?></a>
		  <?php //endif;?> -->
		  
		  <div class="section-label bottom20 center ">
		      <?php echo "<strong>".t("Sign up")."</strong>"?>
		  </div>    
		  
		   <div class="top10 fields">
		     <div class="field-set fieldset-border-btm">
		     <?php echo CHtml::textField('first_name','',
                array('class'=>'',
                'placeholder'=>t("First Name"),
               'required'=>true               
               ))?>
		     </div>
		  </div> <!--row-->	  
		  
		  <div class="top10 fields">
		     <div class="field-set  fieldset-border-btm ">
		     <?php echo CHtml::textField('last_name','',
                array('class'=>'',
                'placeholder'=>t("Last Name"),
               'required'=>true
               ))?>
		     </div>
		  </div> <!--row-->	  
		  
		  <div class="fields top10">
		     <div class="field-set fieldset-border-btm ">
		     <?php echo CHtml::textField('contact_phone','',
                array('class'=>' mobile_inputs',
                'placeholder'=>t("Mobile"),
               'required'=>true
               ))?>
		     </div>
		  </div> <!--row-->	  
		  
		 <div class="fields top10">
		     <div class="field-set  fieldset-border-btm ">
		     <?php echo CHtml::textField('email_address','',
                array('class'=>'',
                'placeholder'=>t("Email address"),
               'required'=>true
               ))?>
		     </div>
		  </div> <!--row-->	   
		  
		  <div class="fields top10">
		     <div class="field-set  fieldset-border-btm ">
		     <?php echo CHtml::passwordField('password','',
                array('class'=>'',
                'placeholder'=>t("Password"),
               'required'=>true
               ))?>
		     </div>
		  </div> <!--row-->	   
		 
		  <div class="fields top10">
		     <div class="field-set ">
		     <?php echo CHtml::passwordField('cpassword','',
                array('class'=>'',
                'placeholder'=>t("Confirm Password"),
               'required'=>true
               ))?>
		     </div>
		  </div> <!--row-->	     
		  		 
		 <?php 
         $FunctionsK=new FunctionsK();
         $FunctionsK->clientRegistrationCustomFields();
         ?>  
		  
		 <?php if ($captcha_customer_signup==2):?>
           <div class="top10">
             <div id="kapcha-2"></div>
           </div>
         <?php endif;?> 
           
         <p class="text-muted">
          <?php echo Yii::t("default","By creating an account, you agree to receive sms from vendor.")?>
         </p>  
         
        <?php if ($terms_customer=="yes"): ?> 
         <div class="row">
           <div class="col-md-1">
           <?php 
		    echo CHtml::checkBox('terms_n_condition',false,array(
		     'value'=>2,
		     'class'=>"icheck",
		     'required'=>true
		   ));?>
           </div>
           <div class="col-md-11 text-left">
           <?php 
           echo " ". t("I Agree To")." <a href=\"$terms_customer_url\" target=\"_blank\">".t("The Terms & Conditions")."</a>";
            ?>
           </div>
         </div>
         <?php endif;;?>
         
         <div class="top10">
         <div class="">
          <input type="submit" value="<?php echo t("Create Account")?>" class="orange-button medium block full-width">
          </div>
         </div>
		  
		</form> 
		</div> <!--box-grey-->  
	  
	  
		</div> 
		</div>
	  <!--bruncherry-sign-up-->
	  
   

</div> <!--container-->

</div> <!--section-grey-->

