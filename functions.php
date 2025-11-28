<?php

function coffee_shop_setup()
{
    // Agregar imagen destacada
    add_theme_support('post-thumbnails');
}

add_action('after_setup_theme', 'coffee_shop_setup');
