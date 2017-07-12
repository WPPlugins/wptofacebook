<?php
global $wp_version;
$print_strings = array();
$print_strings[ 'id' ] = '';
$wptofb = new WpToFb();
$types_of_contents = $wptofb->wptofb_get_available_post_types();
$taxonomy_of_contents = $wptofb->wptofb_select_taxonomy( $types_of_contents );

//update or insert
if( isset( $_REQUEST[ 'wptofb_action' ] ) ){
	$action = $_REQUEST[ 'wptofb_action' ];
	check_admin_referer( 'wptofb-' . $action . '_connid' . $_REQUEST[ 'wptofb_id' ] );

	switch( $action ){
		case 'insert'://response on insert new record
			$message_returned = $wptofb->wptofb_insert( $_POST );
			echo $message_returned[ 'message' ];
			break;
		case 'update'://response on update existing record
			echo $wptofb->wptofb_update( $_POST );
			break;
	}
	//response and verification on edit existing record
}else if( isset( $_REQUEST[ 'action' ] ) ){
	$action = $_REQUEST[ 'action' ];
	if ( !wp_verify_nonce( $_REQUEST[ '_wpnonce' ], 'wptofb-edit_connid' . $_REQUEST[ 'id' ] ) )
	die( __( 'Security error. Try again. ', 'wptofacebook' ) );
}


//edit existing record
if( isset( $_REQUEST[ 'wptofb_action' ] ) ||  isset( $_REQUEST[ 'action' ] ) ){
	$print_strings[ 'h2' ] = __( 'Edit Facebook Connection', 'wptofacebook' );
	$print_strings[ 'submit' ] = 'update';

	if( isset( $_REQUEST[ 'id' ] ) ){
		$print_strings[ 'id' ] = $_REQUEST[ 'id' ];//id passed on edit an existing record from list of records
	}else if( isset( $message_returned ) && $message_returned[ 'exit' ] ){
		$print_strings[ 'id' ] = $message_returned[ 'new_id' ];//id of new inserted record - see line 14

	}else if( isset( $_REQUEST[ 'wptofb_id' ] ) ){
		$print_strings[ 'id' ] = $_REQUEST[ 'wptofb_id' ];//id passed from hidden field on update
	}

	//select data from existing record
	if( isset( $print_strings[ 'id' ] ) ){
		$data = $wptofb->wptofb_select_record( $print_strings[ 'id' ] );
		$contents_data = unserialize( $data->contents );
	}
	
//new record
}else{

	$action = "new";
	$print_strings[ 'h2' ] = __( 'New Facebook Connection', 'wptofacebook' );
	$print_strings[ 'submit' ] = 'insert';
	$data = array();
	$contents_data = array();
}

?>

<div class="wptofb wrap">
<?php screen_icon( 'page' );?>
	<h2>
	<?php echo $print_strings[ 'h2' ];?>
	</h2>

	<form method="post" action="<?php  ?>" id="wptofb_edit_form">
		<!-- SUBMIT BTN HEAD-->
		<div class="submit">
			<input class="button-primary" type="submit" name="wptofb_submit"
				value="<?php _e( 'Publish' ) ?>" /> <a name="wptofb_cancel"
				href="<?php echo admin_url(). '/admin.php?page=wptofb'; ?>"><?php _e('Cancel') ?>
			</a>
		</div>

		<!-- store if it is a new record or we are editing an old one -->
		<input type="hidden" name="wptofb_action"
			value="<?php echo $print_strings[ 'submit' ];?>" />
		<!-- id of the record -->
		<input type="hidden" name="wptofb_id"
			value="<?php echo $print_strings[ 'id' ];?>" />
			<?php wp_nonce_field( 'wptofb-'.$print_strings[ 'submit' ]. '_connid' . $print_strings[ 'id' ] ); ?>
			
		<!-- TABS -->
		<div id="tabs">
			<ul>
				<li><a href="#tab-1"><?php _e( 'General Settings', 'wptofacebook' );?></a></li>
				<li><a href="#tab-2"><?php _e( 'WP Contents', 'wptofacebook' );?></a></li>
				<li><a href="#tab-3"><?php _e( 'Optional Contents', 'wptofacebook' );?></a></li>
				<li><a href="#tab-4"><?php _e( 'Templates / Styles', 'wptofacebook' );?></a></li>
			</ul>
			<!-- TAB 1 - GENERAL SETTINGS -->
			<div id="tab-1">
				<div id="titlediv" class="subsec">
					<div id="titlewrap">
						<label for="post_title"><?php _e( 'Title' );?> </label><br /> <input
							type="text" id="post_title"
							value="<?php if( isset( $data->title ) ) : echo $data->title; endif;?>"
							tabindex="1" size="30" name="post_title" /><br />
							<?php if($action != "new" ):?>
						<code>
						<?php echo site_url() . "/?wptofb=" . $data->id;?>
						</code>
						<span class="help"><?php _e( 'This is the URL you have to point your facebook app to.', 'wptofacebook' );?>
						</span>
						<?php endif;?>
					</div>
				</div>
		
				<div id="appkey" class="subsec">
					<label for="wptofb_fb_app_id"><?php _e( 'Facebook App Id', 'wptofacebook' );?>
					</label> <input type="text" id="wptofb_fb_app_id"
						value="<?php if( isset ( $data->fb_app_id ) ): echo $data->fb_app_id; endif;?>"
						tabindex="1" size="19" name="wptofb_fb_app_id" />
				</div>
		
				<div id="appsecret" class="subsec">
					<label for="wptofb_fb_app_secret"><?php _e( 'Facebook App Secret', 'wptofacebook' );?>
					</label> <input type="text" id="wptofb_fb_app_secret"
						value="<?php if( isset ( $data->fb_app_secret ) ): echo $data->fb_app_secret; endif;?>"
						tabindex="1" size="41" name="wptofb_fb_app_secret" />
				</div>
		
				<div class="subsec">
					<label><?php _e( 'Hide contents to no Facebook Fanpage fans', 'wptofacebook' );?>
					</label> <input type="hidden" name="wptofb_hide_for_nofans" value="0" />
					<input type="checkbox" value="1" name="wptofb_hide_for_nofans"
						id="wptofb_hide_for_nofans"
						<?php if( isset( $data->hide_for_nofans ) ): echo ( $data->hide_for_nofans == '1' )?  'checked="checked"': ''; endif;?> />
				</div>
			</div>
			<!-- TAB 2 - WP CONTENTS -->
			<div id="tab-2">
				<div id="select_posts" class="subsec">
					<label> <?php _e( 'Choose WP contents to show on Facebook', 'wptofacebook' );?>
					</label>
					<!-- option 1 - automatic mixed posts -->
					<div id="automatic_posts">
						<fieldset>
						<?php
						if( isset( $contents_data[ 'custom' ] ) ):
						$check_auto = ( $contents_data[ 'custom' ] == 'automatic' )? 'checked' : '' ;
						$visible_auto = ( $contents_data[ 'custom' ] == 'automatic' )? '' : 'style="display:none;"';
						$auto_legend_style = ( $contents_data[ 'custom' ] == 'automatic' )? 'style="font-weight:bold;"' : '';
						else:
						$visible_auto = 'style="display:none;"';
						endif;
						?>
							<legend
							<?php if( isset( $auto_legend_style ) ): echo $auto_legend_style; endif;?>>
								<?php _e( 'Automatic contents', 'wptofacebook' );?>
							</legend>
		
		
							<input type="radio" name="wptofb_custom" value="automatic"
							<?php if( isset( $check_auto ) ): echo $check_auto; endif;?> /> <span><?php _e( 'Choose some criteria to automatically show contents on FB', 'wptofacebook' );?>
							</span><br />
							<div id="automatic_fields"
							<?php if( isset( $visible_auto ) ): echo $visible_auto; endif;?>>
								<div class="posttypes">
								<?php
								//all types of content available on wp
									
								foreach ( $types_of_contents  as $post_type ) {
									if( isset( $contents_data[ 'types_of_content' ] ) && $contents_data[ 'custom' ] == 'automatic'  ):
									$check_auto = ( in_array( $post_type, $contents_data[ 'types_of_content' ] ) )? 'checked="checked"' : '';
									else:
									$check_auto = '';
									endif
									?>
									<input type="radio" name="wptofb_types_of_content_automatic"
										value="<?php echo $post_type;?>" <?php echo $check_auto;?> />
										<?php echo ( $post_type );?>
										<?php
								}
									
								?>
									<h5>
									<?php _e( 'Taxonomy filter', 'wptofacebook' );?>
									</h5>
									<span><?php _e( 'Choose some existent terms for filtering by categories and taxonomies. All the contents with any of the selected terms associated, will be shown on FB. Choose a diferent type of content to see the available terms. Pages have no taxonomy associated with them.', 'wptofacebook' );?>
									</span>
									<ul id="taxonomy_ul">
									<?php
									if( isset( $taxonomy_of_contents ) ):
									foreach( $taxonomy_of_contents as $taxonomy_item ){
										if( isset( $contents_data[ 'taxonomy_ids' ] ) && $contents_data[ 'custom' ] == 'automatic' ):
										//$is_checked_taxonomy = ( in_array( $taxonomy_item->term_id, $contents_data[ 'taxonomy_ids' ][ ] ) )? 'checked="checked"' : '';
										$is_checked_taxonomy = ( $wptofb->in_array_multi( $taxonomy_item->term_id, $contents_data[ 'taxonomy_ids' ] ) )? 'checked="checked"' : '';
										$visible_taxonomy = ( in_array( $taxonomy_item->post_type, $contents_data[ 'types_of_content' ] ) )? '' : 'style="display:none;"';
										else:
										$is_checked_taxonomy = '';
										$visible_taxonomy = 'style="display:none;"';
										endif;
		
										?>
										<li class="li_<?php echo $taxonomy_item->post_type;?>"
										<?php echo $visible_taxonomy;?>><input
											class="taxonomy_<?php echo $taxonomy_item->post_type;?>"
											type="checkbox"
											name="wptofb_taxonomy_<?php echo $taxonomy_item->taxonomy;?>_<?php echo $taxonomy_item->term_id;?>"
											value="<?php echo $taxonomy_item->term_id;?>"
											<?php echo $is_checked_taxonomy;?> /> <?php echo $taxonomy_item->name ;?>
										</li>
										<?php
									}
									endif;
									?>
									</ul>
									<div class="options">
									<?php _e( 'Number of articles', 'wptofacebook' );?>
										<select id="wptofb_max_posts" name="wptofb_max_posts">
										<?php foreach( $wptofb->wptofb_get_maxposts_options() as $name => $value ):?>
											<option value="<?php echo $value;?>"
											<?php if( isset( $contents_data[ 'max_posts' ] ) ): echo ( $value == $contents_data[ 'max_posts' ] )? 'selected' : ''; endif;?>>
												<?php echo $name;?>
											</option>
											<?php endforeach;?>
										</select>
										<?php _e( 'Order by', 'wptofacebook' );?>
										<select id="wptofb_order_by" name="wptofb_order_by">
										<?php foreach( $wptofb->wptofb_get_orderby_options() as $name => $value ):?>
											<option value="<?php echo $value;?>"
											<?php if( isset( $contents_data[ 'order_by' ] ) ): echo ( $value == $contents_data[ 'order_by' ] )? 'selected' : ''; endif;?>>
												<?php echo $name;?>
											</option>
											<?php endforeach;?>
										</select> <input type="radio" name="wptofb_order" value="ASC"
										<?php echo ( isset( $contents_data[ 'order' ] ) && $contents_data[ 'order' ] != 'DESC' )? 'checked' : '';?> />
										<?php _e( 'Ascendent order', 'wptofacebook' );?>
										<input type="radio" name="wptofb_order" value="DESC"
										<?php echo ( isset( $contents_data[ 'order' ] ) &&  $contents_data[ 'order' ] == 'DESC' )? 'checked' : '';?> />
										<?php _e( 'Descendent order', 'wptofacebook' );?>
		
									</div>
								</div>
							</div>
						</fieldset>
					</div>
		
		
					<!-- option 2 - manual posts -->
					<div id="manual_posts">
						<fieldset>
						<?php
						if( isset( $contents_data[ 'custom' ] ) ):
						$check_manual = ( $contents_data[ 'custom' ]  == 'manual' )? 'checked' : '' ;
						$visible_manual = ( $contents_data[ 'custom' ] == 'manual' )? '' : 'style="display:none;"';
						$manual_legend_style = ( $contents_data[ 'custom' ] == 'manual' )? 'style="font-weight:bold;"' : '';
						else:
						$visible_manual = 'style="display:none;"';
						endif;
						?>
							<legend
							<?php if( isset( $auto_legend_style ) ): echo $manual_legend_style; endif;?>>
								<?php _e( 'Manual Contents', 'wptofacebook' );?>
							</legend>
		
							<input type="radio" name="wptofb_custom" value="manual"
							<?php if( isset( $check_manual ) ): echo $check_manual; endif;?> />
							<span><?php _e( 'Choose exactly what contents and in what order you want to show on FB.', 'wptofacebook');?>
							</span><br />
		
							<div id="custom_fields"
							<?php if( isset( $visible_manual ) ): echo $visible_manual; endif;?>>
								<p class="help">
								<?php _e( 'Drag the Available Contents elements to the Selected Contents Area to show them on Facebook. You can also reorder them.', 'wptofacebook' );?>
								</p>
								<input type="hidden"
									value="<?php if( isset($contents_data[ 'ids_conns'] ) ){ echo implode(",", $contents_data[ 'ids_conns' ]);};?>"
									name="wptofb_ids_conns" id="wptofb_ids_conns" />
								<div class="posttypes">
								<?php
								//all types of content available on wp
								foreach ( $types_of_contents  as $post_type ) {
									if( isset( $contents_data[ 'types_of_content' ] ) && $contents_data[ 'custom' ] == 'manual'  ):
									$check_man = ( in_array( $post_type, $contents_data[ 'types_of_content' ] ) )? 'checked="checked"' : '';
									else:
									$check_man = 'checked="checked"';
									endif
									?>
									<input type="checkbox"
										name="wptofb_types_of_content_<?php echo $post_type;?>_manual"
										value="<?php echo $post_type;?>" <?php echo $check_man;?> />
										<?php echo ( $post_type );?>
										<?php
								}
								?>
		
								</div>
								<div id="availablecontent">
									<label><?php _e( 'Available Contents', 'wptofacebook' );?> </label>
									<?php
		
									$available_contents = $wptofb->wptofb_get_available_posts( $types_of_contents );
									if ( $available_contents ) :
									?>
									<ul id="available" class="drag_column draggable">
									<?php
									foreach( $available_contents as $post ){
										$postid = $post->ID;
		
										$class = "wptofb_" . $post->post_type;//class for post or pages
		
										if( $post->post_type != 'post' && $post->post_type != 'page' ){
											$class .= " wptofb_other";//class for no post or pages
										}
										if( isset( $contents_data[ 'ids_conns' ] ) && $contents_data[ 'custom' ] == 'manual' && in_array( $postid, $contents_data[ 'ids_conns' ] ) ):
										continue;
										endif;
										?>
										<?php
										if( isset( $contents_data[ 'types_of_content' ] ) && $contents_data[ 'custom' ] == 'manual' ):
										$post_visible = !in_array( $post->post_type, $contents_data[ 'types_of_content' ] )? 'style="display:none"' : '';
										endif;
										?>
										<li
											id="<?php if( isset( $postid ) ): echo 'item-' . $postid; endif;?>"
											class="<?php if(isset( $class ) ): echo $class; endif;?>"
											<?php if( isset( $post_visible ) ): echo $post_visible; endif;?>>
											<?php echo $post->post_title;?>
										</li>
										<?php
		
									}
		
									?>
									</ul>
									<?php
									else:
									?>
									<p>
									<?php _e( 'No contents available.', 'wptofacebook' );?>
									</p>
									<?php
									endif;
									?>
								</div>
								<div id="draganddrop"></div>
								<div id="selectedcontent">
									<label><?php _e( 'Selected Contents', 'wptofacebook' );?> </label>
		
									<ul id="selected"
										class="drag_column draggable sortable connected">
										<?php
										//if contents by hand
										if( isset( $contents_data[ 'custom' ] ) && $contents_data[ 'custom' ] == 'manual' && isset( $contents_data[ 'ids_conns' ] ) ){
											//post ids already selected
											foreach( $contents_data[ 'ids_conns' ] as $selected ){
													
												$selected_post = $wptofb->wptofb_get_single_post_data( $selected );
		
													
												$class = "wptofb_" . $selected_post->post_type;
												if( $selected_post->post_type != 'post' && $selected_post->post_type != 'page' ){
													$class .= " wptofb_other";
												}
												?>
		
												<?php
												if( isset( $contents_data[ 'types_of_content' ] )):
												$post_visible = !in_array( $selected_post->post_type, $contents_data[ 'types_of_content' ] )? 'style="display:none"' : '';
												endif;
												?>
		
										<li id="item-<?php echo $selected_post->ID;?>"
											class="<?php if( isset( $class ) ): echo $class; endif;?>"
											<?php if( isset( $post_visible ) ): echo $post_visible; endif;?>><?php if(isset( $selected_post->post_title ) ): echo $selected_post->post_title; endif;?>
										</li>
										<?php
		
											}
										}
										?>
									</ul>
								</div>
							</div>
						</fieldset>
					</div>
		
				</div>
			</div>
			<!-- TAB 3 SECONDARY CONTENTS -->
			<div id="tab-3">
				<div id="poststuff" class="subsec">
					<label><?php _e( 'Intro', 'wptofacebook' );?> </label> <span
						class="help"><?php _e( 'Optional introduction. Div container id: #introtext.', 'wptofacebook');?>
					</span>
					<?php
					$introtext = '';
					if( isset( $data->introtext ) ):
					$introtext = $data->introtext;
					endif;
					?>
					<?php if( version_compare( $wp_version, 3.3, "<" ) ){
						?>
					<div class="toggle_editor">
						<a href="#wptofb_introtext" class="button toggleVisual">Visual</a> <a
							href="#wptofb_introtext" class="button toggleHTML">HTML</a>
					</div>
					<textarea cols="50" rows="6" class="wptofb_editor_class"
						id="wptofb_introtext" name="wptofb_introtext">
						<?php echo stripslashes( $introtext );?>
					</textarea>
					<?php
					}else{
						$intro_settings = array(
							'textarea_rows'=> 6
						);
						wp_editor( $introtext, 'wptofb_introtext', $intro_settings );
					}
					?>
		
					<div class="subsec"></div>
		
					<label><?php _e( 'Outro' );?> </label> <span class="help"><?php _e( 'Optional footer. Div container id: #outrotext.', 'wptofacebook' );?>
					</span>
					<?php
					$outrotext = '';
					if( isset( $data->outrotext ) ):
					$outrotext = $data->outrotext;
					endif;
					?>
					<?php if( version_compare( $wp_version, 3.3, "<" ) ){
						?>
					<div class="toggle_editor">
						<a href="#wptofb_outrotext" class="button toggleVisual">Visual</a> <a
							href="#wptofb_outrotext" class="button toggleHTML">HTML</a>
					</div>
					<textarea cols="50" rows="6" class="wptofb_editor_class"
						id="wptofb_outrotext" name="wptofb_outrotext">
						<?php echo stripslashes( $outrotext );?>
					</textarea>
					<?php
					}else{
						$outro_settings = array(
							'textarea_rows'=> 6
						);
						wp_editor( $outrotext, 'wptofb_outrotext', $outro_settings );
					}
					?>
		
					<div class="subsec"></div>
		
					<label><?php _e( 'No Fans Text', 'wptofacebook' );?> </label> <span
						class="help"><?php _e( 'Contents to show to non fans on Facebook. Div container id: #nofans.', 'wptofacebook' )?>
					</span>
					<?php
					$nofanstext = '';
					if( isset( $data->nofans ) ):
					$nofanstext = $data->nofans;
					endif;
					?>
					<?php if( version_compare( $wp_version, 3.3, "<" ) ){
						?>
					<div class="toggle_editor">
						<a href="#wptofb_nofans" class="button toggleVisual">Visual</a> <a
							href="#wptofb_nofans" class="button toggleHTML">HTML</a>
					</div>
					<textarea cols="50" rows="6" class="wptofb_editor_class"
						id="wptofb_nofans" name="wptofb_nofans">
						<?php echo stripslashes( $nofanstext );?>
					</textarea>
					<?php
					}else{
						$nofans_settings = array(
							'textarea_rows'=> 6
						);
						wp_editor( $nofanstext, 'wptofb_nofans', $nofans_settings );
					}
					?>
		
				</div>
			</div>
			<!-- TAB 4 TEMPLATES AND STYLES -->
			<div id="tab-4">
				<div id="wptofb_div_tpls" class="subsec">
					<label><?php _e( 'Templates', 'wptofacebook' );?> </label> <span
						class="help"><?php _e( 'Choose a template in order to show your contents on FB.', 'wptofacebook' );?>
					</span><br />
					<?php
					$tpls = $wptofb->wptofb_get_templates();
		
					foreach( $tpls as $index => $template ){
						?>
					<div class="wptofb_div_tpl">
						<input type="radio" name="wptofb_tpl"
							value="<?php echo $template;?>"
							<?php if( isset( $data->tpl ) ) : echo ( $template == $data->tpl )? 'checked' : ''; endif;?> />
							<?php echo $template;?>
						<br /> <img
							src="<?php echo plugins_url( 'tpls/' . $template . '/preview.png', dirname( __FILE__ ) )?>" />
					</div>
					<?php
					}
		
					?>
					
		
				</div>
				<div id="featuredimg" class="subsec">
						<label><?php _e( 'Show Featured Image', 'wptofacebook' );?> </label><span
						class="help"><?php _e( 'If the post has a featured image, you can choose to show it and its size, but remember, the width of the image is limited by CSS because the maximum total width of a facebook page content is 760px', 'wptofacebook' );?>
					</span><br />
						<select id="wptofb_featuredimg" name="wptofb_featuredimg">
						<?php foreach( $wptofb->wptofb_get_imgs_sizes() as $name => $value ):?>
							<option value="<?php echo $value;?>"
							<?php if( isset( $data->featuredimg ) ): echo ( $value == $data->featuredimg )? 'selected' : ''; endif;?>>
								<?php echo $name;?>
							</option>
							<?php endforeach;?>
						</select>
					</div>
					
				<div id="styles" class="subsec">
					<label><?php _e( 'CSS Styles', 'wptofacebook');?> </label> <span
						class="help"><?php _e( 'Add, overwrite css rules for the chosen template with your own.', 'wptofacebook' )?>
					</span><br />
					<textarea cols="70" rows="15" id="wptofb_style" name="wptofb_style"><?php echo stripslashes( $data->style );?></textarea>
				</div>
			</div>
		</div><!-- END TABS -->
		
			<!-- SUBMIT BTN FOOT-->
			<div class="submit subsec">
				<input class="button-primary" type="submit" name="wptofb_submit"
					value="<?php _e( 'Publish' ) ?>" /> <a name="wptofb_cancel"
					href="<?php echo admin_url(). '/admin.php?page=wptofb'; ?>"><?php _e('Cancel') ?>
				</a>
			</div>
		
	</form>
</div>
