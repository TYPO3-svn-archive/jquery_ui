<?php



class Tx_JqueryUi_ViewHelpers_Form_MultiselectViewHelper extends Tx_Fluid_ViewHelpers_Form_SelectViewHelper {



	public function initializeArguments() {
		parent::initializeArguments();

		$this->overrideArgument('multiple', 'boolean',
				'Obsolete; is implicitly true for a multiselector', FALSE, TRUE);
		$this->registerArgument('sortable', 'boolean',
				'Describes whether the select options can be sorted', FALSE, TRUE);
		$this->registerArgument('searchable', 'boolean',
				'Describes whether the select options can be searched', FALSE, TRUE);
	}



	public function render() {
		if (!$this->arguments['id']) {
			$this->arguments['id'] = 'alumnilist-datefield-' . uniqid();
			$this->tag->addAttribute('id', $this->arguments['id']);
		}

		$configuration = array(
			'sortable' => (boolean) $this->arguments['sortable'],
			'searchable' => (boolean) $this->arguments['searchable'],
			'dividerLocation' => (float) 0.5
		);

		$content = parent::render();
		$content .= '<script> jQuery(function() { jQuery( "#' . $this->arguments['id'] . '" ).multiselect(' . json_encode($configuration) . '); });</script>';

		return $content;
	}



	protected function isSelected($value) {
		$parentResult = parent::isSelected($value);
		if ($parentResult === TRUE)
			return TRUE;

		$selectedValue = $this->getSelectedValue();
		if ($selectedValue instanceof Tx_Extbase_Persistence_ObjectStorage) {
			foreach ($selectedValue as $areYouSelected)
				if ($areYouSelected->getUid() === (int) $value)
					return TRUE;
		}
		return FALSE;
	}



}