<?php

namespace Celso\Environment\Model;

class Endereco {
    public function __construct(
        protected string $numero,
        protected string $logradouro,
        protected string $cep,
    ) {}
}