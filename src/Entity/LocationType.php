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
 *       "add" = "Drupal\location\Form\LocationTypeForm",
 *       "edit" = "Drupal\location\Form\LocationTypeForm",
 *       "delete" = "Drupal\location\Form\LocationTypeDeleteForm",
 *       "default" = "Drupal\location\Form\LocationTypeForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\DefaultHtmlRouteProvider",
 *     },
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
 *     "reusable",
 *     "has_address",
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

  /**
   * Whether or not the location has an address.
   *
   * @var boolean
   */
  protected $has_address;

  /**
   * Return whether or not this is a reusable type.
   *
   * @return boolean
   */
  public function isReusable() {
    return !empty($this->reusable);
  }

  /**
   * Return whether or not this type has an address.
   */
  public function hasAddress() {
    return !empty($this->has_address);
  }
}
