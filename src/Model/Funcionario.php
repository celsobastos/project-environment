<?php

namespace Celso\Environment\Model;

abstract class Funcionario extends Pessoa {

    /**
     * Construct method
     *
     * @param string $name
     * @param float $salario
     */
    public function __construct(
        string $name,
        protected float $salario,
        Endereco $endereco,
    ) {
        parent::__construct($name, $endereco);
    }

    abstract protected function calculaReajusteSalario() : float;
}