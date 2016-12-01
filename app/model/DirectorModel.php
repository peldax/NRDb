<?php

namespace App\Model;

class PersonModel extends BaseModel
{
    protected $tableName = 'person';

    public function fetchSelectBox()
    {
        $rows = $this->findAll()->order('surname ASC');

        $array = array();
        foreach ($rows as $row)
        {
            $array[$row->id] = $row->name.' '.$row->surname;
        }
        return $array;
    }
}