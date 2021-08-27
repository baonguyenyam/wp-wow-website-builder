<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( isset( $field['select_options'] ) ){
	$options = $field['select_options'];
	if (count($options)){
		?>
		<span class="wow-form-field-item wow-form-field-select">
			<select name="wow_default_form[<?php echo $fieldIndex; ?>]" <?php echo $fieldAttr; ?> >
				<?php
				foreach ($options as $key => $option){
					?>
					<option value="<?php echo $option['label']; ?>"><?php echo $option['label']; ?></option>
					<?php
				}
				?>
			</select>
		</span>
		<?php
	}
}
