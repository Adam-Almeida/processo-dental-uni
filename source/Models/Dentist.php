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
     * @param array $arraySpeciality
     * @param int $idDentist
     * @return bool
     */
    public function updateTrue(array $arraySpeciality, int $idDentist): bool
    {
        $dataSpeciality = (new DentistSpeciality())
            ->find("dentista_id = :id", "id={$idDentist}")->fetch(true);

        foreach ($dataSpeciality as $item) {
            $item->destroy();
        }

        foreach ($arraySpeciality as $item) {
            $this->saveTrue($item, $idDentist);
        }
        return true;
    }

    /**
     * @return array|null
     */
    public function speciality()
    {
        $dataSpeciality = (new DentistSpeciality())
            ->find("dentista_id = :id", "id={$this->id}")
            ->fetch(true);

        $specialitys = [];

        if ($dataSpeciality) {
            foreach ($dataSpeciality as $speciality) {
                $specialityUnique = (new Speciality())->findById($speciality->especialidade_id);
                array_push($specialitys, $specialityUnique);
            }

            return $specialitys;
        }
        return null;

    }

}