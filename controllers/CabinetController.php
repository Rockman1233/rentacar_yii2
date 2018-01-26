<?php

namespace app\controllers;

use app\models\Car;
use app\models\CarSearch;
use app\models\Contract;
use app\models\ContractSearch;
use app\models\ImageUpload;
use app\models\User;
use app\models\UserSearch;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\ContactForm;
use app\models\OrderForm;
use yii\web\UploadedFile;


class CabinetController extends Controller
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

    public function actionIndex()
    {
        $searchModel = new CarSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere('owner ='.Yii::$app->user->getId());

        return $this->render('cabinet', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionContracts()
    {
        $query = Contract::find();
        $searchModel = new ContractSearch();
        $query->leftJoin('car', 'car.id=contract.car_id')
            ->andWhere('owner ='.Yii::$app->user->getId());
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if(Yii::$app->request->post())
        {
            $contractChangeStatus = Contract::findOne(Yii::$app->request->post('id'));
            $contractChangeStatus->status = Yii::$app->request->post('new_stat');
            $contractChangeStatus->save();

        }

        return $this->render('contracts', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionPersonal()
    {
        $searchModel = new UserSearch();
        $query = User::find();
        $query->where('id='.Yii::$app->user->getId());
        $dataProvider = new ActiveDataProvider([
            'query' => $searchModel,
        ]);

        return $this->render('personal', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCarContracts()
    {
        $query = Contract::find();
        $searchModel = new ContractSearch();
        $query->where('car_id='.Yii::$app->request->get('id'));
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('contracts', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionYourContracts()
    {
        $query = Contract::find();
        $searchModel = new ContractSearch();
        $query->where('driver_id='.Yii::$app->user->getId());
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('orders', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionCreate()
    {
        $model = new Car();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['cabinet']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionView($id)
    {
        $car= Car::findOne($id);

        return $this->render('view',[ 'model' => $car
            ]
        );
    }

    public function actionChangestatus($id)
    {
        $currentContract = Contract::findOne($id);
        $currentContract->setStatus(Yii::$app->request->post(['new_stat']));
        $currentContract->save();
        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Car::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionSetImage($id)
    {
        $model = new ImageUpload;
        if(Yii::$app->request->isPost)
        {
            //находим авто по ИД
            $car = $this->findModel($id);
            //вытягиваем картинку из ПОСТ
            $file = UploadedFile::getInstance($model, 'image');
            //берем у рассматриваемого авто существующую картинку
            $currentImage = $car->foto;
            //передаем на сохранение название текущего файла и загруженного файла (чтоб если что перезаписать)
            $img_name = $model->UploadFile($file, $currentImage);
            //если фото успешно записаось в модель делаем редирект
            if($car->saveImage($img_name))
            {
                return $this->redirect(['view', 'id' => $car->id]);
            }
        }
        //если фоточка не была загружена возвращаем к полю загрузки
        return $this->render('image',['model'=>$model]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }




}
