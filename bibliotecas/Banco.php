<?php

class Banco extends mysqli
{
		
	public function __construct($host, $usuario, $senha, $basedados)
        {
            //chama construtor da classe pai(mysqli)
            parent::__construct($host, $usuario, $senha, $basedados);
            
            $this->set_charset("utf8");
            
            if (mysqli_connect_error())
                die('Erro de conexao ' . mysqli_connect_errno() . ': ' . mysqli_connect_error());
        }
        
        public function __destruct() {
            $this->close();
        }
        
        //função que retorna true ou false ou um objeto
        public function executarSQL($sql, $classe = "stdClass")
        {
            
            $resultado = $this->query($sql);
            
            if($resultado === true || $resultado === false)
                return $resultado;
            
            $objetos = array();
            
            while ($obj = $resultado->fetch_object($classe)) {
                $objetos[] = $obj;
            }
 
            $resultado->free();
            
            return $objetos;    
        }
        
}

?>