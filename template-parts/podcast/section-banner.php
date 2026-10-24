<?php 
    $banner_title       = get_field('banner_title');
    $banner_subtitle    = get_field('banner_subtitle');
    $banner_cta_text    = get_field('banner_cta_text');
    $banner_cta_link    = get_field('banner_cta_link');
    $banner_cta_gif     = get_field('banner_cta_gif');
    $banner_badge       = get_field('banner_badge');
?>


<section id="cta" class="ptb-20" style="background-color: #134559">
    <div class="ast-container ast-flex ast-align-items-center">
        <div class="ast-col-md-3 teacher-choice">
            <img src="<?php echo $banner_badge; ?>" alt="">
        </div>
        <div class="ast-col-md-6 banner-content">
            <div class="cta-gif">
                <img src="<?php echo $banner_cta_gif ?>" alt="">
            </div>
            <div class="cta-content">
                <p class="cta-title"><?php echo $banner_title;?></p>
                <p class="cta-subtitle"><?php echo $banner_subtitle; ?></p>
            </div>
        </div>
        <div class="ast-col-md-3 banner-cta-btn">
            <a class="cta-btn"  href="<?php echo $banner_cta_link; ?>"><?php echo $banner_cta_text; ?></a>
        </div>
    </div>
</section>

<style>
    .ptb-20{
        padding-top: 20px;
        padding-bottom: 20px;
    }
    .banner-content{
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .banner-content p{
        margin-bottom: 0px;
    }
    .cta-gif img{
        width:  60px;
        height:  auto;
        object-fit: cover;
    }
    .teacher-choice img{
        width: 180px;
        height:auto;
        object-fit: cover;
    }
    .cta-content{
        text-align: center;
    }
    .cta-content .cta-title{
        font-weight: 700;
        color: #ffffff ;
    }

    .cta-content .cta-subtitle{
        color: #ffffff;
    }

    .cta-btn{
        background: #D4951A;
        padding: 12px 24px;
        font-size: 12px;
        border-radius: 10px;
    }
    .cta-btn:hover{
        color: #000000;
    }
    .banner-cta-btn{
        display: flex;
        justify-content: right;
    }

    @media(max-width: 545px){

        .teacher-choice{
            display: none;
        }
        .banner-cta-btn{
            display:none;
        }
        .banner-content {
            flex-direction: column;
        }
    }

</style>