
<?php if(is_array($menu) && count($menu)>=1):?>
<div class="category">
<?php foreach ($menu as $val):?>

<?php if(is_array($val['item'])!=0):?>
 <a href="#cat-<?php echo $val['category_id']?>" 
    class="category-child relative goto-category <?php echo $menu[0]['category_id'] == $val['category_id'] ? 'active' :''?>" 
    data-id="cat-<?php echo $val['category_id']?>" >
  <?php echo qTranslate($val['category_name'],'category_name',$val)?>
 </a>
 <?php endif;?>
<?php endforeach;?>
</div>
<?php endif;?>