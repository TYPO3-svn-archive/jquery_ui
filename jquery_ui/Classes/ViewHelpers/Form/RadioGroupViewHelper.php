<?php



class Tx_JqueryUi_ViewHelpers_Form_RadioGroupViewHelper extends Tx_Fluid_ViewHelpers_Form_AbstractFormFieldViewHelper
		implements Tx_Fluid_Core_ViewHelper_Facets_ChildNodeAccessInterface {



	/**
	 * An array of Tx_Fluid_Core_Parser_SyntaxTree_AbstractNode
	 * @var array
	 */
	private $childNodes = array();
	protected $tagName = 'div';



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



	/**
	 * @param string $id
	 * @return string
	 */
	public function render($id=NULL) {
		if (!$this->arguments['id']) {
			$this->arguments['id'] = 'jqueryui-btngroup-' . uniqid();
			$this->tag->addAttribute('id', $this->arguments['id']);
		}

		$innerContent = '';
		$i = 0;
		foreach ($this->childNodes as $childNode) {
			if ($childNode instanceof Tx_Fluid_Core_Parser_SyntaxTree_ViewHelperNode
					&& $childNode->getViewHelperClassName() === 'Tx_JqueryUi_ViewHelpers_Form_RadioViewHelper') {
				$args = $childNode->getArguments();
				$childId = $this->arguments['id'].(++$i);

				$value = htmlspecialchars($args['value']->evaluate($this->renderingContext));
				$label = htmlspecialchars($args['label']->evaluate($this->renderingContext));
				$selected = $this->getValue() == $value ? 'checked="checked"' : '';

				$innerContent .= "<input name=\"{$this->getName()}\" type=\"radio\" value=\"$value\" id=\"$childId\" $selected><label for=\"$childId\">$label</label>";
			}
		}

		#$innerContent = $this->renderChildren();

		$this->tag->setContent($innerContent);
		$content = $this->tag->render();
		$content .= "<script>jQuery(function() {jQuery( \"#{$this->arguments['id']}\" ).buttonset();});</script>";
		return $content;
	}



}