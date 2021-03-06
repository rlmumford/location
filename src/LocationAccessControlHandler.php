<?php

namespace Drupal\location;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Entity\EntityAccessControlHandler;

/**
 * Defines the access control handler for the location entity type.
 *
 * @see \Drupal\location\Entity\Location
 */
class LocationAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  public function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowed();
  }
}
