<?php

namespace App\Component;

abstract class ArtistList extends BaseDatagridComponent
{
    /** @var \App\Model\BaseEntityModel */
    protected $entityModel;

    /** @var string */
    protected $makerType;

    public function render()
    {
        $this->template->setFile(__DIR__ . '/AristList.latte');
        $this->template->render();
    }

    public function createComponentDataGrid()
    {
        parent::createComponentDataGrid();

        $name = lcfirst($this->presenter->getName());

        $this->grid->addColumn('name', 'Name')->enableSort();
        $this->grid->addColumn('country_id', 'Nationality')->enableSort();
        $this->grid->addColumn('entity_count', "# of {$name}s");
        $this->grid->addColumn('average_rating', 'Average rating');
        $this->grid->addColumn('top_entity', "Top {$name}");
        $this->grid->addCellsTemplate(__DIR__ . '/ArtistListCellsTemplate.latte');
        $this->grid->setTemplateParams(array(
            'entityModel' => $this->entityModel,
            'pName' => $this->presenter->getName(),
            'pname' => $name,
            'type' => $this->makerType));
        return $this->grid;
    }

    public function getDataSource($filter, $order)
    {
        $pname = lcfirst($this->presenter->getName());

        $filter[":{$pname}2{$this->makerType}.id NOT"] = null;

        foreach ($filter as $k => $v)
        {
            if ($k == 'id' || is_array($v))
            {
                $filters[$k] = $v;
            }
            else if ($k == 'name')
            {
                $filters['name LIKE ?'] = "%$v%";
                $filters['surname LIKE ?'] = "%$v%";
            }
            else
            {
                $filters[$k.' LIKE ?'] = "%$v%";
            }
        }

        $set = $this->model->findByArray($filter);

        if ($order[0])
        {
            if ($order[0] == 'name')
            {
                $orders = "surname $order[1], name $order[1]";
            }
            else if ($order[0] == 'country_id')
            {
                $orders = "country.name $order[1]";
            }
            else if ($order[0] == 'average_rating')
            {
                $orders = "TODO $order[1]";
            }
            else if ($order[0] == 'movie_count')
            {
                $orders = "TODO $order[1]";
            }
            else if ($order[0] == 'top_movie')
            {
                $orders = "TODO $order[1]";
            }
            else
            {
                $orders = implode(' ', $order);
            }
            $set->order($orders);
        }

        return $set;
    }
}