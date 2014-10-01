<?php

use LaravelRU\Access\Access;
use LaravelRU\Term\Forms\TermForm;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TermController extends BaseController {

    /**
     * @var Access
     */
    private $access;
    /**
     * @var TermForm
     */
    private $termForm;

    public function __construct(Access $access, TermForm $termForm)
	{
        $this->access = $access;
        $this->termForm = $termForm;
    }

    public function create()
    {
        $termtext = new Termtext();
        return View::make("terms/edit_term", compact("termtext"));
    }

    public function edit($id)
    {
        try{
            $termtext = Termtext::with("terms")->findOrFail($id);
        }catch(Exception $e){
            throw new NotFoundHttpException;
        }
        return View::make("terms/edit_term", compact("termtext"));
    }

    public function store()
    {
        $this->access->checkEditTerms();

        $id = Input::get("id");
        $input = Input::all();

        $this->termForm->validate($input);

        if( $id ){
            $termtext = Termtext::find($id);
            Term::where("termtext_id", $id)->delete();
        }else{
            $termtext = Termtext::create([]);
        }

        $termtext->text = $input['text'];
        $termtext->save();

        foreach($input['terms'] as $inputterm){
            $term = Term::create(['name'=>trim(strtolower($inputterm))]);
            $termtext->terms()->save($term);
        }

        return "debug";
    }

    public function listTerms()
    {
        $this->access->checkEditTerms();

        $termtexts = TermText::with("terms")->orderBy("id", "ASC")->paginate(20);
        return View::make("terms/list_terms", compact("termtexts"));
    }

    public function popup($name)
    {

    }
	
	
}