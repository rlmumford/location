<?php

namespace Drupal\location;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Config\Entity\ConfigEntityListBuilder;

/**
 * List controller for service types.
 */
class LocationTypeListBuilder extends ConfigEntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header = [
      'type' => [
        'data' => $this->t('Type'),
        'field' => 'label',
        'specifier' => 'type',
      ],
      'reusable' => [
        'data' => $this->t('Reusable?'),
        'field' => 'reusable',
        'specifier' => 'reusable',
      ],
    ];
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    $row['type'] = $entity->label();
    $row['reusable'] = $entity->isReusable() ? $this->t('Yes') : $this->t('No');
    return $row + parent::buildRow($entity);
  }
}
