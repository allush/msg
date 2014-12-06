<?php

class SiteController extends FrontController
{
    public function actionIndex()
    {
        $model = new Dialog();
        $model->sender_id = Yii::app()->user->id;
        $model->receiver_id = $model->sender_id == 1 ? 2 : 1;

        $dialogs = Dialog::model()->findAll(array('limit' => 20, 'order' => 'createdOn DESC'));
        $dialogs = array_reverse($dialogs);

        $model->sender->lastLogin = time();
        $model->sender->save();

        if (Yii::app()->request->isAjaxRequest) {
            $data = array(
                'dialog' => $this->renderPartial('_dialogs', array('dialogs' => $dialogs), true),
                'status' => $model->receiver->textStatus(),
            );
            echo json_encode($data);
            Yii::app()->end();
        }

        $this->render('index', array(
            'model' => $model,
            'dialogs' => $dialogs,
        ));
    }

    public function actionError()
    {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    public function actionLogin()
    {
        if (!Yii::app()->user->isGuest) {
            $this->redirect(Yii::app()->homeUrl);
        }

        $this->layout = 'login';
        $model = new LoginForm();

        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            if ($model->login()) {
                $this->redirect(Yii::app()->homeUrl);
            }
        }

        $this->render('login', array('model' => $model));
    }

    public function actionLogout()
    {
        Yii::app()->user->logout(false);
        $this->redirect(Yii::app()->homeUrl);
    }

    public function actionNewMessage()
    {
        if (!Yii::app()->request->isAjaxRequest) {
            Yii::app()->end();
        }

        $save = false;

        if (isset($_POST['Dialog'])) {
            $dialog = new Dialog();
            $dialog->attributes = $_POST['Dialog'];
            $save = $dialog->save();
        }

        echo json_encode(array('save' => $save));
    }
}