<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Http\Requests\UserRequest;
use App\Http\Requests\LogonRequest;
use Input;

class AuthController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Registration & Login Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration of new users, as well as the
      | authentication of existing users. By default, this controller uses
      | a simple trait to add these behaviors. Why don't you explore it?
      |
     */

use AuthenticatesAndRegistersUsers;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct() {
        //$this->middleware('guest', ['except' => 'getLogout']);
    }

    public function getLogin() {
        return view('layouts.login');
    }

    public function postLogin(LogonRequest $request) {
        $userdata = [
            'name' => $request->input('name'),
            'password' => $request->input('password'),
        ];

        if (auth()->attempt($userdata)) {
            if (auth()->user()->role === 'administrator') {
                return redirect(route('admin'));
            } else {
                return redirect(route('home'));
            }
        } else {
            return redirect(route('login'))->withInput()->with('errorMess', 'Sai tên hoặc mật khẩu!');
        }
    }

    public function getRegister() {
        return view('layouts.register');
    }

    public function postRegister(UserRequest $request) {
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->sex = $request->input('sex');
        $user->bird = $request->input('bird');
        $user->address = $request->input('address');
        $user->role = 'subscriber';

        if ($user->save()) {
            return redirect(route('auth.login'));
        } else {
            return redirect(route('auth.register'))->withInput(Input::excerpt('password'));
        }
    }

    public function index() {
        $data = [
            'title' => 'Quản lý tài khoản', 
            'users' => User::paginate(20, ['id', 'name', 'role', 'email', 'sex', 'bird', 'address'])
            ];
        return view('backend.user.index', $data);
    }

    protected function getCreate() {
        $data = ['title' => 'Tạo tài khoản'];
        return view('backend.user.create', $data);
    }

    protected function postCreate(UserRequest $request) {

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->sex = $request->input('sex');
        $user->bird = $request->input('bird');
        $user->address = $request->input('address');
        $user->role = 'subscriber';

        if ($user->save()) {
            return redirect(route('admin.user'))->with('Mess', 'Thêm mới thành công');
        } else {
            return redirect(route('admin.user.create'))->withInput()->with('errorMess', 'Có lỗi xảy ra!');
        }
    }

    protected function getEdit($id) {
        $data = ['title' => 'Chỉnh sửa Tài khoản', 'user' => User::find($id)];
        return view('backend.user.edit', $data);
    }

    protected function putEdit($id, UserRequest $request) {
        $user = User::find($id);
        $user->update([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'role' => $request->get('role'),
            'sex' => $request->get('sex'),
            'bird' => $request->get('bird'),
            'address' => $request->get('address')
        ]);

        if ($user) {
            return redirect(route('admin.user'))->with('Mess', 'Cập nhật thành công');
        } else {
            return redirect(route('admin.user.edit'))->withInput()->with('errorMess', 'Có lỗi xảy ra!');
        }
    }

    protected function getDelete($id) {
        $user = User::destroy([$id]);
        if ($user) {
            return redirect(route('admin.user'))->with('Mess', 'Đã xóa');
        } else {
            return redirect(route('admin.user'))->with('errorMess', 'Có lỗi xảy ra, vui lòng thử lại!');
        }
    }

    protected function massDelete() {

        $userids = Input::get('massdel');
        if ($userids) {
            $ids = [];
            foreach ($userids as $id => $value) {
                $ids[] = $id;
            }
            $user = User::destroy($ids);
            if ($user) {
                return redirect(route('admin.user'))->with('Mess', 'Đã xóa');
            } else {
                return redirect(route('admin.user'))->with('errorMess', 'Có lỗi xảy ra, vui lòng thử lại!');
            }
        } else {
            return redirect(route('admin.user'))->with('errorMess', 'Vui lòng chọn ít nhất một mục!');
        }
    }

}
