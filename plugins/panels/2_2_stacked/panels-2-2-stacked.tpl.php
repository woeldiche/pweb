<?php
/**
 * @file
 * Template for a 2 column panel layout for homepage and section pages.
 *
 * This template provides a two column panel display layout, with
 * additional areas for the top and the bottom and a special area for
 * the filters bar on section and tag pages.
 *
 * Variables:
 * - $id: An optional CSS id to use for the layout.
 * - $content: An array of content, each item in the array is keyed to one
 *   panel of the layout. This layout supports the following sections:
 *   - $content['filters']: Content in the filters area. Outside panel.
 *   - $content['top']: Content in the top row.
 *   - $content['left']: Content in the left column.
 *   - $content['right']: Content in the right column.
 *   - $content['bottom']: Content in the bottom row.
 */
?>
<?php if ($content['filters']): ?>
  <nav role="navigation" class="grid-full grid clearfix block-filter">
    <?php print $content['filters']; ?>
  </nav>
<?php endif ?>

<div class="grid-full grid clearfix" <?php if (!empty($css_id)) { print "id=\"$css_id\""; } ?>>
  <?php if ($content['top']): ?>
    <div class="grid-full">
      <?php print $content['top']; ?>
    </div>
  <?php endif ?>

  <div class="masonry-front clearfix grid">
    <?php print $content['left']; ?>
  </div>

  <div class="masonry-front clearfix grid">
    <?php print $content['right']; ?>
  </div>

  <?php if ($content['bottom']): ?>
    <div class="grid-full grid">
      <?php print $content['bottom']; ?>
    </div>
  <?php endif ?>
</div>
