<?php
/**
 * Created by PhpStorm.
 * User: khabitoff
 * Date: 2019-03-03
 * Time: 15:12
 */

namespace app\controllers;

use app\exceptions\RepositoryNotFoundException;
use app\models\Bill;
use kartik\mpdf\Pdf;

class PdfController extends BaseController
{
    
    public function actionInvoice($id)
    {
        $model = $this->getBill($id);

        // get your HTML raw content without any layouts or scripts
        $content = $this->renderPartial('invoice', ['model' => $model]);

        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_UTF8,
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            // your html content input
            'content' => $content,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            // any css to be embedded if required
            'cssInline' => '.td-text{border-bottom: 1px solid black; padding-top: 7px} 
                            .td-footer{border-bottom: 1px solid black}',
        ]);

        // return the pdf output as per the destination setting
        return $pdf->render();
    }
    
    public function getBill($id)
    {
        $model = Bill::find()
            ->where('id=:id', [':id' => $id])
            ->andWhere('is_deleted=:is_deleted', [':is_deleted' => Bill::NOT_DELETED])
            ->with(['me', 'customer', 'sender', 'recipient', 'position'])
            ->one();

        if ($model !== null) {
            return $model;
        }

        throw new RepositoryNotFoundException();
    }
}