<?php namespace LaravelRU\DocsSleepingowlAdmin\Models;

use Laracasts\Presenter\PresentableTrait;
use LaravelRU\Comment\CommentableTrait;
use Illuminate\Database\Eloquent\Model;
use LaravelRU\Core\Models\Version;
use Markdown;

class DocumentationSleepingowlAdmin extends Model {

	protected   $table =        'documentation_sleepingowl_admin';

	//protected $presenter = 'LaravelRU\DocsSleepingowlAdmin\Presenters\DocsSleepingowlAdminPresenter';
	
	// ������� �� ���������� ����, ������ ��� ��������� ���� �� ��������
	public function displayText()
	{
		$text = $this->text;
		// ������ ���������� ������
		$text = preg_replace('/\]\(([^h].*?)\)/im', "](".route("documentation.sleepingowl_admin")."/$1".")", $text);
		// ������ markdown
		$text = Markdown::render($text);
		return $text;
	}
}