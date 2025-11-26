<?php

include "../config.inc.php";
require_once("Database.class.php");

class Inscricao {
    private $id;
    private $nome;
    private $email;
    private $data_nascimento;
    private $telefone;
    private $campus;
    private $matricula;
    private $cpf;
    private $anexo;

    public function __construct($id, $nome, $email, $data_nascimento, $telefone, $campus, $matricula, $cpf, $anexo = '') {
        $this->id = $id;
        $this->nome = $nome;
        $this->email = $email;
        $this->data_nascimento = $data_nascimento;
        $this->telefone = $telefone;
        $this->campus = $campus;
        $this->matricula = $matricula;
        $this->cpf = $cpf;
        $this->anexo = $anexo;
    }

    public function getId(){ 
        return $this->id;}

    public function getNome(){ 
    return $this->nome; }

    public function getEmail(){
    return $this->email; }

    public function getDataNascimento() { 
    return $this->data_nascimento; }

    public function getTelefone() {
    return $this->telefone; }

    public function getCampus() {
    return $this->campus; }

    public function getMatricula() {
    return $this->matricula; }

    public function getCpf() { 
    return $this->cpf; }

    public function getAnexo() {
    return $this->anexo; }

    public function setNome($nome) {
        if (empty($nome)) throw new Exception("Nome obrigatório");
        $this->nome = $nome;
    }

    public function setEmail($email) {
        if (empty($email)) throw new Exception("Email obrigatório");
        $this->email = $email;
    }

    public function setDataNascimento($data_nascimento) {
        $this->data_nascimento = $data_nascimento;
    }

    public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    public function setCampus($campus) {
        $this->campus = $campus;
    }

    public function setMatricula($matricula) {
        $this->matricula = $matricula;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    public function setAnexo($anexo = '') {
        $this->anexo = $anexo;
    }

    public function inserir(): bool {
        $sql = "INSERT INTO inscricao 
                (nome, email, data_nascimento, telefone, campus, matricula, cpf, anexo)
                VALUES (:nome, :email, :data_nascimento, :telefone, :campus, :matricula, :cpf, :anexo)";
        
        $parametros = [
            ':nome' => $this->getNome(),
            ':email' => $this->getEmail(),
            ':data_nascimento' => $this->getDataNascimento(),
            ':telefone' => $this->getTelefone(),
            ':campus' => $this->getCampus(),
            ':matricula' => $this->getMatricula(),
            ':cpf' => $this->getCpf(),
            ':anexo' => $this->getAnexo()
        ];

        return Database::executar($sql, $parametros) == true;
    }

    public function excluir(): bool {
        $sql = "DELETE FROM inscricao WHERE id = :id";
        $parametros = [':id' => $this->getId()];
        return Database::executar($sql, $parametros) == true;
    }

    public function alterar(): bool {
        $sql = "UPDATE inscricao SET 
                    nome = :nome,
                    email = :email,
                    data_nascimento = :data_nascimento,
                    telefone = :telefone,
                    campus = :campus,
                    matricula = :matricula,
                    cpf = :cpf,
                    anexo = :anexo
                WHERE id = :id";

        $parametros = [
            ':nome' => $this->getNome(),
            ':email' => $this->getEmail(),
            ':data_nascimento' => $this->getDataNascimento(),
            ':telefone' => $this->getTelefone(),
            ':campus' => $this->getCampus(),
            ':matricula' => $this->getMatricula(),
            ':cpf' => $this->getCpf(),
            ':anexo' => $this->getAnexo(),
            ':id' => $this->getId()
        ];

        return Database::executar($sql, $parametros) == true;
    }

    public static function listar($tipo = 0, $info = ''): array {
        $conexao = new PDO(DSN, USUARIO, SENHA);
        $sql = "SELECT * FROM inscricao";
        $parametros = [];

        if ($tipo > 0) {
            switch ($tipo) {
                case 1:
                    $sql .= " WHERE id = :info";
                    break;
                case 2:
                    $sql .= " WHERE nome LIKE :info";
                    $info = '%' . $info . '%';
                    break;
                case 3:
                     $sql .= " WHERE email LIKE :info";
                     $info = '%' . $info . '%';
                    break;
                case 4:
                    $sql .= " WHERE data_nascimento LIKE :info";
                    $info = '%' . $info . '%';
                    break;
                case 5:
                    $sql .= " WHERE telefone LIKE :info";
                    $info = '%' . $info . '%';
                    break;
                case 6:
                    $sql .= " WHERE campus LIKE :info";
                    $info = '%' . $info . '%';
                    break;
                case 7:
                    $sql .= " WHERE matricula LIKE :info";
                    $info = '%' . $info . '%';
                    break;
                case 8:
                        $sql .= " WHERE cpf LIKE :info";
                        $info = '%' . $info . '%';
                        break;
            }
            $sql .= " ORDER BY id";
            $parametros = [':info' => $info];
        }

        $comando = Database::executar($sql, $parametros);

        $inscricoes = [];
        while ($registro = $comando->fetch()) {
            $inscricao = new Inscricao(
                $registro['id'],
                $registro['nome'],
                $registro['email'],
                $registro['data_nascimento'],
                $registro['telefone'],
                $registro['campus'],
                $registro['matricula'],
                $registro['cpf'],
                $registro['anexo']
            );
            array_push($inscricoes, $inscricao);
        }

        return $inscricoes;
    }
}
?>
