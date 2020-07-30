<?php

    include('../../banco/conexao.php');

    if($conexao){ 

        $sql = "SELECT idclientes, nome * FROM CLIENTES WHERE ativo = 'S' ";
        $resultado = mysqli_query($conexao, $sql);

        if($resultado && mysqli_num_rows($resultado) > 0){

            $dadosClientes = array();
            while($linha = mysqli_fetch_assoc($resultado)){
            $dadosClientes[] = array_map('utf8_encode', $linha);
            }

        } else{
            $dados = array(
                "tipo" => "info",
                "mensagem" => "Não possível localizar o clientes.",
                "dados" => array()
            );
        }

        mysqli_close($conexao);

    } else{
        $dados = array(
            "tipo" => "error",
            "mensagem" => "Não possível conecar ao banco de dados",
            "dados" => array()
        );
    }

echo json_encode($dados, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);