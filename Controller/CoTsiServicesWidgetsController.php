<?php

App::uses("SDWController", "Controller");

class CoTsiServicesWidgetsController extends SDWController {
  // Class name, used by Cake
  public $name = "CoTsiServicesWidgets";
  
  public $uses = array("TsiServicesWidget.CoTsiServicesWidget", "CoService");
  
  /**
   * Render the widget according to the requested user and current configuration.
   *
   * @since  COmanage Registry v3.2.0
   * @param  Integer $id CO Services Widget ID
   */
  
  public function display($id) {
    // Find all the active services and set a view variable.

    $args = array();
    $args['conditions']['co_id'] = $this->cur_co['Co']['id'];
    $args['conditions']['CoService.status'] = SuspendableStatusEnum::Active;
    $args['order'] = 'CoService.name';
    $args['contain'] = false;

    $coServices = $this->CoTsiServicesWidget->CoDashboardWidget->CoDashboard->Co->CoService->find('all', $args);

    $this->set('co_services', $coServices);

    // Set a view variable with the CO Person ID.
    $this->set('co_person_id', $this->reqCoPersonId);
  }
  
  /**
   * Authorization for this Controller, called by Auth component
   * - precondition: Session.Auth holds data used for authz decisions
   * - postcondition: $permissions set with calculated permissions
   *
   * @since  COmanage Registry v3.2.0
   * @return Array Permissions
   */
  
  function isAuthorized() {
    $roles = $this->Role->calculateCMRoles();

    // Determine what operations this user can perform
    
    // Construct the permission set for this user, which will also be passed to the view.
    // Ask the parent to calculate the display permission, based on the configuration.
    // Note that the display permission is set at the Dashboard, not Dashboard Widget level.
    $p = $this->calculateParentPermissions($roles);

    // Delete an existing CO Services Widget?
    $p['delete'] = ($roles['cmadmin'] || $roles['coadmin']);
    
    // Edit an existing CO Services Widget?
    $p['edit'] = ($roles['cmadmin'] || $roles['coadmin']);

    // View an existing CO Services Widget?
    $p['view'] = ($roles['cmadmin'] || $roles['coadmin']);
    
    $this->set('permissions', $p);
    return($p[$this->action]);
  }
}
