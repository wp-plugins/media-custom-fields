<?php

if( isset( $_GET['action'] ) AND $_GET['action'] == 'delete' ) :
	include( 'administration_delete.php' );
elseif( isset( $_GET['action'] ) AND $_GET['action'] == 'edit' ) :
	include( 'administration_edit.php' );
else :


if( $_POST ) {
	call_user_func( 'tqmcf_user_field_' . $_POST['action'] );
}

$tqmcf = get_tqmcf();

?>

<div class="wrap">  
   
    <h2><?php echo TQ_PLUGIN_LONGNAME ?> Administration</h2>  
    
    <?php if( isset( $_GET['action'] ) AND $_GET['message'] ) : ?>
		<div class="updated below-h2" id="message">
			<p><?php echo urldecode( $_GET['message'] ) ?></p>
		</div>
	<?php endif ?>

    <h3><?php _e( 'Add a Custom Field', TQ_PLUGIN_TEXTDOMAIN ) ?></h3>
	
	<form method="post" action="?page=<?php echo $_GET['page'] ?>&message=<?php echo urlencode( 'Custom field created' ) ?>">
	
		<?php wp_nonce_field('tqmcf-add_field'); ?>
	
		<table class="form-table describe">
			
			<tr valign="top">
				<th scope="row"><?php _e( 'Field Name', TQ_PLUGIN_TEXTDOMAIN ) ?></th>
				<td>
					<input type="text" title="<?php _e( 'Add a short descriptive name for your field name', TQ_PLUGIN_TEXTDOMAIN ) ?>" name="custom_field_name" />
				</td>
			</tr>
		
			<tr valign="top">
				<th scope="row">Field Description</th>
				<td>
					<textarea title="<?php _e( 'An optional short description of the field', TQ_PLUGIN_TEXTDOMAIN ) ?>" name="custom_field_description"></textarea>
				</td>
			</tr>
			
		</table>
		
		<p class="submit">
			<input type="hidden" name="action" value="add" />
			<input type="submit" class="button-primary" value="<?php _e( 'Add custom field', TQ_PLUGIN_TEXTDOMAIN ) ?>" />
		</p>
	
	</form>
	
	
	<h3><?php _e( 'Existing Custom Fields', TQ_PLUGIN_TEXTDOMAIN ) ?><h3>	
	
	<div id="tqmcf-list">
		<?php if ( $tqmcf ) : foreach ( $tqmcf as $field ) : $field_meta_name = 'tqmcf_' . sanitize_title_with_dashes( $field['name'] ); ?>
			<div class="item">
		    	<h4><?php echo $field['name'] ?> <small>(<?php echo $field_meta_name ?>)</small></h4>
		    	<p><?php echo $field['description'] ?></p>
		    	
		   
	
		    	<a href="?page=<?php echo $_GET['page'] ?>&action=delete&item=<?php echo urlencode( $field['name'] ) ?>">delete</a>
		    	<a href="?page=<?php echo $_GET['page'] ?>&action=edit&item=<?php echo urlencode( $field['name'] ) ?>">modify</a>	   
		    </div>
	    <?php 
	    	endforeach; 
	    	else :
	    		echo '<p>' . __( 'You have not created any custom fields yet', TQ_PLUGIN_TEXTDOMAIN ) . '</p>';
	    	endif;
	    ?>
	</div>
	
</div> 

<?php endif ?>