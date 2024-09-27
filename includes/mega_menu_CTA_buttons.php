<?php
/*
    Template For displaying Mega Menu CTA buttons
*/
$mega_menu_cta_buttons = get_field('mega_menu_cta_buttons','option');
?>
<div class="button-wrapper ast-col-md-12">
    <?php
        foreach($mega_menu_cta_buttons as $index=>$cta_button):
            $button_text = $cta_button['button_text'];
            $button_link = $cta_button['button_link'];
            $button_icon = $cta_button['button_icon'];
    ?>
        <a href="<?php echo $button_link?>" class=" btn-outline t">
            <?php echo $button_text;
            if(!empty($button_icon)):
            ?> 
                <img src="<?php echo $button_icon?>" alt="" class="ml-1 btn-img">
            <?php
            else:
            ?>
            <i class="ml-1 fa fa-angle-right"></i>
            <?php 
            endif;
            ?>
        </a>
    <?php
        endforeach;
    ?>
</div>