<?php
/**
* Template Name: TEFL Resources
*
* @package WordPress
* @subpackage Astra
* @since 1.0.0
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$hero = get_field('hero');

get_header(); 

?>

<section class="hero">
    <div class="ast-container">
		<div class="ast-row">
		    <div class="ast-col-md-6">
                <div class="left">
                    <h1>TEFL Lesson Resource Packs & Practicum</h1>
                </div>
		    </div>
		    <div class="ast-col-md-6">
                <div class="right">
                    
                </div>
		    </div>
		</div>
	</div>
</section>

<section class="products bundle">
    <div class="ast-container">
		<div class="ast-row">
            <div class="product-bundle-row">
                <div class="ast-col-md-8">
                    <?php 
                        $product = wc_get_product('9943');
                        $product_id = $product->get_id();
                        $regular_price = $product->get_regular_price($product);
                        $sale_price = $product->get_sale_price();
                        $price = $product->get_price();
                    ?>
                    <div class="bundle-product">
                        <div class="title">The TEFL Institute 3 in 1 e-book bundle</div>
                        <div class="description">An essential asset for any ESL Teacher, you can now purchase an all-inclusive 3 E-book collection for the first time! From helping you find employment to gaining the tools to create and administer lesson plans, we’ve got you covered.</div>
                        <div class="price">
                            <?php if(!$sale_price) { ?>
                                <div class="sale"><?php echo get_woocommerce_currency_symbol().$regular_price; ?></div>
                            <?php } else { ?>
                                <div class="regular"><?php echo get_woocommerce_currency_symbol().$regular_price; ?></div>
                                <div class="sale"><?php echo get_woocommerce_currency_symbol().$sale_price; ?></div>
                            <?php } ?>
                        </div>
                        <a rel="nofollow" href="/?addtimetocart&amp;prid=<?php echo $product_id; ?>" class="add-to-cart">Add to Cart</a>
                    </div>
                </div>
                <div class="ast-col-md-4">
                    <div class="product">
                        <img src="/wp-content/uploads/2022/11/3-bundle-guide.png"/>
                    </div>
                </div>
            </div>
		</div>
	</div>
</section>

<section class="products ">
    <div class="ast-container">
		<div class="ast-row">
            <div class="products-row">
                <div class="ast-col-md-4">
                    <?php 
                        $product = wc_get_product('4880');
                        $product_id = $product->get_id();
                        $regular_price = $product->get_regular_price($product);
                        $sale_price = $product->get_sale_price();
                        $price = $product->get_price();
                    ?>
                    <div class="product">
                        <img src="/wp-content/uploads/2022/10/warmers.png">
                        <div class="title">The TEFL Institute Warmers, Fillers and Coolers </div>
                        <div class="description">The TEFL Institute Warmers, fillers and coolers are short 5-10 minute activities used to engage learners, fill time during a lesson or to end a lesson on a positive note. They can either be related to the aim or theme of the lesson or act as short, stand alone activities. Over 70 pages to help you make your lessons more interactive.</div>
                        <?php if(!$sale_price) { ?>
                            <div class="sale"><?php echo get_woocommerce_currency_symbol().$regular_price; ?></div>
                        <?php } else { ?>
                            <div class="regular"><?php echo get_woocommerce_currency_symbol().$regular_price; ?></div>
                            <div class="sale"><?php echo get_woocommerce_currency_symbol().$sale_price; ?></div>
                        <?php } ?>
                        <a rel="nofollow" href="/?addtimetocart&amp;prid=<?php echo $product_id; ?>" class="add-to-cart">Add to Cart</a>
                    </div>
                </div>
                <div class="ast-col-md-4">
                    <?php 
                        $product = wc_get_product('4883');
                        $product_id = $product->get_id();
                        $regular_price = $product->get_regular_price($product);
                        $sale_price = $product->get_sale_price();
                        $price = $product->get_price();
                    ?>
                    <div class="product">
                        <img src="/wp-content/uploads/2022/10/lesson-planning.png">
                        <div class="title">The TEFL Institute Lesson Planning Guide:</div>
                        <div class="description">Good TEFL teachers are passionate, energetic and organized… you deserve some help to make your classroom more dynamic and so we’ve packaged up all our ideas into this handy downloadable eBook. This 37 page guide is bursting with activities to use instantly in your classroom. Less time lesson planning, means more socialising!</div>
                        <?php if(!$sale_price) { ?>
                            <div class="sale"><?php echo get_woocommerce_currency_symbol().$regular_price; ?></div>
                        <?php } else { ?>
                            <div class="regular"><?php echo get_woocommerce_currency_symbol().$regular_price; ?></div>
                            <div class="sale"><?php echo get_woocommerce_currency_symbol().$sale_price; ?></div>
                        <?php } ?>
                        <a rel="nofollow" href="/?addtimetocart&amp;prid=<?php echo $product_id; ?>" class="add-to-cart">Add to Cart</a>
                    </div>
                </div>
                <div class="ast-col-md-4">
                    <?php 
                        $product = wc_get_product('4886');
                        $product_id = $product->get_id();
                        $regular_price = $product->get_regular_price($product);
                        $sale_price = $product->get_sale_price();
                        $price = $product->get_price();
                    ?>
                    <div class="product">
                        <img src="/wp-content/uploads/2022/10/grammar.png">
                        <div class="title">The TEFL Institute Ultimate Grammar Guide:</div>
                        <div class="description">You’ve completed your TEFL course and are raring to go. Now to get that perfect job! Teaching grammar to some is a difficult concept. This 120 page Ultimate Grammar Guide will give you a real understanding of how to teach every aspect of grammar in the classroom.</div>
                        <?php if(!$sale_price) { ?>
                            <div class="sale"><?php echo get_woocommerce_currency_symbol().$regular_price; ?></div>
                        <?php } else { ?>
                            <div class="regular"><?php echo get_woocommerce_currency_symbol().$regular_price; ?></div>
                            <div class="sale"><?php echo get_woocommerce_currency_symbol().$sale_price; ?></div>
                        <?php } ?>
                        <a rel="nofollow" href="/?addtimetocart&amp;prid=<?php echo $product_id; ?>" class="add-to-cart">Add to Cart</a>
                    </div>
                </div>
            </div>
		</div>
	</div>
</section>

<style>
    body{
        background:var(--bg-color) !important;
    }
    .hero {
        padding: 50px 0;
    }
    #content>.ast-container{
        max-width:100%;
        padding:0;
    }
    .left {
        background: black;
        height: 300px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 1.25rem;
        text-transform: uppercase;
        letter-spacing: 0.3rem;
        text-align: center;
        color: white;
        line-height: 1.5;
    }
    
    .right {
        background: url('/wp-content/uploads/2021/09/Guide-mocks-TI-400.jpg') no-repeat center top / cover;
        height: 300px;
    }
    .products-row{
        display:flex;
    }
    @media screen and (max-width:767px) {
        .products-row{ 
            flex-direction:column;
            row-gap:1rem;
        }
    }
    .products-row .product {
        text-align: center;
        background: var(--white);
        padding: 1rem;
        border-radius: .5rem;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .products {
        margin-bottom: 50px;
    }
    
    .title {
        font-size: 1.25rem;
        text-transform: uppercase;
        letter-spacing: 0.3rem;
        line-height: 1.5;
        padding: 20px 0 0;
        min-height: 105px;
    }

    .description {
        line-height: 1.5;
        padding: 15px 0;
        min-height: 185px;
    }
    
    .price {
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .regular {
        opacity: 0.5;
        text-decoration: line-through;
        padding-right: 15px;
    }
    
    .sale {
        font-size: 1.5rem;
    }
    
    .add-to-cart {
        background: #000;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 12px 25px 12px 50px;
        min-height: 55px;
        font-size: 0.688rem;
        letter-spacing: 0.3rem;
        text-transform: uppercase;
        margin-top: 20px;
    }
    .add-to-cart:hover {
        color: #fff;
    }
    
    .bundle-product .title {
        padding: 0;
        min-height: auto;
    }
    
    .bundle-product .description {
        min-height: auto;
    }
    
    .bundle-product .price {
        justify-content: flex-start;
    }
    .left, .right {
        border-radius: .5rem;
    }
</style>

<?php get_footer(); ?>