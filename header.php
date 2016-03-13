<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div class="wrapper">
    <header class="prime-header">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="row between-xs">
                    <h1 class="logo"><a class="navbar-brand" href="<?php echo home_url(); ?>">Blog <span><?php bloginfo('name'); ?></span></a></h1>
                    <?php dynamic_sidebar('widget-header-search'); ?>
                </div>
            </div>
            <?php
            $menuArguments = array(
                'theme_location' => 'primary',
                'container'       => 'nav',
                'container_class' => 'collapse navbar-collapse',
                'container_id'    => 'bs-example-navbar-collapse-1',
                'menu_class' 	=> 'top-menu nav navbar-nav',
            );
            wp_nav_menu($menuArguments); ?>
        </div>
    </header>