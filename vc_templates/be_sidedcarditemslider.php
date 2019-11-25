<?php
$slider_attr = "";
extract(shortcode_atts(array(
    'slider_attr'		=> '',
), $atts));
$parsed_atts = vc_param_group_parse_atts( $slider_attr );
$id_slider  =  "slider_id_".rand(1111,9999);
$args = array(
    'post_type' => 'post',

    'meta_query' => array(
      array(
          'key' => 'show_this_post_on',
          'value' => 'program-terdahulu',
          'compare' => 'LIKE'
      )
    )
  );
    $posts = get_posts($args);
?>
<div class="sc-sided-card-slider" id="<?php echo esc_attr($id_slider);?>">
    <div class="row">
        <div class="col-12 col-sm-6">
            <div class="sc-sided-card-slider__image-slider sc-sided-card-slider__container swiper-container">
                <div class="swiper-wrapper">
                    <?php foreach ($posts as $post) { ?>
                    <div class="swiper-slide">
                        <div class="sc-sided-card-slider__item">
                            <div class="sc-sided-card-slider__img d-flex flex-column align-items-center">
                                <?php 
                                if ( !empty( $post->ID ) ) { 
                                    echo '<img src="' . get_the_post_thumbnail_url( $post->ID, 'medium' ) .  '  " class="img-responsive" />'; 
                                } ?>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                    
                </div>
            </div>
            <div class="swiper-button-next sc-sided-card-slider__btn-next" id="<?php echo esc_js($id_slider);?>_next">
                <i class="fa fa-chevron-right"></i>
            </div>
            <div class="swiper-button-prev sc-sided-card-slider__btn-prev" id="<?php echo esc_js($id_slider);?>_prev">
                <i class="fa fa-chevron-left"></i>
            </div>
            <div class="swiper-pagination sc-sided-card-slider__pagination" id="<?php echo esc_js($id_slider);?>_pagination"></div>
        </div>
        <div class="col-12 col-sm-6">
            <div class="sc-sided-card-slider__desc-slider sc-sided-card-slider__container swiper-container">
                <div class="swiper-wrapper">
                    <?php foreach ($posts as $post) { 
                        $more_link_atts = get_permalink( $post->ID );
                        ?>
                    <div class="swiper-slide">
                        <div class="sc-sided-card-slider__item sc-sided-card-slider__desc">
                            <div class="sc-sided-card-slider__content d-flex flex-wrap flex-column">
                                <div class="sc-sided-card-slider__content-inner">
                                    <h4 class="sc-sided-card-slider__title mb-4">
                                        <?php echo esc_html($post->post_title) ?>
                                    </h4>
                                    <p>
                                        <?php echo get_the_excerpt( $post->ID ); ?>
                                    </p>
                                </div>
                                <a href="<?php echo $more_link_atts; ?>" class="sc-sided-card-slider__readmore-btn">
                                    Read More
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    (function($) {
        "use strict";
        var cardSliderDesc_<?php echo esc_js($id_slider);?> = new Swiper('#<?php echo esc_js($id_slider);?> .sc-sided-card-slider__desc-slider', {
            spaceBetween: 10,
            slidesPerView: 1,
            watchSlidesVisibility: true,
            watchSlidesProgress: true,
        });

        var cardSliderImage_<?php echo esc_js($id_slider);?> = new Swiper('#<?php echo esc_js($id_slider);?> .sc-sided-card-slider__image-slider', {
            slidesPerView: 1,
            grabCursor:false,
            speed: 1000,
            loop: true,
            spaceBetween: 30,
            navigation: {
                nextEl: '#<?php echo esc_js($id_slider);?>_next.swiper-button-next',
                prevEl: '#<?php echo esc_js($id_slider);?>_prev.swiper-button-prev',
            },
            pagination: {
                el: '#<?php echo esc_js($id_slider);?>_pagination.swiper-pagination',
            },
            thumbs: {
                swiper: cardSliderDesc_<?php echo esc_js($id_slider);?>
            }
        });
    })(jQuery);
</script>



