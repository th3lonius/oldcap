<?php
  do_action('get_data');

  //date_default_timezone_set('America/Chicago');
  // Retrieve the upcoming shows that are later than right now, but earlier than today at midnight.
  $showargs = array(
    'post_type' =>      'showing',
    'orderby' =>        'meta_value_num',
    'meta_key' =>       'startdate',
    'order' => 'ASC',
    'numberposts'=>     -1,
    'posts_per_page'=>  -1,
    'meta_query'  => array(
      'relation' => 'AND',
      array(
        'key'   => 'startdate',
        'value'     =>  strtotime('today midnight'),
        'compare'   => '>=',
      ),
      array(
        'key'   => 'startdate',
        'value'     =>  strtotime('+1 day midnight'),
        'compare'   => '<=',
      ),
    ),
    'post_status'=>     'publish'
  );

  $shows = new WP_Query( $showargs );
  // We use this array $todayshows to establish which films need to be pulled for the slider
  $todayshows = array();
  if ( $shows->have_posts() ) while ( $shows->have_posts() ) : $shows->the_post();
    $filmid = get_post_meta(get_the_ID(), 'filmid')[0];
    if( !in_array($filmid, $todayshows) ) {
      array_push($todayshows, get_post_meta(get_the_ID(), 'filmid')[0]);
    }
  endwhile;

?>

    <article class="now-playing">

      <section class="col-12-12 playing-today">
        <h2 class="article-header">Playing Today</h2>
        <div id="slider">
          <ol class="slides-container">
          <?php
            foreach ($todayshows as $todayshow) {
              $filmargs = array(
                'post_type' =>      'film',
                'numberposts'=>     -1,
                'posts_per_page' =>  -1,
                'meta_key'  => 'agileid',
                'meta_value' => $todayshow,
                'post_status'=>     'publish'
              );
              $films = new WP_Query( $filmargs );

              if ( $films->have_posts() ) while ( $films->have_posts() ) : $films->the_post();
              $agileid = get_post_meta(get_the_ID(), 'agileid')[0];
          ?>
            <li data-type="background" data-speed="20" data-background="<?php the_field('event_image'); ?>">
              <div class="gradient-overlay"></div>
              <header>
                <a href="<?php the_field('infolink'); ?>"><h1 class="film-title"><?php the_title(); ?></h1></a>
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
                <a href="#modal" class="trailer" data-video="<?php the_field('trailer'); ?>">
                  <span class="video-link"></span>
                </a>
                <ul class="film-meta">
                <?php
                  $prod_countries = explode(",", get_post_meta(get_the_ID(), 'production_country')[0]);
                  $directors = explode(",", get_post_meta(get_the_ID(), 'director')[0]);
                ?>
                  <li><?php the_field('year_released'); ?></li>
                  <li>
                    <?php
                      echo($prod_countries[0]);
                      if( count($prod_countries) > 1 ) {
                        echo(" <span class='show-extra'>+</span>"); ?>
                        <div class="extra-direct">
                        <?php foreach(array_slice($prod_countries, 1) as $prod_countries) { ?>
                          <span><?php echo($prod_countries); ?></span>
                        <?php } ?>
                        </div>
                    <?php } ?>
                  </li>
                  <li>
                    <?php
                      echo($directors[0]);
                      if( count($directors) > 1 ) {
                        echo(" <span class='show-extra'>+</span>"); ?>
                        <div class="extra-direct">
                        <?php foreach(array_slice($directors, 1) as $director) { ?>
                          <span><?php echo($director); ?></span>
                        <?php } ?>
                        </div>
                    <?php } ?>
                  </li>
                </ul>
                <p><?php
                  $desc = get_the_content();
                  if(strlen($desc) > 250) {
                    echo(substr($desc, 0, 250).'...');
                  } else {
                    echo($desc);
                  }
                ?></p>
                <?php
                  // Necessary nested block to retrieve showtimes for today's films individually
                  if ( $shows->have_posts() ) while ( $shows->have_posts() ) : $shows->the_post();
                    if(get_post_meta(get_the_ID(), 'filmid')[0] == $agileid) {
                ?>
                      <a class="show-time" href="<?php the_field('buylink'); ?>"><?php echo(date('g:ia', get_post_meta(get_the_ID(), 'startdate')[0])); ?></a>
                <?php
                    }
                  endwhile;
                  wp_reset_postdata();
                ?>
              </header>
            </li>
          <?php endwhile;
            }
          ?>
          </ol>
        </div>
      </section><!-- /playing-today -->
