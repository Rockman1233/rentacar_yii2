<?php
/**
 * Created by PhpStorm.
 * User: sergejandrejkin
 * Date: 11.12.17
 * Time: 11:59
 */
namespace app\controllers;

use app\models\LoginForm;
use app\models\SignupForm;
use Yii;
use yii\web\Controller;

/**
 * Login action.
 *
 * @return Response|string
 */

class AuthController extends Controller
{
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return \yii\web\Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionSignup()
    {
        $model = new SignupForm();

        if(Yii::$app->request->post()){
            $model->load(Yii::$app->request->post());
            $model->signup();
        }
        return $this->render('signup',['model'=>$model]);
    }



}