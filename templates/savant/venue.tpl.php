	
	<?php if($this->error == false): ?>
	
	<?php $venue = $this->data->response->venue; ?>
	
	<!-- content container start -->
	<div id="contentContainer">
		<div class="venueTitle">
			
			<?php if(isset($venue->url)): ?>
				
			<div class="title"><a href="<?php echo $venue->url; ?>"><?php echo $venue->name; ?></a></div>
				
			<?php else: ?>
			
			<div class="title"><a href="<?php echo $venue->canonicalUrl; ?>"><?php echo $venue->name; ?></a></div>
			
			<?php endif; ?>
			
			<div class="checkins">
				<div class="num"><?php echo $venue->hereNow->count; ?></div>
				<div class="text">Checkins</div>
			</div>
		</div>
		
		<!-- venue details container start -->
		<div class="venueDetails">
			
			<?php if(isset($venue->categories)): ?>
			
			<div class="venueCategories">
				
				<?php $c = count($venue->categories); for($i = 0; $i < $c; $i++):  ?>
				
				<span class="icon">
					<img src="<?php echo $venue->categories[$i]->icon; ?>" 
						 alt="<?php echo $venue->categories[$i]->pluralName; ?>"
						 title="<?php echo $venue->categories[$i]->pluralName; ?>" />
				</span>
				
				<?php endfor; ?>
				
			</div>
			
			<?php endif; ?>
			
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
			
		</div><!-- // venue details container ends -->
		
		
		<!-- venue photos container start -->
		<?php if(isset($venue->photos)): $photos = $venue->photos->groups[1]->items; ?>
			
		<div class="venuePhotos">
			
			<?php $c = count($photos); for($i = 0; $i < $c; $i++): ?>
				
			
			<a href="<?php echo $photos[$i]->url; ?>">
			<img src="<?php echo $photos[$i]->sizes->items[2]->url; ?>" width="100" height="100" />
			</a>
			
				
			<?php endfor; ?>
			
		</div>
			
		<?php endif; ?><!-- // venue photos container ends -->
		
		<!-- venue description container start -->
		<?php if(isset($venue->description)): ?>
			
		<div class="venueDescription">
			<p><?php echo $venue->description; ?></p>
		</div>
			
		<?php endif; ?><!-- // venue description container ends -->
		
		<!-- venue tips container start -->
		<?php if(isset($venue->tips)): $tips = $venue->tips->groups[0]->items; ?>
			
		<div class="venueTips">
			
			<?php $c = count($tips); for($i = 0; $i < $c; $i++): ?>
				
			<div class="tip">
				<div class="profilePic">
					<img src="<?php echo $tips[$i]->user->photo; ?>">
				</div>
				<div class="content">
					<div class="user">
						<span class="firstname"><?php echo $tips[$i]->user->firstName; ?></span>
						<span class="location">(<?php echo $tips[$i]->user->homeCity; ?>)</span>
					</div>
					<div class="text">
						<p><?php echo $tips[$i]->text; ?></p>
					</div>
				</div>
			</div>
				
			<?php endfor; ?>
			
		</div>
			
		<?php endif; ?><!-- // venue description container ends -->
		
	</div><!-- // content container ends -->
	
	<!-- sidebar container start -->
	<div id="sidebarContainer">
		<!-- mini map container start -->
		<div id="minimap_canvas" 
			data-lat="<?php echo $venue->location->lat; ?>" 
			data-lng="<?php echo $venue->location->lng; ?>" 
			data-venuename="<?php echo $venue->name; ?>">
			Map loading...
		</div><!-- // mini map container ends -->
		
		<?php if(isset($venue->mayor)): ?>
		<!-- mayor container star -->
		<div class="mayorContainer">
			<div class="profilePic">
				<img src="<?php echo $venue->mayor->user->photo ?>" />
			</div>
			<div class="user">
				<div class="name"><?php echo $venue->mayor->user->firstName; ?> <?php if(isset($venue->mayor->user->lastName)) { echo $venue->mayor->user->lastName; } ?></div>
				<div class="location"><?php echo $venue->mayor->user->homeCity; ?></div>
				<div class="label">Venue Mayor</div>
			</div>
		</div><!-- // mayor container ends -->
		<?php endif; ?>
		
		<a href="<?php echo $this->base_url; ?>" class="linkbtn">&larr; Back</a>
		
		<div class="socialButtons">
			</span class="twitter">
				<a href="https://twitter.com/share" class="twitter-share-button" data-count="horizontal">Tweet</a><script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
			</span>
			<span class="google">
				<g:plusone size="medium"></g:plusone>
			</span>
			<span class="facebook">
				<iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Flab.jshamsul.com%2Fcrowded&amp;send=false&amp;layout=button_count&amp;width=100&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21&amp;appId=128979620479922" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100px; height:21px;" allowTransparency="true"></iframe>
			</span>
		</div>

	</div><!-- // sidebar container ends -->
	
	<?php else: ?>
	
		<!-- content container start -->
		<div id="contentContainer">
			<div class="errorBox">
				<p>Error loading venue details. (<a href="">try again</a>)</p>
			</div>
		</div><!-- // content container ends -->
	
	<?php endif; ?>