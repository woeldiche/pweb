<?php
/**
 * @file
 * Template for a 3 column panel layout for search result pages.
 *
 * This template provides a three column panel display layout, with
 * additional areas for at the bottom and a special area for
 * the filters bar.
 *
 * Variables:
 * - $id: An optional CSS id to use for the layout.
 * - $content: An array of content, each item in the array is keyed to one
 *   panel of the layout. This layout supports the following sections:
 *   - $content['filters']: Content in the filters area. Outside panel.
 *   - $content['left']: Content in the left column.
 *   - $content['middle']: Content in the middle column.
 *   - $content['right']: Content in the right column.
 *   - $content['bottom']: Content in the bottom row.
 */
?>
<?php if ($content['filters']): ?>
  <nav role="navigation" class="grid-full grid clearfix block-navigation">
    <?php print $content['filters']; ?>
  </nav>
<?php endif ?>

<div class="grid-full grid clearfix" <?php if (!empty($css_id)) { print "id=\"$css_id\""; } ?>>
  <?php if ($content['left']): ?>
    <div class="grid-1 facet-column">
      <?php print $content['left']; ?>
    </div>
  <?php endif ?>

  <?php if ($content['middle']): ?>
    <div class="grid-2 grid search-column">
      <?php print $content['middle']; ?>
    </div>
  <?php endif ?>

  <?php if ($content['right']): ?>
    <div class="grid-1 grid">
      <?php print $content['right']; ?>
    </div>
  <?php endif ?>
</div>

<?php if ($content['bottom']): ?>
  <div class="grid-full grid clearfix">
    <?php print $content['bottom']; ?>
  </div>
<?php endif ?>
