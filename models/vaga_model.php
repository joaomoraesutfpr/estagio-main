<?php
class VagaModel {
    private $conn;
   
    public function __construct() {
        $this->conn = new mysqli('localhost', 'root', '', 'site_vagas');
        if ($this->conn->connect_error) {
            die("Erro de conexão: " . $this->conn->connect_error);
        }
    }

    public function adicionarVaga($descricao, $cargo, $salario) {
        // Verifica se os campos são válidos
        if (strlen($descricao) > 255){
            return "A descrição é muito longa!";
        } elseif (strlen($cargo) > 20){
            return "O nome do cargo é muito longoo";
        } elseif (strlen($descricao) < 5){
            return "A descrição é muito curta!";
        } elseif (strlen($cargo) < 2){
            return "O nome do cargo é muito curto";
        } elseif (!is_numeric($salario)){
            return "O valor do salário não é numérico";
        } else {
            // Inserir a nova vaga no banco de dados
            $sql = "INSERT INTO vaga (descricao, cargo, salario) VALUES ('$descricao', '$cargo', '$salario')";
            if ($this->conn->query($sql) === TRUE) {
                return "Vaga adicionada com sucesso!";
            } else {
                return "Erro ao adicionar vaga: " . $this->conn->error;
            }
        }
    }

    public function buscarVagasPorCargo($cargo) {
        // Recuperar vagas do banco de dados com base no cargo fornecido
        $sql = "SELECT descricao, cargo, salario FROM vaga WHERE cargo LIKE '%$cargo%'";
        $result = $this->conn->query($sql);
        
        // Exibir vagas encontradas
        if ($result->num_rows > 0) {
            $vagas = [];
            while ($row = $result->fetch_assoc()) {
                $vagas[] = $row;
            }
            return $vagas;
        } else {
            return [];
        }
    }

    public function atualizarVaga($vagaId, $descricao, $cargo, $salario) {
        // Verifica se os campos são válidos
        if (strlen($descricao) > 255) {
            return "A descrição é muito longa!";
        } elseif (strlen($cargo) > 20) {
            return "O nome do cargo é muito longo!";
        } elseif (strlen($descricao) < 5) {
            return "A descrição é muito curta!";
        } elseif (strlen($cargo) < 2) {
            return "O nome do cargo é muito curto!";
        } elseif (!is_numeric($salario)) {
            return "O valor do salário não é numérico!";
        } else {
            $sql = "UPDATE vaga SET descricao='$descricao', cargo='$cargo', salario='$salario' WHERE vaga_id=$vagaId";
            if ($this->conn->query($sql) === TRUE) {
                if ($this->conn->affected_rows > 0) {
                    return "Vaga atualizada com sucesso!";
                } else {
                    return "Vaga não encontrada, nenhuma alteração realizada.";
                }
            } else {
                return "Erro ao atualizar vaga: " . $this->conn->error;
            }
        }
    }
}
?>