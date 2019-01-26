<?php

namespace frontend\controllers;

use PhpOffice\PhpSpreadsheet\IOFactory;
use Yii;
use app\models\Nilai;
use app\models\search\NilaiSearch;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\filters\AccessControl;

/**
 * NilaiController implements the CRUD actions for Nilai model.
 */
class NilaiController extends Controller
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
                'only' => ['index', 'view', 'create', 'update', 'delete', 'import'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'import'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Nilai models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NilaiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Nilai model.
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
     * Creates a new Nilai model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Nilai();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /*
     * Import nilai from Excel
     */

    public function actionImport()
    {
        if(Yii::$app->user->can('import-nilai')){
            $model = new Nilai();

            if ($model->load(Yii::$app->request->post())) {
                $model->file = UploadedFile::getInstance($model, 'file');
                if($model->file){
                    $filePath = 'uploads/excel';
                    $fileImport = $filePath . rand(1, 100) . '-' . str_replace('', '-', $model->file->name);
                    $bulkInsertArray = array();
                    $uploadExists = 1;
                }
                if($uploadExists){
                    $model->file->saveAs($fileImport);

                    $spreadsheet = IOFactory::load($fileImport);
                    $sheetData = $spreadsheet->getActiveSheet()->toArray();
                    $i = 0;
                    foreach ($sheetData as $data){
                        $bulkInsertArray[] = [
                            'nama'      => $sheetData[$i][0],
                            'nilai'     => $sheetData[$i][1],
                        ];
                        $i++;
                    }

                    $tableName = 'nilai';
                    $columnNameArray = ['nama', 'nilai'];
                    Yii::$app->db->createCommand()->batchInsert($tableName, $columnNameArray, $bulkInsertArray)->execute();
                }
                Yii::$app->session->setFlash('success', 'Upload Excel Success');
                return $this->actionIndex();
            }else{
                return $this->render('import', [
                    'model' => $model,
                ]);
            }
        }else{
            return $this->redirect(['site/forbidden-error']);
        }
    }

    /**
     * Updates an existing Nilai model.
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
     * Deletes an existing Nilai model.
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
     * Finds the Nilai model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Nilai the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Nilai::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
