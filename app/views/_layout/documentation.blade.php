@extends('_layout.main')

@section("submenu")

<script type="application/javascript">
	function offsetPosition(e) { // отступ от верхнего края экрана до элемента
		var offsetTop = 0;
		do {offsetTop  += e.offsetTop;} while (e = e.offsetParent);
		return offsetTop;
	}
	$(document).ready(function() {
		var aside = document.querySelector('#submenu_panel');
		var OP = offsetPosition(aside);
		window.onscroll = function () {
			aside.className = (OP < window.pageYOffset ? 'submenu_panel_sticky' : ''); // если значение прокрутки больше отступа от верхнего края экрана до элемента, то элементу присваивается класс sticky
		}
	});
</script>

<div id="submenu_panel">
<div class="navbar submenu-nav" id="version_selector">

	<div class="container">
		<div class="row">

			<?= DocsWidget::versionSelector($version, $name) ?>

			<ul class="nav navbar-nav navbar-right">
			<?if(allowEditTerms()){?><li><a href="<?= route("terms") ?>">Термины</a></li><?}?>
				<li><a href="<?= route("docs.updates") ?>">Прогресс перевода</a></li>
			</ul>

		</div>
	</div>
	</div>
</div>
@stop

@section('container')

<div class="docs container">

	<div class="row">

		<div id="docs-sidebar" class="docs-sidebar col-md-3 col-sm-3 col-xs-12">
			<div class="box-invisible">
			@yield('sidebar')
			</div>
		</div><!--//docs-side-bar-->

		<div id="docs-entry" class="docs-entry section col-md-9 col-sm-9 col-xs-12">
			<div class="box">
				@yield('content')
			</div>
		</div> <!-- docs-entry -->

	</div> <!-- row -->
</div> <!-- container -->


@stop