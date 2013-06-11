<?php
/**
 * @file
 * Template for a 3 column panel layout node panels.
 *
 * This template provides a three column panel display layout, with
 * additional areas for the top and the bottom and a special area for
 * the filters bar on section and tag pages.
 *
 * Variables:
 * - $id: An optional CSS id to use for the layout.
 * - $content: An array of content, each item in the array is keyed to one
 *   panel of the layout. This layout supports the following sections:
 *   - $content['filters']: Content in the filters area. Outside panel.
 *   - $content['top']: Content in the top row. Full width.
 *   - $content['image']: Content in the image row.
 *   - $content['left']: Content in the left, main column.
 *   - $content['inner_right']: Content in the inner right column.
 *   - $content['outer_right']: Content in the outer right column.
 *   - $content['bottom']: Content in the bottom row.
 */
?>
<?php if ($content['filters']): ?>
  <nav role="navigation" class="grid-full grid clearfix block-navigation">
    <?php print $content['filters']; ?>
  </nav>
<?php endif ?>

<?php if ($content['top']): ?>
  <div class="grid-full grid">
    <?php print $content['top']; ?>
  </div>
<?php endif ?>

<div class="grid-3 grid clearfix" <?php if (!empty($css_id)) { print "id=\"$css_id\""; } ?>>
  <?php if ($content['image']): ?>
    <div class="grid-3 grid clearfix">
      <?php print $content['image']; ?>
    </div>
  <?php endif ?>

  <?php if ($content['left']): ?>
    <div class="grid-2 grid content-column">
      <?php print $content['left']; ?>
    </div>
  <?php endif ?>

  <?php if ($content['inner_right']): ?>
    <div class="grid-1 pane-inner-right grid last">
      <?php print $content['inner_right']; ?>
    </div>
  <?php endif ?>
</div>

<?php if ($content['outer_right']): ?>
  <div class="grid-1 grid pane-outer-right">
    <?php print $content['outer_right']; ?>
  </div>
<?php endif ?>

<?php if ($content['bottom']): ?>
  <div class="grid-full grid">
    <?php print $content['bottom']; ?>
  </div>
<?php endif ?>
