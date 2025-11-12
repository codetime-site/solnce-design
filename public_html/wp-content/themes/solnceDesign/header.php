<!DOCTYPE html>
<html lang="<?php bloginfo('language'); ?>">

<head>
    <meta charset="<?php echo bloginfo("charset") ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo bloginfo("name") ?></title>
    <meta name="description" content="<?php echo bloginfo("description") ?>">
    <meta name="yandex-verification" content="abf78c10058774ca" />

    <?php wp_head(); ?>
</head>

<body>
    <?php get_template_part('templates/header');?>
