<div class="wrap">
	<?php screen_icon( 'edit-comments' ); ?>
	<h2><?php _e( 'WpToFacebook - How to create a connection', 'wptofacebook' ); ?></h2>
	
	<div id="accordion">	
		<h3><a href="#">1. <?php _e( 'Create a facebook app', 'wptofacebook' ); ?></a></h3>
		<ol>
			<li>
				<span class="strong">1.1. </span><?php _e( 'Log into Facebook and go to', 'wptofacebook' ); ?> <a target="_blank" href="https://developers.facebook.com/apps">developers.facebook.com/apps</a>. <?php _e( 'If it\'s the first time, you have to give permission the Facebook Developer App.', 'wptofacebook' )
				?>
			</li>
			<li>
				<span class="strong">1.2. </span><?php _e( 'Click on "+ Create New App"', 'wptofacebook' ); ?>
				<br>
				<img src="<?php echo plugins_url( '/images/help-01.jpg', dirname( __FILE__ ) ); ?>"/>
			</li>
			<li>
				<span class="strong">1.3. </span><?php _e( 'Give a name for the app and click "Continue"', 'wptofacebook' )
				?>.
				<?php _e( 'Maybe Facebook will ask you for some verification and security checking', 'wptofacebook' )
				?>.
				<br>
				<img src="<?php echo plugins_url('/images/help-02.jpg', dirname(__FILE__)); ?>"/>
			</li>
			<li>
				<span class="strong">1.4. </span><?php _e( 'You will go to the main app page and see an App ID and an App Secret codes. They are important to make the connection within wptofacebook and your facebook app, so copy them or, without closing this page, open another from your woprdress administration', 'wptofacebook' )
				?>.
				<br>
				<img src="<?php echo plugins_url('/images/help-03.jpg', dirname(__FILE__)); ?>"/>
			</li>
		</ol>
		
		<h3><a href="#">2. <?php _e( 'Create a new WpToFacebook connection', 'wptofacebook' ); ?></a></h3>
		<ol>
			<li>
				<span class="strong">2.1. </span><?php _e( 'Log into your worpdress admin. If WpToFacebook is not activated, please go to your Plugins menu -> Installed Plugins, and click on "Activate"', 'wptofacebook' ); ?>.
				<br>
				<img src="<?php echo plugins_url( '/images/help-04.jpg', dirname( __FILE__ ) ); ?>"/>
			</li>
			<li>
				<span class="strong">2.2. </span><?php _e( 'WpToFacebook will be shown on the Wordpress menu. Go to WpToFacebook -> New Connection', 'wptofacebook' ); ?>.
				<br>
				<img src="<?php echo plugins_url( '/images/help-05.jpg', dirname (__FILE__ ) ); ?>"/>
			</li>
			<li>
				<span class="strong">2.3. </span><?php _e( 'General Settings', 'wptofacebook' ); ?>.
				<br>
				<?php _e( 'Write a title, and put the facebook App Id and App Secret you created on step 1.4', 'wptofacebook' ); ?>.
				<br>
				<?php _e( 'You can have your contents visible just for your fans on your facebook page', 'wptofacebook' ); ?>.
				<br>
				<img src="<?php echo plugins_url( '/images/help-06.jpg', dirname( __FILE__ ) ); ?>"/>
			</li>
		</ol>
		
		<h3><a href="#">3. <?php _e( 'Choose contents to show on Facebook', 'wptofacebook' ); ?></a></h3>
		<ol>
			<?php _e( 'You can choose automatic or manual contents', 'wptofacebook' ); ?>.
			<li>
				3.1. <?php _e( 'Automatic contents', 'wptofacebook' ); ?>.
				<br>
				<?php _e( 'Choose the type of content, the taxonomy (if needed), the number of articles, the order by and the order', 'wptofacebook' ); ?>.
				<br>
				<img src="<?php echo plugins_url( '/images/help-07a.jpg', dirname( __FILE__ ) ); ?>"/>
			</li>
			<li>
				3.2. <?php _e( 'Manual contents', 'wptofacebook' ); ?>.
				<br>
				<?php _e( 'Choose the type of content, and drag individual posts from available to selected contents area', 'wptofacebook' ); ?>.
				<br>
				<?php _e( 'You can also reorder them by drag&drop', 'wptofacebook' ); ?>.
				<br>
				<img src="<?php echo plugins_url( '/images/help-07b.jpg', dirname( __FILE__ ) ); ?>"/>
			</li>
		</ol>
		
		<h3><a href="#">4. <?php _e( 'Header, foooter and content for no fans', 'wptofacebook' ); ?></a></h3>
		<ol>
			<li>
				<?php _e( 'You can add contents for a header (intro), a footer (outro) and just visible for those who are not fans of your facebook page', 'wptofacebook' ); ?>.
				<br>
				<img src="<?php echo plugins_url( '/images/help-08.jpg', dirname( __FILE__ ) ); ?>"/>
			</li>
		</ol>
		
		<h3><a href="#">5. <?php _e( 'Templates and Styles', 'wptofacebook' ); ?></a></h3>
		<ol>
			<li>
				<span class="strong">5.1. </span><?php _e( 'Templates', 'wptofacebook' ); ?>.
				<br>
				<?php _e( 'Choose one template from the list', 'wptofacebook' ); ?>.
				<br>
				<img src="<?php echo plugins_url( '/images/help-09.jpg', dirname( __FILE__ ) ); ?>"/>
			</li>
			<li>
				<span class="strong">5.2. </span><?php _e( 'Show Featured Image', 'wptofacebook' ); ?>.
				<br>
				<?php _e( 'If the post has a featured image, you can choose to show it and its size, but remember, the width of the image is limited by CSS because the maximum total width of a facebook page content is 760px', 'wptofacebook' ); ?>.
				<br>
				<img src="<?php echo plugins_url( '/images/help-10.jpg', dirname( __FILE__ ) ); ?>"/>
			</li>
			<li>
				<span class="strong">5.3. </span><?php _e( 'CSS Rules', 'wptofacebook' ); ?>.
				<br>
				<?php _e( 'Add, overwrite css rules for the chosen template with your own', 'wptofacebook' ); ?>.
				<br>
				<img src="<?php echo plugins_url( '/images/help-11.jpg', dirname( __FILE__ ) ); ?>"/>
			</li>
		</ol>
		
		<h3><a href="#">6. <?php _e( 'Add facebook app to your page', 'wptofacebook' ); ?></a></h3>
		<ol>
			<li>
				<span class="strong">6.1. </span><?php _e( 'Save your wpToFacebook connection', 'wptofacebook' ); ?>.
				<br>
				<?php _e( 'To save the settings for your connection, simply click "Publish"', 'wptofacebook' ); ?>.
				<br>
				<?php _e( 'Under the Title field, you will see an URL. Please copy it', 'wptofacebook' ); ?>.
				<br>
				<img src="<?php echo plugins_url( '/images/help-12.jpg', dirname( __FILE__ ) ); ?>"/>
			</li>
			<li>
				<span class="strong">6.2. </span><?php _e( 'Go to your facebook developer page for the app you\'ve created on step 1', 'wptofacebook' ); ?>.
				<br>
				<?php _e( 'Under Settings->Basic page, select "Page Tab". Enter a Name for your Tab (Page Tab Name:), and the URL from the previous step under "Page Tab URL"', 'wptofacebook' ); ?>.
				<br>
				<?php _e( 'You can also upload an image for your Tab under "Page Tab Image:"', 'wptofacebook' ); ?>.
				<br>
				<?php _e( 'Choose the page tab width also, 520px or 810px', 'wptofacebook' ); ?>.
				<br>
				<?php _e( 'If you have your wordpress hosted on a Server with HTTPS enabled, please enter the secure URL on Secure Page Tab URL', 'wptofacebook' ); ?>.
				<br>
				<?php _e( 'Click on Save Changes', 'wptofacebook' ); ?>.
				<br>
				<img src="<?php echo plugins_url( '/images/help-13.jpg', dirname( __FILE__ ) ); ?>"/>
				<br>
				<?php _e( '*Important note: If you have not a Server with SSL protocol, you can use for free ', 'wptofacebook' ); ?><a target="_blank" href="http://www.social-server.com/">Social Server</a>.
				<?php _e( 'Follow the indications you will find on the web', 'wptofacebook' ); ?>.
			</li>
			<li>
				<span class="strong">6.3. </span><?php _e( 'Add the app to a tab on your Facebook Page', 'wptofacebook' ); ?>.
				<br>
				<?php _e( 'Go to the URL', 'wptofacebook' ); ?><code>https://www.facebook.com/dialog/pagetab?app_id=YOUR_APP_ID&next=YOUR_URL</code>.
				<br>
				<?php _e( 'YOUR_APP_ID and YOUR_URL can be found in your app settings. This URL brings up the Add to Page Dialog where you can choose the page/s where to add your app', 'wptofacebook' ); ?>.
				<br>
				<img src="<?php echo plugins_url( '/images/help-14.jpg', dirname( __FILE__ ) ); ?>"/>
			</li>
			<?php _e( 'More info on page tabs ', 'wptofacebook' ); ?>: <a target="_blank" href="https://developers.facebook.com/docs/appsonfacebook/pagetabs/">Page Tab Tutorial (Facebook Developers)</a>.
		</ol>
		
		<h3><a href="#">7. <?php _e( 'Visit your facebook page', 'wptofacebook' ); ?></a></h3>
		<ol>
			<li>
				<?php _e( 'Go to your facebook page and search for the new tab', 'wptofacebook' ); ?>.
				<br>
				<img src="<?php echo plugins_url( '/images/help-15.jpg', dirname( __FILE__ ) ); ?>"/>
			</li>
		</ol>
			
	</div>
	<h4>&copy; 2012 <a href="http://www.plastikaweb.com" target="_blank">Plastikaweb</a></h4>

</div>