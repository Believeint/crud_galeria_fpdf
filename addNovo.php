<?php

	error_reporting( ~E_NOTICE ); 
	
	require_once 'dbconfig.php';
	
	if(isset($_POST['btnSalvar']))
	{
		$usuario = $_POST['nome_usuario'];
		$profissao = $_POST['profissao_usuario'];
		
		$arquivoImagem = $_FILES['imagem_usuario']['name'];
		$dir_tmp = $_FILES['imagem_usuario']['tmp_name'];
		$tamanhoImagem = $_FILES['imagem_usuario']['size'];
		
		
		if(empty($usuario)){
			$msgErro = "Por Favor entre com seu nome";
		}
		else if(empty($profissao)){
			$msgErro = "Por Favor entre com suas profissão";
		}
		else if(empty($arquivoImagem)){
			$msgErro = "Por Selecione sua imagem de Perfil";
		}
		else
		{
			$dir_upload = 'imagem_usuarios/'; // Diretorio de Upload
	
			$extImagen = strtolower(pathinfo($arquivoImagem,PATHINFO_EXTENSION)); // Pegar extensão da imagem
		
			// valid image extensions
			$extensoes_validas = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
		
			// rename uploading image
			$imagemUsuario = rand(1000,1000000).".".$extImagen;
				
			// allow valid image file formats
			if(in_array($extImagen, $extensoes_validas)){			
				// Check file size '5MB'
				if($tamanhoImagem < 5000000)				{
					move_uploaded_file($dir_tmp,$dir_upload.$imagemUsuario);
				}
				else{
					$msgErro = "Desculpe, Seu arquivo é muito grande.";
				}
			}
			else{
				$msgErro = "Desculpe, Somente arquivos JPG, JPEG, PNG & GIF são permitidos.";		
			}
		}
		
		
		// Se não houver erros ....
		if(!isset($msgErro))
		{
			$stmt = $DB_con->prepare('INSERT INTO tbl_usuario(nomeUsuario,profissaoUsuario,imagemUsuario) VALUES(:nomeU, :profU, :imgU)');
			$stmt->bindParam(':nomeU',$usuario);
			$stmt->bindParam(':profU',$profissao);
			$stmt->bindParam(':imgU',$imagemUsuario);
			
			if($stmt->execute())
			{
				$msgSucesso = "Novo Usuario Adicionado com sucesso ...";
				header("refresh:5;index.php"); // Redireciona a imagem após 5 segundos.
			}
			else
			{
				$msgErro = "erro ao tentar inserir Usuario....";
			}
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Envie, Atualize, Delete uma Imagem usando PHP MySQL</title>

<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">

</head>
<body>

<div class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container">
 
	<div class="navbar-header">
            <a class="navbar-brand" href="#" title='Programming Blog'>Projeto PHP</a>
            <a class="navbar-brand" href="index.php">Home</a>
        </div>
 
    </div>
</div>

<div class="container">


	<div class="page-header">
    	<h1 class="h2">Add Novo Usuário <a class="btn btn-default" href="index.php"> <span class="glyphicon glyphicon-eye-open"></span> &nbsp; Ver Todos </a></h1>
    </div>
    

	<?php
	if(isset($msgErro)){
			?>
            <div class="alert alert-danger">
            	<span class="glyphicon glyphicon-info-sign"></span> <strong><?php echo $msgErro; ?></strong>
            </div>
            <?php
	}
	else if(isset($msgSucesso)){
		?>
        <div class="alert alert-success">
              <strong><span class="glyphicon glyphicon-info-sign"></span> <?php echo $msgSucesso; ?></strong>
        </div>
        <?php
	}
	?>   

<form method="post" enctype="multipart/form-data" class="form-horizontal">
	    
	<table class="table table-bordered table-responsive">
	
    <tr>
    	<td><label class="control-label">Usuario</label></td>
        <td><input class="form-control" type="text" name="nome_usuario" placeholder="Nome de Perfil" value="<?php echo $usuario; ?>" /></td>
    </tr>
    
    <tr>
    	<td><label class="control-label">Profissão</label></td>
        <td><input class="form-control" type="text" name="profissao_usuario" placeholder="Sua Profissão" value="<?php echo $profissao; ?>" /></td>
    </tr>
    
    <tr>
    	<td><label class="control-label">Imagem de Perfil</label></td>
        <td><input class="input-group" type="file" name="imagem_usuario" accept="image/*" /></td>
    </tr>
    
    <tr>
        <td colspan="2"><button type="submit" name="btnSalvar" class="btn btn-default">
        <span class="glyphicon glyphicon-save"></span> &nbsp; Salvar
        </button>
        </td>
    </tr>
    
    </table>
    
</form>

    

</div>


<script src="bootstrap/js/bootstrap.min.js"></script>


</body>
</html>