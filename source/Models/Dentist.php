<?php

namespace Source\Models;

use Source\Core\Model;

/**
 * Class Dentist
 * @package Source\Models
 * @author Adam Almeida <adam.designjuridico@gmail.com>
 */
class Dentist extends Model
{

    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct('dentistas', ['id'], ['name', 'email', 'cro', 'cro_uf']);
    }

    /**
     * @param string $name
     * @param string $email
     * @param string $cro
     * @param string $cro_uf
     * @return $this
     */
    public function bootstrap(
        string $name,
        string $email,
        string $cro,
        string $cro_uf
    ): Dentist {
        $this->name = $name;
        $this->email = $email;
        $this->cro = $cro;
        $this->cro_uf = $cro_uf;
        return $this;
    }

    /**
     * @param int $idSpeciality
     * @param int $idDentist
     * @return bool
     */
    public function saveTrue(int $idSpeciality, int $idDentist): bool
    {
        $dataSpeciality = new DentistSpeciality();
        $dataSpeciality->bootstrap(
            $idSpeciality,
            $idDentist
        );

        if ($dataSpeciality->save()) {
            return true;
        }
        return false;
    }

    /**
     * @param int $idSpeciality
     * @param int $idDentist
     * @return bool
     */
    public function updateTrue(int $idSpeciality, int $idDentist): bool
    {
        $dataSpeciality = (new DentistSpeciality())->find("dentista_id = :id", "id={$idDentist}")->fetch();

        $dataSpeciality->especialidade_id = $idSpeciality;
        if ($dataSpeciality->save()) {
            return true;
        }
        return false;
    }

    /**
     * @return mixed|Model|null
     */
    public function speciality()
    {
        if (!empty($this->id)) {
            $speciality = (new DentistSpeciality())->find("dentista_id = :id", "id={$this->id}",
                "especialidade_id")->fetch();

            if ($speciality) {
                return (new Speciality())->findById((int)$speciality->especialidade_id);
            }
            return null;
        }
        return null;
    }

}