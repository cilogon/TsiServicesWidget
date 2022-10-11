<?php

App::uses("CoDashboardWidgetBackend", "Model");

class CoTsiServicesWidget extends CoDashboardWidgetBackend {
  // Define class name for cake
  public $name = "CoTsiServicesWidget";
  
  // Add behaviors
  public $actsAs = array('Containable');
  
  // Association rules from this model to other models
  public $belongsTo = array(
    "CoDashboardWidget"
  );
  
  public $hasMany = array(
  );
  
  // Validation rules for table elements
  public $validate = array(
    'co_dashboard_widget_id' => array(
      'rule' => 'numeric',
      'required' => true,
      'allowEmpty' => false
    )
  );
}
