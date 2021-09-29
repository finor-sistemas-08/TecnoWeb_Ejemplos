<?php
include_once('clsConexion.php');
class Ciudad extends Conexion
{
	//atributos
	private $id_ciudad;
	private $nombre;
	
		
	//construtor
	public function Ciudad()
	{   parent::Conexion();
	    $this->id_ciudad=0;
	    $this->nombre="";
	}
	//propiedades de acceso
	public function setIdCiudad($valor)
	{
		$this->id_ciudad=$valor;
	}
	public function getIdCiudad()
	{
		return $this->id_ciudad;
	}

	public function setNombre($valor)
	{
		$this->nombre=$valor;
	}
	public function getNombre()
	{
		return $this->nombre;
	}
	
	public function buscarPorCodigo($id_pais)
	{
		$sql="select id_ciudad,ciudad.nombre from ciudad,pais 
		where ciudad.id_pais=pais.id_pais and pais.id_pais = $id_pais";
		return parent::ejecutar($sql);
	}									

}    
?>