<?php
class AdminController extends BaseController {

    public function __construct() {
        $this->beforeFilter('auth', array('except'=>array('login','doLogin')));
    }

    public function index()
	{
		$checkLogin = Auth::check();
        if($checkLogin) {
        	dd(123);
        } else {
            return View::make('admin.layout.login');
        }
	}
    public function login()
    {
    	// $checkLogin = Auth::admin()->check();
     //    if($checkLogin) {
	    // 	if (Auth::admin()->get()->status == ACTIVE) {
	    // 		return Redirect::action('ManagerController@edit', Auth::admin()->get()->id);
	    // 	}else{
	    // 		return View::make('admin.layout.login')->with(compact('message','chưa kich hoat'));
	    // 	}
     //    } else {
        return View::make('admin.layout.login');
        // }
    }

    public function doLogin()
    {
        $rules = array(
            'email'   => 'required|email',
            'password'   => 'required',
        );
        $input = Input::except('_token');
        // dd($input);
        $validator = Validator::make($input, $rules);
        //check validation: email valide, passs is required
        if ($validator->fails()) {
            return Redirect::route('admin.login')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            //check email, password: true->dashboard, false->login form
            dd(444);
        }
    }
    public function logout()
    {
        Auth::logout();
        return Redirect::route('admin.login');
    }

}

