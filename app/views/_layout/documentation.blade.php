@extends('_layout.main')

@section('container')

<script type="application/javascript">
	function offsetPosition(e) { // отступ от верхнего края экрана до элемента
		var offsetTop = 0;
		do {offsetTop  += e.offsetTop;} while (e = e.offsetParent);
		return offsetTop;
	}
	$(document).ready(function() {
		var aside = document.querySelector('.version_selector');
		var OP = offsetPosition(aside);
		window.onscroll = function () {
			aside.className = (OP < window.pageYOffset ? 'version_selector_sticky' : ''); // если значение прокрутки больше отступа от верхнего края экрана до элемента, то элементу присваивается класс sticky
		}
	});
</script>

<div class="docs container">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="version_selector">
				<?= DocsWidget::versionSelector($version, $name) ?>
			</div>
		</div>
	</div>

	<div class="row">

		<div id="docs-sidebar" class="docs-sidebar col-md-3 col-sm-3 col-xs-12">
			<div class="widget">
			@yield('sidebar')
			</div>
		</div><!--//blog-side-bar-->

		<div id="docs-entry" class="docs-entry section col-md-9 col-sm-9 col-xs-12">

			@yield('content')

		</div> <!-- blog-entry -->

	</div> <!-- row -->
</div> <!-- container -->


@stop