<?php


//users controller

class Users extends Controller
{
    function index()
    {
       //code
        if(!Auth::logged_in())
        {
            $this->redirect('login');
            
        }



        $user = new User();
        $school_id= Auth::getSchool_id();
        $data= $user->findAll();
        ///query slelect * from users where school_:id = :scghoool_id, ...

        $crumbs[] = ['Dashboard', '/'];
        $crumbs[] = ['staff', 'users'];

        $this->view('users',[
            'rows'=>$data,
            'crumbs'=>$crumbs,

        ]);
    }
}
