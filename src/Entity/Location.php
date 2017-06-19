<?php

namespace Drupal\location\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;

/**
 * Define the location entity type.
 *
 * @ContentEntityType(
 *   id = "location",
 *   label = @Translation("Location"),
 *   label_singular = @Translation("location"),
 *   label_plural = @Translation("locations"),
 *   label_count = @Translation(
 *     singular = "a location",
 *     plural = "@count locations",
 *   ),
 *   handlers = {
 *     "access" = "Drupal\location\LocationAccessControlHandler",
 *     "list_builder" = "Drupal\location\LocationListBuilder",
 *     "form" = {
 *       "default" = "Drupal\location\Form\LocationForm",
 *     },
 *   },
 *   bundle_entity_type = "location_type",
 *   field_ui_base_route = "entity.location_type.edit_form",
 *   admin_permission = "administer locations",
 *   base_table = "location",
 *   data_table = "location_data",
 *   revision_table = "location_revision",
 *   revision_data_table = "location_revision_data",
 *   fieldable = TRUE,
 *   entity_keys = {
 *     "id" = "id",
 *     "uuid" = "uuid",
 *     "revision" = "revision",
 *     "bundle" = "type",
 *   },
 * )
 */
class Location extends ContentEntityBase {

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);
    return $fields;
  }
}
