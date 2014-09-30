<?php

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TermController extends BaseController {

	public function __construct()
	{
		
	}

    public function create()
    {
        $termtext = new Termtext();
        return View::make("terms/edit_term", compact("termtext"));
    }

    public function edit($id)
    {
        try{
            $termtext = Termtext::findOrFail($id);
        }catch(Exception $e){
            throw new NotFoundHttpException;
        }
        return View::make("terms/edit_term", compact("termtext"));
    }

    public function store()
    {

    }

    public function listTerms()
    {
        $termtexts = TermText::with("names")->orderBy("id", "ASC")->paginate(20);
        return View::make("terms/list_terms", compact("termtexts"));
    }

    public function popup($name)
    {

    }
	
	
}