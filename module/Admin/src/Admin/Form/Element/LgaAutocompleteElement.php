  <?php

    namespace Admin\Form\Element;
    use Zf2DoctrineAutocomplete\Form\Element\ObjectAutocomplete;

    class LgaAutocompleteElement extends ObjectAutocomplete {

        private $initialized = false;

        public function setOptions($options) {
        if (!$this->initialized) {
            $options = array_merge($options, array(
                'class' => get_class($this),
                'object_manager' => $options['sm']->get('Doctrine\ORM\EntityManager'), // For Doctrine ORM
                // 'object_manager' => $options['sm']->get('doctrine.documentmanager.odm_default'), // For Doctrine ODM (Mongodb)
                'target_class' => 'Admin\Entity\Lga',
                'searchFields' => array('name'),
                'empty_item_label' => 'Nothing found',
                'select_warning_message' => 'Choose your L.G.A.',
                'property' => 'name',
                'orderBy' => array('name','ASC')
            ));
            $this->initialized = true;
            }

        parent::setOptions($options);
        }

    }