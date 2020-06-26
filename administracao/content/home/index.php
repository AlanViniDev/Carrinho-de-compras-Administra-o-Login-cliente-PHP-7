<?php 
	if(isset($_GET['acao']) == 'logar')
	{
		include_once('../../inc/conexao.php');
		
		$usuario = $_POST['usuario'];
		$senha = $_POST['senha'];

        $pdo = $conexao->query("SELECT * FROM administradores WHERE email = '$usuario' AND senha = '$senha'");
        $count = $pdo->rowCount();

		//$select = $conexao->query("SELECT * FROM administradores WHERE email = '$usuario' AND senha = '$senha'");
        //$result = $select->fetchAll(PDO::FETCH_ASSOC);
       // print_r($result);

        if($count == 1)
		{
			session_start();
			
			$_SESSION['autenticacao'] = TRUE;
			
			header('Location: index2.php');
		}
		else
		{
			echo 'Seus dados nao conferem.';
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Painel de Controle</title>
    <link href="../../css/admin.css" rel="stylesheet" type="text/css" />	
</head>
<script language="JavaScript" type="text/javascript">
	function abrir (ID){
		if (document.getElementById(ID).style.display == "none"){
			document.getElementById(ID).style.display= "";
		}
	}
	function fechar (ID){
		if (document.getElementById(ID).style.display == ""){
			document.getElementById(ID).style.display= "none";
		}
	}
</script>
<body>
    <div class="CabecalhoFaixa">
    </div>
    <div id="Total">
        <div id="SubTotal">
            <div class="FundoLogo">
                <div class="Logo"> 
                </div>
            </div>
            <div id="Menus">
                <div id="SubMenus">
                    <!-- Aqui coloca-se o menu -->
                </div>
            </div>
            <div id="Conteudo">
                <div id="SubConteudo">
                    <!-- Aqui coloca-se o conteudo -->
                    <p class="titulo">
                        Autenticação de usuário</p>
                    <p class="linhadivisoriacentro">
                        <img alt="Linha Divissão" src="../../img/linha-divisoria-centro.png" /></p>
                    <p class="descricao">
                        Por favor informe seus dados:</p>
                    <br />
                    <br />
                    <form action="index.php?acao=logar" method="post" name="logar">
                    	<p class="legendacaixasdetexto">
                            Usuário:
                            <input name="usuario" type="text" class="caixatexto" value="Digite o usuário:"
                                onfocus="javascript: if(this.value == 'Digite o usuário:'){this.value = ''; }"
                                onblur="javascript: if(this.value == ''){this.value = 'Digite o usuário:';}" />
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Senha:
                            <input name="senha" type="password" class="caixatexto" value=""
                                onfocus="javascript: if(this.value==''){this.value = ''; }" onblur="javascript: if(this.value==''){this.value='';}" />
                            &nbsp;&nbsp;
                            <input name="btnlogar" type="image" src="../../img/botao.png" />
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            
	                    </p>
                        <input name="acessar" type="hidden" value="acessar" />
                    </form>

                    <br />
                    <p class="linhadivisoriacentro">
                        <img alt="Linha Divissão" src="../../img/linha-divisoria-centro.png" /></p>
                    </div>
                </div>
            </div>
            <div id="Rodape">
        
            </div>
        </div>
    </div>
</body>
</html>