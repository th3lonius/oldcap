<?php
/* Template Name: Series & Special Events */

global $post;
$sse_head = get_field('header_image');
get_header();

  // Get all active series
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
  // Add special events to active series
  array_push($collected_series, 9);

  // Retrieve list of all showings, ordered by startdate
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

  $series_films = array();
  foreach( $all_shows->get_posts() as $show ) {
    $cat = wp_get_post_categories($show->ID);
    $filmid = get_post_meta($show->ID, 'filmid')[0];
    // If a show's category is one of the active series or a special event
    // and it's film is not yet added to
    if(in_array($cat[0], $collected_series) && !(in_array($filmid, $series_films))){
      array_push($series_films, $filmid);
    }
  }
?>

<article class="series-archive" data-type="background" data-speed="20" data-background="<?php echo($sse_head); ?>">

  <div class="gradient-overlay"></div>

  <section class="col-6-12 series-intro">

    <h1 class="series-title">Series & Special Events</h1>

    <p></p>

  </section>

</article>

<article class="series-screenings col-10-12 no-float">
  <section class="films-column sse">
    <?php
      foreach( $series_films as $series_film ){
        $filmargs = array(
          'post_type' =>      'film',
          'numberposts'=>     -1,
          'posts_per_page'=>  -1,
          'meta_key'   => 'agileid',
          'meta_value'     => $series_film,
          'post_status'=>     'publish'
        );
        $films = new WP_Query( $filmargs );
        if ( $films->have_posts() ) while ( $films->have_posts() ) : $films->the_post();
          $film_cat = wp_get_post_categories(get_the_ID());
          $categ = get_category($film_cat[0]);
          $taxonomy = $categ->taxonomy;
          $term_id = $categ->term_id;
          $catcolor = get_field("series_color", $taxonomy . '_' . $term_id);
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
                'value'     => $series_film,
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
          $film_shows = new WP_Query( $showargs );

    ?>
    <section class="coming-soon col-6-12">
      <figure>
        <img src="<?php the_field('event_image'); ?>" />
        <figcaption style="background:<?php echo($catcolor); ?>;">
          <a href="<?php echo(the_field('infolink')); ?>"><h3 class="film-title"><?php the_title(); ?></h3></a>
          <h4 class="film-meta"><?php the_field('year_released'); echo(' / '); echo($prod_countries[0]); if( count($prod_countries) > 1 ) { echo(" +"); } echo(' / '); echo($directors[0]); if( count($directors) > 1 ) { echo(" +"); } ?></h4>
        </figcaption>
      </figure>
      <div class="meta-bar">
        <?php
          $film_cats = get_the_category(get_the_ID());
          foreach( $film_cats as $film_cat ){
            $cat_color = get_field('series_color', 'category_'. $film_cat->term_id);
        ?>
            <a href="/series/<?php echo($film_cat->slug); ?>" class="film-tag" style="background:<?php echo($cat_color); ?>"><?php echo($film_cat->name); ?></a>
        <?php
          }
        ?>
        <a href="#modal" class="trailer" data-video="<?php the_field('trailer'); ?>">
          <span class="video-link"></span>
        </a>
      </div>
      <?php
        $dateholder = array();
        while ( $film_shows->have_posts() ) : $film_shows->the_post();
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
      <?php the_content(); ?>
      <?php
        endwhile;
      ?>
    </section>
    <?php
      }
    ?>
  </section>
</article>

<?php get_footer(); ?>