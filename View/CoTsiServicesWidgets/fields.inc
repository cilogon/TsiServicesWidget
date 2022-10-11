<?php
  // Determine if fields are editable
  $e = false;
  
  if(($this->action == "add" && $permissions['add']) || ($this->action == "edit" && $permissions['edit']))
    $e = true;
    
  // We shouldn't get here if we don't have at least read permission, but check just in case
  
  if(!$e && !$permissions['view'])
    return false;
  
  // Add breadcrumbs
  print $this->element("coCrumb");

  $args = array();
  $args['plugin'] = null;
  $args['controller'] = 'co_dashboards';
  $args['action'] = 'index';
  $args['co'] = $cur_co['Co']['id'];
  $this->Html->addCrumb(_txt('ct.co_dashboards.pl'), $args);

  $args = array();
  $args['plugin'] = null;
  $args['controller'] = 'co_dashboards';
  $args['action'] = 'edit';
  $args[] = $co_services_widgets[0]['CoDashboardWidget']['co_dashboard_id'];
  $this->Html->addCrumb(_txt('ct.co_dashboards.1'), $args);
  
  $args = array();
  $args['plugin'] = null;
  $args['controller'] = 'co_dashboard_widgets';
  $args['action'] = 'index';
  $args['codashboard'] = $co_services_widgets[0]['CoDashboardWidget']['co_dashboard_id'];
  $this->Html->addCrumb(_txt('ct.co_dashboard_widgets.1'), $args);
  
  $crumbTxt = _txt('op.' . $this->action . '-a', array(filter_var($co_services_widgets[0]['CoDashboardWidget']['description'],FILTER_SANITIZE_SPECIAL_CHARS)));
  $this->Html->addCrumb($crumbTxt);
  
  print $this->Form->hidden('co_dashboard_widget_id', array('default' => $vv_dwid)) . "\n";
?>


<ul id="<?php print $this->action; ?>_co_url_widget" class="fields form-list form-list-admin">
  <li>
    <?php print _txt('pl.serviceswidget.noconfig'); ?>
  </li>

  <li class="fields-submit">
    <div class="submit">
      <?php print $this->Html->link(_txt('pl.serviceswidget.return'),
        $args,  array('class' => 'spin submit-button btn btn-primary')); ?>
    </div>
  </li>
</ul>
