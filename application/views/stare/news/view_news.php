<div class="container">
			<div class="row">
				<div class="span9">
				<?php
					foreach ($news as $row) {
					$id_news = $row->id_news;
				?>
					<article class="blog-article">
						<div class="blog-img">
							<img src="img/694x246.jpg" alt="Blog image">
						</div><!--end blog-img-->

						<div class="blog-content">
							<div class="blog-content-title">
								<h1><a href="#" class="invarseColor"><?php echo $row->title_news; ?></a></h1>
							</div>
							<div class="clearfix">
								<ul class="unstyled blog-content-date">
									<!-- <li class="pull-right"><i class="icon-comments"></i> 15</li> -->
									<li class="pull-left"><?php echo $row->category_news; ?></li>
									<li class="pull-left"><i class="icon-calendar"></i><?php echo $row->adddate_news; ?></li>
									<li class="pull-left"><i class="icon-pencil"></i> <a href="#"><?php echo $this->portal_model->getNameUser($row->id_user); ?></a></li>
								</ul>
							</div>
							<div class="blog-content-entry">
								<p>
								<?php echo $row->add_content_news; ?>
								</p>
							</div>
						</div><!--end blog-content-->
					</article><!--end article-->

					<div class="about-author well">
						<div class="pull-left">
							<a href="#"><img src="img/72x72.jpg" alt="author avatar"></a>
						</div>
						<div>
							<h4>About: <a href="#">John Doe</a></h4>
							<p>
								consectetur adipiscing eli. Nulla tristique posuere felis vel pretium. Sed sit amet nisi elit. Nulla nec congue elit. Nunc vitae dui ornare mi varius placerat. 
							</p>
						</div>
					</div><!--end about-author-->

					<div class="user-comments">
						<div class="titleHeader clearfix">
							<h3>Users Comments</h3>
						</div><!--end titleHeader-->

						<ul class="media-list">
							<?php 
							if (isset($comment)) {	
							foreach ($comment as $com) {
							?>
							<li class="media">
								<a class="pull-left" href="#">
							      <img class="media-object" src="img/64x64.jpg" alt="user-avatar">
							    </a>
							    <div class="media-body">
							    	
							        <h4 class="media-heading">
							      	   <a href="#" class="invarseColor"><?php echo $com->login; ?></a> - <?php echo $com->date_add; ?>
							        </h4>
							        <p><?php echo $com->content_comment; ?></p>
							    </div>
							</li>
							<?php
							} 
							
							} else {
							?>
							<li class="media">	
							    <div class="media-body"> 	
							        <p>Brak komentarzy.</p>
							    </div>
							</li>
							<?php
							}
							?>
							
						</ul><!--end media-list-->
					</div><!--end user-comments-->
				
					<?php if ($this->users->logged()) { 
						$id_user = $this->users->print_id_user();
					?>
					
					<div class="make-comment">
						<?php if (isset($message)) { ?>
							<dir class="alert alert-error"><?php echo $message;?></dir>
						<?php } ?>
						
						<?php if (isset($errors)) echo $errors; ?>
						<div class="titleHeader clearfix">
							<h3>Skomentuj:</h3>
						</div><!--end titleHeader-->
						
						<?php echo form_open("portal/add_comment/$id_news/$id_user")?>
							
							<div class="controls">
							<?php 
							$data = array(
								'name'		=> 'content_comment',
								'id'		=> 'comment',
								'style'		=> 'width: 100%;',
							);
							echo form_textarea($data); 
							?>
							</div>
							<button type="submit" class="btn btn-primary pull-right">Add Comment</button>
						<?php echo form_close();?><!--end form-->
					</div><!--end make-comment-->
					<?php
					}	
					?>
				<?php
					}	
					?>
				</div><!--end span9-->
				
				<aside class="span3">

					<div class="blog-search">
						<form class="form-search">
						  <div class="input-append">
						    <input type="text" class="span2 search-query" name="" value="" placeholder="Blog Search...">
						    <button type="submit" class="btn">Search</button>
						  </div>
						</form><!--end form-->
					</div><!--end blog-search-->

					<div class="blog-tab">
						<ul class="nav nav-tabs">
						  <li class="active">
						  	<a href="#popular-post" data-toggle="tab"><i class="icon-book"></i></a>
						  </li>
						  <li>
						  	<a href="#recent-post" data-toggle="tab"><i class="icon-time"></i></a>
						  </li>
						  <li>
						  	<a href="#recent-comments" data-toggle="tab"><i class="icon-comments"></i></a>
						  </li>
						  <li>
						  	<a href="#tags-post" data-toggle="tab"><i class="icon-tags"></i></a>
						  </li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" id="popular-post">
								<ul class="vProductItemsTiny">
									<li class="span4 clearfix">
										<div class="thumbImage">
											<a href=""><img src="img/72x72.jpg" alt=""></a>
										</div>
										<div class="thumbSetting">
											<div class="thumbTitle">
												<a href="#" class="invarseColor">
													Foliomania the title here
												</a>
												<br>
												<small>23, Jan 2012</small>
											</div>
										</div>
									</li>
									<li class="span4 clearfix">
										<div class="thumbImage">
											<a href=""><img src="img/72x72.jpg" alt=""></a>
										</div>
										<div class="thumbSetting">
											<div class="thumbTitle">
												<a href="#" class="invarseColor">
													Foliomania the title here
												</a>
												<br>
												<small>23, Jan 2012</small>
											</div>
										</div>
									</li>
									<li class="span4 clearfix">
										<div class="thumbImage">
											<a href=""><img src="img/72x72.jpg" alt=""></a>
										</div>
										<div class="thumbSetting">
											<div class="thumbTitle">
												<a href="#" class="invarseColor">
													Foliomania the title here
												</a>
												<br>
												<small>23, Jan 2012</small>
											</div>
										</div>
									</li>
									<li class="span4 clearfix">
										<div class="thumbImage">
											<a href=""><img src="img/72x72.jpg" alt=""></a>
										</div>
										<div class="thumbSetting">
											<div class="thumbTitle">
												<a href="#" class="invarseColor">
													Foliomania the title here
												</a>
												<br>
												<small>23, Jan 2012</small>
											</div>
										</div>
									</li>
								</ul>
							</div>
							<div class="tab-pane" id="recent-post">
								<ul class="vProductItemsTiny">
									<li class="span4 clearfix">
										<div class="thumbImage">
											<a href=""><img src="img/72x72.jpg" alt=""></a>
										</div>
										<div class="thumbSetting">
											<div class="thumbTitle">
												<a href="#" class="invarseColor">
													Foliomania the title here
												</a>
												<br>
												<small>23, Jan 2012</small>
											</div>
										</div>
									</li>
									<li class="span4 clearfix">
										<div class="thumbImage">
											<a href=""><img src="img/72x72.jpg" alt=""></a>
										</div>
										<div class="thumbSetting">
											<div class="thumbTitle">
												<a href="#" class="invarseColor">
													Foliomania the title here
												</a>
												<br>
												<small>23, Jan 2012</small>
											</div>
										</div>
									</li>
									<li class="span4 clearfix">
										<div class="thumbImage">
											<a href=""><img src="img/72x72.jpg" alt=""></a>
										</div>
										<div class="thumbSetting">
											<div class="thumbTitle">
												<a href="#" class="invarseColor">
													Foliomania the title here
												</a>
												<br>
												<small>23, Jan 2012</small>
											</div>
										</div>
									</li>
									<li class="span4 clearfix">
										<div class="thumbImage">
											<a href=""><img src="img/72x72.jpg" alt=""></a>
										</div>
										<div class="thumbSetting">
											<div class="thumbTitle">
												<a href="#" class="invarseColor">
													Foliomania the title here
												</a>
												<br>
												<small>23, Jan 2012</small>
											</div>
										</div>
									</li>
								</ul>
							</div>
							<div class="tab-pane" id="recent-comments">
								<ul class="vProductItemsTiny">
									<li class="span4 clearfix">
										<div class="thumbImage">
											<a href=""><img src="img/72x72.jpg" alt=""></a>
										</div>
										<div class="thumbSetting">
											<div class="thumbTitle">
												By:<a href="#" class="invarseColor">SomeGuy</a>
												<br>
												On: <a href="#">Foliomania the title here</a>
											</div>
										</div>
									</li>
									<li class="span4 clearfix">
										<div class="thumbImage">
											<a href=""><img src="img/72x72.jpg" alt=""></a>
										</div>
										<div class="thumbSetting">
											<div class="thumbTitle">
												By:<a href="#" class="invarseColor">SomeGuy</a>
												<br>
												On: <a href="#">Foliomania the title here</a>
											</div>
										</div>
									</li>
									<li class="span4 clearfix">
										<div class="thumbImage">
											<a href=""><img src="img/72x72.jpg" alt=""></a>
										</div>
										<div class="thumbSetting">
											<div class="thumbTitle">
												By:<a href="#" class="invarseColor">SomeGuy</a>
												<br>
												On: <a href="#">Foliomania the title here</a>
											</div>
										</div>
									</li>
									<li class="span4 clearfix">
										<div class="thumbImage">
											<a href=""><img src="img/72x72.jpg" alt=""></a>
										</div>
										<div class="thumbSetting">
											<div class="thumbTitle">
												By:<a href="#" class="invarseColor">SomeGuy</a>
												<br>
												On: <a href="#">Foliomania the title here</a>
											</div>
										</div>
									</li>
								</ul>
							</div>
							<div class="tab-pane" id="tags-post">
								Put some Content Tags Here to display it on tabs...
							</div>
						</div><!--end tab-content-->
					</div><!--end blog-tab-->

					<div class="blog-category categories">
						<div class="titleHeader clearfix">
							<h3>Categories</h3>
						</div><!--end titleHeader-->
						<ul class="unstyled">
							<li><a class="invarseColor" href="#"><i class="icon-caret-right"></i> Category No.1</a></li>
							<li><a class="invarseColor" href="#"><i class="icon-caret-right"></i> Category No.2</a></li>
							<li><a class="invarseColor" href="#"><i class="icon-caret-right"></i> Category No.3</a></li>
							<li><a class="invarseColor" href="#"><i class="icon-caret-right"></i> Category No.4</a></li>
							<li><a class="invarseColor" href="#"><i class="icon-caret-right"></i> Category No.5</a></li>
						</ul>
					</div><!--end blog-category-->
					<div class="blog-adds">
						<a href="#"><img src="img/214x136.jpg" alt="Adds"></a>
					</div><!--end blog-adds-->
					<div class="blog-twitter">
						<div class="titleHeader clearfix">
							<h3>Twitter Feeds</h3>
						</div><!--end titleHeader-->	
						<div class="tweet">
							<!-- tweets will generate automaticlly here-->
						</div><!--end tweet-->	
					</div><!--end blog-twitter-->
				</aside><!--end span3-->
			</div><!--end row-->
		</div><!--end conatiner-->