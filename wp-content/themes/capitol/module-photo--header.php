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

      <section data-stellar-background-ratio="2" style="background-image: url(<?php echo $customphoto; ?>);">

  <?php } else {

  } ?>