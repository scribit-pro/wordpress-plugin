<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$action = 'options.php';

?>

<div class="wrap">
	<h2><?php
		/* translators: Page title of the plugin settings */
		_e( 'Scribit.Pro options', 'scribit' );
		?>
	</h2>

	<form action="<?php echo esc_url( $action ); ?>" method="post">
		<?php settings_fields( \Scribit\WordPress\Hooks\AdminInit::OPTIONS_GROUP_NAME ); ?>
		<table class="form-table" role="presentation">
			<tbody>
			<tr>
				<?php $id = new \Scribit\WordPress\Settings\ScribitID(); ?>
				<th scope="row">
					<label for="<?php echo esc_attr($id->key()); ?>">
						<?php
						/* translators: The form label for the scribit id */
						_e( 'Scribit.Pro ID', 'scribit' );
						?>
					</label>
				</th>
				<td>
					<input name="<?php echo esc_attr($id->key()); ?>" type="text" id="<?php echo esc_attr($id->key()); ?>"
					       value="<?php echo esc_attr( $id->value() ) ?>" class="regular-text ltr"
					>
					<p class="description" id="<?php echo esc_attr($id->key()); ?>-description">
						<?php _e( 'You can find your Scribit.Pro ID on <a href="https://scribit.pro/wordpress-plugin" target="_blank">our website</a>', 'scribit' ); ?>
					</p>
				</td>
			</tr>
			</tbody>
		</table>

		<h2 class="title">
			<?php
			/* translators: Sub title for the advanced plugin settings */
			_e( 'Advanced options', 'scribit' );
			?>
		</h2>
		<p>
			<?php
			/* translators: accompanying text that explains whether you should change these advanced settings  */
			_e( 'The default values of the advanced settings are usually good enough for 99% of the websites. We left them in here just in case :)', 'scribit' );
			?>
		</p>


		<table class="form-table" role="presentation">
			<tbody>
			<tr>
				<?php
				$wrapper       = new \Scribit\WordPress\Settings\WidgetWrapper();
				$selectedValue = $wrapper->value();
				?>
				<th scope="row">
					<label for="<?php echo esc_attr($wrapper->key()) ?>">
						<?php
						/* translators: The form label for the widget placement */
						_e( 'Widget bar location', 'scribit' );
						?>
					</label>
				</th>
				<td>
					<select id="<?php echo esc_attr($wrapper->key()) ?>" name="<?php echo esc_attr($wrapper->key()) ?>">
						<option value="" <?php echo $selectedValue == null ? "selected" : null ?>>
							<?php _e( 'After the embedded element', 'scribit' ); ?>
						</option>
						<option value="div" <?php echo $selectedValue === 'div' ? "selected" : null ?>>
							<?php _e( 'After the parent of the embedded element', 'scribit' ); ?>
						</option>
					</select>
				</td>
			</tr>
			</tbody>
		</table>
		<p class='submit'>
			<input name='submit' type='submit' id='submit'
			       class='button-primary' value='<?php _e( "Save Changes" ) ?>'
			/>
		</p>
	</form>
</div>
