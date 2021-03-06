<?php

namespace App\Presenter;

abstract class BaseViewPresenter extends \Nepttune\Presenter\BaseAuthPresenter
{
    /** @var  \Nepttune\Model\BaseModel */
    protected $model;

    public function actionView(int $id)
    {
        if (!$id) { $this->notFound(); }

        $data = $this->model->findRow($id)->fetch();

        if (!$data) { $this->notFound(); }

        $this->template->data = $data;
    }

    protected function notFound()
    {
        $this->flashMessage('Requested item was not found.', 'failure');
        $this->redirect(':default');
    }
}
