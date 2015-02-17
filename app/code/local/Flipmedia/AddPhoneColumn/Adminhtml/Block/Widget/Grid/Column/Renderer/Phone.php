<?php
class Flipmedia_AddPhoneColumn_Adminhtml_Block_Widget_Grid_Column_Renderer_Phone extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract {

	public function render(Varien_Object $row){
		   $value = $this->_getValue($row);
		   return $value ? $value : false;
		}
}
