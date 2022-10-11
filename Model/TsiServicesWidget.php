<?php

class TsiServicesWidget extends AppModel {
  // Define class name for cake
  public $name = "TsiServicesWidget";

  // Required by COmanage Plugins
  public $cmPluginType = "dashboardwidget";
  
  // Add behaviors
  // public $actsAs = array('Containable');
  
  // Document foreign keys
  public $cmPluginHasMany = array();
  
  // Association rules from this model to other models
  public $belongsTo = array(
  );
  
  public $hasMany = array(
  );
  
  // Default display field for cake generated views
  // public $displayField = "description";
  
  // Validation rules for table elements
  public $validate = array(
  );
  
  public function cmPluginMenus() {
    return array();
  }
}
