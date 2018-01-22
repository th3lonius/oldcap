<article id="homepage" class="container__row">
  
  <section class="container__col-sm-12 no-padding">
    

<?php

    $args = array(
      'pagename' => 'video module'
    );

    $query = new WP_Query( $args );

?>
    
  <?php if ( $query->have_posts() ) : ?>

    <?php while ( $query->have_posts() ) : $query->the_post(); ?>
    
    <header>
      
      <?php

      $rows = get_field('catchphrases');
      $row_count = count($rows);
      $i = rand(0, $row_count - 1);

      ?>
      
      <span><?php echo $rows[ $i ]['phrase']; ?></span>
      
    </header>
    
    <div class="video-wrapper">
      <iframe class="video-frontpage" width="100%" height="82vh" src="https://www.youtube.com/embed/<?php the_field('video'); ?>?rel=0&amp;controls=0&amp;showinfo=0&autoplay=1&loop=1&playlist=<?php the_field('video'); ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    </div>
    
    <?php endwhile; ?>
    
  <?php endif; ?>
    
<!--
    <video muted autoplay loop playsinline id="bgvid" poster="<?php bloginfo('template_directory'); ?>/img/batch-still.jpg">
      <source src="<?php bloginfo('template_directory'); ?>/video/oldcap-montage-web.mp4" type="video/mp4">
      <source src="<?php bloginfo('template_directory'); ?>/video/oldcap-montage-web.webm" type="video/webm">
      <source src="<?php bloginfo('template_directory'); ?>/video/oldcap-montage-web.ogv" type="video/ogg">
    </video>

    <!--<a href="#" class="learn-more floating"></a>-->
    
  </section>

</article>