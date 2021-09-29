<?php
include_once('clsConexion.php');
class Empleado extends conexion
{
   //atributos
   private $cod_emp;
   private $nombre;
   private $paterno;
   private $materno;
   private $estado_civil;
   private $categoria;
   private $fecha_ing;
   private $activo;

   //constructor
   public function Empleado()
   {   
      parent::conexion();
      $this->cod_emp=0;
      $this->nombre="";
      $this->paterno="";
      $this->materno="";
      $this->estado_civil="";
      $this->categoria="";
      $this->fecha_ing="";
      $this->activo=1;
   }
   //propiedades de acceso
   public function setCodigo($valor)
   {
      $this->cod_emp=$valor;
   }
   public function getCodigo()
   {
      return $this->cod_emp;
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

   public function setEstadoCivil($valor)
   {
      $this->estado_civil=$valor;
   }
   public function getEstadoCivil()
   {
      return $this->estado_civil;
   }

   public function setCategoria($valor)
   {
      $this->categoria=$valor;
   }
   public function getCategoria()
   {
      return $this->categoria;
   }

   public function setFechaIng($valor)
   {
      $this->fecha_ing=$valor;
   }
   public function getFechaIng()
   {
      return $this->fecha_ing;
   }

   public function setActivo($valor)
   {
      $this->activo=$valor;
   }
   public function getActivo()
   {
      return $this->activo;
   }

   public function guardar()
   {
     $sql="insert into empleado(nombre,paterno,materno,estado_civil,categoria,fecha_ing,activo) 
    values('$this->nombre','$this->paterno','$this->materno','$this->estado_civil','$this->categoria', '$this->fecha_ing','$this->activo')";
      
      if(parent::ejecutar($sql))
         return true;
      else
         return false;  
   }
   
   public function modificar()   {
   $sql="update empleado set nombre='$this->nombre',paterno='$this->paterno',materno='$this->materno',
      estado_civil='$this->estado_civil',categoria='$this->categoria',fecha_ing='$this->fecha_ing',activo='$this->activo'
       where cod_emp=$this->cod_emp";    
      if(parent::ejecutar($sql))
         return true;
      else
         return false;  
   }
   
   public function eliminar()
   {
      $sql="delete from empleado where cod_emp=$this->cod_emp";
      
      if(parent::ejecutar($sql))
         return true;
      else
         return false;  
   }                

   public function buscar($nombre, $paterno,$categoria)
   {
      $sql="select * from empleado";
      if ($nombre != '' || $paterno != '' || $categoria != '') {
         $sql .= " where ";
      }
      if ($nombre != '' ) {
         $sql .= "nombre like '$nombre%'";
         if ($paterno != '' || $categoria !='') {
            $sql .=" AND ";
         }
      }
      if ($paterno != '') {
         $sql .= "paterno like '$paterno%'";
         if ($categoria != '') {
            $sql .=" AND ";
         }
      }    
      if ($categoria != '') {
         $sql .= "categoria like '$categoria%'";
      }

      return parent::ejecutar($sql);
   }
}    
?>