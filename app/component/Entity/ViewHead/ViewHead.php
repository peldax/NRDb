<?php

namespace App\Component;

final class ViewHead extends BaseComponent
{
    public function render($data = null, $ratingModel = null)
    {
        $this->template->data = $data;
        $this->template->ratingModel = $ratingModel;
        $this->template->pName = $this->presenter->getName();

        parent::render();
    }
}
