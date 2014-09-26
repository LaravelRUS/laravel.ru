<?php 

class TermController extends BaseController {

	public function __construct()
	{
		
	}

    public function create()
    {

    }

    public function edit($id)
    {

    }

    public function listTerms()
    {
        $terms = TermText::with("names")->orderBy("id", "ASC")->paginate(20);
        return View::make("terms/list_terms", compact("terms"));
    }

    public function popup($name)
    {

    }
	
	
}