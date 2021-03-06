<?php 
	session_start();
	
	if($_SESSION['autenticacao'] != TRUE)
	{
		header('Location: ../home/index.php');
	}
	
	if(isset($_POST['acao']))
	{
		include_once('../../inc/conexao.php');
		
		switch($_POST['acao'])
		{
			case 'salvar':
				$categoria = $_POST['nome_categoria'];
				
				$resultado = mysql_query("INSERT INTO categorias (categoria) VALUES ('$categoria')");
				
				if($resultado)
				{
					echo 'Cadastro realizado com sucesso.';
				}
				else
				{
					echo 'Seu cadastro n�o pode ser realizado.';
				}
				
				break;
			case 'localizar':
				$id = $_POST['id'];
				
				$resultado = mysql_query("SELECT * FROM categorias WHERE idcategoria = '$id' ORDER BY categoria");
				$dados_categoria = mysql_fetch_array($resultado);
				
				break;
			case 'atualizar':
				$id = $_POST['id'];
				$categoria = $_POST['nome_categoria'];
				
				$resultado = mysql_query("UPDATE categorias SET categoria = '$categoria' WHERE idcategoria = '$id'");
				
				if($resultado)
				{
					echo 'Cadastro alterado com sucesso.';
				}
				else
				{
					echo 'Seu cadastro n�o pode ser alterado.';
				}
				
				break;
			case 'excluir':
				$id = $_POST['id'];
				
				$resultado = mysql_query("DELETE FROM categorias WHERE idcategoria = '$id'");
				
				if($resultado)
				{
					echo 'Cadastro excluido com sucesso.';
				}
				else
				{
					echo 'Seu cadastro n�o pode ser excluido.';
				}
				
				break;
		}
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Painel de Controle</title>
    <link href="../../css/admin.css" rel="stylesheet" type="text/css" />
    <link href="../../css/menu.css" rel="stylesheet" type="text/css" />

    <script type="text/javascript">
        var menuids=["sidebarmenu1"]
        function initsidebarmenu()
        {
            for (var i=0; i<menuids.length; i++)
            {
                var ultags=document.getElementById(menuids[i]).getElementsByTagName("ul")
                for (var t=0; t<ultags.length; t++)
                {
                    ultags[t].parentNode.getElementsByTagName("a")[0].className+=" subfolderstyle"
                    if (ultags[t].parentNode.parentNode.id==menuids[i])
                        ultags[t].style.left=ultags[t].parentNode.offsetWidth+"px"
                    else
                        ultags[t].style.left=ultags[t-1].getElementsByTagName("a")[0].offsetWidth+"px" 
                        ultags[t].parentNode.onmouseover=function(){
                        this.getElementsByTagName("ul")[0].style.display="block"
                }
            ultags[t].parentNode.onmouseout=function(){
            this.getElementsByTagName("ul")[0].style.display="none"
            }
        }
        for (var t=ultags.length-1; t>-1; t--){
        ultags[t].style.visibility="visible"
        ultags[t].style.display="none"
        }
        }
        }
        if (window.addEventListener)
        window.addEventListener("load", initsidebarmenu, false)
        else if (window.attachEvent)
        window.attachEvent("onload", initsidebarmenu)
    </script>
</head>

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
                    <div class="sidebarmenu" style="margin: 0 0 0 10px;">
                        <ul id="sidebarmenu1">
                            <li><a href="../home/index2.php">Pagina Inicial</a></li>
                            <li><a href="#"><b>Produtos</b>
                                <img alt="Seta Sub-menu" border="0" style="margin-left:115px;" src="../../img/seta-menu.jpg" /></a>
                                <ul>
                                    <li><a href="../categoria/index.php"><b>Categorias</b></a></li>
                                    <li><a href="../produto/index.php">Produtos</a></li>
                                </ul>
                            </li>
                            <li><a href="../pedido/index.php">Pedido de Produtos</a></li>
                            <li><a href="../clientes/index.php">Cadastro de Clientes</a></li>
                            <li> <a href="#"> &nbsp; </a> </li>
                            
                            <li><a href="../usuario/index.php"> Cadastro de Usu&aacute;rio </a></li>
                            <li><a href="../../inc/sair_sistema.php">[Sair]</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div id="Conteudo">
                <div id="SubConteudo">
                    <!-- Aqui coloca-se o conteudo -->
                    <p class="titulo">
                        Categorias</p>
                    <p class="linhadivisoriacentro">
                        <img alt="Linha Divissão" src="../../img/linha-divisoria-centro.png" /></p>
                    <p class="descricao">
                        Para inserir uma categoria informe os dados abaixo:</p>
                    <br />
                    <br />
                    <form action="index.php" method="post" name="clientes" enctype="multipart/form-data">
                        <p class="legendacaixasdetexto">
                            Nome da Categoria:
                        </p>
                        <p>
                            <input name="nome_categoria" type="text" value="<?php if(isset($dados_categoria['categoria'])){echo $dados_categoria['categoria'];}?>" class="caixadetexto" maxlength="100"
                             	onfocus="javascript: if(this.value == 'Digite o nome da categoria:'){this.value = ''; }"
                                	onblur="javascript: if(this.value == ''){this.value = 'Digite o nome da categoria:';}" />

                        </p>                      
                        
				
						<p class='botaoinseirealterar'>
						<input type='image' src='../../img/btn_inserir.jpg' /> </p>
                                <input type='hidden' name='inserir' value='inserir' />
                        
                        <?php 
                        if(isset($dados_categoria['categoria']) == '')
                        {
                        ?> 
                        <input name="acao" type="hidden" value="salvar" /> 
                        <?php 
                        }
                        else
                        {
                        ?> 
                        <input name="acao" type="hidden" value="atualizar" />
                        <input name="id" type="hidden" value="<?php echo $dados_categoria['idcategoria']?>" />
                        <?php
                        } 
                        ?>
                        
                    </form>
                    <p class="linhadivisoriacentro">
                        <img alt="Linha Divissão" src="../../img/linha-divisoria-centro.png" /></p>
                        
                        
                        
                        
                    <p class="descricao">
                        Lista de Categorias cadastradas:</p>
                        
<?php 
	include_once('../../inc/conexao.php');
	
// Inicio Configura��o da Pagina��o
	if(isset($_GET['pagina']))
	{
		$pagina = $_GET['pagina'];
	}
	else
	{
		$pagina = 1;
	}
	
	$numero_resultados = 15; // resultados por p�gina
	$inicio = ($pagina*$numero_resultados)-$numero_resultados;
// fim Configura��o da Pagina��o

	$resultado = mysql_query("SELECT * FROM categorias ORDER BY categoria LIMIT $inicio, $numero_resultados");
	
	while($dados = mysql_fetch_array($resultado))
	{
?>
                    <!--  Inicio repeti��o -->
                    <div class="adm_cadastrados">
                        <p class="adm_cadastrados"> 
                        	<?php echo $dados['categoria']?>
	                       </p>
                            
                        <div class="botao_Edt_Exc">
                        	<form action="index.php" method="post" name="excluir">
	                            <input type="image" src="../../img/btn_excluir.jpg" />
                                <input type='hidden' name='id' value='<?php echo $dados['idcategoria']?>' />
                                <input type='hidden' name='excluir' value='excluir' />
                                <input name="acao" type="hidden" value="excluir" />
							</form>
                        </div>
                        
                        <div class="botao_Edt_Exc">
                        	<form action="index.php" method="post" name="editar" >
	                            <input type="image" src="../../img/btn_editar.jpg" />
                                <input type='hidden' name='id' value='<?php echo $dados['idcategoria']?>' />
                                <input type='hidden' name='editar' value='editar' />
                                <input name="acao" type="hidden" value="localizar" />
							</form>
                        </div>
                        <!--  fim repeti��o -->
                           
                        <div class="linha">
                            <img alt="Linha Divissão" src="../../img/linha-divisoria-centro.png" />
                        </div>
                    </div>
<?php 
	}
?>
	                    
                    <div class="paginacao">
<?php 
	$resultado = mysql_query("SELECT * FROM categorias ORDER BY categoria");
	$num_total_registros = mysql_affected_rows();
	$quant_paginas = ceil($num_total_registros/$numero_resultados);
	$links = 5; // Quantidade de Links na Pagina��o
	
	for($i = $pagina-$links; $i <= $pagina-1; $i++)
	{
		if($i > 0)
		{
?>
			<a href="index.php?pagina=<?php echo $i?>"><?php echo $i?></a> | 						
<?php
		} 
	}
	
	echo $pagina.' | ';
	
	for($i = $pagina+1; $i <= $pagina+$links; $i++)
	{
		if($i <= $quant_paginas)
		{
?>
		<a href="index.php?pagina=<?php echo $i?>"><?php echo $i?></a> |
<?php 
		}
	}
?>
					</div>
                    
                </div>
            </div>
            <div id="Rodape">
                <br />
          
            </div>
        </div>
    </div>
</body>
</html>