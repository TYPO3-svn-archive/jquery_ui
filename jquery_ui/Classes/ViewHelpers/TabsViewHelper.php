<?php



class Tx_JqueryUi_ViewHelpers_TabsViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper
		implements Tx_Fluid_Core_ViewHelper_Facets_ChildNodeAccessInterface {



	/**
	 * An array of Tx_Fluid_Core_Parser_SyntaxTree_AbstractNode
	 * @var array
	 */
	private $childNodes = array();



	/**
	 * Setter for ChildNodes - as defined in ChildNodeAccessInterface
	 *
	 * @param array $childNodes Child nodes of this syntax tree node
	 * @return void
	 * @author Sebastian Kurfürst <sebastian@typo3.org>
	 */
	public function setChildNodes(array $childNodes) {
		$this->childNodes = $childNodes;
	}



	public function initializeArguments() {
		parent::initializeArguments();

		$this->registerArgument('type', 'string',
				'Tabs or Accordion [tab|accordion]?', FALSE, 'tab');
	}



	/**
	 * @param string $id
	 * @return string
	 */
	public function render($id=NULL) {
		$tabData = array();
		foreach ($this->childNodes as $childNode) {
			if ($childNode instanceof Tx_Fluid_Core_Parser_SyntaxTree_ViewHelperNode
					&& $childNode->getViewHelperClassName() === 'Tx_JqueryUi_ViewHelpers_TabViewHelper') {
				$localId = uniqid();
				$args = $childNode->getArguments();
				$tabContents[$localId] = array(
					'label' => $args['label']->evaluate($this->renderingContext),
					'content' => $childNode->evaluate($this->renderingContext)
				);
			}
		}

		$mainId = $id ? $id : uniqid();
		$content = "<div id=\"$mainId\">";
		$configuration = array();

		if ($this->arguments['type'] === 'tab') {
			$content .= "<ul>";
			foreach ($tabContents as $id => $values) {
				$content .= "<li><a href=\"#$mainId-$id\">" . $values['label'] . "</a>";
			}
			$content .= "</ul>";
			$configuration['collapsible'] = false;
		} else {
			$configuration['header'] = 'div.'.$mainId.'-header';
		}
		foreach ($tabContents as $id => $values) {
			if ($this->arguments['type'] === 'accordion')
				$content .= '<div class="'.$mainId.'-header"><a href="#">' . $values['label'] . '</a></div>';
			$content .= "<div id=\"$mainId-$id\">" . $values['content'] . "</div>";
		}

		$content .= "</div><script>jQuery(function() {jQuery( \"#$mainId\" ).{$this->getMethodName()}(".json_encode($configuration).");});</script>";
		return $content;
	}



	protected function getMethodName() {
		switch ($this->arguments['type']) {
			case 'tab': return 'tabs';
			case 'accordion': return 'accordion';
		}
	}



}