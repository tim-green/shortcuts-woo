<?php
/**
 * Template part which is for ACF slider, which is display on the home page
 *
 *
 * @package shortcuts
 */

?>


<div class="container slider">
    <div class="home-slider">
    <?php if( have_rows('slider_images','option') ): ?>

    <?php while( have_rows('slider_images','option') ): the_row(); 

        // vars
        $image = get_sub_field('image','option');
        $heading = get_sub_field('heading','option');
        $subheading = get_sub_field('sub_heading','option');
        $text = get_sub_field('text','option');
        $button_text = get_sub_field('button_text','option');
        $button_link = get_sub_field('button_link','option');

    ?>
     <div class="slide">
            <div class="slide-content d-flex align-items-center" style="background-image: url(<?php echo $image['url']; ?>);">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="slide-text text-center text-lg-left">
                                <h1><?php echo $heading; ?></h1>
                                <p><?php echo $subheading; ?></p>
                                    <div class="hero-action">
                                        <?php echo $text; ?>
                                        <a class="btn btn-primary" href="<?php echo $button_link; ?>"><?php echo $button_text; ?></a>
                                    </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
        <?php endwhile; endif; ?>
    </div>
</div>