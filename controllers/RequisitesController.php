<?php

namespace app\controllers;

use app\exceptions\RepositoryNotFoundException;
use app\exceptions\ValidationException;
use Yii;
use app\models\Requisites;
use app\models\RequisitesSearch;
use yii\helpers\Json;
use yii\web\Controller;


class RequisitesController extends Controller
{
    public function actionIndex()
    {
        $model = new Requisites();
        $searchModel = new RequisitesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionGetModel($id) {
        try {
            $model = $this->findModel($id);
            return Json::encode($model);
        } catch(\Exception $e) {
            return false;
        }
    }

    public function actionCreate()
    {
        try {
            $model = new Requisites();
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

    public function actionUpdate($id)
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

    public function actionDelete($id)
    {
        try {
            $model = $this->findModel($id);
            if($model->isMe) {
                return false;
            }

            $model->is_deleted = 1;
            $model->save();
            return true;
        } catch(\Exception $e) {
            return false;
        }
    }

    protected function findModel($id)
    {
        $model = Requisites::find()
            ->where('id=:id', [':id' => $id])
            ->andWhere('is_deleted=:is_deleted', [':is_deleted' => Requisites::NOT_DELETED])
            ->one();

        if ($model !== null) {
            return $model;
        }

        throw new RepositoryNotFoundException();
    }
}
