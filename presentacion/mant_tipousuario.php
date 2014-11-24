<?php
session_start();
if(!isset($_SESSION['Usuario']))
{
	header("location: ../presentacion/login.php?error=1");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
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

  check_input("txtDescripcion", 1, "El tipo de usuario debe tener una descripcion");
  
  if (error == true) {
    alert(error_message);
    return false;
  } else {
    submitted = true;
    return true;
  }
}
//--></script>
<link href="../css/estilosistema.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="titulo01">MANTENIMIENTO DE TIPO DE USUARIO</div>
<form id="form1" name="formMant" method="post" action="<?php echo '../negocio/cont_tipousuario.php?accion='.$_GET['accion']?>" onSubmit="return check_form(formMant);">
<?php
if($_GET['accion']=='ACTUALIZAR'){
require("../datos/cado.php");
require("../negocio/cls_tipousuario.php");
$objTipoUsuario = new clsTipoUsuario();
$rst = $objTipoUsuario->buscar($_GET['IdTipoUsuario'],'');
$dato = $rst->fetchObject();
}
?>
  <p>
    <input name="txtIdTipoUsuario" type="hidden" id="txtIdTipoUsuario"  value="<?php if($_GET['accion']=='ACTUALIZAR') echo $dato->idtipousuario;?>"/>
  </p>
<table width="400" class="tablaint" align="center">
  <tr>
    <td class="alignright">Descripci�n:</td>
    <td><input name="txtDescripcion" type="text" id="txtDescripcion" value="<?php if($_GET['accion']=='ACTUALIZAR') echo $dato->descripcion;?>" style="text-transform:uppercase"/></td>
  </tr>
  <tr>
    <th colspan="2"><input type='submit' name = 'grabar' value='GRABAR' />
      <input type='reset' name = 'cancelar' value='CANCELAR' onclick="javascript:window.open('list_tipousuario.php','_self')" /></th>
    </tr>
</table>

</form>
</body>
</html>
