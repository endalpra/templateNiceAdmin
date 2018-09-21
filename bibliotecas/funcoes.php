<?php

function geraSenha() {
    //Gerar senha
    $caracteres = array("#", "*", "+", "@", "$");
    $letras = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r",
        "s", "t", "u", "v", "x", "w", "y", "z", "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L",
        "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "X", "W", "Y", "Z");
    $senha = "";
    for ($i = 0; $i < 3; $i++) {
        $senha .= $caracteres[rand(0, 4)];
        $senha .= $letras[rand(0, 51)];
        $senha .= rand(0, 9);
    }
    return $senha;
}

function enviaEmail($to, $subject, $msg) {
    //Envio do email   
    $headers = "MIME-Version: 1.1\r\n";
    $headers .= "Content-type: text/html; charset=utf-8\r\n";
    $headers .= "From: admin@bibliotecapessoal.com\r\n"; // remetente
    $headers .= "Return-Path: admin@bibliotecapessoal.com\r\n"; // return-path
    // E-mail que receberá a resposta quando se clicar no 'Responder' de seu leitor de e-mails
    $headers .= "Reply-To: admin@bibliotecapessoal.com\r\n";
    if (mail($to, $subject, $msg, $headers)) {
        return 1;
    } else {
        return 0;
    }
}

function r_c_e($string) {
    $c = array("'", ";", "--", "/*", "*/", "[", "]");
    foreach ($c as $v) {
        $string = str_replace($v, '', $string);
    }
    return $string;
}

function redimensionar($caminho_imagem) {// O caminho da imagem no servidor            
    $imagem = imagecreatefromjpeg($caminho_imagem);
    // Cria duas variáveis com a largura e altura da imagem
    list( $largura, $altura ) = getimagesize($caminho_imagem);

    // Nova largura e altura em px
    $nova_largura = 350;
    $nova_altura = $altura * ($nova_largura / $largura);

    // Cria uma nova imagem em branco
    $nova_imagem = imagecreatetruecolor($nova_largura, $nova_altura);

    // Copia a imagem para a nova imagem com o novo tamanho
    imagecopyresampled(
            $nova_imagem, // Nova imagem 
            $imagem, // Imagem original
            0, // Coordenada X da nova imagem
            0, // Coordenada Y da nova imagem 
            0, // Coordenada X da imagem 
            0, // Coordenada Y da imagem  
            $nova_largura, // Nova largura
            $nova_altura, // Nova altura
            $largura, // Largura original
            $altura // Altura original
    );

    // Cria a imagem
    imagejpeg($nova_imagem, $caminho_imagem, 65);
    // Remove as imagens temporárias
    imagedestroy($imagem);
    imagedestroy($nova_imagem);
}

function inverte_data($dt, $a, $n) {
    $vet = explode($a, $dt);
    return $vet[2] . $n . $vet[1] . $n . $vet[0];
}

function calculaDistancia($lat1, $lng1, $lat2, $lng2) {
    $earth_radius = 6378137;
    $rlo1 = deg2rad($lng1);
    $rla1 = deg2rad($lat1);
    $rlo2 = deg2rad($lng2);
    $rla2 = deg2rad($lat2);
    $dlo = ($rlo2 - $rlo1) / 2;
    $dla = ($rla2 - $rla1) / 2;
    $a = (sin($dla) * sin($dla)) + cos($rla1) * cos($rla2) * (sin($dlo) * sin($dlo
    ));
    $d = 2 * atan2(sqrt($a), sqrt(1 - $a));
    return (($earth_radius * $d) / 1000);
}
