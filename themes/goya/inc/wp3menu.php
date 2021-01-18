<?php
/* Mega Menu */
add_filter( 'wp_setup_nav_menu_item', 'goya_add_custom_nav_fields' );
function goya_add_custom_nav_fields( $menu_item ) {

  $menu_item->megamenu = get_post_meta( $menu_item->ID, '_menu_item_megamenu', true );
  $menu_item->menuimage = get_post_meta( $menu_item->ID, '_menu_item_menuimage', true );
  $menu_item->menutitle = get_post_meta( $menu_item->ID, '_menu_item_menutitle', true );
  $menu_item->menulabel = get_post_meta( $menu_item->ID, '_menu_item_menulabel', true );
  $menu_item->menulabelcolor = get_post_meta( $menu_item->ID, '_menu_item_menulabelcolor', true );
  return $menu_item;
	
}

// Update custom fields on menu
add_action( 'wp_update_nav_menu_item', 'goya_update_custom_nav_fields', 1, 3 );
function goya_update_custom_nav_fields( $menu_id, $menu_item_db_id, $menu_item_data ) {
  
	if (!isset($_REQUEST['edit-menu-item-menuimage'][$menu_item_db_id])) {
		$_REQUEST['edit-menu-item-menuimage'][$menu_item_db_id] = '';
	}
	$menuimage_enabled_value = $_REQUEST['edit-menu-item-menuimage'][$menu_item_db_id];        
	update_post_meta( $menu_item_db_id, '_menu_item_menuimage', $menuimage_enabled_value );
	
	if (!isset($_REQUEST['edit-menu-item-menutitle'][$menu_item_db_id])) {
		$_REQUEST['edit-menu-item-menutitle'][$menu_item_db_id] = '';
	}
	$menutitle_enabled_value = $_REQUEST['edit-menu-item-menutitle'][$menu_item_db_id];        
	update_post_meta( $menu_item_db_id, '_menu_item_menutitle', $menutitle_enabled_value );

	if (!isset($_REQUEST['edit-menu-item-menulabel'][$menu_item_db_id])) {
		$_REQUEST['edit-menu-item-menulabel'][$menu_item_db_id] = '';
	}
	$menulabel_enabled_value = $_REQUEST['edit-menu-item-menulabel'][$menu_item_db_id];        
	update_post_meta( $menu_item_db_id, '_menu_item_menulabel', $menulabel_enabled_value );

	if (!isset($_REQUEST['edit-menu-item-menulabelcolor'][$menu_item_db_id])) {
		$_REQUEST['edit-menu-item-menulabelcolor'][$menu_item_db_id] = '';
	}
	$menulabelcolor_enabled_value = $_REQUEST['edit-menu-item-menulabelcolor'][$menu_item_db_id];        
	update_post_meta( $menu_item_db_id, '_menu_item_menulabelcolor', $menulabelcolor_enabled_value );
	
  if (!isset($_REQUEST['edit-menu-item-megamenu'][$menu_item_db_id])) {
	  $_REQUEST['edit-menu-item-megamenu'][$menu_item_db_id] = '';  
  }
  $menu_mega_enabled_value = $_REQUEST['edit-menu-item-megamenu'][$menu_item_db_id];        
  update_post_meta( $menu_item_db_id, '_menu_item_megamenu', $menu_mega_enabled_value );
  
}


// Edit menu
add_filter( 'wp_edit_nav_menu_walker', 'goya_edit_walker' );
function goya_edit_walker() {
   return 'goya_Nav_Menu_Edit'; 
}


/**
 * Custom Walker
 *
 * @access      public
 * @since       1.0 
 * @return      void
*/
class Goya_Mega_Menu extends Walker_Nav_Menu {

  var $active_megamenu = 0;

  /**
	 * Starts the list before the elements are added.
	 *
	 * @since 3.0.0
	 *
	 * @see Walker::start_lvl()
	 *
	 * @param string   $output Used to append additional content (passed by reference).
	 * @param int      $depth  Depth of menu item. Used for padding.
	 * @param stdClass $args   An object of wp_nav_menu() arguments.
	 */
  function start_lvl(&$output, $depth = 0, $args = array()) {	
	  if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}
		$indent = str_repeat( $t, $depth );

		// Default class.
		$classes = array( 'sub-menu' );

		/**
		 * Filters the CSS class(es) applied to a menu list element.
		 *
		 * @since 4.8.0
		 *
		 * @param string[] $classes Array of the CSS classes that are applied to the menu `<ul>` element.
		 * @param stdClass $args    An object of `wp_nav_menu()` arguments.
		 * @param int      $depth   Depth of menu item. Used for padding.
		 */
		$class_names = join( ' ', apply_filters( 'nav_menu_submenu_css_class', $classes, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		$output .= "{$n}{$indent}<ul$class_names>{$n}";
  }

  /**
	 * Ends the list of after the elements are added.
	 *
	 * @since 3.0.0
	 *
	 * @see Walker::end_lvl()
	 *
	 * @param string   $output Used to append additional content (passed by reference).
	 * @param int      $depth  Depth of menu item. Used for padding.
	 * @param stdClass $args   An object of wp_nav_menu() arguments.
	 */
  function end_lvl(&$output, $depth = 0, $args = array()) {
	  if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}
		$indent  = str_repeat( $t, $depth );
		$output .= "$indent</ul>{$n}";

  }    

  function start_el(&$output, $item, $depth = 0, $args = array(), $current_object_id = 0) {
	  if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}
		$indent = ( $depth ) ? str_repeat( $t, $depth ) : '';

		$classes   = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;
		
		if($depth === 1 && $this->active_megamenu)  {
			$classes[] = 'mega-menu-title';
		}

		/**
		 * Filters the arguments for a single nav menu item.
		 *
		 * @since 4.4.0
		 *
		 * @param stdClass $args  An object of wp_nav_menu() arguments.
		 * @param WP_Post  $item  Menu item data object.
		 * @param int      $depth Depth of menu item. Used for padding.
		 */
		$args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );

		/**
		 * Filters the CSS classes applied to a menu item's list item element.
		 *
		 * @since 3.0.0
		 * @since 4.1.0 The `$depth` parameter was added.
		 *
		 * @param string[] $classes Array of the CSS classes that are applied to the menu item's `<li>` element.
		 * @param WP_Post  $item    The current menu item.
		 * @param stdClass $args    An object of wp_nav_menu() arguments.
		 * @param int      $depth   Depth of menu item. Used for padding.
		 */
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );

		if($depth === 0) {   
		  $this->active_megamenu = get_post_meta( $item->ID, '_menu_item_megamenu', true);
		  if($this->active_megamenu) { $class_names .= " menu-item-mega-parent "; }
	  } else {
			$class_names .= get_post_meta( $item->ID, '_menu_item_menutitle', true) === 'enabled' ? ' title-item' : '';
	  }
	  if($depth === 2) {   
		  if($this->active_megamenu) { $class_names .= " menu-item-mega-link "; }  
	  }

		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		/**
		 * Filters the ID applied to a menu item's list item element.
		 *
		 * @since 3.0.1
		 * @since 4.1.0 The `$depth` parameter was added.
		 *
		 * @param string   $menu_id The ID that is applied to the menu item's `<li>` element.
		 * @param WP_Post  $item    The current menu item.
		 * @param stdClass $args    An object of wp_nav_menu() arguments.
		 * @param int      $depth   Depth of menu item. Used for padding.
		 */
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $class_names . '>';
	   
	  $atts           = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target ) ? $item->target : '';
		if ( '_blank' === $item->target && empty( $item->xfn ) ) {
			$atts['rel'] = 'noopener noreferrer';
		} else {
			$atts['rel'] = $item->xfn;
		}
		$atts['href']         = ! empty( $item->url ) ? $item->url : '';
		$atts['aria-current'] = $item->current ? 'page' : '';
	  
	  /**
		 * Filters the HTML attributes applied to a menu item's anchor element.
		 *
		 * @since 3.6.0
		 * @since 4.1.0 The `$depth` parameter was added.
		 *
		 * @param array $atts {
		 *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
		 *
		 *     @type string $title        Title attribute.
		 *     @type string $target       Target attribute.
		 *     @type string $rel          The rel attribute.
		 *     @type string $href         The href attribute.
		 *     @type string $aria_current The aria-current attribute.
		 * }
		 * @param WP_Post  $item  The current menu item.
		 * @param stdClass $args  An object of wp_nav_menu() arguments.
		 * @param int      $depth Depth of menu item. Used for padding.
		 */
		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );
	  
	  $attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value       = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

	  /** This filter is documented in wp-includes/post-template.php */
		$title = apply_filters( 'the_title', $item->title, $item->ID );

		/**
		 * Filters a menu item's title.
		 *
		 * @since 4.4.0
		 *
		 * @param string   $title The menu item's title.
		 * @param WP_Post  $item  The current menu item.
		 * @param stdClass $args  An object of wp_nav_menu() arguments.
		 * @param int      $depth Depth of menu item. Used for padding.
		 */
		$title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

	  $menu_label_color = $item->menulabelcolor != '' ? ' style="background-color:'. $item->menulabelcolor .'"' : '';
	  $menu_image = wp_get_attachment_image( $item->menuimage, 'medium_large', '', array( 'class' => 'skip-webp' ) );
			
	  $item_output = $args->before;
	  $item_output .= '<a'. $attributes .'>';
	  $item_output .= $item->menuimage != '' ? '<span class="item-thumb">' . $menu_image . '</span>' : '';

	  $item_output .= $args->link_before . $title . $args->link_after;
	  $item_output .= $item->menulabel != '' ? '<span class="menu-label"'. $menu_label_color .'>'. $item->menulabel .'</span>' : '';
	  $item_output .= '</a>';
	  $item_output .= $args->after;
	  
	  /**
		 * Filters a menu item's starting output.
		 *
		 * The menu item's starting output only includes `$args->before`, the opening `<a>`,
		 * the menu item's title, the closing `</a>`, and `$args->after`. Currently, there is
		 * no filter for modifying the opening and closing `<li>` for a menu item.
		 *
		 * @since 3.0.0
		 *
		 * @param string   $item_output The menu item's starting HTML output.
		 * @param WP_Post  $item        Menu item data object.
		 * @param int      $depth       Depth of menu item. Used for padding.
		 * @param stdClass $args        An object of wp_nav_menu() arguments.
		 */
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	  
	  apply_filters( 'walker_nav_menu_start_lvl', $item_output, $depth, $args->menuimage = $item->menuimage );
  }
}

/**
 *  /!\ This is a copy of Walker_Nav_Menu_Edit class in core
 * 
 * Create HTML list of nav menu input items.
 *
 * @package WordPress
 * @since 3.0.0
 * @uses Walker_Nav_Menu
 */
class Goya_Nav_Menu_Edit extends Walker_Nav_Menu  {
	
	/**
	 * @see Walker_Nav_Menu::start_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference.
	 */
	function start_lvl(&$output, $depth = 0, $args = array()) {  
	}
	
	/**
	 * @see Walker_Nav_Menu::end_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference.
	 */
	function end_lvl(&$output, $depth = 0, $args = array()) {
	}
	/**
	 * @see Walker::start_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param object $args
	 */
	function start_el(&$output, $item, $depth = 0, $args = array(), $current_object_id = 0) {
		global $_wp_nav_menu_max_depth;
		$_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;

		ob_start();
		$item_id = esc_attr( $item->ID );
		$removed_args = array(
			'action',
			'customlink-tab',
			'edit-menu-item',
			'menu-item',
			'page-tab',
			'_wpnonce',
		);

		$original_title = false;
		if ( 'taxonomy' == $item->type ) {
			$original_title = get_term_field( 'name', $item->object_id, $item->object, 'raw' );
			if ( is_wp_error( $original_title ) )
				$original_title = false;
		} elseif ( 'post_type' == $item->type ) {
			$original_object = get_post( $item->object_id );
			$original_title = get_the_title( $original_object->ID );
		} elseif ( 'post_type_archive' == $item->type ) {
			$original_object = get_post_type_object( $item->object );
			if ( $original_object ) {
				$original_title = $original_object->labels->archives;
			}
		}
		
		$classes = array(
			'menu-item menu-item-depth-' . $depth,
			'menu-item-' . esc_attr( $item->object ),
			'menu-item-edit-' . ( ( isset( $_GET['edit-menu-item'] ) && $item_id == sanitize_key( $_GET['edit-menu-item'] ) ) ? 'active' : 'inactive'),
		);

		$title = $item->title;
		
		if ( ! empty( $item->_invalid ) ) {
			$classes[] = 'menu-item-invalid';
			/* translators: %s: title of menu item which is invalid */
			$title = sprintf( esc_html__( '%s (Invalid)', 'goya'), $item->title );
		} elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
			$classes[] = 'pending';
			/* translators: %s: title of menu item in draft status */
			$title = sprintf( esc_html__('%s (Pending)', 'goya'), $item->title );
		}
		
		$title = empty( $item->label ) ? $title : $item->label;
		
		?>
		<li id="menu-item-<?php echo esc_attr($item_id); ?>" class="<?php echo implode(' ', $classes ); ?>">
			<dl class="menu-item-bar">
				<dt class="menu-item-handle">
					<span class="item-title"><?php echo esc_html( $title ); ?></span>
					<span class="item-controls">
						<span class="item-type"><?php echo esc_html( $item->type_label ); ?></span>
						<span class="item-order hide-if-js">
							<a href="<?php
								echo wp_nonce_url(
									add_query_arg(
										array(
											'action' => 'move-up-menu-item',
											'menu-item' => $item_id,
										),
										remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
									),
									'move-menu_item'
								);
							?>" class="item-move-up"><abbr title="<?php esc_attr_e('Move up', 'goya'); ?>">&#8593;</abbr></a>
							|
							<a href="<?php
								echo wp_nonce_url(
									add_query_arg(
										array(
											'action' => 'move-down-menu-item',
											'menu-item' => $item_id,
										),
										remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
									),
									'move-menu_item'
								);
							?>" class="item-move-down"><abbr title="<?php esc_attr_e('Move down', 'goya' ); ?>">&#8595;</abbr></a>
						</span>
						<a class="item-edit" id="edit-<?php echo esc_attr($item_id); ?>" title="<?php esc_attr_e('Edit Menu Item', 'goya'); ?>" href="<?php
							echo ( isset( $_GET['edit-menu-item'] ) && $item_id == sanitize_key( $_GET['edit-menu-item'] ) ) ? admin_url( 'nav-menus.php' ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) );
						?>"><?php esc_html_e( 'Edit Menu Item', 'goya'); ?></a>
					</span>
				</dt>
			</dl>
		
		  <div class="menu-item-settings wp-clearfix" id="menu-item-settings-<?php echo esc_attr($item_id); ?>">
				<?php if( 'custom' == $item->type ) : ?>
					<p class="field-url description description-wide">
						<label for="edit-menu-item-url-<?php echo esc_attr($item_id); ?>">
							<?php esc_html_e( 'URL', 'goya' ); ?><br />
							<input type="text" id="edit-menu-item-url-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
						</label>
					</p>
				<?php endif; ?>
				<p class="description description-thin">
					<label for="edit-menu-item-title-<?php echo esc_attr($item_id); ?>">
						<?php esc_html_e( 'Navigation Label', 'goya' ); ?><br />
						<input type="text" id="edit-menu-item-title-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
					</label>
				</p>
				<p class="description description-thin">
					<label for="edit-menu-item-attr-title-<?php echo esc_attr($item_id); ?>">
						<?php esc_html_e( 'Title Attribute', 'goya' ); ?><br />
						<input type="text" id="edit-menu-item-attr-title-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
					</label>
				</p>
				<p class="field-link-target description">
					<label for="edit-menu-item-target-<?php echo esc_attr($item_id); ?>">
						<input type="checkbox" id="edit-menu-item-target-<?php echo esc_attr($item_id); ?>" value="_blank" name="menu-item-target[<?php echo esc_attr($item_id); ?>]"<?php checked( $item->target, '_blank' ); ?> />
						<?php esc_html_e( 'Open link in a new window/tab', 'goya' ); ?>
					</label>
				</p>
				<p class="field-css-classes description description-thin">
					<label for="edit-menu-item-classes-<?php echo esc_attr($item_id); ?>">
						<?php esc_html_e( 'CSS Classes (optional)', 'goya' ); ?><br />
						<input type="text" id="edit-menu-item-classes-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
					</label>
				</p>
				<p class="field-xfn description description-thin">
					<label for="edit-menu-item-xfn-<?php echo esc_attr($item_id); ?>">
						<?php esc_html_e( 'Link Relationship (XFN)', 'goya'  ); ?><br />
						<input type="text" id="edit-menu-item-xfn-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
					</label>
				</p>
				<p class="field-description description description-wide">
					<label for="edit-menu-item-description-<?php echo esc_attr($item_id); ?>">
						<?php esc_html_e( 'Description', 'goya' ); ?><br />
						<textarea id="edit-menu-item-description-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo esc_attr($item_id); ?>]"><?php echo esc_html( $item->description ); // textarea_escaped ?></textarea>
						<span class="description"><?php esc_html_e('The description will be displayed in the menu if the current theme supports it.', 'goya'); ?></span>
					</label>
				</p>
				<?php do_action( 'wp_nav_menu_item_custom_fields', $item_id, $item, $depth, $args );?>
				<div class="et_menu_options">
					<div class="et-field-link-mega description description-wide">
					<label for="edit-menu-item-megamenu-<?php echo esc_attr($item_id); ?>">
						<?php esc_html_e( 'Show as Mega Menu', 'goya'  ); ?><br />
					  <?php 
		
						  $value = get_post_meta( $item_id, '_menu_item_megamenu', true);
						  if($value != "") $value = "checked='checked'";
		
					  ?>
				  	<input type="checkbox" value="enabled" id="edit-menu-item-megamenu-<?php echo esc_attr($item_id); ?>" name="edit-menu-item-megamenu[<?php echo esc_attr($item_id); ?>]" <?php echo esc_attr( $value ); ?> />
				  	<?php esc_html_e( 'Enable', 'goya'  ); ?>
				  </label>
				  </div>
				  <div class="et-field-link-title description description-wide">
				  	<label for="edit-menu-item-menutitle-<?php echo esc_attr($item_id); ?>">
				  		<?php esc_html_e( 'Show as Title', 'goya'  ); ?><br />
				  	  <?php 
				  		  $value = get_post_meta( $item_id, '_menu_item_menutitle', true);
				  		  if($value != "") $value = "checked='checked'";
				  	  ?>
				  	  <input type="checkbox" value="enabled" id="edit-menu-item-menutitle-<?php echo esc_attr($item_id); ?>" name="edit-menu-item-menutitle[<?php echo esc_attr($item_id); ?>]" <?php echo esc_attr( $value ); ?> />
				  	  <?php esc_html_e( 'Enable', 'goya'  ); ?>
				  	</label>
				  </div>
			    <div class="et-field-link-label description description-wide">
			  	<label for="edit-menu-item-menulabel-<?php echo esc_attr($item_id); ?>">
			  		<?php esc_html_e( 'Highlight Label', 'goya'  ); ?> <span class="small-tag"><?php esc_html_e( 'label', 'goya'  ); ?></span><br />
			  	  <input type="text" class="widefat code edit-menu-item-custom" id="edit-menu-item-menulabel-<?php echo esc_attr($item_id); ?>" name="edit-menu-item-menulabel[<?php echo esc_attr($item_id); ?>]" value="<?php echo get_post_meta( $item_id, '_menu_item_menulabel', true); ?>"/>
			  	 </label>
			    </div>
			    <div class="et-field-link-labelcolor description description-wide">
			    	<label for="edit-menu-item-menulabelcolor-<?php echo esc_attr($item_id); ?>">
		    	  	<input type="text" class="widefat code edit-menu-item-custom et-color-field" id="edit-menu-item-menulabelcolor-<?php echo esc_attr($item_id); ?>" name="edit-menu-item-menulabelcolor[<?php echo esc_attr($item_id); ?>]" value="<?php echo get_post_meta( $item_id, '_menu_item_menulabelcolor', true); ?>"/>
		    	  </label>
		      </div>
				  <div class="et-field-link-image description description-wide">
				  	
				  	<?php wp_enqueue_media(); ?>

						<label for="edit-menu-item-menuimage-<?php echo esc_attr($item_id); ?>">
							<?php esc_html_e( 'Menu Image', 'goya'  ); ?>
							</label>

							<div class='image-preview-wrapper'>
								<?php $image_attributes = wp_get_attachment_image_src( get_post_meta( $item_id, '_menu_item_menuimage', true), 'thumbnail' );
								if ($image_attributes != '' ) { ?>
									<img id='image-preview-<?php echo esc_attr($item_id); ?>' class="image-preview" src="<?php echo esc_attr( $image_attributes[0]); ?>" />
								<?php } ?>
							</div>
							<input id="remove_image_button-<?php echo esc_attr($item_id); ?>" type="button" class="remove_image_button button" value="<?php esc_attr_e( 'Remove', 'goya' ); ?>" style="display: none;" />
							<input id="upload_image_button-<?php echo esc_attr($item_id); ?>" type="button" class="upload_image_button button" value="<?php esc_attr_e( 'Select image', 'goya' ); ?>" />

							<input type="hidden" class="widefat code edit-menu-item-custom image_attachment_id" id="edit-menu-item-menuimage-<?php echo esc_attr($item_id); ?>" name="edit-menu-item-menuimage[<?php echo esc_attr($item_id); ?>]" value="<?php echo get_post_meta( $item_id, '_menu_item_menuimage', true); ?>"/>

						
					</div>
				  
			  </div>
			 
			 <fieldset class="field-move hide-if-no-js description description-wide">
				<span class="field-move-visual-label" aria-hidden="true"><?php esc_html_e( 'Move', 'goya' ); ?></span>
				<button type="button" class="button-link menus-move menus-move-up" data-dir="up"><?php esc_html_e( 'Up one', 'goya' ); ?></button>
				<button type="button" class="button-link menus-move menus-move-down" data-dir="down"><?php esc_html_e( 'Down one', 'goya' ); ?></button>
				<button type="button" class="button-link menus-move menus-move-left" data-dir="left"></button>
				<button type="button" class="button-link menus-move menus-move-right" data-dir="right"></button>
				<button type="button" class="button-link menus-move menus-move-top" data-dir="top"><?php esc_html_e( 'To the top', 'goya' ); ?></button>
			 </fieldset>
		
			  <div class="menu-item-actions description-wide submitbox">
				  <?php if( 'custom' != $item->type && $original_title !== false ) : ?>
					  <p class="link-to-original">
						  <?php printf( esc_html__('Original: %s', 'goya'), '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
					  </p>
				  <?php endif; ?>
				  <a class="item-delete submitdelete deletion" id="delete-<?php echo esc_attr($item_id); ?>" href="<?php
				  echo wp_nonce_url(
					  add_query_arg(
						  array(
							  'action' => 'delete-menu-item',
							  'menu-item' => $item_id,
						  ),
						  remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
					  ),
					  'delete-menu_item_' . $item_id
				  ); ?>"><?php esc_html_e('Remove', 'goya' ); ?></a> <span class="meta-sep"> | </span> <a class="item-cancel submitcancel" id="cancel-<?php echo esc_attr($item_id); ?>" href="<?php echo esc_url( add_query_arg( array('edit-menu-item' => $item_id, 'cancel' => time()), remove_query_arg( $removed_args, admin_url( 'nav-menus.php' ) ) ) );
					  ?>#menu-item-settings-<?php echo esc_attr($item_id); ?>"><?php esc_html_e('Cancel', 'goya'); ?></a>
			  </div>
		
			  <input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr($item_id); ?>" />
			  <input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->object_id ); ?>" />
			  <input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->object ); ?>" />
			  <input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>" />
			  <input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>" />
			  <input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->type ); ?>" />
		  </div><!-- .menu-item-settings-->
		  <ul class="menu-item-transport"></ul>
		<?php
		
		$output .= ob_get_clean();
	
	}
}