<?php

class TesteController extends Controller {
	
	public function index() {
		echo "Chamando a ação index de Teste";
	}
		
	public function acao() {
		$v = new View("teste/acao");		
		
		$c = $this->load_model("Carro");
		$c->setRoda(10);
		
		$v->add_variable("carro", $c);		
		$v->show();
	}
}