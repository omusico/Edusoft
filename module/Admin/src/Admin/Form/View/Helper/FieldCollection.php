<?php

namespace Admin\Form\View\Helper;

use Zend\Form\Element\Collection as CollectionElement;
use Zend\Form\View\Helper\FormCollection;
use Zend\Form\ElementInterface;
use Zend\View\Helper\EscapeHtmlAttr;
use Zend\View\Helper\HeadScript;
use Zend\View\Helper\InlineScript;

class FieldCollection extends FormCollection
{
    /**
     * @var string
     */
    protected static $legendFormat = '<legend%s>%s</legend>';

    /**
     * @var string
     */
    protected static $fieldsetFormat = '<fieldset%s>%s</fieldset>';

    /**
     * Attributes valid for the tag represented by this helper
     * @var array
     */
    protected $validTagAttributes = array(
        'disabled' => true
    );

    /**
     * Render a collection by iterating through all fieldsets and elements
     * @param \Zend\Form\ElementInterface $oElement
     * @return string
     */
    public function render(ElementInterface $oElement)
    {
        $oRenderer = $this->getView();
        if (!method_exists($oRenderer, 'plugin')) {
            return '';
        }

        $bShouldWrap = $this->shouldWrap;

        $sMarkup = '';
        $sElementLayout = $oElement->getOption('twb-layout');
        if ($oElement instanceof \IteratorAggregate) {
            $oElementHelper = $this->getElementHelper();
            $oFieldsetHelper = $this->getFieldsetHelper();

            foreach ($oElement->getIterator() as $oElementOrFieldset) {
                $aOptions = $oElementOrFieldset->getOptions();
                if ($sElementLayout && empty($aOptions['twb-layout'])) {
                    $aOptions['twb-layout'] = $sElementLayout;
                    $oElementOrFieldset->setOptions($aOptions);
                }

                if ($oElementOrFieldset instanceof \Zend\Form\FieldsetInterface) {
                    $sMarkup .= $oFieldsetHelper($oElementOrFieldset);
                } elseif ($oElementOrFieldset instanceof \Zend\Form\ElementInterface) {
                	if ($oElementOrFieldset->getOption('twb-row-open')) {
						$sMarkup .= '<div class="row">' . PHP_EOL;
					}

					$sMarkup .= $oElementHelper($oElementOrFieldset);

					if ($oElementOrFieldset->getOption('twb-row-close')) {
						$sMarkup .= '</div>' . PHP_EOL;
					}
                }
            }
            if ($oElement instanceof \Zend\Form\Element\Collection && $oElement->shouldCreateTemplate()) {
                $sMarkup .= $this->renderTemplate($oElement);
            }
        }

        if ($bShouldWrap) {
            if (false != ($sLabel = $oElement->getLabel())) {
                if (null !== ($oTranslator = $this->getTranslator())) {
                    $sLabel = $oTranslator->translate($sLabel, $this->getTranslatorTextDomain());
                }

                $sMarkup = sprintf(
                        self::$legendFormat, ($sAttributes = $this->createAttributesString($oElement->getLabelAttributes()? : array())) ? ' ' . $sAttributes : '', $this->getEscapeHtmlHelper()->__invoke($sLabel)
                ) . $sMarkup;
            }

            //Set form layout class
            if ($sElementLayout) {
                $sLayoutClass = 'form-' . $sElementLayout;
                if (false != ($sElementClass = $oElement->getAttribute('class'))) {
                    if (!preg_match('/(\s|^)' . preg_quote($sLayoutClass, '/') . '(\s|$)/', $sElementClass)) {
                        $oElement->setAttribute('class', trim($sElementClass . ' ' . $sLayoutClass));
                    }
                } else {
                    $oElement->setAttribute('class', $sLayoutClass);
                }
            }

            $sMarkup = sprintf(
                    self::$fieldsetFormat, ($sAttributes = $this->createAttributesString($oElement->getAttributes())) ? ' ' . $sAttributes : '', $sMarkup
            );
        }
        return $sMarkup;
    }

    /**
     * Only render a template
     *
     * @param CollectionElement $collection
     * @return string
     */
    public function renderTemplate(CollectionElement $collection)
    {
        if (false != ($sElementLayout = $collection->getOption('twb-layout'))) {
            $elementOrFieldset = $collection->getTemplateElement();
            $elementOrFieldset->setOption('twb-layout', $sElementLayout);
        }

        return parent::renderTemplate($collection);
    }

    /**
     * Determines whether this element needs the add/remove buttons at all.
     * @param ElementInterface $element
     * @return boolean
     */
    protected function needsButtons(ElementInterface $element)
    {
        if (!$element instanceof Collection) {
            return false;
        }

        return ($element->allowAdd() || $element->allowRemove());
    }

    /**
     * Gets the id of an element. Makes one up if there is none yet.
     * @return string
     */
    protected function getElementId(ElementInterface $element)
    {
        $elementId = $element->getAttribute('id');
        if ($elementId) {
            return $elementId;
        }

        // Generate an id if the element has none yet.
        $newId = 'coll-' . substr(sha1(rand(0, 9999) . $element->getName()), 0, 7);
        $element->setAttribute('id', $newId);

        return $newId;
    }

    /**
     * Sets data attributes onto the element for the jQuery ElementCollection
     *  plugin, to have it determine which buttons to create.
     * @param CollectionElement $collectionElement
     */
    public function setJqueryElementCollectionPluginData(Collection $collectionElement)
    {
        $collectionElement->setAttribute('data-add', $collectionElement->allowAdd());
        $collectionElement->setAttribute('data-remove', $collectionElement->allowRemove());
        $collectionElement->setAttribute('data-count', $collectionElement->getOption('count') ? : 0);
    }

    /**
     * Adds the necessary jQuery ElementCollection plugin script to the view. 
     */
    public function addJQueryElementCollectionPluginToView()
    {
        $headScriptHelper = $this->view->plugin('HeadScript');
        /* @var $headScriptHelper HeadScript */
        // TODO Make the script path configurable.
        $headScriptHelper->appendFile('/js/jquery.zf2-element-collection.js');
    }

    /**
     * Adds a piece of inline script to the view, which applies the jQuery
     *  ElementCollection plugin onto the Element Collection's fieldset.
     * @param int $elementId
     */
    protected function addJQueryElementCollectionApplyToView($elementId)
    {
        $inlineScriptHelper = $this->view->plugin('InlineScript');
        /* @var $inlineScriptHelper InlineScript */
        $escaper = $this->view->plugin('EscapeHtmlAttr');
        /* @var $escaper EscapeHtmlAttr */
        $elementIdEscaped = $escaper($elementId);
        $inlineScriptHelper->appendScript("jQuery(document).ready(function() {jQuery('#{$elementIdEscaped}').zf2ElementCollection();});");
    }
}
