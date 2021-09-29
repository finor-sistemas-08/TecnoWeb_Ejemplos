<?php
include_once('clsConexion.php');
class Pais extends Conexion
{
	//atributos
	private $id_pais;
	private $nombre;	
		
	//construtor
	public function Pais()
	{   parent::Conexion();
	    $this->id_pais=0;
	    $this->nombre="";
	}
	//propiedades de acceso
	public function setIdPais($valor)
	{
		$this->id_pais=$valor;
	}
	public function getIdPais()
	{
		return $this->id_pais;
	}

	public function setNombre($valor)
	{
		$this->nombre=$valor;
	}
	public function getNombre()
	{
		return $this->nombre;
	}

	public function guardar()
	{
        $sql="insert into pais(nombre) values('$this->nombre')";		
		if(parent::ejecutar($sql))
			return true;
		else
			return false;	
	}
	
	public function eliminar(){
		$sql="delete from pais where id_pais=$this->id_pais";		
		if(parent::ejecutar($sql))
			return true;
		else
			return false;	
	}
	
	public function buscarPorNombre($criterio)
	{
		$sql="select *from pais 
		 where nombre like '$criterio%'";
		return parent::ejecutar($sql);
	}										

	public function buscar()
	{
		$sql="select *from pais";
		return parent::ejecutar($sql);
	}										

}    
?>