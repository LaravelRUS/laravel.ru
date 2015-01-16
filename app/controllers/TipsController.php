<?php

use LaravelRU\Access\Access;
use LaravelRU\Tips\Forms\CreateTipForm;
use LaravelRU\Tips\Forms\UpdateTipForm;
use LaravelRU\Tips\Models\Tip;

class TipsController extends BaseController {

	/**
	 * @var Access
	 */
	private $access;

	/**
	 * @var CreateTipForm
	 */
	private $createTipForm;

	/**
	 * @var UpdateTipForm
	 */
	private $updateTipForm;

	public function __construct(Access $access, CreateTipForm $createTipForm, UpdateTipForm $updateTipForm)
	{
		$this->access = $access;
		$this->createTipForm = $createTipForm;
		$this->updateTipForm = $updateTipForm;
	}

	public function create()
	{
		$tip = new Tip();
		$tip->is_draft = 1;

		$author = Auth::user();

		return View::make('tips/edit_tip', compact('tip', 'author'));
	}

	public function edit($id)
	{
		if ( ! $tip = Tip::find($id)) abort();

		$author = $tip->user;

		return View::make('tips/edit_tip', compact('tip', 'author'));
	}

	public function store()
	{
		$tip_id = Input::get('id');

		if ($tip_id)
		{
			$this->updateTipForm->validate(Input::all());

			$tip = Tip::find($tip_id);

			$this->access->checkEditTip($tip);
		}
		else
		{
			$this->createTipForm->validate(Input::all());

			$tip = Tip::create([]);
			$tip->author_id = Auth::id();
			$tip->is_draft = 0;
			// TODO добавить функцию или пересмотреть поведение
			$tip->is_approved = (int) allowApproveTip();
		}

		$tip->text = Input::get('text');
		$tip->save();

		if ($tip->is_approved)
		{
			return Redirect::route('tips.edit', $tip->id)
				->with('success', 'Новость сохранена и опубликована.');
		}

		// TODO разослать уведомление модераторам на аппрув новости
		return Redirect::route('tips.edit', $tip->id)
			->with('success', 'Новость сохранена и будет опубликована после одобрения модераторами.');
	}

}
