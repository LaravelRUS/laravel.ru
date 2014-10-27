@extends('_layout.main')

@section('container')


<div class="blog container">
	<div class="row">

		<aside id="blog-sidebar" class="blog-sidebar col-md-3 col-sm-3 col-xs-12 col-md-offset-1 col-sm-offset-1 col-xs-offset-0">
			<section class="widget search">
				<form class="search-blog-form">
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Search blog...">
					</div>
					<button type="submit" class="btn btn-cta btn-cta-primary"><i class="fa fa-search"></i></button>
				</form>
			</section><!--//search-->
			<section class="widget social">
				<h3 class="title">Get Connected</h3>
				<ul class="list-inline">
					<li><a href="#"><i class="fa fa-facebook-square"></i></a></li>
					<li><a href="#"><i class="fa fa-twitter-square"></i></a></li>
					<li><a href="#"><i class="fa fa-envelope-square"></i></a></li>
					<li><a href="#"><i class="fa fa-rss-square"></i></a></li>
				</ul>
			</section><!--//widget-->
			<section class="widget categories">
				<h3 class="title">Categories</h3>
				<ul class="list-unstyled">
					<li><a href="#">News</a></li>
					<li><a href="#">Stories</a></li>
					<li><a href="#">Technology</a></li>
					<li><a href="#">Business</a></li>
				</ul>
			</section><!--//widget-->
			<section class="widget archives">
				<h3 class="title">Archives</h3>
				<ul class="list-unstyled">
					<li><a href="#">June 2014 <span class="count">(3)</span></a></li>
					<li><a href="#">May 2014 <span class="count">(5)</span></a></li>
					<li><a href="#">April 2014 <span class="count">(4)</span></a></li>
					<li><a href="#">March 2014 <span class="count">(2)</span></a></li>
				</ul>
			</section><!--//widget-->
			<section class="widget recent-posts">
				<h3 class="title">Recent Posts</h3>
				<ul class="list-unstyled">
					<li><a href="#">Lorem ipsum dolor sit amet</a><br /><span class="date">22 May 2014</span></li>
					<li><a href="#">Vestibulum ante ipsum primis</a><br /><span class="date">16 May 2014</span></li>
					<li><a href="#">Phasellus feugiat arcu eget sem tincidunt </a><br /><span class="date">12 May 2014</span></li>
					<li><a href="#">Pellentesque mattis scelerisque</a><br /><span class="date">27 April 2014</span></li>
					<li><a href="#">Nulla egestas commodo dignissim</a><br /><span class="date">6 April 2014</span></li>
				</ul>
			</section><!--//widget-->
		</aside><!--//blog-side-bar-->

		<div id="blog-entry" class="blog-entry section col-md-8 col-sm-8 col-xs-12">

			@yield('content')

		</div> <!-- blog-entry -->

	</div> <!-- row -->
</div> <!-- container -->


@stop