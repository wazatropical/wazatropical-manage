<?php
namespace WAZA\ComptabiliteBundle\Entity;

class DataChart{    
    private $labelsjour;
    private $labelsmois;
    private $labelsannee;
    private $datasjour; 
    private $datasmois;
    private $datasannee;
    
    public function getLabelsmois(){
        return $this->labelsmois;
    }
    
    public function getDatasmois(){
        return $this->datasmois;
    }
    
    public function getDatasjour(){
        return $this->datasjour;
    }

    public function getLabelsannee(){
        return $this->labelsannee;
    }
    
    public function getLabelsjour(){
        return $this->labelsjour;
    }
    
    public function getDatasannee(){
        return $this->datasannee;
    }
    
    public function setLabelsmois($nLabelsmois){
        $this->labelsmois = $nLabelsmois;
    }  
    
    public function setLabelsjour($nLabelsjour){
        $this->labelsjour = $nLabelsjour;
    }
    
    public function setDatasmois($nDatasmois){
        $this->datasmois = $nDatasmois;
    }
     
    public function setDatasjour($nDatasjour){
        $this->datasjour = $nDatasjour;
    }
    
    public function setLabelsannee($nLabelsannee){
        $this->labelsannee = $nLabelsannee;
    }
    
    public function setDatasannee($nDatasannee){
        $this->datasannee = $nDatasannee;
    }
}
