<?php

namespace frontend\controllers;

use http\Exception\BadMethodCallException;
use Yii;
use app\models\Siswa;
use app\models\search\SiswaSearch;
use yii\db\Expression;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;

/**
 * SiswaController implements the CRUD actions for Siswa model.
 */
class SiswaController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view', 'create', 'update', 'delete'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'create', 'update', 'delete'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Siswa models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SiswaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Siswa model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Siswa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Siswa();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /*
     * Import siswa form csv
     */
    public function actionImport()
    {
        $model = new Siswa();

        if ($model->load(Yii::$app->request->post())) {
            $model->file = UploadedFile::getInstance($model, 'file');
            $uploadExsist = 0;
            if($model->file) {
                $filePath = 'uploads/csv';
                $model->file_import = $filePath . rand(1, 100) . '-' . str_replace('', '-', $model->file->name);

                $bulkInsertArray = array();
                $random_date = Yii::$app->formatter->asDatetime(date("dmyyhis"), "php:dmYHis");
//                $random = $random_date . rand(10, 100);
//                $userId = \Yii::$app->user->identity->getId();
//                $now = new Expression('NOW()');
                $uploadExsist = 1;
            }
            if($uploadExsist){
                $model->file->saveAs($model->file_import);
                $handle = fopen($model->file_import, 'r');
                if($handle){

                    // Jika bisa di save dulu
//                    if($model->save()){
//                        while (($line = fgetcsv($handle, 1000, ",")) != FALSE){
//                            $bulkInsertArray[] = [
//                                'nama'              => $line[0],
//                                'jenis_kelamin'     => $line[1],
//                                'agama'             => $line[2],
//                            ];
//                        }
//                    }

                    /*
                     * Cara memakai fgetcsv
                     * fgetcsv($handle, panjang_semua_karakter_dari_semua_kolom_dalam_satu_baris, delimiter)
                     */
                    while (($line = fgetcsv($handle, 2000, ",")) != FALSE){
                        $bulkInsertArray[] = [
                            'nama'              => $line[0],
                            'jenis_kelamin'     => $line[1],
                            'agama'             => $line[2],
                        ];
                    }

                    fclose($handle);
                    $tableName = 'siswa';
                    $columnNameArray = ['nama', 'jenis_kelamin', 'agama'];
                    Yii::$app->db->createCommand()->batchInsert($tableName, $columnNameArray, $bulkInsertArray)->execute();
                }
            }
            return $this->actionIndex();
        }else{
            return $this->render('import', [
                'model' => $model,
            ]);
        }
    }



    /**
     * Updates an existing Siswa model.
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
     * Deletes an existing Siswa model.
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

    /**
     * Finds the Siswa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Siswa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Siswa::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
