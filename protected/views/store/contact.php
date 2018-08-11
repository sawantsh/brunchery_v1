<?php
$this->renderPartial('/front/banner-contact',array(
   'h1'=>t("Contact Us"),
   'sub_text'=>$address." ".$country,
   'contact_phone'=>$contact_phone,
   'contact_email'=>$contact_email
));

$fields=yii::app()->functions->getOptionAdmin('contact_field');
if (!empty($fields)){
	$fields=json_decode($fields);
}
?>

<div class="sections section-contact">
  
  <div class="container contact-us bruncherry-container">

    <div class="store-topbar">
				<div class="resto-info">
					<div class="trim-text text-center"><a class="pull-left" href="/profile"><i class="ion-ios-arrow-back"></i></a> Contact us</div>
					<!-- <a href="#" class="pull-right top-right-action">Sign up</a> -->
				</div>
		</div>

     <div class="">
        <div class="row bruncherry-contact">
          
        <div class="ttl-img contact-pg"></div>

           <div class="col-md-12 ">
             <form class="uk-form uk-form-horizontal forms" id="forms" onsubmit="return false;">   
             <?php echo CHtml::hiddenField('action','contacUsSubmit')?>
             <?php echo CHtml::hiddenField('currentController','store')?>
             <?php FunctionsV3::addCsrfToken();?>
             <?php if (is_array($fields) && count($fields)>=1):?>
             <?php foreach ($fields as $val):?>
             <?php  
        $placeholder='';
        $label='';
			  $validate_default="required";
			  switch ($val) {
          case "name":
            $label="Your Name";
			  		$placeholder="Type your name here";
			  		break;
          case "email":
              $label="Leave your email address for us to get back to you";  
			  	    $placeholder="Type your email address";
			  	    $validate_default="email";
			  		break;
          case "phone":  
              $label="Your Phone number";
			  	    $placeholder="Phone";
			  		break;
          case "country": 
              $label="Your Country"; 
			  	    $placeholder="Country";
			  		break;
          case "message":  
              $label="Your Message";
			  	    $placeholder="Type your message here...";
			  		break;	  	
			  	default:
			  		break;
			  }
			 ?>			 			 			
			 <?php if ( $val=="message"):?>
             <div class="fields">
             <div class="field-set clearfix fieldset-border-btm">
               <div class="col-md-3"><?php echo t($label)?></div>
               <div class="col-md-9">
                <?php echo CHtml::textArea($val,'',array(
                  'placeholder'=>t($placeholder),
                  'class'=>'full-width'
                ))?>
               </div>
             </div>
             </div>
             <?php else :?>
             <div class="fields">
             <div class="field-set clearfix fieldset-border-btm">
             <div class="col-md-3"><?php echo t($label)?></div>
             <div class="col-md-9">
               <?php echo CHtml::textField($val,'',array(
                'placeholder'=>t($placeholder),
                'class'=>'full-width',
                'data-validation'=>$validate_default
               ))?>
             </div>  
             </div>
             </div>
             <?php endif;?>
             
             <?php endforeach;?>
             
             <div class="row top10">
             <div class="col-md-12 text-center">
                <input type="submit" value="<?php echo t("Send Email")?>" class="button orange-button medium rounded full-width">
             </div>
             </div>
             <?php endif;?>
             </form>
             
             
           </div> <!--col-->
        </div> <!--row-->
     </div> <!--inner-->
  </div> <!--container-->

</div> <!--sections-->