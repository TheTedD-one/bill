<?php

namespace app\controllers;

use app\helpers\FlashHelper;
use app\models\Position;
use app\models\PositionSearch;
use Yii;
use app\models\Bill;
use app\models\BillSearch;
use yii\web\Controller;
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
        $searchModel = new BillSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreateBill()
    {
        try {
            $model = new Bill();
            $model->save();

            FlashHelper::setFlash(FlashHelper::TYPE_SUCCESS);
            return $this->redirect(['view', 'bill_id' => $model->id]);
        } catch(\Exception $e) {
            FlashHelper::setFlash(FlashHelper::TYPE_ERROR);
            return $this->redirect(['index']);
        }
    }

    public function actionView($bill_id)
    {
        $billModel = $this->findModel($bill_id);

        $searchModel = new PositionSearch();;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $bill_id);

        return $this->render('view', [
            'billModel' => $billModel,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreatePosition()
    {
        $position = new Position();

        $position->bill_id = 1;
        $position->name = 'asd';
        $position->unit = 1;
        $position->quantity = 1;
        $position->price = 1;
        $position->tax_rate = 1;
        $position->tax_sum = 1;
        $position->total_price = 1;
        $position->excise_rate = 1;
        $position->excise_sum = 1;

        $position->save();
        return $this->redirect(Yii::$app->request->referrer);
    }

    protected function findModel($id)
    {
        if (($model = Bill::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    /**
     * Updates an existing Bill model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Bill model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


}
