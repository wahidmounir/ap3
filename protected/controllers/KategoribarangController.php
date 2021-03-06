<?php

class KategoribarangController extends Controller {

   public $layout = '//layouts/box_kecil';

   /**
    * @return array action filters
    */
   public function filters() {
      return array(
          'accessControl', // perform access control for CRUD operations
          'postOnly + delete', // we only allow deletion via POST request
      );
   }

   /**
    * Specifies the access control rules.
    * This method is used by the 'accessControl' filter.
    * @return array access control rules
    */
   public function accessRules() {
      return array(
          array('deny', // deny guest
              'users' => array('guest'),
          ),
      );
   }

   /**
    * Displays a particular model.
    * @param integer $id the ID of the model to be displayed
    */
   public function actionView($id) {
      $this->render('view', array(
          'model' => $this->loadModel($id),
      ));
   }

   /**
    * Creates a new model.
    * If creation is successful, the browser will be redirected to the 'view' page.
    */
   public function actionTambah() {
      $model = new KategoriBarang;

      // Uncomment the following line if AJAX validation is needed
      // $this->performAjaxValidation($model);

      if (isset($_POST['KategoriBarang'])) {
         $model->attributes = $_POST['KategoriBarang'];
         if ($model->save())
            $this->redirect(array('view', 'id' => $model->id));
      }

      $this->render('tambah', array(
          'model' => $model,
      ));
   }

   /**
    * Updates a particular model.
    * @param integer $id the ID of the model to be updated
    */
   public function actionUbah($id) {
      $model = $this->loadModel($id);

      // Uncomment the following line if AJAX validation is needed
      // $this->performAjaxValidation($model);

      if (isset($_POST['KategoriBarang'])) {
         $model->attributes = $_POST['KategoriBarang'];
         if ($model->save())
            $this->redirect(array('view', 'id' => $id));
      }

      $this->render('ubah', array(
          'model' => $model,
      ));
   }

   /**
    * Deletes a particular model.
    * If deletion is successful, the browser will be redirected to the 'admin' page.
    * @param integer $id the ID of the model to be deleted
    */
   public function actionHapus($id) {
      $this->loadModel($id)->delete();

      // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
      if (!isset($_GET['ajax']))
         $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
   }

   /**
    * Manages all models.
    */
   public function actionIndex() {
      $model = new KategoriBarang('search');
      $model->unsetAttributes();  // clear any default values
      if (isset($_GET['KategoriBarang']))
         $model->attributes = $_GET['KategoriBarang'];

      $this->render('index', array(
          'model' => $model,
      ));
   }

   /**
    * Returns the data model based on the primary key given in the GET variable.
    * If the data model is not found, an HTTP exception will be raised.
    * @param integer $id the ID of the model to be loaded
    * @return KategoriBarang the loaded model
    * @throws CHttpException
    */
   public function loadModel($id) {
      $model = KategoriBarang::model()->findByPk($id);
      if ($model === null)
         throw new CHttpException(404, 'The requested page does not exist.');
      return $model;
   }

   /**
    * Performs the AJAX validation.
    * @param KategoriBarang $model the model to be validated
    */
   protected function performAjaxValidation($model) {
      if (isset($_POST['ajax']) && $_POST['ajax'] === 'kategori-barang-form') {
         echo CActiveForm::validate($model);
         Yii::app()->end();
      }
   }

   public function renderLinkToView($data) {
      $return = '';
      if (isset($data->nama)) {
         $return = '<a href="'.
                 $this->createUrl('view', array('id' => $data->id)).'">'.
                 $data->nama.'</a>';
      }
      return $return;
   }

}
