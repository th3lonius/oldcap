<?php $image = get_field('photo');

  if( !empty($image) ){
    
    // vars
    $url = $image['url'];
    $title = $image['title'];
    $alt = $image['alt'];
    $caption = $image['caption'];

    // thumbnail
    $size = 'large';
    $customphoto = $image['sizes'][ $size ];
    $width = $image['sizes'][ $size . '-width' ];
    $height = $image['sizes'][ $size . '-height' ];
    
    ?>

      <figure style="background-image: url(<?php echo $customphoto; ?>);"></figure>

  <?php } else {

    $args = array(
        'post_type' => 'attachment',
        'post_status' => 'inherit',
        'tag' => 'fields',
        'posts_per_page' => 1,
        'fields' => 'ids',
        'orderby' => 'rand'
    );

    $randimage = new WP_Query( $args );

    if( $randimage->have_posts() ){
        $image_attributes = wp_get_attachment_image_src( $randimage->posts[0], 'large' );
    ?>
    <figure style="background-image: url(<?php echo $image_attributes[0]; ?>);"></figure>
          
<?php }

  } ?>