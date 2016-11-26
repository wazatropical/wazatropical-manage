<?php

namespace WAZA\ComptabiliteBundle\Change;

class WAZAChange
{
    public $currency = 0;
    public $date;

    
    public function getCurrency() {
        return $this->currency;
    }
    
    public function setCurrency($c) {
        $this->currency = $c;
        return $this;
    }
    
    public function getDate() {
        return $this->date;
    }
	
    public function setDate($d) {
        $this->date = $d;
        return $this;
    }
    
    public function convert ($money1,$money2){	
        //$lien='http://download.finance.yahoo.com/d/quotes.csv?s='.$money1.$money2.'=X&f=sl1d1t1ba&e=.csv';
        //$this->download($lien);
        //$data = $this->readCSV("fichiers/quotes.csv");
        $data = $this->readCSV('http://download.finance.yahoo.com/d/quotes.csv?s='.$money1.$money2.'=X&f=sl1d1t1ba&e=.csv');
        $this->setCurrency($data[1]);
        $this->setDate($data[2]);
    }
    
    public function convertValue($value, $money1, $money2){
        $this->convert($money1, $money2);
        return $value * $this->getCurrency();
    }


    // read file
    public function readCSV($fichier){	
        if (($handle = fopen("$fichier", "r")) !== FALSE) {
            $ret=array();
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $ret[0]=$data[0];
                $ret[1]=$data[1];
                $ret[2]=$data[2];	
            }
            return $ret;
        }
    }


    //Dowload
    public function download($lien){	
        $newfile = 'fichiers/quotes.csv';
        copy($lien, $newfile);
    }
}