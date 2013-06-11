<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" <?php print $rdf_namespaces; ?>> <!--<![endif]-->
<?php print $mothership_poorthemers_helper; ?>
  <head>
    <title><?php print $head_title; ?></title>
    <?php print $head; ?>
    <?php print $appletouchicon; ?>
    <?php if(theme_get_setting('mothership_mobile')){  ?>
    <meta name="MobileOptimized" content="width">
    <meta name="HandheldFriendly" content="true"><?php } ?>
    <?php if(theme_get_setting('mothership_viewport')){  ?><meta name="viewport" content="width=device-width, initial-scale=1"><?php } ?>
    <?php if(theme_get_setting('mothership_viewport_maximumscale')){  ?><meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"><?php } ?>
    <?php print $styles; ?>
    <!--[if lt IE 9]>
      <script src="/sites/all/themes/personaleweb/js/html5shiv.js"></script>
    <![endif]-->
    <?php
      if(!theme_get_setting('mothership_script_place_footer')) {
        print $scripts;
      }
    ?>
  </head>
  <body class="<?php print $classes; ?>" <?php print $attributes;?>>
    <a href="#main-content" class="element-invisible element-focusable"><?php print t('Skip to main content'); ?></a>
    <?php print $page_top; //stuff from modules always render first ?>
    <?php print $page; // uses the page.tpl ?>
    <?php
      if(theme_get_setting('mothership_script_place_footer')) {
        print $scripts;
      }
    ?>
    <?php print $page_bottom; //stuff from modules always render last ?>
  </body>
</html>

