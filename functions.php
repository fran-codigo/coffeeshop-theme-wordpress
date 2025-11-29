<?php

function coffee_shop_setup()
{
    // Agregar imagen destacada
    add_theme_support('post-thumbnails');
}

add_action('after_setup_theme', 'coffee_shop_setup');

/* Esta función sirve para agregar campos personalizados 
a la API REST de WordPress */
function coffee_shop_api_init()
{
    register_rest_field(
        ['page'],
        'featured_images',
        ['get_callback' => 'get_featured_image']
    );
}

add_action('rest_api_init', 'coffee_shop_api_init');

/* Esta funcion obtiene las imágenes destacadas en varios tamaños 
y es la que se agrega a la API REST*/
function get_featured_image($post)
{
    if (!$post['featured_media']) {
        return false;
    }

    $image_sizes = get_intermediate_image_sizes();
    $images = [];
    foreach ($image_sizes as $size) {

        if ($size === '2048x2048') {
            continue;
        }

        $image = wp_get_attachment_image_src($post['featured_media'], $size);
        $images[$size === '1536x1536' ? 'full' : $size] = [
            'url' => $image[0],
            'width' => $image[1],
            'height' => $image[2],
        ];
    }
    return $images;
}
