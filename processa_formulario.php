<?php
    function validarCNPJ($cnpj) {
        $cnpj = preg_replace('/[^0-9]/', '', $cnpj);
        //preg_replace = Remove todos os caracteres não numéricos da string CNPJ.
    
        if (strlen($cnpj) == 14) {
            return true;
        }
    
       // Calcular o primeiro dígito verificador
    $soma = 0;
    for ($i = 0; $i < 12; $i++) {
        $soma += $cnpj[$i] * (13 - $i);
    }
    $resto = $soma % 11;
    $digitoVerificador1 = ($resto < 2) ? 0 : 11 - $resto;

    // Calcular o segundo dígito verificador
    $soma = 0;
    for ($i = 0; $i < 13; $i++) {
        $soma += $cnpj[$i] * (14 - $i);
    }
    $resto = $soma % 11;
    $digitoVerificador2 = ($resto < 2) ? 0 : 11 - $resto;

    if ($cnpj[12] == $digitoVerificador1 && $cnpj[13] == $digitoVerificador2) {
        return true;
    } else {
        return false;
    }
    }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $cnpj = $_POST["cnpj"];
    $telefone = $_POST["telefone"];
    $email = $_POST["email"];

    // Verificar número de dígitos no telefone
    $telefoneValido = (strlen($telefone) == 11); //formato do telefone é 11 dígitos

    // Validar e-mail
    $emailValido = filter_var($email, FILTER_VALIDATE_EMAIL);

    echo "Nome: $nome <br>";

    if (validarCNPJ($cnpj)) {
        echo "CNPJ: $cnpj <br>";
    } else {
        echo "CNPJ: Seu CNPJ é inválido <br>";
    }
    //$cnpjTeste = "03.320.415/0001-30";

    if ($telefoneValido) {
        echo "Telefone: $telefone <br>"; 
    } else {
        echo "Telefone:Número de telefone incorreto <br>";
    }

    if ($emailValido) {
        echo "E-mail: $email <br>";
    } else {
        echo "E-mail: Endereço de e-mail inválido <br>";
    }
}
?>
