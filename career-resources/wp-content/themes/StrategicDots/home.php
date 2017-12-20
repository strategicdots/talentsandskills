<?php get_header(); ?>

<div class="container inner-top p-heavy-top-breather registration" id="ms-container">

    <div class="row">

        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <div class="col-md-4 ms-item">

            <?php if (get_the_post_thumbnail()) : ?>
            <div class="post-img">
                <?php the_post_thumbnail('medium', ['class' => 'img-responsive img-center img-rounded', 'title' => 'Feature image']); ?>
            </div>
            <?php endif; ?>
            
            <h1>
                <a href="<?php the_permalink(); ?>">
                    <?php the_title(); ?>
                </a>
            </h1>

            <!-- the excerpt -->
            <p><?php the_excerpt(); ?></p>

            <!-- read more -->
            <div class="more-link text-center">
                <a class="read-more btn" href="<?php the_permalink(); ?>">Read More</a>
            </div>

            <!-- post meta data -->
            <div class="post-meta">
                <i class="fa fa-clock-o"></i>
                <span><?php the_date("M j, Y"); ?></span> &nbsp;&nbsp;
                <i class="fa fa-comment-o"></i>
                <span>&nbsp;
                    <a href="<?php the_permalink(); ?>#comments">
                    <?php comments_number('no Comment', 'one Comment', '% Comments'); ?>
                    </a>
                </span><br>
                <i class="fa fa-smile-o"></i>
                <span><?php the_author(); ?></span>
            </div>

        </div>
        <?php endwhile; ?>
        
        <?php else : echo "<h2 class=\"\">No posts yet!</h2>"; ?>

        <?php endif; ?>
    </div>

</div>

<?php get_footer(); ?>