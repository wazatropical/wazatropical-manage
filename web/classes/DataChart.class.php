<?php

class DataChart{    
    private $labelsmois;
    private $datasmois;    
    private $labelsannee;
    private $datasannee;
    
    public function getLabelsmois(){
        return $this->labelsmois;
    }
    
    public function getDatasmois(){
        return $this->datasmois;
    }
    
    public function getLabelsannee(){
        return $this->labelsannee;
    }
    
    public function getDatasannee(){
        return $this->datasmois;
    }
    
    public function setLabelsmois($nLabelsmois){
        $this->labelsmois = $nLabelsmois;
    }
    
    public function setDatasmois($nDatasmois){
        $this->datasmois = $nDatasmois;
    }
    
    public function setLabelsannee($nLabelsannee){
        $this->labelsannee = $nLabelsannee;
    }
    
    public function setDatasannee($nDatasannee){
        $this->datasannee = $nDatasannee;
    }
}