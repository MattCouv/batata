<?php
namespace Core\HTML;
/**
*
*/
class Piform extends Form
{
	protected function surround($html)
	{
		return "<div class=\"form-group\">{$html}</div>";
	}

	public function input($name,$label, $options = [])
	{
		$type = isset($options['type']) ? $options['type'] : 'text';
		return $this->surround(
			'<label for="' . $name . '">' . $label . '</label><input type="' . $type . '" name="' . $name . '" id="' . $name . '" value="' . $this->getValue($name) . '"  class="form-control" placeholder="' . $label . '" required/>'
			);
	}
	public function input2($name,$label='', $options = [])
	{
		$type = isset($options['type']) ? $options['type'] : 'text';
		$value = isset($options['value']) ? $options['value'] : $this->getValue($name);
		return '<input type="' . $type . '" name="' . $name . '" id="' . $name . '" value="' . $value . '" placeholder="' . $label . '" required/>';
	}
	public function select($name,$label, $options = [])
	{
		$value = $this->getValue($name);
		return $this->surround(
			'<label for="' . $name . '">' . $label . '</label><select name="' . $name . '" id="' . $name . '" class="form-control"/>' . $this->optionHTML($options,$value) . '</select>'
			);
	}

	public function select2($name, $options = [])
	{
		return '<select name="' . $name . '" id="' . $name . '" />' . $this->optionHTML($options) . '</select>';
	}

	private function optionHTML($options,$value=null)
	{
		$html = '';
		foreach ($options as $option) {
			if($value != null){
				($value == $option) ? $select = "selected" : $select = "";
			}else{
				$select = "";
			}
			$html .= '<option value="' . $option  .'"'. $select.'>' . $option . '</option>';
		}
		return $html;
	}

	public function textarea($name,$label)
	{
		$value = $this->getValue($name);
		return $this->surround(
			'<label for="' . $name . '">' . $label . '</label><textarea name="' . $name . '" id="' . $name . '" class="form-control" rows="3" required placeholder="' . $label . '">' . $value . '</textarea>'
			);
	}
	}
 ?>
