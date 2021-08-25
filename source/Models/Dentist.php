<?php

namespace Source\Models;

use Source\Core\Model;

class Dentist extends Model
{

    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct('dentistas', ['id'], ['name', 'email', 'cro', 'cro_uf']);
    }

    public function bootstrap(
        string $name,
        string $email,
        string $cro,
        string $cro_uf
    ): Dentist {
        $this->name = $name;
        $this->email = $email;
        $this->cro = $cro;
        $this->cro_uf  = $cro_uf;
        return $this;
    }

    public function saveTrue(int $idSpeciality, int $idDentist)
    {
        $dataSpeciality = new DentistSpecialty();
        $dataSpeciality->bootstrap(
            $idSpeciality,
            $idDentist
        );

        if ($dataSpeciality->save()){
            return true;
        }

        return false;

    }

}