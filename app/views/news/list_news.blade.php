@extends("layouts.rightsidebar")

@section("title")
    Новости
@stop

@section("content")

<h1>Новости</h1>

<?foreach($listNews as $news){?>
    <div class="news_box">
        <div class="date"><?= $news->created_at ?></div>
        <p><?= $news->text ?></p>
    </div>
<?}?>

@stop