<?php
session_start();
if(!isset($_SESSION['Usuario']))
{
	header("location: ../presentacion/login.php?error=1");
}
?>
<html>
<head>
<script type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>
<script language="javascript"><!--
var form = "";
var submitted = false;
var error = false;
var error_message = "";

function check_input(field_name, field_size, message) {
  if (form.elements[field_name] && (form.elements[field_name].type != "hidden")) {
    var field_value = form.elements[field_name].value;

    if (field_value.length < field_size) {
      error_message = error_message + "* " + message + "\n";
      error = true;
    }
  }
}

function check_select(field_name, field_default, message) {
  if (form.elements[field_name] && (form.elements[field_name].type != "hidden")) {
    var field_value = form.elements[field_name].value;

    if (field_value == field_default) {
      error_message = error_message + "* " + message + "\n";
      error = true;
    }
  }
}

function check_form(form_name) {
  if (submitted == true) {
    alert("Ya ha enviado el formulario. Pulse Aceptar y espere a que termine el proceso.");
    return false;
  }

  error = false;
  form = form_name;
  error_message = "Hay errores en su formulario!\nPor favor, haga las siguientes correciones:\n\n";

  check_input("txtNombre", 1, "La talla debe tener una Nombre");

  check_input("txtAbreviatura", 1, "La talla debe tener una Abreviatura");
  
  if (error == true) {
    alert(error_message);
    return false;
  } else {
    submitted = true;
    return true;
  }
}
//--></script>
<link href="../css/estilosistema.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="titulo01">MANTENIMIENTO DE TALLA</div>
<?php 
if(isset($_GET['origen'])) {
	if($_GET['origen']=='PROD') {
	$origen=$_GET['origen'].'&accionprod='.$_GET['accionprod'].'&idprod='.$_GET['idprod'];
	}else {$origen='LIST';}	
}else {$origen='LIST';}
?>
<form action=<?php echo '../negocio/cont_talla.php?accion='.$_GET['accion'].'&origen='.$origen?> method='POST' onSubmit="return check_form(formMantTalla);" name="formMantTalla"><input type='hidden' name = 'txtIdTalla' value = '<?php if($_GET['accion']=='ACTUALIZAR')
echo $_GET['idTalla'];?>'>
<?php
if($_GET['accion']=='ACTUALIZAR'){
require("../datos/cado.php");
require("../negocio/cls_talla.php");
$objTalla = new clsTalla();
$rst = $objTalla->buscar($_GET['idTalla'],'','','');
$dato = $rst->fetchObject();
}?>
<BR>
<table width="300" align="center" class="tablaint">
  <tr>
    <td class="alignright">Nombre :</td>
    <td><input type='text' name = 'txtNombre' value = '<?php if($_GET['accion']=='ACTUALIZAR')
echo $dato->Nombre;?>' style="text-transform:uppercase"></td>
  </tr>
  <tr>
    <td class="alignright">Abreviatura :</td>
    <td><input type='text' name = 'txtAbreviatura' value = '<?php if($_GET['accion']=='ACTUALIZAR')
echo $dato->Abreviatura;?>' size="5" maxlength="5" style="text-transform:uppercase"></td>
  </tr>
  <tr>
    <td colspan="2"><?php
/*
echo "ESTADO : ";
echo "<select name='cboEstado'>";

$seleccionar="";
if($_GET['accion']=='ACTUALIZAR'){if($dato->Estado=='A') $seleccionar="selected";}
echo "<option value='N'>NORMAL</option>";
echo "<option value='A' ".$seleccionar.">DESACTIVADO</option>";
echo "</select>";
*/
?></td>
    </tr>
  <tr>
    <th colspan="2"><input type='submit' name = 'grabar' value='GRABAR'>
      <input type='button' name = 'cancelar' value='CANCELAR' onClick="javascript: <?php if($_GET['origen']=='PROD') echo "window.close();"; else echo "window.open('list_talla.php','_self');";?>"></th>
    </tr>
</table>
</form>
</body>
</html>