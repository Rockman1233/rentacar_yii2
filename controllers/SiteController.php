<?php

namespace app\controllers;

use app\models\Car;
use app\models\CarSearch;
use app\models\Contract;
use DateTime;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\ContactForm;
use app\models\OrderForm;


class SiteController extends Controller
{
    public $model;
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex($pageSize = 4)
    {
        $query = Car::find()->where(['status' => 1]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize'=> $pageSize]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('index', [
            'models' => $models,
            'pages' => $pages,
        ]);
    }


    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }


    public function actionView($id)
    {
        $car= Car::findOne($id);
        $model = new OrderForm();

        return $this->render('single',[ 'model' => $model,
                'car' => $car
            ]
        );
    }


    public function makeOrder(
        OrderForm $orderForm
    )
    {
        $Contract = new Contract();
        $Contract->first_date = $orderForm->first_date;
        $Contract->second_date = $orderForm->second_date;
        $Contract->car_id = $orderForm->car_id;
        $Contract->driver_id = Yii::$app->user->getId();
        $Contract->status = 0;
        return ($this->checkDates($Contract->first_date,$Contract->second_date,$Contract->car_id) ? $Contract->save() : false);
    }

    public function actionContract() {
        $model = new OrderForm();

        if($model->load(Yii::$app->request->post()) && $model->validate()){
            ($this->makeOrder($model))? Yii::$app->session->setFlash('success','Заявка отправлена'): null ;

        }
        return $this->redirect(['/']);
    }

    public function checkDates($start_order, $finish_order, $id){
        $errors = 0;
        $model = new Car();
        $currentCarContracts = $model->getContractsByID($id);
        $start_order = new DateTime($start_order);
        $finish_order = new DateTime($finish_order);
        if($start_order < $finish_order) {
            foreach ($currentCarContracts as $object) {
                $start_busy = new DateTime($object->first_date);
                $finish_busy = new DateTime($object->second_date);
                if ($start_order >= $start_busy && $finish_busy >= $start_order) {
                    Yii::$app->session->setFlash('error', 'Выберите другую дату.Машина занята с ' . $start_busy->format('Y-m-d') . ' по ' . $finish_busy->format('Y-m-d'));
                    //$_SESSION['message']=('Выберите другую дату.Машина занята с ' . $date3->format('Y-m-d') . ' по ' . $date4->format('Y-m-d'));
                    $errors = +1;
                } //crossing second date
                elseif ($finish_order >= $start_busy && $start_order <= $start_busy) {
                    Yii::$app->session->setFlash('error', 'Выберите другую дату.Машина занята с ' . $start_busy->format('Y-m-d') . ' по ' . $finish_busy->format('Y-m-d'));
                    //$_SESSION['message']=('Выберите другую дату. Машина занята с ' . $date3->format('Y-m-d') . ' по ' . $date4->format('Y-m-d'));
                    $errors = +1;
                }
                continue;
            }
        }
        else{
            Yii::$app->session->setFlash('error', 'Дата окончания аренды не может быть меньше даты начала аренды');
            $errors =+ 1;
        }
        return ($errors)?false:true;



    }


}
