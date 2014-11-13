@extends("_layout.rightsidebar")

@section("title")
    Новости
@stop

@section("content")

<h1>Новости</h1>

<?foreach($listNews as $news){?>
    <div class="news_box">
        <div class="date"><?= $news->displayDate() ?></div>
        <p><?= $news->displayText() ?></p>
    </div>
<?}?>

@stop