<?php
	namespace Application\Helper;

	use Zend\Form\View\Helper\FormElementErrors as OriginalFormElementErrors;
	
	class FormElementErrors extends OriginalFormElementErrors {
		protected $messageCloseString     = '</span></div>';
		protected $messageOpenFormat      = '<div class="inlineError"><span>';
		protected $messageSeparatorString = '</span><span>';
	}
?>