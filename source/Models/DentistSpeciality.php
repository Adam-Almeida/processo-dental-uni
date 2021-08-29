<?php


namespace Source\Models;


use Source\Core\Model;

/**
 * Class DentistSpeciality
 * @package Source\Models
 * @author Adam Almeida <adam.designjuridico@gmail.com>
 */
class DentistSpeciality extends Model
{
    /**
     * DentistSpeciality constructor.
     */
    public function __construct()
    {
        parent::__construct('dentistas_especialidades', ['id'], ['especialidade_id', 'dentista_id']);
    }

    /**
     * @param int $especialidade_id
     * @param int $dentista_id
     * @return $this
     */
    public function bootstrap(
        int $especialidade_id,
        int $dentista_id
    ) {
        $this->especialidade_id = $especialidade_id;
        $this->dentista_id = $dentista_id;

        return $this;
    }

    /**
     * @return mixed|Model|null
     */
    public function dentist()
    {
        if ($this->dentista_id) {
            return (new Dentist())->findById($this->dentista_id);
        }
        return null;
    }

    /**
     * @return array|null
     */
    public function speciality()
    {
        $dataSpeciality = (new DentistSpeciality())
            ->find("dentista_id = :id", "id={$this->dentista_id}")
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
