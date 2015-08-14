<article class="new-releases">

  <h2 class="article-header">New Releases // Special Events</h2>

 <section class="container">

  <?php
    $showargs = array(
      'post_type' =>      'showing',
      'orderby' =>        'meta_value_num',
      'meta_key' =>       'startdate',
      'order' => 'ASC',
      'numberposts'=>     -1,
      'posts_per_page'=>  -1,
      'category__in' =>   array(4, 7, 9),  // New Release Films, Coming Soon, Special Event
      'meta_query'  => array(
        array(
          'key'   => 'startdate',
          'value'     =>  strtotime('today midnight'),
          'compare'   => '>=',
        ),
      ),
      'post_status'=>     'publish'
    );
    $shows = new WP_Query( $showargs );
    $catshows = array();
    if ( $shows->have_posts() ) while ( $shows->have_posts() ) : $shows->the_post();
      $filmid = get_post_meta(get_the_ID(), 'filmid')[0];
      if( !in_array($filmid, $catshows) ) {
        array_push($catshows, get_post_meta(get_the_ID(), 'filmid')[0]);
      }
    endwhile;

    foreach( $catshows as $catshow ) {
      $filmargs = array(
        'post_type' =>      'film',
        'numberposts'=>     -1,
        'posts_per_page'=>  -1,
        'meta_key'   => 'agileid',
        'meta_value'     => $catshow,
        'post_status'=>     'publish'
      );
      $films = new WP_Query( $filmargs );

      if ( $films->have_posts() ) while ( $films->have_posts() ) : $films->the_post();
      $cat = get_the_category($post->ID);
  ?>
  <section class="col-3-12">
    <?php
      $film_cats = get_the_category(get_the_ID());
      foreach( $film_cats as $film_cat ){
        if( $film_cat->name != 'New Release Films' && $film_cat->name != 'Coming Soon' ) {
          $cat_color = get_field('series_color', 'category_'. $film_cat->term_id);
    ?>
          <a href="/series/<?php echo($film_cat->slug); ?>" class="film-tag" style="background:<?php echo($cat_color); ?>"><?php echo($film_cat->name); ?></a>
    <?php
        }
      }
    ?>
     <a class="film-photo trailer" href="#modal" data-video="<?php the_field('trailer'); ?>" data-type="background" data-background="<?php the_field('event_image'); ?>">
       <span class="video-link"></span>
     </a>

     <header>
      <a href="<?php the_field('infolink'); ?>" class="film-title"><?php the_title(); ?></a>
      <?php
        $prod_countries = explode(",", get_post_meta(get_the_ID(), 'production_country')[0]);
        $directors = explode(",", get_post_meta(get_the_ID(), 'director')[0]);

      ?>
        <ul class="film-meta">
          <li><?php the_field('year_released'); ?></li>
          <li>
            <?php echo($prod_countries[0]); ?>
          </li>
          <li>
            <?php echo($directors[0]); ?>
          </li>
        </ul>
      </div>
    </header>

    <p><?php
      $desc = get_the_content();
      if(strlen($desc) > 250) {
        echo(substr($desc, 0, 250).'...');
      } else {
        echo($desc);
      }
    ?></p>
    <div class="options">
      <a class="cta" href="<?php the_field('infolink'); ?>">Buy Tickets</a>
      <a class="cta" href="<?php the_field('infolink'); ?>">Learn More</a>
    </div>

  </section>

  <?php
    endwhile;
  }
  ?>

  </section><!-- /container -->

</article><!-- /new-releases -->