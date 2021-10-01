<?php
class Conexion
{
	//atributos
	private $servidor;
	private $usuario;
	private $password;
	private $basedatos;

	//  Constructor de la clase
	public function __construct()
	{
		$this->servidor = "localhost";
		$this->usuario = "root";
		$this->password = "";
		$this->basedatos = "bd_MaestroDetalle";
	}

	//Métodos de acceso set y get
	public function setServidor($valor)
	{
		$this->servidor = $valor;
	}
	public function getServidor()
	{
		return $this->servidor;
	}
	public function setUsuario($valor)
	{
		$this->usuario = $valor;
	}
	public function getUsuario()
	{
		return $this->usuario;
	}
	public function setPassword($valor)
	{
		$this->password = $valor;
	}
	public function getPassword()
	{
		return $this->password;
	}
	public function setBasedatos($valor)
	{
		$this->basedatos = $valor;
	}
	public function getBasedatos()
	{
		return $this->basedatos;
	}
	//metodos 
	public function conectar()
	{
		// Utilizando los atributos de la clase con valor inicializado por el constructor
		$bd = mysqli_connect($this->servidor, $this->usuario, $this->password, $this->basedatos,);

		// Conectando a MySQL y a la base de datos de manera directa
		// $bd = mysqli_connect("localhost", "root", "", "bd_MaestroDetalle");

		// Revisando el valor de los atributos de la clase
		// var_dump($this->servidor);
		// var_dump($this->usuario);
		// var_dump($this->password);
		// var_dump($this->basedatos);
		if ($bd)
			return $bd;
		else
			echo "ERROR AL CONECTAR LA BASE DE DATOS...!!!";
	}

	public function desconectar($cnx)
	{
		mysqli_close($cnx);
	}

	public function ejecutar($sql)
	{
		$bd = $this->conectar();
		$registros = mysqli_query($bd, $sql);
		$this->desconectar($bd);
		return $registros;
	}
}//end clase		
