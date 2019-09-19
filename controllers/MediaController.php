<?php
/**
 * Created by PhpStorm.
 * User: ClassAdmin
 * Date: 16.09.2019
 * Time: 12:30
 */

namespace app\controllers;


use yii\helpers\VarDumper;
use yii\web\Controller;

class MediaController extends Controller
{

    public function actionUpload(){
        $model = new Modelup();

        $imageFile = UploadedFile::getInstance($model, 'image');

        if ($imageFile->saveAs($filePath)) {
            $path = '/img/' . Yii::$app->session->id . DIRECTORY_SEPARATOR . $fileName;
            return Json::encode([
                'files' => [
                    [
                        'name' => $fileName,
                        'size' => $imageFile->size,
                        'url' => $path,
                        'thumbnailUrl' => $path,
                        'deleteUrl' => 'image-delete?name=' . $fileName,
                        'deleteType' => 'POST',
                    ],
                ],
            ]);
        }
    }
}