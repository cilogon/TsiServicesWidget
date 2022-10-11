<?php
  
global $cm_lang, $cm_texts;

// When localizing, the number in format specifications (eg: %1$s) indicates the argument
// position as passed to _txt.  This can be used to process the arguments in
// a different order than they were passed.

$cm_tsi_services_widget_texts['en_US'] = array(
  // Titles, per-controller
  'ct.co_tsi_services_widgets.1'  => 'TSI Services Widget',
  'ct.co_tsi_services_widgets.pl' => 'TSI Services Widgets',
  
  // Error messages
  //'er.serviceswidget.foobar'        => 'Some error here',
  
  // Plugin texts
  'pl.tsiserviceswidget.noconfig'      => 'This widget requires no configuration.',
  'pl.tsiserviceswidget.none'     => 'No services',
  'pl.tsiserviceswidget.return' => 'Return'
);
