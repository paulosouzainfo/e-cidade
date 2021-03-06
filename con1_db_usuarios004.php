<?
/*
 *     E-cidade Software Publico para Gestao Municipal                
 *  Copyright (C) 2013  DBselller Servicos de Informatica             
 *                            www.dbseller.com.br                     
 *                         e-cidade@dbseller.com.br                   
 *                                                                    
 *  Este programa e software livre; voce pode redistribui-lo e/ou     
 *  modifica-lo sob os termos da Licenca Publica Geral GNU, conforme  
 *  publicada pela Free Software Foundation; tanto a versao 2 da      
 *  Licenca como (a seu criterio) qualquer versao mais nova.          
 *                                                                    
 *  Este programa e distribuido na expectativa de ser util, mas SEM   
 *  QUALQUER GARANTIA; sem mesmo a garantia implicita de              
 *  COMERCIALIZACAO ou de ADEQUACAO A QUALQUER PROPOSITO EM           
 *  PARTICULAR. Consulte a Licenca Publica Geral GNU para obter mais  
 *  detalhes.                                                         
 *                                                                    
 *  Voce deve ter recebido uma copia da Licenca Publica Geral GNU     
 *  junto com este programa; se nao, escreva para a Free Software     
 *  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA          
 *  02111-1307, USA.                                                  
 *  
 *  Copia da licenca no diretorio licenca/licenca_en.txt 
 *                                licenca/licenca_pt.txt 
 */

require("libs/db_stdlib.php");
require("libs/db_conecta.php");
include("libs/db_sessoes.php");
include("libs/db_utils.php");
include("libs/db_usuariosonline.php");
include("dbforms/db_funcoes.php");
include("classes/db_db_usuarios_classe.php");
include("classes/db_db_usuacgm_classe.php");
include("classes/db_db_userinst_classe.php");
include("classes/db_db_depusu_classe.php");

$cldb_usuarios = new cl_db_usuarios;
$cldb_usuacgm = new cl_db_usuacgm;
$cldb_userinst = new cl_db_userinst;
$cldb_depusu = new cl_db_depusu;
db_postmemory($HTTP_POST_VARS);

$db_opcao = 1;
$db_botao = true;
if(isset($incluir)){
  $sqlerro=false;
  db_inicio_transacao();
  $cldb_usuarios->senha = Encriptacao::encriptaSenha($senha);
  $cldb_usuarios->nome  = "$z01_nome";
  $cldb_usuarios->usuext="0";
  $cldb_usuarios->incluir(null);
  if($cldb_usuarios->erro_status==0){

    $senha = '';
    $sqlerro=true;
  }
  $id_usuario= $cldb_usuarios->id_usuario;
  $erro_msg = $cldb_usuarios->erro_msg;
  if ($sqlerro==false){
  	$cldb_usuacgm->id_usuario=$id_usuario;
  	$cldb_usuacgm->cgmlogin=$z01_numcgm;
  	$cldb_usuacgm->incluir($id_usuario);
  	if($cldb_usuacgm->erro_status==0){
    	$sqlerro=true;
    	$erro_msg = $cldb_usuacgm->erro_msg;
  	}
  }
  if ($sqlerro==false){
  	for($i = 0;$i < sizeof($instit);$i++){
  		$cldb_userinst->id_usuario=$id_usuario;
  		$cldb_userinst->id_instit=$instit[$i];
  		$cldb_userinst->incluir();
  		if($cldb_userinst->erro_status==0){
    		$sqlerro=true;
    		$erro_msg = $cldb_userinst->erro_msg;
  		}
  	}
  }
  db_fim_transacao($sqlerro);
   $id_usuario= $cldb_usuarios->id_usuario;
   $db_opcao = 1;
   $db_botao = true;
}
?>
<html>
<head>
<title>DBSeller Inform&aacute;tica Ltda - P&aacute;gina Inicial</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="Expires" CONTENT="0">
<script language="JavaScript" type="text/javascript" src="scripts/scripts.js"></script>
<link href="estilos.css" rel="stylesheet" type="text/css">
</head>
<body bgcolor=#CCCCCC leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="a=1" >
<table width="790" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="430" align="left" valign="top" bgcolor="#CCCCCC">
    <center>
	<?
	include("forms/db_frmdb_usuarios.php");
	?>
    </center>
	</td>
  </tr>
</table>
</body>
</html>
<?
if(isset($incluir)){
  if($sqlerro==true){
    db_msgbox($erro_msg);
    if($cldb_usuarios->erro_campo!=""){
      echo "<script> document.form1.".$cldb_usuarios->erro_campo.".style.backgroundColor='#99A9AE';</script>";
      echo "<script> document.form1.".$cldb_usuarios->erro_campo.".focus();</script>";
    };
  }else{
   db_msgbox($erro_msg);
   db_redireciona("con1_db_usuarios005.php?liberaaba=true&chavepesquisa=$id_usuario");
  }
}
?>