<?php
ob_start();
include_once('clsConexion.php');

// Inicia una nueva sesión en el contexto actual
session_start();
include_once('clsCategoria.php');

// Si la variable de sesión contiene un valor "búsqueda" y éste no es 
// nulo entonces se le asigna un valor string "registro" el cual nos va
// ayudar a elegir las filas que queramos eliminar de los registros de Categorías
if (!isset($_SESSION['busqueda'])) {
	$_SESSION['busqueda'] = "registro";
}
?>

<html>

<head>
</head>
<title>Categorias de Productos</title>

<!-- Llamada a la CSS -->
<link rel="stylesheet" href="estilo.css" type="text/css" />

</head>

<body>
	<center>
		<form id="form2" name="formularioCate" method="post" action="frmCategoria.php">
			<fieldset id="form">
				<legend>MENÚ DE CATEGORIAS</legend>
				<table width="381" border="0">
					<tr>
						<td colspan="2">
							<div align="center" class="Estilo1"> </div>
						</td>
					</tr>
					<tr>
						<td width="72"></td>
						<td width="299"><label>
								<input name="txtIdCategoria" type="hidden" id="txtIdCategoria" />
							</label></td>
					</tr>
					<tr>
						<td>Nombre</td>
						<td><label>
								<input name="txtNombre" type="text" id="txtNombre" />
							</label></td>
					</tr>
					<tr>
						<td colspan="3"><label>
								<input name="btnAccion" type="submit" id="btnAccion" value="Guardar" />
								<input name="btnAccion" type="submit" id="btnAccion" value="Eliminar" />
								<input name="btnAccion" type="submit" id="btnAccion" value="Buscar" />
							</label></td>
					</tr>
					<tr>
						<td> Buscar </td>
						<td><input name="txtBuscar" type="text" id="txtBuscar" /> </td>
					</tr>
				</table>

				<?php
				function guardar()
				{
					if ($_POST['txtNombre']) {
						$obj = new Categoria();
						$obj->setNombre($_POST['txtNombre']);
						if ($obj->guardar())
							echo "Categoria guardada";
						else
							echo "Error al guardar el categoria";
					} else
						echo "El nombre es obligatorio";
				}
				function modificar()
				{
					if ($_POST['txtIdCategoria'] && $_POST['txtNombre']) {
						$obj = new Categoria();
						$obj->setNombre($_POST['txtNombre']);
						if ($obj->modificar())
							echo "Categoria modificada";
						else
							echo "Error al modificar la categoria";
					} else
						echo "El id y nombre son obligatorios";
				}

				function eliminar()
				{
					if ($_POST['txtIdCategoria']) {
						$obj = new Categoria();
						$obj->setIdCategoria($_POST['txtIdCategoria']);

						if ($obj->eliminar())
							echo "Categoria eliminada";
						else
							echo "Error al eliminar el categoria";
					} else
						echo "para eliminar la categoria, debe introducir el id de la categoria";
				}

				function eliminar1()
				{
					$j = 1;
					$obj = new Categoria();

					// La última búsqueda realizada (string) está en la variable $_SESSION
					// con ella obtenemos las filas y columnas resultantes de esa
					// búsqueda usando la función "buscarPorNombre"
					$resultado = $obj->buscarPorNombre($_SESSION['busqueda']);

					// Desengranamos aún más el resultado de la búsqueda en una variable
					// con la cual vamos a acceder a las filas de la tabla
					while ($reg = mysqli_fetch_object($resultado)) {
						if ($_POST['registro' . $j]) {
							$categ = new Categoria();

							// Asignamos el ID a una instancia de la clase
							$categ->setIdCategoria($reg->id_categoria);
							
							// Llamado a la función eliminar la cual actúa sobre el ID
							// que posee dicha instancia de la clase Categoría
							$categ->eliminar();

							// Si la eliminación resultó exitosa entonces mandamos un mensaje
							if ($categ->eliminar() == true) {
								echo ("<br>");
								echo ("Registro " . $categ->getIdCategoria() . " eliminado exitosamente");
								echo ("<br>");
							}
						}
						$j++;
					}
				}

				function buscar()
				{
					echo "<p>";
					$obj = new Categoria();
					$resultado = $obj->buscarPorNombre($_POST['txtBuscar']);
					
					// La primera vez que mostremos los registros en pantalla
					// también vamos a asignar el mismo valor de la búsqueda a la
					// variable $_SESSION en la clave "busqueda".
					$_SESSION['busqueda'] = $_POST['txtBuscar'];
					
					echo "<form id='form3' name='form3' method='post' action='frmCategoria.php'>";
					echo "<table border ='1'>";
					echo "<tr bgcolor='black'><td><font color='white'>IDCat</font></td><td><font color='white'>Nombre</font></td><td></td></tr>";
					$k = 1;
					while ($reg = mysqli_fetch_object($resultado)) {
						echo "<tr>";
						echo "<td>$reg->id_categoria</td>";
						echo "<td>$reg->nombre</td>";
						echo "<td><input type='checkbox' name='registro$k";
						// echo $k;
						echo "'></td>";
						echo "</tr>";
						$k++;
					}
					echo "</table></form>";
				}
				//programa principal
				switch ($_POST['btnAccion']) {
					case "Guardar":
						guardar();
						break;
					case "Modificar":
						modificar();
						break;
					case "Eliminar":
						eliminar1();
						break;
					case "Buscar":
						buscar();
						break;
				}
				?>
		</form>
		<center>
</body>

</html>