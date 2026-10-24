<?php
/**
* Template Name: Teach English Resources
*
* @package WordPress
* @subpackage Astra
* @since 1.0.0
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}



get_header(); 

?>

<style id="wpr-usedcss">
.hero-container{min-height:450px;background-position:center;background-size:cover}.hero-inner{text-align:center;background:rgba(0,0,0,.25);height:100%;display:flex;position:absolute;width:calc(100% - 40px);justify-content:center;align-items:center;flex-direction:column;margin:0}.hero-inner h1{color:#fff;text-transform:uppercase;letter-spacing:.3rem;font-size:2rem}.hero-inner h2{color:#fff;text-transform:uppercase;font-weight:600;letter-spacing:.3rem;font-size:2rem;margin-top:.5rem}.freebie-section{margin:50px 0}.freebie-inner h2,.guide-inner h2{font-size:2.5rem;margin-bottom:1rem;color:#000}.freebie-inner .content,.guide-inner .content{line-height:1.5}.freebie-inner .content p:last-child,.guide-inner .content p:last-child{margin:0}.freebie-inner .image,.guide-inner .image{width:100%;height:250px;background-position:center;background-size:cover}.guide-inner .image{background-size:contain}.freebie-inner a,.guide-inner a{font-size:.7rem;background:#000;color:#fff;letter-spacing:.3rem;text-transform:uppercase;padding:10px 40px;display:inline-block;margin-top:2rem}.guide-inner a{background:#45562a}.guide-container{overflow:auto;background:#ededed;margin:0 20px;padding:50px 20px}.guide-section{margin:0 0 5rem}.products-section .ast-row>div{margin-bottom:1.5rem}.product-card{height:100%;background:#ededed;padding:1.5rem;text-align:center;margin-bottom:2rem}.products-section{margin-bottom:2rem}.product-card .image{height:200px;background-position:center;background-size:cover;margin:2rem}.product-card h2{font-size:1.25rem;font-weight:600;color:#000;padding:0 1rem 1rem;min-height:90px}.product-card .content{line-height:1.5;padding:0 1rem;height:400px}.buttons{margin-top:1rem;display:flex;justify-content:center}.add-to-cart,.look-inside{font-size:.7rem;background:#45562a;color:#fff;letter-spacing:.3rem;text-transform:uppercase;padding:10px 14px;display:inline-block}.look-inside{margin-right:9px;background:0 0;border:1px solid;color:#000}.add-to-cart:hover{color:#fff;opacity:.9}.look-inside:hover{color:#000;opacity:.9}.price{margin-top:1rem;font-size:2rem}.price del{opacity:.5;font-size:1.25rem;position:relative;top:-4px}.price .woocommerce-Price-amount{font-weight:600}del .woocommerce-Price-amount.amount{font-weight:500}@media (max-width:767px){.freebie-inner .image{margin-top:2rem}.hero-container{min-height:250px}.hero-inner h1,.hero-inner h2{font-size:1.5rem}.freebie-section{margin:2rem 0}.guide-section{margin:0 0 2rem}.products-section{margin-bottom:2rem}.guide-inner .image{background-repeat:no-repeat;height:150px}.guide-container{padding:20px 20px 40px}}
</style>
<section class="hero-section">
    <?php 
        $hero       = get_field('hero');
        $hero_image = $hero['image'];
        $hero_title = $hero['title'];
        $hero_stitle = $hero['subtitle'];
    ?>
    <div class="ast-container">
        <div class="ast-row">
        <div class="ast-col-md-12">
            <div data-bg="<?php echo $hero_image?>" class="hero-container rocket-lazyload entered error" style="background-image: url('<?php echo $hero_image?>');" data-ll-status="error">
                <div class="hero-inner">
                    <h1><?php echo $hero_title ?></h1>
                    <h2><?php echo $hero_stitle ?></h2>
                </div>
            </div>
        </div>
        </div>
    </div>
</section>
<section class="freebie-section">
    <?php 
        $freebie         = get_field('freebie');
        $freebie_title   = $freebie['title'];
        $freebie_content = $freebie['content'];
        $freebie_image   = $freebie['image'];
        $freebie_button  = $freebie['button'];
        $button_value    = $freebie_button['value'];
        $button_link     = $freebie_button['link']
    ?>
    <div class="ast-container">
        <div class="ast-row">
        <div class="ast-col-md-6">
            <div class="freebie-inner">
                <h2><?php echo $freebie_title?></h2>
                <div class="content">
                    <?php echo  $freebie_content?>
                </div>
            </div>
        </div>
        <div class="ast-col-md-6">
            <div class="freebie-inner">
                <div data-bg="<?php echo $freebie_image?>" class="image rocket-lazyload entered error" style="background-image: url('<?php echo $freebie_image?>');" data-ll-status="error"></div>
                <a href="<?php echo $button_link?>"><?php echo  $button_value ?></a>
            </div>
        </div>
        </div>
    </div>
</section>
<section class="guide-section">
    <?php
        $guide = get_field('guide');
        $guide_title   = $guide['title'];
        $guide_content = $guide['content'];
        $guide_image   = $guide['cover'];
        $guide_button  = $guide['button'];
        $button_value    = $guide_button['value'];
        $button_link     = $guide_button['link']
    ?>
    <div class="ast-container">
        <div class="ast-row">
        <div class="guide-container">
            <div class="ast-col-md-6">
                <div class="guide-inner">
                    <div data-bg="<?php echo $guide_image ?>" class="image rocket-lazyload entered exited error" style="background-image: url('<?php echo $guide_image ?>');" data-ll-status="error"></div>
                </div>
            </div>
            <div class="ast-col-md-6">
                <div class="guide-inner">
                    <h2><?php echo $guide_title?></h2>
                    <div class="content">
                        <?php echo $guide_content?>
                    </div>
                    <a href="<?php echo $button_link ?>"><?php echo $button_value ?></a>
                </div>
            </div>
        </div>
        </div>
    </div>
</section>
<section class="products-section">
    <?php
        $products = get_field('products')
    ?>
    <div class="ast-container">
        <div class="ast-row ast-flex">
            <?php 
                foreach($products as $product):
                    $product_image         = $product['image'];
                    $product_title         = $product['title'];
                    $product_content       = $product['content'];
                    $product_look_inside   = $product['look_inside'];
                    $product_ID            = $product['product'];
                    $wc_product = wc_get_product($product_ID);
            ?>
            <div class="ast-col-md-4">
                <div class="product-card">
                    <div data-bg="<?php echo $product_image?>" class="image rocket-lazyload" style="background-image: url('<?php echo $product_image ?>');" ></div>
                    <h2><?php echo $product_title?></h2>
                    <div class="content">
                        <?php echo $product_content?>
                    </div>
                    <div class="price">
                        <?php echo $wc_product->get_price_html()?>
                    </div>
                    <div class="buttons">
                        <a rel="nofollow" href="/?addtimetocart&amp;prid=<?php echo $product_ID ?>" class="add-to-cart">Add to Cart</a>
                    </div>
                </div>
            </div>
            <?php endforeach ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>