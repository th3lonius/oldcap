<?php
  get_header();
  $categ = get_queried_object();
  $taxonomy = $categ->taxonomy;
  $term_id = $categ->term_id;
  $catcolor = get_field("series_color", $taxonomy . '_' . $term_id);
  $catheadimg = get_field("header_image", $taxonomy . '_' . $term_id);
  $catsponsors = get_field("sponsor_info", $taxonomy . '_' . $term_id);
?>

<article class="series-archive" data-type="background" data-speed="20" data-background="<?php echo($catheadimg["url"]); ?>">

  <div class="gradient-overlay"></div>

  <section class="col-6-12 series-intro">

    <h1 class="series-title" style="color:<?php echo($catcolor); ?>;"><?php echo($categ->name); ?></h1>

    <p><?php echo($categ->description); ?></p>

  </section>

</article>


<article class="series-screenings col-10-12 no-float">

  <section class="col-6-12 films-column">

      <?php
        $showargs = array(
          'post_type' =>      'showing',
          'orderby' =>        'meta_value_num',
          'meta_key' =>       'startdate',
          'order' => 'ASC',
          'numberposts'=>     -1,
          'posts_per_page'=>  -1,
          'category__in' =>   array($categ->term_id),
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
        if ( $shows->have_posts() ) {
        ?>
          <h1 class="article-header">Upcoming Screenings</h1>
        <?php
        }
        if ( $shows->have_posts() ) while ( $shows->have_posts() ) : $shows->the_post();
          $filmid = get_post_meta(get_the_ID(), 'filmid')[0];
          if( !in_array($filmid, $catshows) ) {
            array_push($catshows, get_post_meta(get_the_ID(), 'filmid')[0]);
          }
        endwhile;
        $catfilms = array();
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
            $agileid = get_post_meta(get_the_ID(), 'agileid')[0];
            array_push($catfilms, $agileid);
            $prod_countries = explode(",", get_post_meta(get_the_ID(), 'production_country')[0]);
            $directors = explode(",", get_post_meta(get_the_ID(), 'director')[0]);

            $showargs = array(
              'post_type' =>      'showing',
              'orderby' =>        'meta_value',
              'meta_key' =>       'startdate',
              'order' => 'ASC',
              'meta_query'  => array(
                'relation' => 'AND',
                array(
                  'key'   => 'filmid',
                  'value'     => $agileid,
                  'compare'   => '=',
                ),
                array(
                  'key'   => 'startdate',
                  'value'     => strtotime('now'),
                  'compare'   => '>=',
                  'type' => 'NUMERIC,'
                ),
              ),
              'numberposts'=>     -1,
              'posts_per_page'=>  -1,
              'post_status'=>     'publish'
            );
            $shows = new WP_Query( $showargs );
            if ( $shows->have_posts() ) {
        ?>
         <section>
          <figure>
            <img src="<?php the_field('event_image'); ?>" />
            <figcaption style="background:<?php echo($catcolor); ?>;">
              <a href="<?php echo(the_field('infolink')); ?>"><h3 class="film-title"><?php the_title(); ?></h3></a>
              <h4 class="film-meta"><?php the_field('year_released'); echo(' / '); echo($prod_countries[0]); if( count($prod_countries) > 1 ) { echo(" +"); } echo(' / '); echo($directors[0]); if( count($directors) > 1 ) { echo(" +"); } ?></h4>
            </figcaption>
          </figure>
          <?php
            $dateholder = array();
            while ( $shows->have_posts() ) : $shows->the_post();
              $dateday = date('D, M j', get_field('startdate'));
              $datetime = date('g:ia', get_field('startdate'));
              if( array_key_exists($dateday, $dateholder) ) {
                $dateholder[$dateday][$datetime][] = get_field('buylink');
              } else {
                $dateholder[$dateday] = array();
                $dateholder[$dateday][$datetime] = array();
                $dateholder[$dateday][$datetime][] = get_field('buylink');
              }
            endwhile;
            $films->reset_postdata();

            foreach($dateholder as $date => $time){
              echo("<date class='show-date'>".$date);
              foreach($time as $showtime => $buylink) {
                echo("<a class='show-time' style='background:".$catcolor.";' href='".$buylink[0]."'>".$showtime."</a>");
              }
              echo("</date>");
            }
          ?>
          <p><?php the_content(); ?></p>
        </section>
        <?php
          }
          endwhile;
        }
        ?>
    <?php
        $showargs = array(
          'post_type' =>      'showing',
          'orderby' =>        'meta_value_num',
          'meta_key' =>       'startdate',
          'order' => 'ASC',
          'numberposts'=>     -1,
          'posts_per_page'=>  -1,
          'category__in' =>   array($categ->term_id),
          'meta_query'  => array(
            array(
              'key'   => 'startdate',
              'value'     =>  strtotime('today midnight'),
              'compare'   => '<=',
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
              'post_status'=>     'publish',
              'meta_query'  => array(
                array(
                  'key'   => 'agileid',
                  'value'     =>  $catfilms,
                  'compare'   => 'NOT IN',
                )
              ),
           );
           $films = new WP_Query( $filmargs );
            if ( $films->have_posts() ) {
              ?>
              <h1 class="article-header">Previous Screenings</h1>
              <?php
            }
            if ( $films->have_posts() ) while ( $films->have_posts() ) : $films->the_post();
                $agileid = get_post_meta(get_the_ID(), 'agileid')[0];
                $prod_countries = explode(",", get_post_meta(get_the_ID(), 'production_country')[0]);
                $directors = explode(",", get_post_meta(get_the_ID(), 'director')[0]);
        ?>
         <section>
          <figure>
            <img src="<?php the_field('event_image'); ?>" />
            <figcaption style="background:<?php echo($catcolor); ?>;">
              <a href="<?php echo(the_field('infolink')); ?>"><h3 class="film-title"><?php the_title(); ?></h3></a>
              <h4 class="film-meta"><?php the_field('year_released'); echo(' / '); echo($prod_countries[0]); if( count($prod_countries) > 1 ) { echo(" +"); } echo(' / '); echo($directors[0]); if( count($directors) > 1 ) { echo(" +"); } ?></h4>
            </figcaption>
          </figure>
          <p><?php the_content(); ?></p>
        </section>
        <?php
            endwhile;
        }
    ?>
  </section>

  <aside class="col-6-12">
    <?php
      print_r($catsponsors);
    ?>
  </aside>

</article>

<?php get_footer(); ?>