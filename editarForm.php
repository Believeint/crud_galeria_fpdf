<?php

	error_reporting( ~E_NOTICE );
	
	require_once 'dbconfig.php';
	
	if(isset($_GET['editar_id']) && !empty($_GET['editar_id']))
	{
		$id = $_GET['editar_id'];
		$stmt_edit = $DB_con->prepare('SELECT nomeUsuario, profissaoUsuario, imagemUsuario FROM tbl_usuario WHERE idUsuario =:idU');
		$stmt_edit->execute(array(':idU'=>$id));
		$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
		extract($edit_row);
	}
	else
	{
		header("Location: index.php");
	}
	
	
	
	if(isset($_POST['btn_save_updates']))
	{
		$usuario = $_POST['nome_usuario'];// Nome de Usuario
		$profUsuario = $_POST['profissao_usuario'];// Email de Usuario
			
		$arquivoImagem = $_FILES['imagem_usuario']['name'];
		$dir_tmp = $_FILES['imagem_usuario']['tmp_name'];
		$tamanhoImagem = $_FILES['imagem_usuario']['size'];
					
		if($arquivoImagem)
		{
			$dir_upload = 'imagem_usuarios/'; // upload directory	
			$ext_imagem = strtolower(pathinfo($arquivoImagem,PATHINFO_EXTENSION)); // get image extension
			$extensoes_validas = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
			$imgUsuario = rand(1000,1000000).".".$ext_imagem;
			if(in_array($ext_imagem, $extensoes_validas))
			{			
				if($tamanhoImagem < 5000000)
				{
					unlink($dir_upload.$edit_row['imagemUsuario']);
					move_uploaded_file($dir_tmp,$dir_upload.$imgUsuario);
				}
				else
				{
					$msgErro = "Desculpe, Seu arquivo é muito grande, deve ter no máximo 5MB";
				}
			}
			else
			{
				$msgErro = "Desculpe, Somente são permitidos arquivos JPG, JPEG, PNG & GIF.";		
			}	
		}
		else
		{
			// Se a imagem não for trocada, permanece a mesma
			$imgUsuario = $edit_row['imagemUsuario']; // imagem antiga do banco
		}	
						
		
		// if no error occured, continue ....
		if(!isset($msgErro))
		{
			$stmt = $DB_con->prepare('UPDATE tbl_usuario 
									     SET nomeUsuario=:nomeU, 
										     profissaoUsuario=:profU, 
										     imagemUsuario=:imgU 
								       WHERE idUsuario=:idU');
			$stmt->bindParam(':nomeU',$nomeUsuario);
			$stmt->bindParam(':profU',$profissaoUsuario);
			$stmt->bindParam(':imgU',$imgUsuario);
			$stmt->bindParam(':idU',$id);
				
			if($stmt->execute()){
				?>
                <script>
				alert('Atualizado com Sucesso ...');
				window.location.href='index.php';
				</script>
                <?php
			}
			else{
				$msgErro = "Não foi possível atualizar os dados !";
			}
		
		}
		
						
	}
	
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" content="pt-br"/>
<title>Envie, Atualize, Delete uma Imagem usando PHP MySQL</title>

<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">

<!-- custom stylesheet -->
<link rel="stylesheet" href="style.css">

<!-- Latest compiled and minified JavaScript -->
<script src="bootstrap/js/bootstrap.min.js"></script>

<script src="jquery-1.11.3-jquery.min.js"></script>
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
</div>


<div class="container">


	<div class="page-header">
    	<h1 class="h2">Atualizar perfil <a class="btn btn-default" href="index.php"> Todas as Pessoas </a></h1>
    </div>

<div class="clearfix"></div>

<form method="post" enctype="multipart/form-data" class="form-horizontal">
	
    
    <?php
	if(isset($msgErro)){
		?>
        <div class="alert alert-danger">
          <span class="glyphicon glyphicon-info-sign"></span> &nbsp; <?php echo $msgErro; ?>
        </div>
        <?php
	}
	?>
   
    
	<table class="table table-bordered table-responsive">
	
    <tr>
    	<td><label class="control-label">Usuario.</label></td>
        <td><input class="form-control" type="text" name="nome_usuario" value="<?php echo $nomeUsuario; ?>" required /></td>
    </tr>
    
    <tr>
    	<td><label class="control-label">Profissão</label></td>
        <td><input class="form-control" type="text" name="profissao_usuario" value="<?php echo $profissaoUsuario; ?>" required /></td>
    </tr>
    
    <tr>
    	<td><label class="control-label">Imagem de Perfil</label></td>
        <td>
        	<p><img src="imagem_usuarios/<?php echo $imagemUsuario; ?>" height="150" width="150" /></p>
        	<input class="input-group" type="file" name="imagem_usuario" accept="image/*" />
        </td>
    </tr>
    
    <tr>
        <td colspan="2"><button type="submit" name="btn_save_updates" class="btn btn-default">
        <span class="glyphicon glyphicon-save"></span> Atualizar
        </button>
        
        <a class="btn btn-default" href="index.php"> <span class="glyphicon glyphicon-backward"></span> Cancelar </a>
        
        </td>
    </tr>
    
    </table>
    
</form>

</div>
</body>
</html>