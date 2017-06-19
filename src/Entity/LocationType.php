<?php

namespace Drupal\location\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;
use Drupal\Core\Enttiy\EntityStorageInterface;

/**
 * Defines the location type entity class.
 *
 * @ConfigEntityType(
 *   id = "location_type",
 *   label = @Translation("Location Type"),
 *   handlers = {
 *     "list_builder" = "Drupal\location\LocationTypeListBuilder",
 *     "form" = {
 *       "default" = "Drupal\location\LocationTypeForm"
 *     }
 *   },
 *   admin_permission = "administer location types",
 *   config_prefix = "type",
 *   bundle_of = "location",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *   },
 *   config_export = {
 *     "id",
 *     "label",
 *     "default_label",
 *     "default_uri",
 *   },
 *   links = {
 *     "add-form" = "/admin/structure/location_types/add",
 *     "delete-form" = "/admin/structure/location_types/manage/{location_type}/delete",
 *     "edit-form" = "/admin/structure/location_types/manage/{location_type}",
 *     "admin-form" = "/admin/structure/location_types/manage/{location_type}",
 *     "collection" = "/admin/structure/location_types"
 *   }
 * )
 */
class LocationType extends ConfigEntityBundleBase {

  /**
   * The primary identifier for the location type.
   *
   * @var string
   */
  protected $id;

  /**
   * The universally universally unique id for the location type.
   *
   * @var string
   */
  protected $uuid;

  /**
   * The human-readable name of the location type.
   *
   * @var string
   */
  protected $label;

  /**
   * Whether or not the location type is reusable.
   *
   * @var boolean
   */
  protected $reusable;

}
