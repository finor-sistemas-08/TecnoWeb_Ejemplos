<html>
<head>
<title>Registro de Empleados</title>
<link rel="stylesheet" type="text/css" href="styles.css" />
</head>

<body style="background-color: #CEE3F6;">
  <div id="wrapper" style="width: 700px; margin: 20px auto; border: 1px solid #ccc; padding: 20px; background-color: #FFF;">
    <?php
     include_once('clsEmpleado.php');
     $valor=$_POST['txtBuscar'];
    ?>

    <div style="background-color: #ccc; font-weight: bold; text-align: center; padding: 5px;">
      REGISTRO DE EMPLEADOS
    </div>
    <form id="form1" name="form1" method="post" action="frmEmpleado.php">
      <table width="690" border="0">
        <tr>
          <td>&nbsp;</td>
          <td>
            <?php $cod=$_GET['pcod_emp']; ?>
            <input name="txtCodigo" type="hidden" value="<?php echo $cod; ?>" id="txtCodigo" />
            <label></label>
          </td>
        </tr>
        <tr>
          <td width="79">Nombre</td>
          <td width="227">
            <?php $nom= $_GET['pnombre']; ?>    
            <input name="txtNombre" type="text"  value="<?php echo $nom; ?>" id="txtNombre" />
          </td>
        </tr>
        <tr>
          <td>Paterno</td>
          <td>
            <?php $pat = $_GET['ppaterno']; ?>   
            <input name="txtPaterno" type="text" value="<?php echo $pat; ?>" id="txtPaterno" />
          </td>
        </tr>
        <tr>
          <td>Materno</td>
          <td>
            <?php $mat=$_GET['pmaterno']; ?>   
            <input name="txtMaterno" type="text" value="<?php echo $mat; ?>" id="txtMaterno" />
          </td>
        </tr>
        <tr>
          <td>Estado Civil</td>
          <td>
            <?php
            $est='soltero';
            if ($_GET['pestado']) {
              $est=$_GET['pestado'];  
            }
            ?>
            <input name="txtEstadoCivil" type="radio" value="soltero" <?php if ($est == 'soltero' || $est == 'Soltero' ) {echo "checked";} ?> /> Soltero
            <input name="txtEstadoCivil" type="radio" value="casado"  <?php if ($est == 'casado' || $est == 'Casado') {echo "checked";} ?> /> Casado
            <input name="txtEstadoCivil" type="radio" value="divorciado" <?php if ($est == 'divorciado' || $est == 'Divorciado') {echo "checked";} ?> /> Divorciado
          </td>
        </tr>
        <tr>
          <td>Categoria</td>
          <td>
            <?php
             $cat='A';
             if ($_GET['pcategoria']) {
               $cat=$_GET['pcategoria'];  
             }
            ?>
            
            <select name="txtCategoria" id="txtCategoria" value="$cat">
              <option <?php if ($cat == 'A') {echo "selected='selected'";} ?> >A</option>
              <option <?php if ($cat == 'B') {echo "selected='selected'";} ?> >B</option>
              <option <?php if ($cat == 'C') {echo "selected='selected'";} ?> >C</option>
            </select>
          </td>
        </tr>
        <tr>
          <td>Fecha Ingreso</td>
          <td><label>
          <?php 			 
	      $fec = date('Y-m-d');
              if($_GET['pfecha_ing']) { 
                $fec=$_GET['pfecha_ing'];
              } 			  
	  ?>    
          <input name="txtFechaIng" type="date" value="<?php echo $fec; ?>" id="txtFechaIng" />
          </label></td>
        </tr>
        <tr>
          <td>Activo</td>
          <td><label>
          <?php 
           $act = '0';
           if ($_GET['pactivo']){
             $act = $_GET['pactivo'];
           }
          ?>
           <input name="txtActivo" type="checkbox" value="1" id="txtActivo" 
           <?php if ($act == '1') { echo 'checked'; } ?> />
          </label></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><label></label></td>
        </tr>
        <tr>
          <td colspan="2">
        <label>
        <input type="submit" name="botones"  value="Nuevo" />
          <input type="submit" name="botones"  value="Guardar" />
          <input type="submit" name="botones"  value="Modificar" />
          <input type="submit" name="botones"  value="Eliminar" />
          </label>
        </td>
        </tr>
        
        <tr>		
           <td colspan="2" style="background-color: #ddd; padding: 0 20px;">&nbsp;<br>
            <table>
	    <tr>
               Buscar por los siguientes criterios:       
               <td><input type="checkbox" name="chkNom"  value="1" /></td>
               <td><label>Nombre</label></td>
               <td><input type="text" name="tnombre" id="tnombre" /></td>
            </tr>
             <tr>
               <td><input type="checkbox" name="chkPat" value="1"  /></td>
               <td><label>Paterno</label></td>
               <td><input type="text" name="tpaterno" id="tpaterno" /></td>
             </tr>

             <tr>
               <td><input type="checkbox" name="chkCat" value="1"  /></td>
               <td><label>Categoria</label></td>
               <td>
                <select name="tcategoria" id="tcategoria" />
                 <option>A</option>
                 <option>B</option>
                 <option>C</option>
		            </select>
                </td>
             </tr>
             <tr>
                <td></td><td></td>
                <td style="text-align: right;"><input type="submit" name="botones"  value="Buscar" /></td>
             </tr>             
          </tr>
            </table>
          </td>
        </tr>
      </table>
    </form>

<?php
function guardar()
{
  if($_POST['txtNombre'] && $_POST['txtPaterno'])
  {
    $obj= new Empleado();
    $obj->setCodigo($_POST['txtCodigo']);
    $obj->setNombre($_POST['txtNombre']);
    $obj->setPaterno($_POST['txtPaterno']);
    $obj->setMaterno($_POST['txtMaterno']);
    $obj->setEstadoCivil($_POST['txtEstadoCivil']);
    $obj->setCategoria($_POST['txtCategoria']);
    $obj->setFechaIng($_POST['txtFechaIng']);
    if ($_POST['txtActivo']) {
      $obj->setActivo(1);
    } 
    else 
    {
      $obj->setActivo(0);
    }
    if ($obj->guardar())
      echo "Empleado guardado...!!!";
    else
      echo "Error al guardar el Empleado";
  }
  else
    echo "El Nombre y el Apellido son obligatorios";
} 

function modificar()
{
  if($_POST['txtNombre'] && $_POST['txtPaterno'])
  {
    $obj= new Empleado();
    $obj->setCodigo($_POST['txtCodigo']);
    $obj->setNombre($_POST['txtNombre']);
    $obj->setPaterno($_POST['txtPaterno']);
    $obj->setMaterno($_POST['txtMaterno']);
    $obj->setEstadoCivil($_POST['txtEstadoCivil']);
    $obj->setCategoria($_POST['txtCategoria']);
    $obj->setFechaIng($_POST['txtFechaIng']);
    if ($_POST['txtActivo']) {
      $obj->setActivo(1);
    } else {
      $obj->setActivo(0);
    }
    if ($obj->modificar()) {
      echo "Empleado modificado";
    }
    else
      echo "Error al modificar el Empleado";   
  }
  else
    echo "El nombre y apellidos son obligatorios";
}

function eliminar()
{
  if($_POST['txtCodigo'])
  {
    $obj= new Empleado();
    $obj->setCodigo($_POST['txtCodigo']);   
    if ($obj->eliminar())
      echo "Empleado eliminado";
    else
      echo "Error al eliminar el empleado";   
  }
  else  
    echo "para eliminar el empleado, debe introducir el codigo del empleado..!!!"; 
}

function buscar()
{
  $obj= new Empleado();
  $chkNom = '';
  $chkPat = '';
  $chkCat = '';
  if ($_POST['chkNom'] == 1) {
    $chkNom = $_POST['tnombre'];
  }
  if ($_POST['chkPat'] == 1) {
    $chkPat = $_POST['tpaterno'];
  }
  if ($_POST['chkCat'] == 1) {
    $chkCat = $_POST['tcategoria'];
  }

  $res = $obj->buscar($chkNom, $chkPat, $chkCat);
  mostrarRegistros($res);
}

function mostrarRegistros($registros)
{
  echo"<table border ='2'>";
  echo"<tr><td>Codigo</td> <td>Nombre</td> <td>Paterno</td> <td>Materno</td><td>Estado Civil</td> <td>Categoria</td> <td>Fecha Ingreso</td> 
  <td>Activo</td><td> * </td></tr>";  
  while($reg=mysqli_fetch_object($registros)) {
    echo"<tr>";
    echo"<td>$reg->cod_emp</td>";
    echo"<td>$reg->nombre</td>";
    echo"<td>$reg->paterno</td>";
    echo"<td>$reg->materno</td>";
    echo"<td>$reg->estado_civil</td>";
    echo"<td>$reg->categoria</td>";
    echo"<td>$reg->fecha_ing</td>";
    echo"<td>$reg->activo</td>";
    $fila = $reg;
    echo "<td><a href='frmEmpleado.php? pcod_emp=$fila->cod_emp&pnombre=$fila->nombre&ppaterno=$fila->paterno&
    pmaterno=$fila->materno&pestado=$fila->estado_civil&pcategoria=$fila->categoria&pfecha_ing=$fila->fecha_ing&pactivo=$fila->activo' > Editar </a> </td>";
    echo"</tr>";
  }
  echo"</table>";
}


//hasta aqui el programa principal
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
</div>
</body>
</html>
