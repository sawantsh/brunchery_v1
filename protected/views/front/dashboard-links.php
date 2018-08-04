<?php if ($links=FunctionsV3::getDashboardLinks()):?>
<div class="links-slider home-hero">
<?php foreach ($links as $link):?>
    <a href="<?php echo $link['link']?>" target="_blank">
        <img class="logo-small" src="<?php echo FunctionsV3::getDashboardLinkImage($link['photo']);?>">
    </a>
<?php endforeach;?>
</div>
<script type="text/javascript">
jQuery(document).ready(function() {
	jQuery('.links-slider').slick({
        dots: true,
        pauseOnHover: true,
        autoplay: true,
        arrows: true,
        nextArrow: '<i class="ion-ios-arrow-forward slide-next">',
        prevArrow: '<i class="ion-ios-arrow-back slide-back">',
    });
});
</script>
<?php endif;?>