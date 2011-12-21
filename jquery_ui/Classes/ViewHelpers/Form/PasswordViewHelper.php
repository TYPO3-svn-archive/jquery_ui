<?php



class Tx_JqueryUi_ViewHelpers_Form_PasswordViewHelper extends Tx_Fluid_ViewHelpers_Form_PasswordViewHelper {

	public function render() {
		if (!$this->arguments['id']) {
			$this->arguments['id'] = 'alumnilist-datefield-'.uniqid();
			$this->tag->addAttribute('id', $this->arguments['id']);
		}

		$content = parent::render();
		$content .= '<script> jQuery(function() { jQuery( "#'.$this->arguments['id'].'" ).pstrength(); });</script>';

		return $content;
	}

}