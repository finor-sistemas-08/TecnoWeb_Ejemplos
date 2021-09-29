<?php
include_once('clsConexion.php');
class Persona extends conexion
{
	//atributos
	private $id_persona;
	private $nombre;
	private $paterno;
	private $materno;
	private $sexo;
	private $estado_civil;
	private $fecha_nac;
	
	//construtor
	public function Persona()
	{   parent::conexion();
	    $this->id_persona=0;
	    $this->nombre="";
	    $this->paterno="";
	    $this->materno="";
	    $this->sexo="";
	    $this->estado_civil="";
	    $this->fecha_nac="";				
	}
	//propiedades de acceso
	public function setIdPersona($valor)
	{
	   $this->id_persona=$valor;
	}
	public function getIdPersona()
	{
	   return $this->id_persona;
	}

	public function setNombre($valor)
	{
	   $this->nombre=$valor;
	}
	public function getNombre()
	{
	   return $this->nombre;
	}
	
	public function setPaterno($valor)
	{
	   $this->paterno=$valor;
	}
	public function getPaterno()
	{
	   return $this->paterno;
	}
	
	public function setMaterno($valor)
	{
	   $this->materno=$valor;
	}
	public function getMaterno()
	{
	   return $this->materno;
	}
	
	public function setSexo($valor)
	{
	   $this->sexo=$valor;
	}
	public function getSexo()
	{
	   return $this->sexo;
	}

	public function setEstadoCivil($valor)
	{
		$this->estado_civil=$valor;
	}
	public function getEstadoCivil()
	{
		return $this->estado_civil;
	}
	
	public function setFechaNac($valor)
	{
		$this->fecha_nac=$valor;
	}
	public function getFechaNac()
	{
		return $this->fecha_nac;
	}
	
	public function guardar()
	{
     $sql="insert into persona(nombre,paterno,materno,sexo,estado_civil,fecha_nac) values
	 ('$this->nombre','$this->paterno','$this->materno','$this->sexo','$this->estado_civil','$this->fecha_nac')";		
		if(parent::ejecutar($sql))
			return true;
		else
			return false;	
	}
	
	public function modificar()	{
	$sql="update persona set nombre='$this->nombre', paterno='$this->paterno', materno='$this->materno', sexo='$this->sexo', 
	estado_civil='$this->estado_civil', fecha_nac='$this->fecha_nac' where id_persona=$this->id_persona";		
		if(parent::ejecutar($sql))
			return true;
		else
			return false;	
	}
	
	public function eliminar()
	{
		$sql="delete from persona where id_persona=$this->id_persona";
		
		if(parent::ejecutar($sql))
			return true;
		else
			return false;	
	}
	
	public function buscar()
	{
		$sql="select *from persona";
		return parent::ejecutar($sql);
	}										

	public function buscarPorCodigo($criterio)
	{
		$sql="select *from persona where id_persona like '$criterio%'";
		return parent::ejecutar($sql);
	}								
	
	public function buscarPorNombre($criterio)
	{
		$sql="select *from persona where nombre like '$criterio%'";
		return parent::ejecutar($sql);
	}

	public function buscarPorFechaNac($criterio)
	{
		$sql="select *from persona where nombre like '$criterio%'";
		return parent::ejecutar($sql);
	}

}    
?>