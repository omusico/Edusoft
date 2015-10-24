<?php
	namespace Application\Helper;
	
	use Zend\Form\FieldsetInterface;
	use Zend\Form\FormInterface;
	use Zend\Form\View\Helper\Form as OriginalForm;
	
	class Form extends OriginalForm {
	    public function render(FormInterface $form) {
		   if (method_exists($form, 'prepare')) {
			  $form->prepare();
		   }
	
		   $formContent = '';
	
		   foreach ($form as $element) {
			  if ($element instanceof FieldsetInterface) {
				 $formContent.= $this->getView()->formCollection($element) . "\n\n";
			  } else {
				 $formContent.= $this->getView()->formRow($element) . "\n\n";
			  }
		   }
	
		   return $this->openTag($form) . "\n\n" . $formContent . $this->closeTag() . "\n\n";
	    }
	}
?>