<div class="container">

			<div class="row">
				
				<div class="span9">
					<?php
						foreach ($newses as $row) {
					?>
					<article class="blog-article">
					<div class="row">
						<div class="span4">
							<div class="blog-img">
								<a href="portal/show_news/<?php echo $row->id_news; ?>"><img src="img/294x216.jpg" alt="<?php echo $row->title_news; ?>"></a>
							</div><!--end blog-img-->
						</div><!--end span4-->

						<div class="span5">
							<div class="blog-content">
								<div class="blog-content-title">
									<h2><a href="portal/show_news/<?php echo $row->id_news; ?>" class="invarseColor" title="<?php echo $row->title_news; ?>"><?php echo $row->title_news; ?></a></h2>
								</div>
								<div class="clearfix">
									<ul class="unstyled blog-content-date">
										<li class="pull-right"><i class="icon-comments"></i> <?php echo $this->portal_model->HowManyComment($row->id_news);?></li>
										<li class="pull-left"><i class="icon-calendar"></i> <?php echo $row->adddate_news; ?></li>
										<li class="pull-left"><i class="icon-pencil"></i> <a href="#"><?php echo $this->portal_model->getNameUser($row->id_user);?></a></li>
										
									</ul>
								</div>
								<div class="blog-content-entry">
									<p>
										<?php echo $row->content_news; ?>
									</p>
									<p>Kategoria: <?php echo $row->category_news; ?></p><a href="portal/show_news/<?php echo $row->id_news; ?>" title="<?php echo $row->title_news; ?>">Czytaj więcej &rarr;</a>
								</div>
							</div><!--end blog-content-->
						</div><!--end span5-->
					</div><!--end row-->
					</article><!--end article-->
					<?php
						}
					?>
					<div class="pagination pagination-large pagination-centered">
						<ul>
							<?php echo $pagination;?>
						</ul>
					</div>
				</div><!--end span9-->


				<aside class="span3">

					<div class="blog-search">
						<form class="form-search">
						  <div class="input-append">
						    <input type="text" class="span2 search-query" name="" value="" placeholder="Blog Search...">
						    <button type="submit" class="btn">Search</button>
						  </div>
						</form>
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
	