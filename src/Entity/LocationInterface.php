<?php

namespace Drupal\location\Entity;

interface LocationInterface {

  /**
   * Returns true if the location is active.
   *
   * @return boolean.
   */
  public function isActive();
}
