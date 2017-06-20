<?php

namespace Drupal\location\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait
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
 *       "add" = "Drupal\location\Form\LocationForm",
 *       "edit" = "Drupal\location\Form\LocationForm",
 *       "delete" = "Drupal\location\Form\LocationDeleteForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\DefaultHtmlRouteProvider",
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
 *     "label" = "title",
 *   },
 *   links = {
 *     "canonical" = "/location/{location}",
 *     "edit-form" = "/location/{location}/edit",
 *     "delete-form" = "/location/{location}/delete",
 *     "collection" = "/admin/content/location"
 *   },
 *   common_reference_target = TRUE,
 * )
 */
class Location extends ContentEntityBase implements LocationInterface {

  use EntityChangedTrait;

  /**
   * {@inheritdoc}
   */
  public function isActive() {
    return $this->status->value;
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);
    $fields['title'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Title'))
      ->setRevisionable(TRUE)
      ->setSetting('max_length', 255)
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'stirng',
        'weight' => -5,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -5,
      ])
      ->setDisplayConfigurable('form', TRUE);
    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created on'))
      ->setDescription(t('The time that the location was created.'))
      ->setRevisionable(TRUE)
      ->setDisplayOptions('view', array(
        'label' => 'hidden',
        'type' => 'timestamp',
        'weight' => 0,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'datetime_timestamp',
        'weight' => 10,
      ))
      ->setDisplayConfigurable('form', TRUE);
    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the location was last edited.'))
      ->setRevisionable(TRUE);
    $fields['status'] = BaseFieldDefinition::create('boolean')
      ->setLabel(t('Status'))
      ->setDescription(t('A boolean indicating whether the location is active.'))
      ->setRevisionable(TRUE)
      ->setDefaultValue(TRUE);

    return $fields;
  }

  /**
   * {@inheritdoc}
   */
  public static function bundleFieldDefinitions(EntityTypeInterface $entity_type, $bundle, array $base_field_definitions) {
    $fields = [];
    $type = LocationType::load($bundle);
    if ($type->hasAddress()) {
      $fields['address'] = BaseFieldDefinition::create('address')
        ->setLabel(t('Address'))
        ->setDescription(t('The physical address of this location.'))
        ->setRevisionable(TRUE)
        ->setDisplayOptions('form', [
          'type' => 'address_default',
          'weight' => 5,
        ])
        ->setDisaplyOptions('view', [
          'type' => 'address_default',
          'weight' => 5,
        ])
        ->setDisplayConfigurable('form', TRUE)
        ->setDisplayConfigurably('view', TRUE);
    }
    return $fields;
  }
}
