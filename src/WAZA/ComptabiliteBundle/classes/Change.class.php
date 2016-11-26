<?php 

class Change
{
    public $currency;
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
}


?>