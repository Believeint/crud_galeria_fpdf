<?php
require 'dbconfig.php';

$id = $_REQUEST['gerar_pdf'];

$stmt = $DB_con->prepare('SELECT nomeUsuario, profissaoUsuario, imagemUsuario FROM tbl_usuario WHERE idUsuario=:idU');
$stmt->execute(['idU' => $id]);
$usuario = $stmt->fetch();

$nome = $usuario['nomeUsuario'];
$profissao = $usuario['profissaoUsuario'];
$imagem = $usuario['imagemUsuario'];

require 'fpdf.php';

$pdf = new FPDF('P', 'mm', 'A4');
$pdf->AddPage();

$pdf->SetXY(80, 20);
$pdf->SetFont('Arial', 'B', 16);
$pdf->SetTextColor(0,0, 60);
$pdf->Cell(0, 10, "Perfil do Usuário", 1, 1, "Right text", 0, 0, 'C');
$pdf->GetX(100);

$pdf->SetXY(80, 35);
$pdf->SetFont('Arial', 'B', 16);
$pdf->SetTextColor(11, 80, 145);
$pdf->Cell(0, 10, "Nome: $nome", 0, 0, 'L');

$pdf->SetXY(80, 35);
$pdf->SetFont('Arial', 'B', 16);
$pdf->SetTextColor(11, 80, 145);
$pdf->Cell(0, 30, "Profissão: $profissao");

$pdf->Image("imagem_usuarios/$imagem", 10, 20, 50, 50);

$pdf->Output();
