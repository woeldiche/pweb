<?php

// Plugin definition
$plugin = array(
  'title' => t('1-2-1 stacked (search)'),
  'category' => t('Personaleweb'),
  'icon' => '1_2_1_stacked.png',
  'theme' => 'panels_1_2_1_stacked',
  'css' => '1_2_1_stacked.css',
  'regions' => array(
    'filters' => t('Search bar'),
    'left' => t('Left'),
    'middle' => t('Main content'),
    'right' => t('Right'),
    'bottom' => t('Bottom')
  ),
);
