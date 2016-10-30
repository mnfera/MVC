<?php

class Carro extends Model {
	
	private $roda;
	
	public function getRoda() {
		return $this->roda;
	}
	
	public function setRoda($roda) {
		$this->roda = $roda;
	}
	
}