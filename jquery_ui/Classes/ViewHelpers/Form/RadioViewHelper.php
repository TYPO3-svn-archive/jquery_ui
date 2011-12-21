<?php



/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */



/**
 * Description of RadioViewHelper
 *
 * @author mhelmich
 */
class Tx_JqueryUi_ViewHelpers_Form_RadioViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {



	public function initializeArguments() {
		parent::initializeArguments();

		$this->registerArgument('value', 'string', 'The element\'s value', TRUE);
		$this->registerArgument('label', 'string', 'The element\'s label', TRUE);
	}

	public function render() {
		return "You should not see this!";
	}




}

?>
