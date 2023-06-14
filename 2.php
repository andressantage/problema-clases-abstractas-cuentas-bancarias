<!-- Desafío: Crea una clase abstracta llamada CuentaBancaria con los siguientes atributos y métodos:

Atributos:

$saldo: representa el saldo disponible en la cuenta.

Métodos:

depositar($monto): recibe un monto y lo agrega al saldo de la cuenta.
retirar($monto): recibe un monto y lo resta del saldo de la cuenta. Asegúrate de validar que el saldo sea suficiente antes de realizar el retiro.
Luego, crea dos clases hijas, CuentaCorriente y CuentaAhorros, que extiendan la clase CuentaBancaria. Cada clase hija debe implementar su 
propia lógica para los métodos depositar() y retirar().

La clase CuentaCorriente debe permitir retiros incluso si el saldo es insuficiente, pero aplicando un cargo por sobregiro del 10% del monto 
retirado.

La clase CuentaAhorros debe permitir retiros solo si el saldo es suficiente y no aplicar ningún cargo adicional. -->

<?php

abstract class CuentaBancaria{
    protected $saldo;

    public function __construct($saldoInicial=0){
        $this->saldo=$saldoInicial;
    }

    abstract public function depositar($monto);

    abstract public function retirar($monto);
}

class CuentaCorriente extends CuentaBancaria{

    public function depositar($monto){
        $this->saldo+=$monto;
        return $this->saldo;
    }
    public function retirar($monto){
        if($monto>$this->saldo){
            $this->saldo-=$monto+0.1*$monto;
            return $this->saldo;
        }else{
            $this->saldo-=$monto;
            return $this->saldo;
        }
    }
}

class CuentaAhorros extends CuentaBancaria{

    public function depositar($monto){
        $this->saldo += $monto;
        return $this->saldo;
    }
    public function retirar($monto){
        if($monto<$this->saldo){
            $this->saldo -= $monto;
            return $this->saldo;
        }else{
            return "Saldo no disponible porque es una cuenta debito";
        }
    }
}

$cuenta1=new CuentaCorriente(300);
$cuenta2=new CuentaAhorros(200);

var_dump($cuenta1->depositar(10));
var_dump($cuenta1->retirar(20));
var_dump($cuenta1->retirar(20));

var_dump($cuenta2->depositar(10));
var_dump($cuenta2->retirar(20));
var_dump($cuenta2->retirar(20));

var_dump($cuenta1->retirar(200));
var_dump($cuenta2->retirar(200));
?>