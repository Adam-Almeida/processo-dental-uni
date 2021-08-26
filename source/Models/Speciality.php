<?php


namespace Source\Models;


use Source\Core\Model;

class Speciality extends Model
{
    public function __construct()
    {
        parent::__construct('especialidades', ['id'], ['name']);
    }

    public function bootstrap(string $name): Speciality
    {
        $this->name = $name;
        return $this;
    }

}
