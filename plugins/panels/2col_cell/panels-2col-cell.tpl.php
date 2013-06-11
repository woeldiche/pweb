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
 *   - $content['middle']: Content in the middle column.
 */
?>
<?php if ($content['middle']): ?>
  <div class="grid clearfix cell-2-1" <?php if (!empty($css_id)) { print "id=\"$css_id\""; } ?>>
    <?php print $content['middle']; ?>
  </div>
<?php endif ?>
