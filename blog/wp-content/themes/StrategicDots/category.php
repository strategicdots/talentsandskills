<?php get_header(); ?>

<div class="blog container">
    <div class="row">
        <!-- main posts -->
        <div class="col-sm-9">
            <div class="posts">
                <?php if( have_posts() ): while( have_posts() ) : the_post(); ?>
                <div class="post m-heavy-bottom-breather">
                    <h2 class="text-center no-bottom-margin headfont-bold title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> </h2>
                    <p class="small-font-size post-date"> <?php the_date(); ?></p>
                    <?php if( get_the_post_thumbnail() ): ?>
                    <div class="post-img">
                        <?php the_post_thumbnail('medium-large', ['class' => 'img-responsive img-center img-rounded', 'title' => 'Feature image']); ?>
                    </div>
                    <?php endif; ?>

                    <p><?php the_excerpt(); ?></p>
                    <div class="more-link text-center">
                        <hr class="line">
                        <a class="read-more btn" href="<?php the_permalink(); ?>">Read More</a>
                    </div>
                    <?php the_category(); ?>
                    <div class="row">
                        <div class="col-sm-4"><?php echo shareButtons( get_the_permalink() ); ?></div>
                    </div>
                </div>
                <?php endwhile; ?>
                <?php else: echo "<p class=\"uppercase headfont-bold\">No posts yet!</p>"; ?>

                <?php endif; ?>
            </div> 
        </div>

        <!-- sidebar -->
        <div class="col-sm-3 sidebar p-heavy-top-breather p-mid-bottom-breather">
            <div class="p-mid-top-breather abt-us">
                <p class="uppercase text-center headfont-bold"><a href="http://www.episodeinteriors.com/about-us/" class="head">episode interiors</a></p>
                <a href="http://www.episodeinteriors.com/about-us/"><img src="<?php echo get_bloginfo('template_url'); ?>/img/jumbo_bg.jpg" class="img-responsive img-center img-rounded"></a>
                <div class="small-font-size m-light-top-breather content">
                    <p>Episode Interiors was established in 1995 to offer complete interior design, product co-ordination and installation services.</p>
                    <p>We are a team of highly trained and multi-skilled professionals poised to serve our customer with our mix of customer service culture and sound technical skills. <a href="http://www.episodeinteriors.com/about-us/" class="btn"> Read More >>></a></p>
                </div>
            </div>
            <div class="p-light-top-breather gal hidden-xs">

                <p class="uppercase text-center headfont-bold"><a href="http://www.episodeinteriors.com/gallery/" class="head">gallery</a></p>
                <div class="row">
                    <div class="col-sm-6 no-right-padding">
                        <a href="http://www.episodeinteriors.com/gallery/"><img src="<?php echo get_bloginfo('template_url'); ?>/img/gal1.jpg" class="img-responsive"></a>
                    </div>
                    <div class="col-sm-6 no-right-padding">
                        <a href="http://www.episodeinteriors.com/gallery/"><img src="<?php echo get_bloginfo('template_url'); ?>/img/gal2.jpg" class="img-responsive"></a>
                    </div>
                </div>

                <div class="row m-light-top-breather">
                    <div class="col-sm-6 no-right-padding">
                        <a href="http://www.episodeinteriors.com/gallery/"><img src="<?php echo get_bloginfo('template_url'); ?>/img/gal3.jpg" class="img-responsive"></a>
                    </div>
                    <div class="col-sm-6 no-right-padding">
                        <a href="http://www.episodeinteriors.com/gallery/"><img src="<?php echo get_bloginfo('template_url'); ?>/img/gal4.jpg" class="img-responsive"></a>
                    </div>
                </div>

                <div class="row m-light-top-breather">
                    <div class="col-sm-6 no-right-padding">
                        <a href="http://www.episodeinteriors.com/gallery/"><img src="<?php echo get_bloginfo('template_url'); ?>/img/gal5.jpg" class="img-responsive"></a>
                    </div>
                    <div class="col-sm-6 no-right-padding">
                        <a href="http://www.episodeinteriors.com/gallery/"><img src="<?php echo get_bloginfo('template_url'); ?>/img/gal6.jpg" class="img-responsive"></a>
                    </div>
                </div>



            </div>

            <div class="p-mid-top-breather subsc">
                <p class="uppercase text-center headfont-bold"><a href="#formModal" class="head">subscribe to our newsletter</a></p>
                <div class="small-font-size m-light-top-breather content">
                    <form class="" method="post" action="//episodeinteriors.us16.list-manage.com/subscribe/post?u=dd43485ff2f86f3c2d5333034&amp;id=442fd1a4a1" name="mc-embedded-subscribe-form"><div class="form-group"><input type="email" class="form-control" name="EMAIL" placeholder="Enter your email" required></div><div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_512cdde05864668bf643d9b96_ebd16c7740" tabindex="-1" value=""></div><div class="form-group"><input class="btn main-btn-color form-control" type="submit" value="Submit" name="subscribe"></div></form>
                </div>
            </div>
        </div>
    </div>


</div>

<?php get_footer(); ?>