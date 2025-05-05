<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta name="google-site-verification" content="EecTcvdM0xO2hTF18KPt-aHk1WlgoacxMqV7DU-UW0Y" />
    <meta name="theme-color" content="#fff">
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php wp_title('|', true, 'right'); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <?php wp_head(); ?>
    <!-- <script type='text/javascript'>
      window.smartlook||(function(d) {
        var o=smartlook=function(){ o.api.push(arguments)},h=d.getElementsByTagName('head')[0];
        var c=d.createElement('script');o.api=new Array();c.async=true;c.type='text/javascript';
        c.charset='utf-8';c.src='https://web-sdk.smartlook.com/recorder.js';h.appendChild(c);
        })(document);
        smartlook('init', 'a6d64f666d9c88b18ba8a57c64fc178d578e35f6', { region: 'eu' });
    </script> -->
</head>

<body <?php body_class(); ?>>

    <!-- <body data-bs-spy="scroll" data-bs-target="#navbarSupportedContent" data-bs-offset="90" class="scrollspy-example" -->
    tabindex="0">
    <header id="header" class="js-header" itemscope itemtype="http://schema.org/WPHeader">
        <nav class="navbar navbar-expand-xl">
            <div class="container">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="navbar-brand">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/src/img/logo.svg" alt="logo">
                </a><!-- /.navbar-brand -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <div class="hamburger" id="hamburger">
                        <span class="line"></span>
                        <span class="line"></span>
                        <span class="line"></span>
                    </div><!-- ./hamburger -->
                </button><!-- ./navbar-toggler -->
                <?php get_template_part('templates-parts/header/header', 'nav'); ?>
            </div><!-- /.container -->
        </nav>

    </header>

    <main id="main">