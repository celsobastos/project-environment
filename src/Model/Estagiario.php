<?php

namespace Celso\Environment\Model;

class Estagiario extends Funcionario {
    public function calculaReajusteSalario() :float {
        return $this->salario + $this->salario * 0.1;
    }
}