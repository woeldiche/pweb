<?php
//kpr(get_defined_vars());
?>
<?php if( theme_get_setting('mothership_poorthemers_helper') ){ ?>
<!--page.tpl.php-->
<?php } ?>

<?php print $mothership_poorthemers_helper; ?>

<div class="wrapper page-top">
  <header class="header clearfix" role="banner">
    <div class="siteinfo">
      <?php if ($logo): ?>
        <a class="site-logo" href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home">
          <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
        </a>
      <?php endif; ?>

      <?php if($site_name or $site_slogan ): ?>
        <?php if($site_name AND $site_slogan): ?>
        <hgroup  class="element-invisible">
        <?php endif; ?>
          <?php if($site_name): ?>
            <h1><?php print $site_name; ?></h1>
          <?php endif; ?>
          <?php if ($site_slogan): ?>
            <h2><?php print $site_slogan; ?></h2>
          <?php endif; ?>
        <?php if($site_name AND $site_slogan): ?>
        </hgroup>
        <?php endif; ?>
      <?php endif; ?>
    </div>

    <?php if($page['search']): ?>
      <div class="search-region">
        <?php // @todo: Print secondary menu links; ?>
        <?php print render($page['search']); ?>
      </div>
    <?php endif; ?>
  </header>

  <?php if($page['menu'] || $page['filterbar']): ?>
  <nav class="menu-region">
    <?php if ($action_links): ?>
      <ul class="action-links"><?php print render($action_links); ?></ul>
    <?php endif; ?>

    <?php if (isset($tabs['#primary'][0]) || isset($tabs['#secondary'][0])): ?>
      <nav class="tabs"><?php print render($tabs); ?></nav>
    <?php endif; ?>

    <?php if($page['highlighted'] or $messages){ ?>
      <div class="drupal-messages">
      <?php print render($page['highlighted']); ?>
      <?php print $messages; ?>
      </div>
    <?php } ?>

    <?php print render($page['menu']); ?>
    <?php print render($page['filterbar']); ?>
  </nav>
  <?php endif; ?>

  <div role="main">
    <div  class="m-main">
      <?php print render($title_prefix); ?>
      <?php if ($title): ?>
        <h1 class="title-page"><?php print $title; ?></h1>
      <?php endif; ?>
      <?php print render($title_suffix); ?>

      <?php // print $breadcrumb; ?>

      <?php print render($page['content']); ?>
      <?php print $feed_icons; ?>
    </div><!--/main-->
  </div><!--/page-->
</div>
<?php if($page['postscript_first'] || $page['postscript_second'] || $page['postscript_third']): ?>
<div class="m-secondary">
  <div class="wrapper clearfix">

    <?php if($page['postscript_first']): ?>
      <div class="grid-15 grid">
        <?php print render($page['postscript_first']); ?>
      </div>
    <?php endif; ?>

    <?php if($page['postscript_second']): ?>
      <div class="grid-15 grid">
        <?php print render($page['postscript_second']); ?>
      </div>
    <?php endif; ?>

    <?php if($page['postscript_third']): ?>
      <div class="grid-1 grid">
        <?php print render($page['postscript_third']); ?>
      </div>
    <?php endif; ?>

  </div>
</div>
<?php endif; ?>

<div class="wrapper">
  <footer class="footer-region clearfix text-footer" role="contentinfo">
    <?php print render($page['footer']); ?>
    <?php print $logo_list; ?>
  </footer>
</div>
