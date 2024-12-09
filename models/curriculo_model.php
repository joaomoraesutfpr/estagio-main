<?php


class CurriculoModel {
    
    private $conn;
   
    public function __construct() {
        $this->conn = new mysqli('localhost', 'root', '', 'site_vagas');
        if ($this->conn->connect_error) {
            die("Erro de conexão: " . $this->conn->connect_error);
        }
    }

    public function adicionarCurriculo($descricao, $cargo, $experiencias, $salario) {

        
        // Verifica se os campos são válidos
        if (strlen($descricao) > 255) {
            return "O perfil pessoal é muito longo!";
        } elseif (strlen($cargo) > 20) {
            return "O nome do cargo é muito longo!";
        } elseif (strlen($descricao) < 5) {
            return "Preencha o perfil pessoal!";
        } elseif (strlen($cargo) < 2) {
            return "O nome do cargo é muito curto!";
        } elseif (strlen($experiencias) > 255) {
            return "O campo de experiencias excedeu o limite de caracteres!";
        } elseif (!is_numeric($salario)) {
            return "O valor do salário não é numérico!";
        } else {
        $conn = new mysqli('localhost', 'root', '', 'site_vagas');
        if ($conn->connect_error) {
            die("Erro de conexão: " . $conn->connect_error);
        }
            $stmt = $this->conn->prepare("INSERT INTO curriculo (descricao, cargo, experiencia, salario) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("sssd", $descricao, $cargo, $experiencias, $salario);
        
            if ($stmt->execute()) {
                echo "Currículo adicionado com sucesso!";
            } else {
                echo "Erro ao adicionar currículo: " . $stmt->error;
            }
            // Fechar a conexão
            $stmt->close();
        }
    }

    public function buscarCurriculosPorCargo($cargo) {
        // Recuperar currículos do banco de dados com base no cargo fornecido
        $sql = "SELECT * FROM curriculo WHERE cargo LIKE '%$cargo%'";
        $result = $this->conn->query($sql);
        // Exibir currículos encontrados
        if ($result->num_rows > 0) {
            $curriculos = [];
            while ($row = $result->fetch_assoc()) {
                $curriculos[] = $row;
            }
            return $curriculos;
        } else {
            return "Nenhum currículo encontrado.";
        }
    }
}
?>