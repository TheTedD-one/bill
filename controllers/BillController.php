<?php

namespace app\controllers;

use app\exceptions\RepositoryNotFoundException;
use app\exceptions\ValidationException;
use app\helpers\FlashHelper;
use app\models\Position;
use app\models\PositionSearch;
use Yii;
use app\models\Bill;
use app\models\BillSearch;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BillController implements the CRUD actions for Bill model.
 */
class BillController extends BaseController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $model = new Bill();
        $searchModel = new BillSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreateBill()
    {
        try {
            $model = new Bill();
            if($model->load(Yii::$app->request->post()) && $model->validate()) {
                $model->save();
                return $this->redirect(Url::to(['view', 'bill_id' => $model->id]));
            } else {
                throw new ValidationException();
            }
        } catch(\Exception $e) {
            return false;
        }
    }

    public function actionUpdateBill($id)
    {
        try {
            $model = $this->findModel($id);
            if($model->load(Yii::$app->request->post()) && $model->validate()) {
                $model->save();
                return true;
            } else {
                throw new ValidationException();
            }
        } catch(\Exception $e) {
            return false;
        }
    }

    public function actionView($bill_id)
    {
        $billModel = $this->findModel($bill_id);

        $searchModel = new PositionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $bill_id);

        $positionModel = new Position();

        return $this->render('view', [
            'billModel' => $billModel,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'positionModel' => $positionModel,
        ]);
    }

    public function actionCreatePosition()
    {
        try {
            $model = new Position();
            if($model->load(Yii::$app->request->post()) && $model->validate()) {
                $model->save();
                return true;
            } else {
                throw new ValidationException();
            }
        } catch(\Exception $e) {
            return false;
        }
    }

    public function actionUpdatePosition($id)
    {
        try {
            $model = $this->findPositionModel($id);
            if($model->load(Yii::$app->request->post()) && $model->validate()) {
                $model->save();
                return true;
            } else {
                throw new ValidationException();
            }
        } catch(\Exception $e) {
            return false;
        }
    }

    public function actionGetBillModel($id) {
        try {
            $model = $this->findModel($id);
            return Json::encode($model);
        } catch(\Exception $e) {
            return false;
        }
    }

    public function actionGetPositionModel($id) {
        try {
            $model = $this->findPositionModel($id);
            return Json::encode($model);
        } catch(\Exception $e) {
            return false;
        }

    }

    protected function findModel($id)
    {
        $model = Bill::find()
            ->where('id=:id', [':id' => $id])
            ->andWhere('is_deleted=:is_deleted', [':is_deleted' => Bill::NOT_DELETED])
            ->one();

        if ($model !== null) {
            return $model;
        }

        throw new RepositoryNotFoundException();
    }

    protected function findPositionModel($id)
    {
        $model = Position::find()
            ->where('id=:id', [':id' => $id])
            ->andWhere('is_deleted=:is_deleted', [':is_deleted' => Position::NOT_DELETED])
            ->one();

        if ($model !== null) {
            return $model;
        }

        throw new RepositoryNotFoundException();
    }
}
