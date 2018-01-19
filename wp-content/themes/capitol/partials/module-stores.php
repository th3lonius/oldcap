<?php

    $args = array(
        'pagename' => 'find-our-tofu'
    );

    $query = new WP_Query( $args );

?>

<?php if ( $query->have_posts() ) : ?>

  <section id="module-stores" class="container__col-sm-12 container__col-md-8">

    <h2 class="section-title st-stores">Retail Locations</h2>
    
<p><iframe src="//batchgeo.com/map/049b5214dfd3515186addbf50a052f7e" frameborder="0" width="100%" height="550" style="border:1px solid #aaa;"></iframe></p><p><small>View <a href="https://batchgeo.com/map/049b5214dfd3515186addbf50a052f7e">Grocery Locations</a> in a full screen map</small></p>

    <?php while ( $query->have_posts() ) : $query->the_post(); ?>

      <?php if( have_rows('location') ): ?>
    
        <ol class="location">

        <?php while ( have_rows('retail') ) : the_row(); ?>

          <li><a href="<?php the_sub_field('hyperlink'); ?>" target="_blank" class="contextual-link"><?php the_sub_field('name'); ?></a></li>

          <?php if ( has_sub_field('addresses') ) : ?>
          <li><address><?php the_sub_field('address'); ?></address></li>
          <?php endif; ?>  

        <?php endwhile; ?>
          
        </ol>

      <?php endif; ?>

    </section><!-- #module-stores -->

  <?php endwhile; ?>

<?php endif; ?>