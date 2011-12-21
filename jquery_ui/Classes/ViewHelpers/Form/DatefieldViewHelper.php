<?php



class Tx_JqueryUi_ViewHelpers_Form_DatefieldViewHelper extends Tx_Fluid_ViewHelpers_Form_TextfieldViewHelper {



	public function initializeArguments() {
		parent::initializeArguments();
		$this->registerArgument('format', 'string', 'Date format', FALSE, 'd. m. Y');
	}



	/**
	 *
	 * @param boolean $required
	 * @param string $type
	 * @param string $placeholder
	 * @return string
	 */
	public function render($required = NULL, $type = 'text', $placeholder = NULL) {
		if (!$this->arguments['id']) {
			$this->arguments['id'] = 'alumnilist-datefield-'.uniqid();
			$this->tag->addAttribute('id', $this->arguments['id']);
		}

		$config = array(
			"dateFormat" => 'dd.mm.yy',
			'changeYear' => TRUE,
			'yearRange' => '1930:-10',
			'nextText' => 'Vor',
			'prevText' => 'Zurück',
			'changeMonth' => TRUE,
			'dayNamesMin' => array('So','Mo','Di','Mi','Do','Fr','Sa'),
			'monthNamesShort' => array('Jan','Feb','Mär','Apr','Mai','Jun','Jul','Aug','Sep','Okt','Nov','Dez')
		);

		$content = parent::render($required, $type, $placeholder);
		$content .= '<script> jQuery(function() { jQuery( "#'.$this->arguments['id'].'" ).datepicker('.json_encode($config).'); });</script>';

		return $content;
	}



	protected function getValue() {
		$date = parent::getValue();
		if (!$date instanceof DateTime)
			return '';
		else
			return $date->format($this->arguments['format']);
	}



}