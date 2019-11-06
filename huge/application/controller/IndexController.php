<?php

class IndexController extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Handles what happens when user moves to URL/index/index - or - as this is the default controller, also
     * when user moves to /index or enter your application at base level
     */
    public function index()
    {
        $user = UserModel::getUserDataByUserNameOrEmail(Session::get('user_name'));
        if(isset($user->user_id)) {
            $this->View->render('index/index', array(
                'public_images' => GalleryModel::getPublicContent(),
                'private_images' => GalleryModel::getUserContent($user->user_id)
            ));
        } else {
            $this->View->render('index/index', array(
                'public_images' => GalleryModel::getPublicContent()
            ));
        }

    }

    public function delete()
    {

        


        $this->View->render('index/delete');
    }
}
