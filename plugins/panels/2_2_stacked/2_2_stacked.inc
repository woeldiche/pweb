<?php

// Plugin definition
$plugin = array(
  'title' => t('2-2 stacked (homepage/section)'),
  'category' => t('Personaleweb'),
  'icon' => '2_2_stacked.png',
  'theme' => 'panels_2_2_stacked',
  'css' => '2_2_stacked.css',
  'regions' => array(
    'filters' => t('Tag filter'),
    'top' => t('Top'),
    'left' => t('Left side'),
    'right' => t('Right side'),
    'bottom' => t('Bottom')
  ),
);
