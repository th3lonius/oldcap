<?php
  $args = array(
    'child_of'                 => 2,
    'orderby'                  => 'name',
    'order'                    => 'ASC',
    'hide_empty'               => 1,
    'hierarchical'             => 1,
    'taxonomy'                 => 'category',
    'pad_counts'               => false
  );
  $active_series = get_categories( $args );
  $collected_series = array();
  foreach( $active_series as $series ) {
    array_push($collected_series, $series->term_id);
  }

  $showargs = array(
    'post_type' =>      'showing',
    'orderby' =>        'meta_value_num',
    'meta_key' =>       'startdate',
    'order' => 'ASC',
    'numberposts'=>     -1,
    'posts_per_page'=>  -1,
    'meta_query'  => array(
      array(
        'key'   => 'startdate',
        'value'     =>  strtotime('today midnight'),
        'compare'   => '>=',
      )
    ),
    'post_status'=>     'publish'
  );
  $all_shows = new WP_Query( $showargs );
  $series_shows = array();
  foreach( $collected_series as $match_series ) {
    foreach( $all_shows->get_posts() as $show ) {
      $cat = wp_get_post_categories($show->ID);
      if( $cat[0] == $match_series ) {
        array_push($series_shows, $show->ID);
        break;
      }
    }
  }

  $showargs = array(
    'post_type' =>      'showing',
    'orderby' =>        'meta_value_num',
    'meta_key' =>       'startdate',
    'order' => 'ASC',
    'numberposts'=>     -1,
    'posts_per_page'=>  -1,
    'post__in' => $series_shows,
    'post_status'=>     'publish'
  );
  $collected_shows = new WP_Query( $showargs );
?>

<h2 class="article-header">Current Series</h2>

    <article class="active-series">

      <?php
        if ( $collected_shows->have_posts() ) while ( $collected_shows->have_posts() ) : $collected_shows->the_post();
          $nextShowtime = get_field('buylink');
          $showdate = date('D, M j', get_post_meta(get_the_ID(), 'startdate')[0]);
          $filmargs = array(
            'post_type' =>      'film',
            'numberposts'=>     -1,
            'posts_per_page'=>  -1,
            'meta_key'   => 'agileid',
            'meta_value'     => get_field('filmid'),
            'post_status'=>     'publish'
          );
          $films = new WP_Query( $filmargs );

          if ( $films->have_posts() ) while ( $films->have_posts() ) : $films->the_post();
            $series = get_the_category($post->ID);
            $catcolor = get_field("series_color", 'category_' . $series[0]->term_id);
      ?>
        <section class="col-6-12 series-module">

           <div class="film-photo" data-type="background" data-background="<?php the_field('event_image'); ?>">
              <div class="overlay"></div>
              <header>
                <a style="background-color:<?php echo($catcolor); ?>;" href="series/<?php echo($series[0]->slug); ?>" role="archive-link"><h3 style="background-color:<?php echo($catcolor); ?>;" class="series-title"><?php echo($series[0]->name); ?></h3></a>

                <div class="next-screening">

                  <span><?php echo($showdate); ?></span>

                  <a href="<?php the_field('infolink'); ?>" class="film-title"><?php the_title(); ?></a>

                  <ul class="film-meta">
                    <li><?php the_field('year_released'); ?></li>
                    <li><?php $production_countries = explode(',', get_field('production_country')); echo $production_countries[0]; ?></li>
                    <li><?php $directors = explode(',', get_field('director')); echo $directors[0]; ?></li>
                  </ul><!-- /film-meta -->

                  <div class="options">
                    <a class="cta" href="<?php echo($nextShowtime); ?>" style="background-color:<?php echo $catcolor; ?>;" role="ticket-link">Buy Tickets</a>
                    <a class="cta" href="series/<?php echo($series[0]->slug); ?>" style="background-color:<?php echo $catcolor; ?>;" role="archive-link">Series Archive</a>
                  </div><!-- /options -->

                </div><!-- /next-screening -->

              </header>

            </div>

        </section>
      <?php
          endwhile;
          wp_reset_postdata();
        endwhile;
      ?>

      <?php
        $args = array(
          'child_of'                 => 2,
          'orderby'                  => 'name',
          'order'                    => 'ASC',
          'exclude'                  => $collected_series,
          'hide_empty'               => 0,
          'hierarchical'             => 1,
          'taxonomy'                 => 'category',
          'pad_counts'               => false
        );
        $remaining_series = get_categories( $args );

        foreach( $remaining_series as $series ) {
          $catcolor = get_field("series_color", 'category_' . $series->term_id);
          $catheadimg = get_field("header_image", 'category_' . $series->term_id);
      ?>
        <section class="col-6-12 series-module">

           <div class="film-photo" data-type="background" data-background="<?php echo($catheadimg['url']); ?>">
              <div class="overlay"></div>
              <header>
                <a style="background-color:<?php echo($catcolor); ?>;" href="series/<?php echo($series->slug); ?>" role="archive-link"><h3 style="background-color:<?php echo($catcolor); ?>;" class="series-title"><?php echo($series->name); ?></h3></a>
                <div class="next-screening">
                  <span>Ongoing Series</span>
                </div>

              </header>

            </div>

        </section>
      <?php
        }
      ?>
    </article><!-- /active-series -->