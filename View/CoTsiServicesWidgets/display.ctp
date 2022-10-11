<?php
?>

<div class="co-services">
  
  <?php foreach ($co_services as $c): ?>

    <?php
    $containerClass = "";
    if(!empty($c['CoService']['co_group_id'])) {
      // Possibly render a join/leave link, depending on whether
      // the group is open and if this person is currently a member.
      $isMember = false;
      $isOpen = false;

      if(isset($vv_member_groups)
        && in_array($c['CoService']['co_group_id'], $vv_member_groups)) {
        $isMember = true;
      }

      if(isset($vv_open_groups)
        && in_array($c['CoService']['co_group_id'], $vv_open_groups)) {
        $isOpen = true;
      }

      $args = array(
        'controller' => 'co_services',
      );
      $action = "";
      $attribs = null;

      if($isMember) {
        if($isOpen) {
          $action = _txt('op.svc.leave');
          $args['action'] = 'leave';
          $attribs = array(
            'class' => 'co-card-link deletebutton ui-button ui-corner-all ui-widget',
          );
        } else {
          $action = _txt('op.svc.member');
          $args = null;
        }
        $containerClass = " is-member";
      } else {
        if($isOpen) {
          $action = _txt('op.svc.join');
          $args['action'] = 'join';
          $attribs = array(
            'class' => 'co-card-link addbutton ui-button ui-corner-all ui-widget',
          );
        } else {
          // XXX CO-1057
          // $action = _txt('op.svc.request');
          $args = null;
        }
      }
    }

    if(!empty($c['CoService']['service_url'])) {
      $containerClass .= " co-card-linked";
    }
    ?>

  <div class="co-card<?php print $containerClass ?>">
    <?php
       $filteredServiceName = filter_var($c['CoService']['name'],FILTER_SANITIZE_SPECIAL_CHARS);
    ?>
    <h2>
      <?php
        // wrap the title with the URL if available; JavaScript will be used to make entire div clickable
        if(!empty($c['CoService']['service_url'])) {
          // Replace URL template ??co_person_id with the passed view variable value.
          $url = str_replace('??co_person_id??', $co_person_id, $c['CoService']['service_url']);
          if(substr($url, 0, 4) !== 'http') {
            $url = Router::url('/', true) . $url;
          }

          print $this->Html->link(
            $c['CoService']['name'], // note that the link function does the filtering for us.
            $url,
            array(
              'class' => 'co-card-link co-card-service-url',
              'escape' => false,
              'title' => $url
            ));
        } else {
          // otherwise just print the name
          print $filteredServiceName;
        }
      ?>
    </h2>
    <div class="co-card-content">
      <?php if(!empty($c['CoService']['logo_url'])): ?>
        <div class="co-card-image">
          <?php print $this->Html->image($c['CoService']['logo_url'], array('alt' => $filteredServiceName . ' Logo')); ?>
        </div>
      <?php endif; ?>
      <div class="co-card-description">
        <?php print filter_var($c['CoService']['description'],FILTER_SANITIZE_SPECIAL_CHARS); ?>
      </div>
      <div class="co-card-icons">
        <?php

          if(!empty($c['CoService']['contact_email'])) {
            print $this->Html->link('<em class="material-icons" aria-hidden="true">email</em>',
              'mailto:'.$c['CoService']['contact_email'],
              array(
                'class' => 'co-card-link',
                'escape' => false,
                'title' => _txt('fd.svc.mail.prefix', array($c['CoService']['contact_email']))
              ));
          }

        ?>
      </div>
      <div class="co-card-join-button">
        <?php
          if(!empty($c['CoService']['co_group_id'])) {
            // Render the join/leave link, depending on the outcome of the code above
            if($args) {
              $args[] = $c['CoService']['id'];
              
              // If we have a cou (ie: cou portal), add it here as advisory for redirect
              if(!empty($this->request->params['named']['cou'])) {
                $args['cou'] = filter_var($this->request->params['named']['cou'],FILTER_SANITIZE_SPECIAL_CHARS);
              }
              print $this->Html->link($action, $args, $attribs);
            } else {
              print $action;
            }
          }
        ?>
      </div>
      <span class="clearfix"></span>
    </div>
  </div>
  <?php endforeach; ?>

</div>


<script>
  $(function() {
    // make entire service card clickable
    $(".co-card-linked").click(function () {
      cardServiceUrl = $(this).find("a.co-card-service-url").attr("href");
      if (cardServiceUrl != undefined && cardServiceUrl != "") {
        window.location.href = cardServiceUrl;
      }
    });

    // don't bubble the event if we've clicked on a child anchor
    $(".co-card-linked a.co-card-link").click(function (e) {
      e.stopPropagation();
    });
  });
</script>
