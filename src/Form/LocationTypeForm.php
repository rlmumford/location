<?php

namespace Drupal\location\Form;

use Drupal\Core\Entity\BundleEntityFormBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for location type forms.
 */
class LocationTypeForm extends BundleEntityFormBase {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);
    $type = $this->entity;

    // Set the title.
    if ($this->operation == 'add') {
      $form['#title'] = $this->t('Add location type');
    }
    else {
      $form['#title'] = $this->t('Edit %label location type', ['%label' => $type->label()]);
    }

    $form['label'] = [
      '#title' => $this->t('Label'),
      '#type' => 'textfield',
      '#default_value' => $type->label(),
      '#description' => $this->t('The human-readable name of this location type.'),
      '#required' => TRUE,
      '#size' => 30,
    ];
    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $type->id(),
      '#maxlength' => EntityTypeInterface::BUNDLE_MAX_LENGTH,
      '#machine_name' => [
        'exists' => '\Drupal\location\Entity\LocationType::load',
        'source' => ['label'],
      ],
    ];
    $form['reusable'] = [
      '#type' => 'checkbox',
      '#default_value' => $type->isReusable(),
      '#title' => $this->t('Locations of this type are reusable'),
      '#description' => $this->t('Reusable location can be used multiple times but cannot be edited by the field widget'),
    ];

    return $this->protectBundleIdElement($form);
  }

  /**
   * {@inheritdoc}
   */
  protected function actions(array $form, FormStateInterface $form_state) {
    $actions = parent::actions($form, $form_state);
    if (\Drupal::moduleHandler()->moduleExists('field_ui') && $this->getEntity()->isNew()) {
      $actions['save_continue'] = $actions['submit'];
      $actions['save_continue']['#value'] = $this->t('Save and manage fields');
      $actions['save_continue']['#submit'][] = [$this, 'redirectToFieldUI'];
    }
    return $actions;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $type = $this->entity;
    $status = $type->save();

    if ($status == SAVED_UPDATED) {
      drupal_set_message(t('%label location type has been updated.', ['%label' => $type->label()]));
    }
    else {
      drupal_set_message(t('%label location type has been created.', ['%label' => $type->label()]));
    }
    $form_state->setRedirect('entity.location_type.collection');
  }

  /**
   * Form submission handler to redirect to manage fields page of Field UI.
   */
  public function redirectToFieldUI(array $form, FormStateInterface $form_state) {
    if ($route_info = FieldUI::getOverviewRouteInfo('location', $this->entity->id())) {
      $form_state->setRedirectUrl($route_info);
    }
  }

  /**
   * {@inheritdoc}
   */
  public function delete(array $form, FormStateInterface $form_state) {
    $form_state->setRedirect('entity.location_type.delete_form', [
      'location_type' => $this->entity->id(),
      ]);
  }
}
