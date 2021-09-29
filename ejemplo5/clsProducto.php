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
	public function Producto()
	{   parent::Conexion();
	    $this->id_producto=0;
	    $this->descripcion="";
        $this->precio=0;
        $this->stock=0;
	    $this->id_categoria=0;		
	}

	//propiedades de acceso
	public function setIdProducto($valor)
	{
		$this->id_producto=$valor;
	}
	public function getIdProducto()
	{
		return $this->id_producto;
	}
	public function setDescripcion($valor)
	{
		$this->descripcion=$valor;
	}
	public function getDescripcion()
	{
		return $this->descripcion;
	}

	public function setPrecio($valor)
	{
		$this->precio=$valor;
	}
	public function getPrecio()
	{
		return $this->precio;
	}
	
	public function setStock($valor)
	{
		$this->stock=$valor;
	}
	public function getStock()
	{
		return $this->stock;
	}
	
	public function setIdCategoria($valor)
	{
		$this->id_categoria=$valor;
	}
	public function getIdCategoria()
	{
		return $this->id_categoria;
	}
	
	public function guardar()
	{
        $sql="insert into producto(descripcion,precio,stock,id_categoria) values('$this->descripcion','$this->precio','$this->stock','$this->id_categoria')";
		if(parent::ejecutar($sql))
			return true;
		else
			return false;	
	}
	
	public function modificar()	{
	$sql="update producto set descripcion='$this->descripcion', precio='$this->precio',stock='$this->stock',id_categoria='$this->id_categoria'
	where id_producto=$this->id_producto";
		if(parent::ejecutar($sql))
			return true;
		else
			return false;	
	}
	
	public function eliminar()
	{
		$sql="delete from producto where id_producto=$this->id_producto";
		
		if(parent::ejecutar($sql))
			return true;
		else
			return false;	
	}
	
	public function buscar()
	{
		$sql="select id_producto,descripcion,precio,stock,nombre from producto,categoria where categoria.id_categoria=producto.id_categoria";
		return parent::ejecutar($sql);
	}										
   //metodos utilizados para el comboBox
	public function buscarPorCodigo($criterio)
	{
		$sql="select id_producto,descripcion,precio,stock,nombre from producto,categoria where categoria.id_categoria=producto.id_categoria and id_producto like '$criterio%'";
		return parent::ejecutar($sql);
	}								
	
	public function buscarPorDescripcion($criterio)
	{
		$sql="select id_producto,descripcion,precio,stock,nombre from producto,categoria where categoria.id_categoria=producto.id_categoria and descripcion like '$criterio%'";
		return parent::ejecutar($sql);
	}

	public function buscarPorPrecio($p1,$p2)
	{
		$sql="select id_producto,descripcion,precio,stock,nombre  from producto,categoria where categoria.id_categoria=producto.id_categoria and precio >= '$p1' and precio <='$p2'";
		return parent::ejecutar($sql);
	}

	public function buscarPorStock($s1,$s2)
	{
		$sql="select id_producto,descripcion,precio,stock,nombre from producto,categoria where categoria.id_categoria=producto.id_categoria and stock >= '$s1' and stock <='$s2'";
		return parent::ejecutar($sql);
	}
}    
?>