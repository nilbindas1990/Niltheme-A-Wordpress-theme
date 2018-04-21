<?php 
get_header();
if(have_posts()) : ?>

<?php while(have_posts()) : the_post();?>
<article class="post page">
	<div class="column-container clearfix">

		<!-- Title -->
		<div class="tilte-column">
			<h2><?php the_title();?></h2>
		</div>
		
		<!--Content-->
		<div class="atuhor-content-box">
			<div class="map-box">
				<h3>My Google Maps Demo</h3>
			    <div id="map"></div>

			    <script>
			      function initMap() {
			        var uluru = {lat: 20.5937, lng: 78.9629};
			        var map = new google.maps.Map(document.getElementById('map'), {
			          zoom: 4,
			          center: uluru
			        });
			        var marker = new google.maps.Marker({
			          position: uluru,
			          map: map
			        });
			      }
			    </script>
			    
			    <script async defer
			    	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDkVOFgidbi7ifVTL8SliWXk2bwxxzqqcA&callback=initMap">
			    </script>

			</div>
			<div class="text-column">
				<?php the_content();?>
			</div>
		</div>
		
	</div>
	
</article>
	<?php endwhile;?>

<?php 
	else :
		echo('No Content Found');
	endif;
get_footer();
?>
