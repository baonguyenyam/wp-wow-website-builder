<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( isset( $field['radio_field_options'] ) ){
	$options = $field['radio_field_options'];
	if (count($options)){
		foreach ($options as $option){
			?>
			<span class="wow-form-field-item wow-form-field-radio">
					<input type="radio" name="wow_default_form[<?php echo $fieldIndex; ?>]" value="<?php echo $option['label'];?>" <?php echo $fieldAttr; ?> > <label for="<?php echo $option['label']; ?>"> <?php echo $option['label']; ?>
			</label></span>
			<?php
		}
	}
}
