<?php

namespace Celso\Environment\Model;

class Diretor extends Funcionario {
    public function calculaReajusteSalario() :float {
        return $this->salario + $this->salario * 0.20;
    }
}