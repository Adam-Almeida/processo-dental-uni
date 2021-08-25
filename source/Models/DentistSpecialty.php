<?php


namespace Source\Models;


use Source\Core\Model;

class DentistSpecialty extends Model
{
    public function __construct()
    {
        parent::__construct('dentistas_especialidades',['id'], ['especialidade_id', 'dentista_id']);
    }

    public function bootstrap(
        int $especialidade_id,
        int $dentista_id
    )
    {
        $this->especialidade_id = $especialidade_id;
        $this->dentista_id = $dentista_id;

        return $this;
    }

    public function dentist()
    {
        if ($this->dentista_id) {
            return (new Dentist())->findById($this->dentista_id);
        }
        return null;
    }

    public function speciality()
    {
        if ($this->especialidade_id) {
            return (new Specialty())->findById($this->especialidade_id);
        }
        return null;
    }


}
