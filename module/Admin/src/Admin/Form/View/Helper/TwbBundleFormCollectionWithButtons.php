<?php

namespace Application\Form\View\Helper;


use Zend\Form\View\Helper\FormCollection;

/**
 * {@inheritdoc}
 * 
 * Also renders 'add' and/or 'remove' buttons for dynamically removing/adding
 *  elements to the collection.
 */
class FieldCollection extends FormCollection
{
 protected $defaultElementHelper = 'fieldRow';
}
