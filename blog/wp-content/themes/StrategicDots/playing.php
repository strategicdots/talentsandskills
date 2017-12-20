<div class="modal fade" id="formModal"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><h2 class="modal-title uppercase text-center"> Subscribe to Our Newsletter</h2></div><div class="modal-body"><img src="../img/jumbo_bg.jpg" class="img-responsive m-light-bottom-breather"><div class="mid-container p-light-top-breather"><p class="heavy-font-size headfont capitalize text-center">signup today to receive our home furnishing picks and news</p><form class="" method="post" action="//episodeinteriors.us16.list-manage.com/subscribe/post?u=dd43485ff2f86f3c2d5333034&amp;id=442fd1a4a1" name="mc-embedded-subscribe-form"><div class="form-group"><input type="email" class="form-control" name="EMAIL" placeholder="Enter your email" required></div><div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_512cdde05864668bf643d9b96_ebd16c7740" tabindex="-1" value=""></div><div class="form-group"><input class="btn main-btn-color form-control" type="submit" value="Submit" name="subscribe"></div></form></div></div></div></div></div>


<!-- DON'T DELETE -->
<!-- categories in wordpress -->
<div class="text-center">
    <h3 class="uppercase">categories</h3>
    <?php 
    $categories = get_categories( [
        'orderby' => 'name',
        'parent'  => 0
    ] );

    foreach ( $categories as $category ) {
        printf( '<a class="category-item" href="%1$s">%2$s</a><br />',
               esc_url( get_category_link( $category->term_id ) ),
               esc_html( $category->name )
              );
    } 
    ?>
</div>

<!-- comments in wp -->
<div class="col-sm-6 col-sm-offset-2">
<p><a href="<?php the_permalink(); ?>#comments" class="small-font-size capitalize comment-count"><?php comments_number( 'no comments', 'one response', '% comments' ); ?></a></p>
</div>