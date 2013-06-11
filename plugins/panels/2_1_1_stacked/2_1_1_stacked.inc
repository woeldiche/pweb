<?php

// Plugin definition
$plugin = array(
  'title' => t('2-1-1- stacked (node panels)'),
  'category' => t('Personaleweb'),
  'icon' => '2_1_1_stacked.png',
  'theme' => 'panels_2_1_1_stacked',
  'css' => '2_1_1_stacked.css',
  'regions' => array(
    'filters' => t('Tag filter'),
    'top' => t('Top'),
    'image' => t('Article header'),
    'left' => t('Main content'),
    'inner_right' => t('Secondary content'),
    'outer_right' => t('Right sidebar'),
    'bottom' => t('Bottom')
  ),
);
