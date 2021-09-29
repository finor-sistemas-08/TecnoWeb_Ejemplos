<html>
<head>
<title>Registro de Autos</title>
<style type="text/css">
<!--
body {
	background-color: #79F080;
}
-->
</style>
</head>

<body>
<?php
 include_once('clsPais.php');
 include_once('clsCiudad.php');
?>

<b> SELECCIONAR</b>
<form id="form1" name="form1" method="post" action="frmSeleccionar.php">
  <table width="342" border="0">
  <tr>
    <td>Pais</td>
    <td>
    <select name="cboPais" id="id_pais">
  <?php
	  $a=new Pais();
	  $registros=$a->buscar();  
	  while ($row=mysqli_fetch_object($registros)) {
           echo "<option value='$row->id_pais'> $row->nombre </option>";     
    }		  
  ?>       
     </select>
     <input type="submit" name="boton" value="Mostrar"/>
    </td>
  </tr>     
  </table>
</form>

<?php
 function buscar()
 {  
   $obj= new Ciudad();	
   //echo $_POST['cboPais']; //ver que imprime el codigo del pais, no el nombre
   $resultado=$obj->buscarPorCodigo($_POST['cboPais']);
   mostrarRegistros($resultado);		 		
 }

 function mostrarRegistros($registros)
 {
	echo "<table border='3' width='200'>";
	echo "<tr bgcolor='black' align='center'>
	<td><font color='white'>Codigo</font></td>
	<td><font color='white'>Nombre </font></td>";
		   
	while($fila=mysqli_fetch_object($registros))
	{
	 echo "<tr>";
	 echo "<td> <input type='text' size='3'  readonly='true'  value='$fila->id_ciudad'/> </td>";
	 echo "<td> <input type='text' size='18' readonly='true'  value='$fila->nombre'/> </td>";
	 echo "</tr>";
	}
	echo "</table>";    	  
  }		 	 


 if($_POST['boton'])
  {
     buscar();
  }


?>  

</body>
</html>
