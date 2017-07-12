<div class="updated">
<p><strong> <?php
if ( !isset( $_REQUEST[ 'id' ] ) && !isset( $_REQUEST[ '_wpnonce' ] ) 
		&&  !wp_verify_nonce( $_REQUEST[ '_wpnonce' ], 'wptofb-delete_connid' . $_REQUEST[ 'id' ] ) ){
	_e( 'Security error. Try again.', 'wptofacebook' );
}else{
	$wptofb = new WpToFb();
	$wptofb->wptofb_delete( $_REQUEST[ 'id' ] );
	_e( 'Register deleted.', 'wptofacebook' );
}
?> </strong></p>
</div>
