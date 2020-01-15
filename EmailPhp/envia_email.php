<?php
session_start();
 //Vareiaves
 $nome_cc = filter_input(INPUT_POST, 'campo_nome', FILTER_SANITIZE_STRING);
 $email = filter_input(INPUT_POST, 'campo_email', FILTER_SANITIZE_STRING);
 $regiao = filter_input(INPUT_POST, 'campo_regiao', FILTER_SANITIZE_STRING);
 $obs = filter_input(INPUT_POST, 'campo_obs', FILTER_SANITIZE_STRING);
 $data_envio = date('d/m/Y');
$hora_envio = date('H:i:s');

// Inclui o arquivo class.phpmailer.php localizado na mesma pasta do arquivo php 
include "../EmailPhp/PHPMailer/PHPMailerAutoload.php"; 

// Inicia a classe PHPMailer 
$mail = new PHPMailer(); 

// Método de envio 
$mail->IsSMTP(); 

// Enviar por SMTP 
$mail->Host = "smtp.office365.com"; 

// Você pode alterar este parametro para o endereço de SMTP do seu provedor 
$mail->Port = 587; 


// Usar autenticação SMTP (obrigatório) 
$mail->SMTPAuth = true; 

// Usuário do servidor SMTP (endereço de email) 
// obs: Use a mesma senha da sua conta de email 
//$mail->Username = 'webmaster@freng.com.br';
$mail->Username = 'frincorporadora@hotmail.com';
//$mail->Username = 'webmaster@freng.com.br'; 
$mail->Password = 'Fw38q1V7sN';

// Configurações de compatibilidade para autenticação em TLS 
$mail->SMTPOptions = array( 'ssl' => array( 'verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true ) ); 

// Você pode habilitar esta opção caso tenha problemas. Assim pode identificar mensagens de erro. 
 //$mail->SMTPDebug = 2; 

// Define o remetente 
// Seu e-mail 
$mail->From = "frincorporadora@hotmail.com";

// Seu nome 
$mail->FromName = "$nome_cc"; 

// Define o(s) destinatário(s) 
$mail->AddAddress("frincorporadora@hotmail.com", "CPD"); 

// Opcional: mais de um destinatário
 //$mail->AddAddress('webmaster@freng.com.br'); 

// Opcionais: CC e BCC
// $mail->AddCC('joana@provedor.com', 'Joana'); 
// $mail->AddBCC('roberto@gmail.com', 'Roberto'); 

// Definir se o e-mail é em formato HTML ou texto plano 
// Formato HTML . Use "false" para enviar em formato texto simples ou "true" para HTML.
$mail->IsHTML(true); 

// Charset (opcional) 
$mail->CharSet = 'UTF-8'; 

// Assunto da mensagem 
$mail->Subject = "Solicitação Acesso"; 

// Corpo do email 
$mail->Body = 
"<head>
<title>Document</title>

<style>
    *{
margin: 0;
padding: 0;
text-decoration: none;
font-family: montserrat;
box-sizing: border-box;
}
body{
min-height: 100vh;
background-image: linear-gradient(20deg,#195670, #1E90FF,#008B8B);

}
.login{
width: 360px;
background: #f1f1f1;
height: 380px;
padding: 40px 40px;
border-radius: 10px;
position: absolute;
left: 50%;
top: 50%;
transform: translate(-50%, -50%);
}
.form{
margin-top: 20px;
}
</style>
</head>
<body>
<div class='container-fluid'>
    <div class='row'>
        <div class='col-md-8'></div>
            <div class='col-md-4 login'>
                <form>
                    <h4>Dados para criar acesso.</h4>
                    <br>
                    <p>Olá, a baixo está os dados do usuário para criar acesso.</p>
                    <br>
                    <fieldset>
                    <div class='form-row form'>
                        <div class='form-group col-md-12'>
                            <label for='' class='position-inputs'>Nome.: ".$nome_cc."</label>
                        </div>
                        <br>
                        <div class='form-group col-md-12'>
                            <label for=''class='position-inputs'>Email.: ".$email."</label>
                        </div>
                        <br>
                        <div class='form-group col-md-12'>
                                <label for='' class='position-inputs'>Região.: ".$regiao."</label>
                            </div>
                            <br>
                        <div class='form-group col-md-12'>
                            <label for='' class='position-inputs'>Obs.: ".$obs."</label>
                        </div>
                        <div class='form-group col-md-12'>
                                <label for='' class='position-inputs'>Data.: ".$data_envio."</label>
                                <label for='' class='position-inputs'>   Hora.: ".$hora_envio."</label>
                            </div>
                    </div>
                </fieldset>
                </form>
            <div class='col-md-8'></div>
            </div>
    </div>
</body>
  </html>
";

// Opcional: Anexos 
// $mail->AddAttachment("/home/usuario/public_html/documento.pdf", "documento.pdf"); 

// Envia o e-mail 
$enviado = $mail->Send(); 

// Exibe uma mensagem de resultado 
if ($enviado) 
{ 
    header('location: ../Views/page-solicita-acesso.php?enviado=1');
    //echo "Seu email foi enviado com sucesso!"; 
    //include "../Views/chamado.php";
} else {
    header('location: ../Views/page-solicita-acesso.php?enviado=2'); 
    //echo "Houve um erro enviando o email: ".$mail->ErrorInfo; 
    //include "../Views/chamado.php";
} 
?>