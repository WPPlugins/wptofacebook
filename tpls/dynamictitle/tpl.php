<?php
//TITLE TPL
if ( $my_query->have_posts() ) :

?>
<div class="contents">
<?php //all posts content

while($my_query->have_posts()) : $my_query->the_post();
?>

	<div class="content">

		<div class="permalink_class">
			<h2>
				<a href="#" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?>
				</a>
				
			</h2>
			<a class="hider" href="#" title="Show/hide post">&darr;</a>
			
	
			<div class="fb-like" data-href="<?php the_permalink() ?>"
				data-send="true" data-width="490" data-layout="button_count"
				data-show-faces="false"></div>
		</div>


		<!-- Display a comma separated list of the Post's Categories. -->
		<div class="content_class">
		<?php
		if( $data->featuredimg && function_exists( 'the_post_thumbnail' ) ){
			the_post_thumbnail( $data->featuredimg );
		}
		?>
		<?php the_content();?>

		</div>
	</div>
	<!-- closes the first div box -->
	<?php
	endwhile;
	wp_reset_query();
	?>
</div>
	<?php endif;
	?>
<script
	type="text/javascript"
	src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
<script
	type="text/javascript"
	src="<?php echo WP_PLUGIN_URL . '/wptofacebook/tpls/' . $data->tpl;?>/script.js"></script>
