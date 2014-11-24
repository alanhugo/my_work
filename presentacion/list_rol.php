<?php
session_start();
if(!isset($_SESSION['Usuario']))
{
	header("location: ../presentacion/login.php?error=1");
}

?>

<html>
<link href="../css/estilosistema.css" rel="stylesheet" type="text/css">
<body>
<div id="barramenusup" style="display:none"> <!-- inicio menu superior -->
			<ul>
                <li><?php echo $_SESSION['Sucursal'];?></li>
                <li>Bienvenido:<img src="../imagenes/user_suit.png" alt="usuario"> <?php echo $_SESSION['Usuario']?></li>
                <li><a href="main.php"><img src="../imagenes/application_home.png">Ir a Menu</a></li>
                <li><a href='../negocio/cont_usuario.php?accion=LOGOUT'><img src="../imagenes/door_in.png" alt="salir" width="16" height="16" longdesc="Cerrar Sesi�n"> Cerrar sesion </a></li>
            </ul>
</div>
<center>
<img src="../imagenes/encabezado.gif">
</center>
<form action="mant_rol.php?accion=NUEVO" method="POST">

<table width="400" class="tablaint">
<tr>
<th>C�digo</th>
<th>Descripci�n</th>
<th colspan="2">Operaciones</th>
</tr>
<tr>
<?php
require("../datos/cado.php");
require("../negocio/cls_rol.php");
$objRol = new clsRol();
$rst = $objRol->consultar();
while($dato = $rst->fetchObject())
{
?>
<td><?php echo $dato->IdRol?></td>
<td><?php echo $dato->descripcion?></td>
<td><a href="mant_rol.php?accion=ACTUALIZAR&IdRol=<?php echo $dato->IdRol;?>"> <img src="../imagenes/editar_.jpg" width="16" height="16">Actualizar </a></td>
<td><a href="../negocio/cont_rol.php?accion=ELIMINAR&IdRol=<?php echo $dato->IdRol;?>"> <img src="../imagenes/eliminar.jpg" width="16" height="16">Eliminar </a></td>
</tr>
<?php }?>
</table>
<table width="400">
  <tr>
    <th><input type="submit" name = 'NUEVO' value="NUEVO"></th>
  </tr>
</table>

</form>
</body>
</html>