<html>
<head>
</head>
<body>
<?php
include_once('clsPersona.php');
$valor=$_POST['txtBuscar'];
?>

<b> REGISTRO DE PERSONAS  </b>
<form id="form1" name="form1" method="POST" action="frmPersona.php">
  <table width="400" border="0">
    <tr> <td> </td>
     <td>
     <input name="txtIdPersona" type="hidden" value="<?php echo $_GET['pid_persona']; ?>" id="txtIdPersona" />
     </td>
    </tr>
    <tr>
      <td width="80">Nombre</td>
      <td width="225">	 	  
        <input name="txtNombre" type="text"  value="<?php echo $_GET['pnombre']; ?>" id="txtNombre" />
      </td>
    </tr>
    <tr>
      <td width="80">Paterno</td>
      <td width="225">	  	  
        <input name="txtPaterno" type="text" value="<?php echo $_GET['ppaterno']; ?>" id="txtPaterno" />
      </td>
    </tr>
    
	<tr>
      <td width="80">Materno</td>
      <td width="225">	  	  
        <input name="txtMaterno" type="text" value="<?php echo $_GET['pmaterno']; ?>" id="txtMaterno" />
      </td>
    </tr>
    
      <tr>
      <td width="80">Sexo</td>
      <td width="225">
      <?php 
	    $sexo=$_GET['psexo'];  
      ?>
        <input type="radio" name="rbtSexo" checked="checked" value="M" <?php if ($sexo == 'M') {echo "checked";} ?> />Maculino
	<input type="radio" name="rbtSexo" value="F" <?php if ($sexo == 'F') {echo "checked";} ?> />Femenino			
       </td>
     </tr>
    
     <tr>
      <td width="80">Estado Cvil</td>
      <td width="225">	  
      <?php
           $estado=$_GET['pestado_civil'];     
      ?>
  	   <select name="cboEstadoCivil" id="cboEstadoCvil" value="$estado" />
	   <option <?php if ($estado == 'Soltero') {echo "selected='selected'";} ?> >Soltero</option>
	   <option <?php if ($estado == 'Casado') {echo "selected='selected'";} ?> >Casado</option>
	   <option <?php if ($estado == 'Divorciado') {echo "selected='selected'";} ?> >Divorciado</option>
	   <option <?php if ($estado == 'Viudo') {echo "selected='selected'";} ?> >Viudo</option>
	   </select>
      </td>
    </tr>
    
      <tr>
      <td width="80">Fecha Nacimiento</td>
      <td width="225">	  	  
      <input type="date" name="datFechaNac" value="<?php //echo $_GET['pfecha_nac']; ?>">
      </td>
    </tr>    
	
    <tr>
      <td colspan="2">
      <input type="submit" name="botones"  value="Nuevo" />
      <input type="submit" name="botones"  value="Guardar" />
      <input type="submit" name="botones"  value="Modificar" />
      <input type="submit" name="botones"  value="Eliminar" />
      <input type="submit" name="botones"  id="botones" value="Buscar"/>
     </td>
    </tr>  
   <tr>
	<!-- busqueda por codigo y nombre -->
	<td colspan="2">
        Buscar por       
        <input name="grupo" type="radio" <?php if ($_POST['grupo']=="1") echo "checked"; ?> value="1" checked="checked" />
        Codigo
          <input type="radio" name="grupo" <?php if ($_POST['grupo']=="2") echo "checked"; ?> value="2" />
        Nombre

        <input type="radio" name="grupo" <?php if ($_POST['grupo']=="3") echo "checked"; ?> value="3" />
        Fecha Nacimiento

          <input name="txtBuscar" type="text" id="txtBuscar" value="<?php echo $valor; ?>" size="20"/>   
          <input name="txtBuscar" type="text" id="t1" value="" size="10"/>   
          <input name="txtBuscar" type="text" id="t2" value="" size="10"/>   
        </td>
    </tr>
  </table>
</form>

<?php
function guardar()
{
	if($_POST['txtNombre'] && $_POST['txtPaterno'] )
	{	    
		$obj= new Persona();
		$obj->setNombre($_POST['txtNombre']);
		$obj->setPaterno($_POST['txtPaterno']);
		$obj->setMaterno($_POST['txtMaterno']);
		if($_POST['rbtSexo']=='M') 
		  $obj->setSexo('M');
	        else
		  $obj->setSexo('F');		
		$obj->setEstadoCivil($_POST['cboEstadoCivil']);
		$obj->setFechaNac($_POST['datFechaNac']);		
		if ($obj->guardar())
			echo "Persona Guardada..!!!";
		else
			echo "Error al guardar la Persona";
	}
	else
		echo "El nombre y paterno es obligatorio..!!!";
}	

function modificar()
{
	if($_POST['txtNombre'])
	{
		$obj= new Persona();
		$obj->setIdPersona($_POST['txtIdPersona']);
		$obj->setNombre($_POST['txtNombre']);
		$obj->setPaterno($_POST['txtPaterno']);
		$obj->setMaterno($_POST['txtMaterno']);
		if($_POST['rbtSexo']=='M') 
		$obj->setSexo('M');
	else
		$obj->setSexo('F');		
		$obj->setEstadoCivil($_POST['cboEstadoCivil']);
		$obj->setFechaNac($_POST['datFechaNac']);		
		if ($obj->modificar())
			echo "Persona modificada..!!!";
		else
			echo "Error al modificar la persona..!!!";		
	}
	else
		echo "El nombre es obligatorio...!!!";
}

function eliminar()
{
	if($_POST['txtIdPersona'])
	{
		$obj= new Persona();
		$obj->setIdPersona($_POST['txtIdPersona']);		
		if ($obj->eliminar())
			echo "Persona eliminada";
		else
			echo "Error al eliminar la persona";		
	}
	else	
		echo "para eliminar la persona, debe tener el codigo de la persona..!!!";	
}

function buscar()
{  
   $obj= new Persona();	
   $valor=$_POST['txtBuscar'];
   switch ($_POST['grupo']) {
   case 1:{
           $resultado=$obj->buscarPorCodigo($_POST['txtBuscar']);
           mostrarRegistros($resultado);	
	 		
   	  }; break;
   case 2: 
          {
	   $resultado=$obj->buscarPorNombre($_POST['txtBuscar']);
     	   mostrarRegistros($resultado);	
 	  }; break;
   case 3: 
          {
	   $resultado=$obj->buscarPorFechaNac($_POST['t1'],$_POST['t2']);
     	   mostrarRegistros($resultado);	
 	  }; break;
   }	
}

 function mostrarRegistros($registros)
 {
	echo "<table border='1' align='left'>";
	echo "<tr> <td>Codigo</td>
	       <td>Nombre</td>
		   <td>Paterno</td>
		   <td>Materno</td>
		   <td>Sexo</td>
		   <td>Estado Civil </td>
		   <td>Fecha Nacimiento </td>		   
		   <td><center>*</center></td></tr>";
	while($fila=mysqli_fetch_object($registros))
	{
		echo "<tr>";
		echo "<td>$fila->id_persona</td>";
		echo "<td>$fila->nombre</td>";
		echo "<td>$fila->paterno</td>";
		echo "<td>$fila->materno</td>";
		echo "<td>$fila->sexo</td>";
		echo "<td>$fila->estado_civil</td>";
		echo "<td>$fila->fecha_nac</td>";		
		echo "<td><a href='frmPersona.php? pid_persona=$fila->id_persona&pnombre=$fila->nombre&ppaterno=$fila->paterno&pmaterno=$fila->materno&psexo=$fila->sexo&pestado_civil=$fila->estado_civil&pfecha_nac=$fila->fecha_nac'> [Editar] </a> </td>";
		echo "</tr>";
	}
	echo "</table>";
 }   

//menu principal
  switch($_POST['botones'])
  {
	case "Nuevo":{
	}break;

	case "Guardar":{
    guardar();
	}break;

	case "Modificar":{
    modificar();
	}break;

	case "Eliminar":{
     eliminar();
	}break;

	case "Buscar":{
     buscar();
	}break;

  }
?>  

</body>
</html>
