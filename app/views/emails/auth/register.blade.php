@extends("emails._layout.default")

@section("content")
<p>
	Для завершения регистрации подтвердите свой email:
	<a href='<?= route("auth.registration.confirmation", $confirmationString) ?>'><?= route("auth.registration.confirmation", $confirmationString) ?></a>
</p>
@stop