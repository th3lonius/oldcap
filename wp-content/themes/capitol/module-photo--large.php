<?php $image = get_field('photo');
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