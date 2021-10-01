<?php
include_once('clsConexion.php');
class Producto extends Conexion
{
	//atributos
	private $id_producto;
	private $descripcion;
	private $precio;
	private $stock;
	private $id_categoria;

	//construtor
	public function __construct()
	{
		parent::__construct();
		$this->id_producto = 0;
		$this->descripcion = "";
		$this->precio = 0;
		$this->stock = 0;

		$this->id_categoria = 0;
	}

	//Propiedades de acceso
	public function setIdProducto($valor)
	{
		$this->id_producto = $valor;
	}
	public function getIdProducto()
	{
		return $this->id_producto;
	}


	public function setDescripcion($valor)
	{
		$this->descripcion = $valor;
	}
	public function getDescripcion()
	{
		return $this->descripcion;
	}

	public function setPrecio($valor)
	{
		$this->precio = $valor;
	}
	public function getPrecio()
	{
		return $this->precio;
	}

	public function setStock($valor)
	{
		$this->stock = $valor;
	}
	public function getStock()
	{
		return $this->stock;
	}

	public function setIdCategoria($valor)
	{
		$this->id_categoria = $valor;
	}
	public function getIdCategoria()
	{
		return $this->id_categoria;
	}

	public function guardar()
	{
		$sql = "insert into producto(descripcion,precio,stock,id_categoria)
				values('$this->descripcion',
						$this->precio,
						$this->stock,
						$this->id_categoria
						)";
		if (parent::ejecutar($sql))
			return true;
		else
			return false;
	}

	public function modificar()
	{
		$sql = "update producto
				set descripcion='$this->descripcion',
					precio=$this->precio,
					stock=$this->stock
				where id_producto=$this->id_producto";
		if (parent::ejecutar($sql))
			return true;
		else
			return false;
	}

	public function eliminar()
	{
		$sql = "delete from producto where id_producto=$this->id_producto";
		if (parent::ejecutar($sql))
			return true;
		else
			return false;
	}

	public function buscar()
	{
		$sql = "select id_producto, descripcion, precio, stock, nombre
				from producto, categoria 
		 		where producto.id_categoria=categoria.id_categoria
				order by id_producto";
		return parent::ejecutar($sql);
	}

	public function buscarPorDescripcion($criterio)
	{
		//No se esta tomando en cuenta el decremento del stock de la tabla producto
		$sql = "select id_producto, descripcion, precio, stock, nombre
				from producto, categoria 
		 		where producto.id_categoria=categoria.id_categoria and descripcion like '$criterio%'";
		return parent::ejecutar($sql);
	}

	public function buscarPorCategoria($criterio)
	{
		$sql = "select id_producto, descripcion, precio, stock, nombre
				from producto, categoria 
		 		where producto.id_categoria=categoria.id_categoria
				and nombre like '$criterio%'";
		return parent::ejecutar($sql);
	}

	public function buscarPorCategoriaNombre($criterio1, $criterio2)
	{
		$sql = "select id_producto, descripcion, precio, stock, nombre
				from producto, categoria 
		 		where producto.id_categoria=categoria.id_categoria
				and (nombre like '$criterio1%' and descripcion like '$criterio2%')";
		return parent::ejecutar($sql);
	}

	public function buscarPorCodigo($criterio)
	{
		$sql = "select id_producto,descripcion, precio, stock, nombre
				from producto, categoria 
		 		where producto.id_producto='$criterio'
				and producto.id_categoria=categoria.id_categoria";
		return parent::ejecutar($sql);
	}	
}
