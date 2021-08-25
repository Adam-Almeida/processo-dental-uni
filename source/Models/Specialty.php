<?php


namespace Source\Models;


use Source\Core\Model;

class Specialty extends Model
{
    public function __construct()
    {
        parent::__construct('especialidades', ['id'], ['name']);
    }

    public function bootstrap(string $name): Specialty
    {
        $this->name = $name;
        return $this;
    }



}
