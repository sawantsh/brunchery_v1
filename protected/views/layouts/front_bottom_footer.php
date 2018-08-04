
<?php if ( getOptionA('disabled_subscription') == ""):?>
<form method="POST" id="frm-subscribe" class="frm-subscribe f-hide" onsubmit="return false;">
<?php echo CHtml::hiddenField('action','subscribeNewsletter')?>
<div class="sections section-subcribe">
  <div class="container">
      <h2><?php echo t("Subscribe to our newsletter") ?></h2>
      <div class="subscribe-footer">
          <div class="row border">
             <div class="col-md-3 border col-md-offset-4 ">
               <?php echo CHtml::textField('subscriber_email','',array(
                 'placeholder'=>t("E-mail"),
                 'required'=>true,
                 'class'=>"email"
               ))?>
             </div>
             <div class="col-md-2 border">
               <button class="green-button rounded">
                <?php echo t("Subscribe")?>
               </button>               
             </div>
          </div>
      </div>
  </div>
  

<img src="<?php echo assetsURL()."/images/divider.png"?>" class="footer-divider">
  
</div> <!--section-browse-resto-->
</form>
<?php endif;?>


<div class="sections section-footer f-hide">
  <div class="container">
      <div class="row">
         <div class="col-md-4 ">
     
         
         </div> <!--col-->
         
      </div> <!--row-->
  </div> <!--container-->
</div> <!--section-footer-->