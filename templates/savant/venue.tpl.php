	
	<?php if($this->error == false): ?>
	
	<?php $venue = $this->data->response->venue; ?>
	
	<!-- content container start -->
	<div id="contentContainer">
		<div class="venueTitle">
			
			<?php if(isset($venue->url)): ?>
				
			<p><a href="<?php echo $venue->url; ?>"><?php echo $venue->name; ?></a></p>
				
			<?php else: ?>
			
			<p><a href="<?php echo $venue->canonicalUrl; ?>"><?php echo $venue->name; ?></a></p>
			
			<?php endif; ?>

		</div>
		
		<div class="venueDetails">
			
			<?php if(isset($venue->location)): ?>
			
			<div class="venueAddress">
				<?php if(isset($venue->location->address)): ?>
					<span class="address"><?php echo $venue->location->address; ?></span>
				<?php endif; ?>	
				
				<?php if(isset($venue->location->postalCode)): ?>
					<span class="postalcode"><?php echo $venue->location->postalCode; ?></span>
				<?php endif; ?>
				
				<?php if(isset($venue->location->city)): ?>
					<span class="city"><?php echo $venue->location->city; ?></span>
				<?php endif; ?>
				
				<?php if(isset($venue->location->state)): ?>
					<span class="state"><?php echo $venue->location->state; ?></span>
				<?php endif; ?>
				
				<?php if(isset($venue->location->country)): ?>
					<span class="country"><?php echo $venue->location->country; ?></span>
				<?php endif; ?>
			</div>
			
			<?php endif; ?>
			
			<?php if(isset($venue->contact)): ?>
			
			<div class="venueContacts">
				<?php if(isset($venue->contact->phone)): ?>
					<div class="phone"><span class="label">Phone: </span><?php echo $venue->contact->phone; ?></div>
				<?php endif; ?>
				
				<?php if(isset($venue->contact->twitter)): ?>
					<div class="twitter"><span class="label">Twitter: </span><a href="http://twitter.com/<?php echo $venue->contact->twitter; ?>">@<?php echo $venue->contact->twitter; ?></a></div>
				<?php endif; ?>
			</div>
			
			<?php endif; ?>
			
			<?php if(isset($venue->categories)): ?>
			
			<div class="venueCategories">
				
				<?php $c = count($venue->categories); for($i = 0; $i < count(); $i++):  ?>
				
				<span class="icon"></span>
				
				<?php endfor; ?>
				
			</div>
			
			<?php endif; ?>
			
		</div>
	</div><!-- content container ends -->
	
	<!-- sidebar container start -->
	<div id="sidebarContainer">
		<!-- mini map container start -->
		<div id="minimap_canvas">
			Map loading...
		</div><!-- mini map container ends -->
	</div><!-- sidebar container ends -->
	
	<?php else: ?>
	
		<!-- content container start -->
		<div id="contentContainer">
			<div class="errorBox">
				<p>Error loading venue details. (<a href="">try again</a>)</p>
			</div>
		</div><!-- content container ends -->
	
	<?php endif; ?>