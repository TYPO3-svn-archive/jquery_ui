<?php



class Tx_JqueryUi_ViewHelpers_TabViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {



	/**
	 * @param string $label
	 * @return string
	 */
	public function render($label) {
		return $this->renderChildren();
	}



}