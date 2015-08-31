<?php

class BackendAdminController extends BaseController
{
    public function showDashboard()
    {
        if (!Sentry::check()) {
            return Redirect::to('/admin/login');
        }

        return View::make(
            'backend.dashboard',
            compact('reviews', 'feedbacks', 'logs', 'statuses', 'ordersInfo', 'ordersStats')
        );
    } // end showDashboard





    public function showLogin()
    {
        if (Sentry::check()) {
            return Redirect::to('/admin');
        }
        
        return View::make('admin::vis-login');
    } // end showLogin
 
    public function postLogin()
    {
        $email    = Input::get('email');
        $password = Input::get('password');
        
        if (User::authenticate(['email' => $email, 'password' => $password], Input::has('rememberme'))) {
            return Redirect::intended('/admin');
        }
 
        return Redirect::to('/login')
            ->withInput()
            ->withErrors('Такой связки email и пароля нет.');
    } // end 
 
    public function getLogin()
    {
        return Redirect::to('/login');
    } // end 
 
    public function getLogout()
    {
        User::logout();
 
        return Redirect::to('/');
    } // end 

    public function getSpecialOfferItemForm()
    {
        $productsAll = DB::table('products')->select('id', 'name')->get();

        $view = View::make('backend.shop.partials.offer_item_simple', compact('productsAll'))->render();

        $data = array(
            'status' => true,
            'html'   => $view
        );

        return Response::json($data);
    } // end getSpecialOfferItemForm


}