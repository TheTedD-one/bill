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
use Yii;

class PdfController extends BaseController
{
    public function actionInvoice($id)
    {
        $model = $this->getBill($id);
        $total = $this->getTotal($model->position);

        // get your HTML raw content without any layouts or scripts
        $content = $this->renderPartial('invoice', [
            'model' => $model,
            'total' => $total
        ]);

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
                            .td-footer{border-bottom: 1px solid black}
                            .table-font-size{font-size: 11px}',
        ]);

        // return the pdf output as per the destination setting
        return $pdf->render('web/asd.pdf');
    }

    public function actionPayment($id)
    {
        $model = $this->getBill($id);
        $total = $this->getTotal($model->position);

        // get your HTML raw content without any layouts or scripts
        $content = $this->renderPartial('payment', [
            'model' => $model,
            'total' => $total
        ]);

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
                            .td-footer{border-bottom: 1px solid black}
                            .table-font-size{font-size: 11px}
                            .table-font-size13{font-size: 13px}',
        ]);

        return $pdf->render();
    }

    public function actionPaymentSend($id, $email)
    {
        try {
            $model = $this->getBill($id);
            $total = $this->getTotal($model->position);

            // get your HTML raw content without any layouts or scripts
            $content = $this->renderPartial('payment', [
                'model' => $model,
                'total' => $total
            ]);

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
                            .td-footer{border-bottom: 1px solid black}
                            .table-font-size{font-size: 11px}
                            .table-font-size13{font-size: 13px}',
            ]);

            $filename = 'payment-' . rand(100000000, 999999999);
            $pdf->output($content, 'files/' . $filename . '.pdf','F');
            // return the pdf output as per the destination setting

            Yii::$app->mailer->compose()
                ->setFrom(Yii::$app->params['adminEmail'])
                ->setTo($email)
                ->setSubject('Счет на оплату ИП Назыров М.Я')
                ->setTextBody('Счет на оплату ИП Назыров М.Я')
                ->attach('files/' . $filename . '.pdf')
                ->send();

            unlink('files/' . $filename . '.pdf');

            return true;
        } catch(\Exception $e) {
            return false;
        }
    }

    public function getTotal($positions)
    {
        $total = [];
        $total['total_price_without_tax'] = 0;
        $total['total_price'] = 0;
        $total['tax_sum'] = 0;

        foreach($positions as $position) {
            $total['total_price_without_tax'] += $position->total_price_without_tax;
            $total['total_price'] += $position->total_price;
            $total['tax_sum'] += $position->tax_sum;
        }

        return $total;
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