<?php
ob_start();
include_once('models/clsCarro.php');
session_start();
?>
<?php
include_once('models/clsVenta.php');
include_once('models/clsDetalleVenta.php');
include_once('models/clsCliente.php');
include_once('models/clsProducto.php');
?>
<?php
if (!isset($_SESSION['carrito'])) {
	$_SESSION['carrito'] = new Carrito();
}
if (!isset($_SESSION['cliente'])) {
	$_SESSION['cliente'] = $_POST['txtBuscarCli'];
}
if (!isset($_SESSION['idcliente'])) {
	$_SESSION['idcliente'] = $_POST['txtIdCliente'];
}
if (!isset($_SESSION['idventa'])) {
	$_SESSION['idventa'] = $_POST['txtIdVenta'];
}

// Añadido para traer la fecha de venta
if (!isset($_SESSION['fecha'])) {
	$_SESSION['fecha'] = $_POST['txtFecha'];
}

// Inicializando la variable addClient en el array asociativo $_SESSION
if (!isset($_SESSION["addClient"])) {
	$_SESSION['addClient'] = false;
}

// Cuando se dé clic al botón se indica a frmBuscarCliente que queremos añadir un cliente
// if (isset($_SESSION["addClient"])) {
// 	echo "addClient no es null, es: ";
// 	var_dump($_SESSION["addClient"]);
// } else {
// 	echo "addClient es null";
// }

// Por eliminar
// $_SESSION["addClient"] = true; 


// Por eliminar
// Añadiendo ID Producto
// if(!isset($_SESSION['idproducto'])){
// 	$_SESSION['idproducto'] = $_POST['idproducto'];
// }
// ----------------------------------------------

if (!isset($_SESSION['nuevocliente'])) {
	$_SESSION['nuevocliente'] = "existe";
}

// if ($_POST['botones'] == "Nuevo") {
// 	nuevo();
// }

function nuevo()
{
	$_SESSION["cliente"] = "";
	$_SESSION["idcliente"] = "";
	$_SESSION["idventa"] = "";
	$_SESSION['fecha'] = "";

	$_SESSION['posCart'] = 0;
	// Indicamos que no queremos añadir un usuario aún desde el formulario de búsqueda
	$_SESSION["addClient"] = false;

	$_SESSION["carrito"] = new Carrito();
}

function switchAddClient()
{
	// Cuando se dé clic al botón se indica a frmBuscarCliente que queremos añadir un cliente
	$_SESSION["addClient"] = true;
}

// Mostrando el carrito
echo "El carrito de productos contiene los siguientes datos: ";
echo ("<pre>");
print_r($_SESSION['carrito']);
echo ("</pre>");

function quitarProducto()
{
	echo "El valor de la posición es: ";
	echo $_POST['posicionCart'];
	echo "<br>";
	// Elimina uno de los registros de produtos si es que la variable "pelim" no es nulo
	if ($_POST['posicionCart']) {
		if ($_POST['posicionCart'] == 1) {
			$_SESSION["carrito"]->Eliminar(1);
			$posicion = 1;
		} 
		else {
			$_SESSION['posCart'] = $_POST['posicionCart'] - 1;
			$posicion = $_SESSION['posCart'];
			$_SESSION["carrito"]->Eliminar($posicion);
		}
		echo "Producto quitado del carrito en la posición: $posicion";
		updatePosCart();
	} else {
		echo "posicionCart está nulo o vacío";
	}
}

updatePosCart();

function updatePosCart()
{
	for ($i = 0; $i < $_SESSION['carrito']->getDim(); $i++) {
		$_SESSION['cart'][$i] = $i;
	}
}
?>

<html>

<head>
	<title>Venta de Productos</title>
	<script>
		var miPopup

		function abreBuscarCliente() {
			miPopup = window.open("frmBuscarCliente.php", "miwin", "width=800,height=500,scrollbars=yes")
			miPopup.focus()
		}

		function abreBuscarProducto() {
			miPopup = window.open("frmBuscarProducto.php", "miwin", "width=800,height=550,scrollbars=yes")
			miPopup.focus()
		}

		function abreBuscarVenta() {
			miPopup = window.open("frmBuscarVenta.php", "miwin", "width=800,height=450,scrollbars=yes")
			miPopup.focus()
		}
	</script>

	<!-- Llamada a la CSS -->
	<link rel="stylesheet" href="css/estilo.css" type="text/css" />
</head>

<body>

	<center>
		<form id="form1" name="form1" method="post" action="frmVenta.php">
			<fieldset id="form">
				<legend>REGISTRO DE VENTAS </legend>
				<table width="642" border="0">
					<tr>
						<td> </td>
						<td>
							<?php
							if ($_GET['pid_ven']) {
								$id_ven = $_GET['pid_ven'];
								$_SESSION["idventa"] = $id_ven;
							}
							?>
							<input name="txtIdVenta" type="hidden" readonly="true" value="<?php echo $_SESSION["idventa"]; ?>" id="txtIdVenta" />
						</td>
					</tr>
					<tr>
						<td width="79"><label>Fecha</label></td>
						<td width="253"><label>
								<?php
								if ($_GET['pfecha']) {
									$fecha = $_GET['pfecha'];
								}
								?>
								<input name="txtFecha" type="date" maxlength="8" size="8" value="<?php echo $_SESSION['fecha']; ?>" id="txtFecha" />
							</label>
						</td>
					</tr>
					<tr>
						<td><label>Cliente</label></td>
						<td><label>
								<?php
								// Por método GET se obtiene el nombre del cliente
								if ($_GET['pnom_cli']) {
									$nom_cli = $_GET['pnom_cli'];
									$_SESSION["cliente"] = $nom_cli;
								}
								?>

								<!-- Nombre del cliente en un input -->
								<input name="txtNombreCli" type="text" value="<?php echo $_SESSION["cliente"]; ?>" id="txtNombreCli" />

								<!-- Buscar cliente con "a href" -->
								<!-- <a href="#" onClick="abreBuscarCliente()">
									Buscar
								</a> -->

								<!-- Buscar un Cliente en una ventana emergente con frmBuscarCliente y cambiar el switch $_SESSION 'addClient' -->
								<input type="submit" name="botones" value="Buscar Cliente" onclick="abreBuscarCliente()">

								<?php
								//href="frmBuscarCliente.php" 

								// Por método GET obtiene el ID del cliente
								if ($_GET['pid_cli']) {
									$id_cli = $_GET['pid_cli'];
									$_SESSION["idcliente"] = $id_cli;
								}
								?>
								<input name="txtIdCliente" type="hidden" readonly="true" size="3" value="<?php echo $_SESSION['idcliente']; ?>" id="txtIdCliente" />
							</label></td>
					</tr>

					<!-- Agregar Producto con ventana emergente -->
					<tr>
						<td colspan="2">
							<center><a href="#" onClick="abreBuscarProducto()"><b> Agregar Productos <b></a></center>
							<?php



							// Mostrando la lista de carrito de compras o PRODUCTOS a comprar
							echo "<table border='1' align='left'>";
							echo "<tr bgcolor='black' align='center'>
									<td width='420'><font color='white'>Descripcion</font></td>
									<td width='200' ><font color='white'> Categoria</font></td>		   		   
									<td><font color='white'> Precio</font></td>
									<td><font color='white'> Cantidad</font></td>
									<td><font color='white'> Subtotal</font></td>
									<td><font color='white'>*</font></td></tr>";
							if ($_SESSION['carrito']->getDim() > 0) {
								$total = 0;
								for ($k = 1; $k <= $_SESSION['carrito']->getDim(); $k++) {
									$aux = new Producto();
									$productos = $aux->buscarPorCodigo($_SESSION['carrito']->getProducto($k - 1));

									while ($g = mysqli_fetch_object($productos)) {
										$cant = $_SESSION['carrito']->getCantidad($k - 1);
										$prec = $_SESSION['carrito']->getPrecio($k - 1);
										$subt = $cant * $prec;
										$total = $total + $subt;

										$pos_aux = $_SESSION['cart'][$k - 1];

										echo "<tr bgcolor='44BB77'>";
										echo "<td>$g->descripcion</td>";
										echo "<td>$g->nombre</td>";
										echo "<td>$prec</td>";
										echo "<td>$cant</td>";
										echo "<td>$subt</td>";

										// Quitando producto del carro vía método GET
										// echo "<td>
										// 		<a href='frmVenta.php?
										// 			pelim=$k'>
										// 		 Quitar 
										// 		</a>
										// 	</td>";

										// Quitar un producto del carrito o lista de productos vía un botón input
										echo "<td>
												<input type=\"submit\" name=\"botones\" class=\"btn\" value=\"Quitar\" />
												
												<input name=\"posicionCart$k\" type=\"text\" value=\" $pos_aux \"  />
											</td>";
										echo "</tr>";
									}
								}
								echo "<tr><td colspan='4'>TOTAL</td><td>$total</td></tr>";
							}
							echo "</table>";

							?>
						</td>
					</tr>
					<tr>
						<!-- Salto de línea o espacios -->
						<td>&nbsp;</td>
						<td><label></label></td>
					</tr>
					<tr>
						<td colspan="2">
							<center> <label>
									<input type="submit" name="botones" class="btn" value="Nuevo" />
									<input type="submit" name="botones" class="btn" value="Guardar" />
									<input type="submit" name="botones" class="btn" value="Modificar" />
									<input type="submit" name="botones" class="btn" value="Eliminar" />
									<input type="button" name="botones" class="btn" value="Busqueda" onClick="abreBuscarVenta()" />
								</label></center>
						</td>
					</tr>
				</table>
		</form>
	</center>

	<?php
	function guardar()
	{
		if ($_POST['txtIdCliente'] && $_POST['txtNombreCli'] && $_POST['txtFecha']) {
			$obj = new Venta();
			$obj->setFecha($_POST['txtFecha']);
			$obj->setIdCliente($_POST['txtIdCliente']);
			if ($obj->guardar()) {
				for ($k = 1; $k <= $_SESSION['carrito']->getDim(); $k++) {
					$obj = new Venta();
					$obj2 = new DetalleVenta();
					$obj2->setIdVenta($obj->ultimo_codigo());
					$obj2->setIdProducto($_SESSION['carrito']->getProducto($k - 1));
					$obj2->setPreciov($_SESSION['carrito']->getPrecio($k - 1));
					$obj2->setCantidad($_SESSION['carrito']->getCantidad($k - 1));
					$obj2->guardar();
				}
				echo "Venta Guardada..!!!";
			} else
				echo "Error al guardar la Venta";
		} else
			echo "Guardar:Campos obligatorios";
	}

	function modificar()
	{
		if ($_POST['txtIdCliente'] && $_POST['txtNombreCli'] && $_POST['txtFecha'] && $_POST['txtIdVenta']) {
			$obj2 = new DetalleVenta();
			$obj2->setIdVenta($_POST['txtIdVenta']);
			$obj2->eliminardetalle();
			for ($k = 1; $k <= $_SESSION['carrito']->getDim(); $k++) {
				$obj2->setIdProducto($_SESSION['carrito']->getProducto($k - 1));
				$obj2->setPreciov($_SESSION['carrito']->getPrecio($k - 1));
				$obj2->setCantidad($_SESSION['carrito']->getCantidad($k - 1));
				$obj2->guardar();
			}
			$obj = new Venta();
			$obj->setIdVenta($_POST['txtIdVenta']);
			$obj->setIdCliente($_POST['txtIdCliente']);
			$obj->setFecha($_POST['txtFecha']);
			if ($obj->modificar2()) {
				echo "Venta Modificada..!!!";
			} else
				echo "Error al Modificar la Venta";
		} else
			echo "Modificar::Campos obligatorios";
	}

	function eliminar()
	{
		if ($_POST['txtIdCliente'] && $_POST['txtNombreCli'] && $_POST['txtFecha'] && $_POST['txtIdVenta']) {
			$obj2 = new DetalleVenta();
			$obj2->setIdVenta($_POST['txtIdVenta']);
			$obj2->setIdProducto($_SESSION['carrito']->getProducto(0));
			$obj2->eliminardetalle();
			$obj = new Venta();
			$obj->setIdVenta($_POST['txtIdVenta']);
			if ($obj->eliminar()) {
				echo "Venta Eliminada..!!!";
			} else
				echo "Error al Eliminar la Venta";
		} else
			echo "Eliminar::Campos obligatorios";
	}

	//hasta aqui el programa principal
	switch ($_POST['botones']) {
		case "Guardar": {
				guardar();
			}
			break;

		case "Modificar": {
				modificar();
			}
			break;

		case "Eliminar": {
				eliminar();
			}
			break;

		case "Nuevo": {
				nuevo();
			}
			break;

		case "Buscar Cliente": {
				switchAddClient();
			}
			break;

		case "Quitar": {
				quitarProducto();
			}
			break;
	}
	?>

</body>

</html>
<?php
ob_end_flush();
?>