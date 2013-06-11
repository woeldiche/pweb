<?php

/**
 * Implements template_preprocess_page().
 * Adds variable printing partner logos.
 */
function personaleweb_preprocess_page(&$vars) {
  $logos  = '<ul class="list-logos">';
  $logos .= '<li class="logo-item"><img src="/' . drupal_get_path("theme", "personaleweb") . '/images/logo-kl.png"  /></li>';
  $logos .= '<li class="logo-item"><img src="/' . drupal_get_path("theme", "personaleweb") . '/images/logo-dr.png"  /></li>';
  $logos .= '<li class="logo-item"><img src="/' . drupal_get_path("theme", "personaleweb") . '/images/logo-kto.png" /></li>';
  $logos .= '<li class="logo-item"><img src="/' . drupal_get_path("theme", "personaleweb") . '/images/logo-sk.png"  /></li>';
  $logos .= '</ul>';

  $vars['logo_list'] = $logos;

}

/**
 * Implements template_preprocess_block().
 *
 * Adds classes for styling.
 */
function personaleweb_preprocess_block(&$vars, $hook) {
  // Check if block was created by views.
  if ($vars['elements']['#block']->module == 'views') {

    // If views name exists directly get that.
    if (isset($vars['elements']['#views_contextual_links_info']['views_ui']['view']->name)) {
      $views_name = $vars['elements']['#views_contextual_links_info']['views_ui']['view']->name;
    }

    // If not grab it from ['#block']->delta.
    else {
      $block_delta = explode('-', $vars['elements']['#block']->delta);
      $views_name = $block_delta[0];
    }

    // Add classes based on views name.
    switch ($views_name) {
      case 'latest_news':
      case 'upcoming_events':
        $vars['title_attributes_array']['class'][] = 'title-list';
        if ($vars['elements']['#block']->region == 'inner_right') {
          $vars['classes_array'][] = 'block-list';
        }

        break;

      case 'text_blocks_files_and_contact_info_view':
        $vars['title_attributes_array']['class'] = array('title-block');
        $vars['classes_array'] = array('block-secondary');
        break;

      default;

    }
  } elseif ($vars['elements']['#block']->module == 'facetapi') {
     $vars['classes_array'] = array('block-secondary', 'block-facet');
     $vars['title_attributes_array']['class'] = array('title-block');

  }

  // Else switch based on region
  switch ($vars['elements']['#block']->region) {
    case 'postscript_first':
    case 'postscript_second':
    case 'postscript_third':
      $vars['classes_array'][] = 'm-block';
      $vars['classes_array'][] = 'clearfix';
      $vars['title_attributes_array']['class'][] = 'title-list';
      break;

    case 'inner_right':
      $vars['classes_array'][] = 'block-list';

    default;
  }
}


/**
 * Implements template_preprocess_panels_pane().
 *
 * Adds classes for styling.
 */
function personaleweb_preprocess_panels_pane(&$vars) {
  // Add styling classes to fields as panes.
  if ($vars['pane']->type == 'entity_field') {
    switch ($vars['content']['#field_name']) {
      case 'field_location':
      case 'field_date':
      case 'field_price':
      case 'field_deadline':
      case 'field_website':
      case 'field_organizer':
      case 'field_contact_information':
        $vars['title_attributes_array']['class'] = array('list-key');
      default;
    }
  // add classes to views panes.
  } elseif ($vars['pane']->type == 'views_panes') {
    // First add classes based on display
    switch ($vars['pane']->subtype) {
      case 'tags-panel_pane_1':
        $vars['title_attributes_array']['class'] = array('content-footer-title', 'text-secondary');
        $vars['theme_hook_suggestions'][] = 'panels_pane__wrapper';
        $vars['classes_array'][] = 'clear';
        break;

      default:
    }

    // Switch add classes based on location
    switch ($vars['pane']->panel) {
      case 'outer_right':
        $vars['title_attributes_array']['class'][] = 'title-block';
        break;
    }
  }
    // Add classes to search result lists
    elseif ($vars['pane']->type == 'search_results') {
      switch ($vars['pane']->panel) {
        case 'right':
          $vars['classes_array'][] = 'grid-1';
          $vars['classes_array'][] = 'grid';
          $vars['classes_array'][] = 'clearfix';
          $vars['classes_array'][] = 'list-pane';

        case 'left':
          $vars['theme_hook_suggestions'][] = 'panels_pane__wrapper';
          break;
      }
  }
  // Modify specific panes.
  //kpr($vars);
  switch ($vars['pane']->subtype) {
    case 'pwb_subscribe-pwb_subscribe':
      $vars['classes_array'] = array('contextual-links-region');
      $vars['classes_array'][] = 'block-modal';
      $vars['classes_array'][] = 'clearfix';
      $vars['theme_hook_suggestions'][] = 'panels_pane__wrapper';
      $vars['title_attributes_array']['class'][] = 'title-list';
      $vars['title_attributes_array']['class'][] = 'modal-trigger';
      $vars['title_attributes_array']['class'][] = 'title-subscribe';
      break;

    case 'menu-basic-pages':
      $vars['title_attributes_array']['class'][] = 'title-menu';
      break;
  }
}

/**
 * Implements template_preprocess_fiels().
 */
function personaleweb_preprocess_field(&$vars,$hook) {
  //add class to a specific field
  switch ($vars['element']['#field_name']) {
    case 'body':
      $vars['classes_array'][] = 'text-content';
      break;
    case 'field_summary':
      $vars['classes_array'][] = 'text-teaser';
      break;
    case 'field_location':
    case 'field_date':
    case 'field_price':
    case 'field_deadline':
    case 'field_website':
    case 'field_organizer':
    case 'field_contact_information':
      $vars['classes_array'] = array('list-definition', 'text-content');
      break;
    case 'field_image':
      $vars['classes_array'] = array('title-image');
    default:
      break;
  }
}

/**
 * MYTHEME_theme_name().
 * wraps output in <span>
 */
function personaleweb_facetapi_link_active($variables) {
  // Sanitizes the link text if necessary.
  $sanitize = empty($variables['options']['html']);
  $link_text = ($sanitize) ? check_plain($variables['text']) : $variables['text'];

  $variables['options']['html'] = TRUE;
  foreach ($variables['options']['attributes']['class'] as $index => $class) {
    if ($class == 'facetapi-active') {
      $variables['options']['attributes']['class'][$index] = 'facetapi-text-active';
    }
  }

  return '<span class="active-link">' . theme('link', $variables) . '</span>';
}

/**
 * Implements hook_form_FORMID_alter().
 *
 * Adjust global search box.
 */
function personaleweb_form_pwb_search_form_alter(&$form) {
  $form['pwb_search_container']['submit']['#type'] = 'image_button';
  unset($form['pwb_search_container']['submit']['#value']);
  $form['pwb_search_container']['submit']['#src'] = drupal_get_path('theme', 'personaleweb') .'/images/icon-search.png';
  $form['pwb_search_container']['submit']['#attributes'] = array('class' => array('search-submit'),'alt' => array(t('search')));
}


/**
 * Implements hook_form_FORMID_alter().
 *
 * Adjusts search bar on search pages.
 */
function personaleweb_form_freetext_search_block_form_alter(&$form) {
  // Reorder fields to make submit and
  $form['search']['#weight'] = -10;
  $form['submit']['#weight'] = -9;
  $form['pwb_search_facets_content_types']['#weight'] = -8;

  // Add classes for styling
  $form['search']['#attributes']['class'][] = 'inline-field';
  $form['submit']['#attributes']['class'][] = 'inline-field end-icon';
  $form['pwb_search_facets_content_types']['#attributes']['class'][] = 'inline-field';

  // Change submit to image button.
  $form['submit']['#type'] = 'image_button';
  unset($form['submit']['#value']);
  $form['submit']['#src'] = drupal_get_path('theme', 'personaleweb') .'/images/icon-search.png';
}



/**
 * Implements template_preprocess_views_view().
 *
 * Adds styling classes to views.
 * Show/hides teaser texts on tiles based on presence of image.
 */
function personaleweb_preprocess_views_view (&$vars) {
  switch ($vars['view']->name) {
    // Add classes to frontpage/sectionpage tiles.
    case 'nodequeue_1':
      // Use offset to add alternating classes to tiles
      switch ($vars['view']->offset) {
        case 0:
          break;
        case 1:
          $vars['classes_array'][] = 'st-magenta';
          break;
        case 2:
          $vars['classes_array'][] = 'st-yellow';
          break;
        case 3:
          $vars['classes_array'][] = 'st-petroleum';
          $vars['classes_array'][] = 'last';
          break;
        case 4:
          $vars['classes_array'][] = 'st-magenta';
          break;
        case 5:
          $vars['classes_array'][] = 'st-yellow';
          break;
        case 6:
          $vars['classes_array'][] = 'st-petroleum';
          break;
        case 7:
          $vars['classes_array'][] = 'last';
          break;
        default:
      }
      break;

    case 'articles_in_the_same_tema':
    case 'related_articles':
      $vars['theme_hook_suggestions'][] = 'views_view__no_wrapper';
      break;

    case 'section_page_cubical_view':
      // Use offset to add alternating classes to tiles
      switch ($vars['view']->offset) {
        case 0:
          $vars['classes_array'][] = 'st-yellow';
          break;

        case 1:
          $vars['classes_array'][] = 'st-petroleum';
          break;
      }
      break;

    default:
      break;
  }
}

/**
 * Implements theme_menu_tree().
 * Adds additional wrapper classes for vertical menu.
 */
function personaleweb_menu_tree__menu_basic_pages($variables) {
  return '<ul class="vertical-menu">' . $variables['tree'] . '</ul>';
}

/**
 * Implements template_preprocess_views_views_fields().
 *
 * Shows/hides summary on tiles based on presence of images.
 */
function personaleweb_preprocess_views_view_fields(&$vars) {
  if ($vars['view']->name == 'nodequeue_1' && $vars['view']->current_display == 'panel_pane_2' || $vars['view']->name == 'section_page_cubical_view' && $vars['view']->current_display == 'panel_pane_1') {

    // Check if we have both an image and a summary
    if (isset($vars['fields']['field_image']) && $vars['fields']['field_image']->content != '<div class="tile-image"></div>') {
      // If a combined field has been created, unset it and just show image
      if (isset($vars['fields']['nothing'])) {
        unset($vars['fields']['nothing']);
      }
    } elseif (isset($vars['fields']['title'])) {
      unset ($vars['fields']['title']);
    }

    // Always unset the separate summary if set
    if (isset($vars['fields']['field_summary'])) {
      unset($vars['fields']['field_summary']);
    }
  }
}

/**
  * Implements hook_form_formid_alter().
  *
  * Add styling classes to form elements.
  */
function personaleweb_form_campaignmonitor_subscribe_form_alter(&$form, &$form_state) {
  $form['unsubscribe']['#attributes']['class'][] = "text-link";
  $form['example_link']['#attributes']['class'][] = "text-link align-right";
}


function personaleweb_form_element__prp_facet_dropdown_checkbox($variables) {
  $element = &$variables['element'];
  // This is also used in the installer, pre-database setup.
  $t = get_t();

  // This function is invoked as theme wrapper, but the rendered form element
  // may not necessarily have been processed by form_builder().
  $element += array(
    '#title_display' => 'before',
  );

  // Add element #id for #type 'item'.
  if (isset($element['#markup']) && !empty($element['#id'])) {
    $attributes['id'] = $element['#id'];
  }
  // Add element's #type and #name as class to aid with JS/CSS selectors.
  $attributes['class'] = array('form-item');
  if (!empty($element['#type'])) {
    $attributes['class'][] = 'form-type-' . strtr($element['#type'], '_', '-');
  }
  if (!empty($element['#name'])) {
    $attributes['class'][] = 'form-item-' . strtr($element['#name'], array(' ' => '-', '_' => '-', '[' => '-', ']' => ''));
  }
  // Add a class for disabled elements to facilitate cross-browser styling.
  if (!empty($element['#attributes']['disabled'])) {
    $attributes['class'][] = 'form-disabled';
  }
  $output = '<div' . drupal_attributes($attributes) . '>' . "\n";

  // If #title is not set, we don't display any label or required marker.
  if (!isset($element['#title'])) {
    $element['#title_display'] = 'none';
  }
  $prefix = isset($element['#field_prefix']) ? '<span class="field-prefix">' . $element['#field_prefix'] . '</span> ' : '';
  $suffix = isset($element['#field_suffix']) ? ' <span class="field-suffix">' . $element['#field_suffix'] . '</span>' : '';

  $classes = array();
  if (isset($element['#attributes']['class']) && !empty($element['#attributes']['class'])) {
    $classes = $element['#attributes']['class'];
  }
  $classes[] = 'prp_checkbox_links';

  $output .= ' ' . $prefix . $element['#children'] . $suffix;
  $options = array('attributes' => array('id' => $element['#id'] . '-link', 'class' => $classes), 'html' => FALSE);
  $output .= ' ' . theme('link', array('text' => $element['#title'], 'path' => '#', 'options' => $options)) . "\n";

  if (!empty($element['#description'])) {
    $output .= '<div class="description">' . $element['#description'] . "</div>\n";
  }

  $output .= "</div>\n";

  $output .= '<script type="text/javascript">';
    $output .= 'jQuery("#'. $element['#id'] . '-link' .'").click(function() {var checkbox_id = jQuery(this).attr("id").replace(/-link$/, ""); jQuery("#" + checkbox_id).attr("checked", true); jQuery(this).parents("form:first").submit(); return false;})';
  $output .= '</script>';

  return $output;
}
