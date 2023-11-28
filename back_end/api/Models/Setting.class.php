<?php

class Setting extends Db
{
    public function getAll()
    {
        $sql = "SELECT * from `setting`";
        $data = $this->select($sql);
        if (count($data) > 0) {
            return $data[0];
        } else {
            return null;
        }
    }

    public function updateClientRespons($client_respons)
    {
        $sql = "UPDATE `setting` SET `client_respons`= ?";
        return $this->update($sql, array($client_respons));
    }
    public function updateBanner($banner)
    {
        $sql = "UPDATE `setting` SET `banner`= ?";
        return $this->update($sql, array($banner));
    }
    public function updateAbout($about)
    {
        $sql = "UPDATE `setting` SET `about`= ?";
        return $this->update($sql, array($about));
    }
    public function updateService($service)
    {
        $sql = "UPDATE `setting` SET `service`= ?";
        return $this->update($sql, array($service));
    }
    public function updatePolicy($policy)
    {
        $sql = "UPDATE `setting` SET `policy`= ?";
        return $this->update($sql, array($policy));
    }
    public function updateExperience($experience)
    {
        $sql = "UPDATE `setting` SET `experience`= ?";
        return $this->update($sql, array($experience));
    }
    public function updateMating($mating)
    {
        $sql = "UPDATE `setting` SET `mating`= ?";
        return $this->update($sql, array($mating));
    }
}
?>