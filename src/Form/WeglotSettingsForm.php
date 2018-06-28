<?php
/**
 * @file
 * Contains \Drupal\weglot\Form\WeglotSettingsForm.
 */

namespace Drupal\weglot\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Weglot settings form
 */
class WeglotSettingsForm extends ConfigFormBase
{

    /**
     * Implements \Drupal\Core\Form\FormInterface::getFormID().
     */
    public function getFormId()
    {
        return 'weglot_admin';
    }

    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames()
    {
        return ['weglot.settings'];
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state)
    {
        $config = $this->config('weglot.settings');

        $form['general'] = array(
          '#type' => 'fieldset',
          '#title' => t('General Configuration'),
          '#collapsible' => false,
          '#collapsed' => false,
        );

        $form['general']['weglot_api_key'] = array(
          '#type' => 'textfield',
          '#title' => t('Api Key'),
          '#default_value' => $config->get('weglot_api_key', ''),
          '#description' => t("Log in to <a target='_blank' href='https://weglot.com/register-wordpress'>Weglot</a> to get your API key."),
          '#required' => true
        );

        $form['exclusion'] = array(
          '#type' => 'fieldset',
          '#title' => t('Translation exclusion (optional)'),
          '#description' => t('By default, every page is translated. You can exclude parts of a page or a full page here.'),
          '#collapsible' => true,
          '#collapsed' => false,
        );

        $form['exclusion']['weglot_exclude_url'] = array(
          '#type' => 'textarea',
          '#title' => 'Exclude URL here',
          '#description' => t('You can write regex.'),
          '#default_value' => $config->get('weglot_exclude_url', '')
        );

        $form['exclusion']['weglot_exclude_blocks'] = array(
          '#type' => 'textarea',
          '#title' => 'Exclude blocks',
          '#description' => t('Enter CSS selectors, separated by commas.'),
          '#default_value' => $config->get('weglot_exclude_blocks', '')
        );

        return parent::buildForm($form, $form_state);
    }

    /**
     * {@inheritdoc}
     */
    public function validateForm(array &$form, FormStateInterface $form_state)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
      $form_value = $form_state->getValues();

      $this->config('weglot.settings')
          ->set('weglot_api_key', $form_value['weglot_api_key'])
          ->set('weglot_exclude_url', $form_value['weglot_exclude_url'])
          ->set('weglot_exclude_blocks', $form_value['weglot_exclude_blocks'])
          ->save();

        parent::submitForm($form, $form_state);
    }
}
