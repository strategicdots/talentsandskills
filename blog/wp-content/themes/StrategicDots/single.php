<?php get_header(); ?>

<div class="blog container">
    <div class="row">
        <!-- main posts -->
        <div class="col-sm-9">
            <div class="posts">
                <?php if( have_posts() ): while( have_posts() ) : the_post(); ?>
                <div class="single-post m-heavy-bottom-breather">
                    <h2 class="text-center no-bottom-margin headfont-bold title"><?php the_title(); ?></h2>
                    <p class="small-font-size post-date text-center"> <?php the_date(); ?></p>
                    <?php if( get_the_post_thumbnail() ): ?>
                    <div class="post-img m-mid-bottom-breather">
                        <?php the_post_thumbnail('medium-large', ['class' => 'img-responsive img-center img-rounded', 'title' => 'Feature image']); ?>
                    </div>
                    <?php endif; ?>

                    <?php the_content(); ?>

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

    </div>


</div>

<?php get_footer(); ?>