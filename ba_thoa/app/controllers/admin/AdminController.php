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
            $userData = array(
                'email' => $input['email'],
                'password' => $input['password'],
            );
            // có thể viết hàm chung để lấy ra bọn này
            //$userData = User::getInput(['email', 'password']);

            if (Auth::attempt($userData)) {
                return View::make('admin.layout.dashboard');
            } else {
                //Đăng nhập không thành công-->ko hard code
                //define ra 1 chỗ: có 3 cách:
                //cách 1: sử dụng define trong constant.php
                //cách 2: sử dụng config: tạo mới 1 file trong folder config-> return ra array['message']
                //cách 3 : sử dụng translate, vào lang/en tạo 1 file rồi tương tự cách 2
                //khác nhau: cách 1: biến define là biến global được khai báo ngay khi khỏi tạo app
                //cách 2: biến static được dùng khi nào cần thì gọi đến
                //cách 3: dùng trường hợp đa ngôn ngữ
                //nếu sử dụng nheieuf thì dùng cách 1, còn ít thì dùng cách 2 và đa ngôn ngữ dùng cách 3
                return Redirect::route('admin.login')
                    ->withErrors(MSG)
                    // ->withErrors(Config::get('message.msg'))
                    // ->withErrors(trans('message.msg'))
                    ->withInput(Input::except('password'));
            }
        }
    }

    public function logout()
    {
        Auth::logout();
        return Redirect::route('admin.login');
    }
}

