<?php

require_once (__DIR__ . '/../bibliotecas/Configuracao.php');
require_once (__DIR__ . '/../bibliotecas/Banco.php');

class Pessoas {

    private $id;
    private $nome;
    private $email;
    private $login;
    private $senha;
    private $facebook;
    private $whatsapp;
    private $cidade;
    private $estado;
    private $pais;
    private $confiabilidade;
    private $pontos;
    private $votos;
    private $nao_devolvidos;
    private $latitude;
    private $longitude;
    private $distancia;
    private $imagem;
    private $descricao;
    private $data;

    public static function cadastrarPessoa($nome, $email, $login, $senha, $latitude, $longitude) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $nome = $bd->real_escape_string($nome);
        $email = $bd->real_escape_string($email);
        $login = $bd->real_escape_string($login);
        $senha = sha1($bd->real_escape_string($senha));
        $latitude = $bd->real_escape_string($latitude);
        $longitude = $bd->real_escape_string($longitude);
        $sql = "INSERT INTO pessoas(nome,email,login,senha,latitude,longitude) VALUES('$nome','$email','$login','$senha', '$latitude','$longitude')";
        $bd->executarSQL($sql);
        return $bd->executarSQL("SELECT LAST_INSERT_ID() as id FROM pessoas", "Pessoas");
    }

     public static function insereRecuperacao($utilizador, $chave) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $utilizador = $bd->real_escape_string($utilizador);
        $sql = "INSERT INTO recuperacoes(utilizador, confirmacao) VALUES('".$utilizador."','".$chave."') ";
        return $bd->executarSQL($sql);
    }
    
     public static function verificaExistenciaRecuperacao($utilizador, $chave) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $utilizador = $bd->real_escape_string($utilizador);
        $chave = $bd->real_escape_string($chave);
        $sql = "SELECT COUNT(*) as id FROM recuperacoes WHERE utilizador = '".$utilizador."' AND confirmacao = '".$chave."' ";
        return $bd->executarSQL($sql, 'Pessoas');
    }
    
    public static function verificaExistenciaLogin($login) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $login = $bd->real_escape_string($login);
        $sql = "SELECT * FROM pessoas WHERE login='$login'";
        return $bd->executarSQL($sql, 'Pessoas');
    }

     public static function verificaExistenciaLoginRecuperar($login, $email) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $login = $bd->real_escape_string($login);
        $sql = "SELECT count(*) as id FROM pessoas WHERE login='".$login."' AND email <> '".$email."' ";
        return $bd->executarSQL($sql, 'Pessoas');
    }
                
    public static function buscarPessoaId($id) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "SELECT * FROM pessoas WHERE id=" . $id;
        return $bd->executarSQL($sql, 'Pessoas');
    }
    
    public static function redefinirLoginSenha($email,$login, $senha) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $email = $bd->real_escape_string($email);
        $login = $bd->real_escape_string($login);
        $senha = sha1( $bd->real_escape_string($senha) );
        $sql = "UPDATE pessoas SET login='".$login."', senha='".$senha."' WHERE email='".$email."' ";
        return $bd->executarSQL($sql);
    }

     public static function deletarRecuperacao($email) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "DELETE FROM recuperacoes WHERE utilizador='".$email."' ";
        return $bd->executarSQL($sql);
     }
     
    public static function buscarPessoaEmail($email) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $email = $bd->real_escape_string($email);
        $sql = "SELECT count(*) as id FROM pessoas WHERE email='".$email."' ";
        return $bd->executarSQL($sql, 'Pessoas');
    }
    
    public static function buscarPessoaPerfil($pessoaLogada, $pessoa) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "SELECT ROUND( ( ST_Distance( Point( (SELECT longitude FROM pessoas WHERE id=$pessoaLogada), (SELECT latitude FROM pessoas WHERE id=$pessoaLogada)),
        Point((SELECT longitude FROM pessoas WHERE id=" . $pessoa . "),(SELECT latitude FROM pessoas WHERE id=" . $pessoa . "))) * 100), 2) as distancia, imagem, nome, email, confiabilidade, id FROM pessoas 
        WHERE id=" . $pessoa;

        return $bd->executarSQL($sql, 'Pessoas');
    }

    public static function buscarDescricaoEmprestimosPessoa($pessoa, $primeiroRegistro, $qtdRegistros) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "SELECT p.nome as nome, p.imagem as imagem, e.descricao as descricao, e.data_sistema as data FROM pessoas p, emprestimos e, livros l WHERE l.pessoa=p.id AND e.livro=l.id AND e.pessoa_emprestou=" . $pessoa . " AND e.data_sistema IS NOT NULL ORDER BY e.data_sistema DESC LIMIT $primeiroRegistro, $qtdRegistros ";
        return $bd->executarSQL($sql, 'Pessoas');
    }

    public static function buscarTodasPessoas() {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "SELECT * FROM pessoas ";
        return $bd->executarSQL($sql, 'Pessoas');
    }

    public static function buscarPessoasString($string) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $string = $bd->real_escape_string($string);
        $sql = "SELECT id, nome FROM pessoas WHERE (LOWER(nome) LIKE LOWER('" . $string . "%')) ORDER BY nome";
        return $bd->executarSQL($sql, 'Pessoas');
    }

    public static function buscarLatLon($pessoa) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "SELECT latitude, longitude FROM pessoas WHERE id=" . $pessoa;
        return $bd->executarSQL($sql, 'Pessoas');
    }

    public static function updatePessoaBasico($pessoa, $nome, $email, $login) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $nome = $bd->real_escape_string($nome);
        $email = $bd->real_escape_string($email);
        $login = $bd->real_escape_string($login);
        $sql = "UPDATE pessoas SET nome='" . $nome . "', email='" . $email . "', login='" . $login . "' WHERE id=" . $pessoa;
        return $bd->executarSQL($sql);
    }

    public static function updatePessoaLocal($pessoa, $nome, $email, $login, $latitude, $longitude) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $nome = $bd->real_escape_string($nome);
        $email = $bd->real_escape_string($email);
        $login = $bd->real_escape_string($login);
        $latitude = $bd->real_escape_string($latitude);
        $longitude = $bd->real_escape_string($longitude);
        $sql = "UPDATE pessoas SET nome='" . $nome . "', email='" . $email . "', login='" . $login . "', latitude=" . $latitude . ", longitude=" . $longitude . " WHERE id=" . $pessoa;
        return $bd->executarSQL($sql);
    }

    public static function updatePessoaSenha($pessoa, $nome, $email, $login, $senha) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $nome = $bd->real_escape_string($nome);
        $email = $bd->real_escape_string($email);
        $login = $bd->real_escape_string($login);
        $senha = sha1($bd->real_escape_string($senha));
        $sql = "UPDATE pessoas SET nome='" . $nome . "', email='" . $email . "', login='" . $login . "', senha='" . $senha . "' WHERE id=" . $pessoa;
        return $bd->executarSQL($sql);
    }

    public static function updatePessoaSenhaLocal($pessoa, $nome, $email, $login, $latitude, $longitude, $senha) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $nome = $bd->real_escape_string($nome);
        $email = $bd->real_escape_string($email);
        $login = $bd->real_escape_string($login);
        $latitude = $bd->real_escape_string($latitude);
        $longitude = $bd->real_escape_string($longitude);
        $senha = sha1($bd->real_escape_string($senha));
        $sql = "UPDATE pessoas SET nome='" . $nome . "', email='" . $email . "', login='" . $login . "', latitude=" . $latitude . ", longitude=" . $longitude . ", senha='" . $senha . "' WHERE id=" . $pessoa;
        return $bd->executarSQL($sql);
    }

    public static function updatePessoasImagem($pessoa, $imagem) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $imagem = $bd->real_escape_string($imagem);
        $sql = "UPDATE pessoas SET imagem='" . $imagem . "' WHERE id=" . $pessoa;
        return $bd->executarSQL($sql);
    }

    public static function updateConfiabilidade($pessoa, $pontos, $votos, $confiabilidade) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "UPDATE pessoas SET pontos=" . $pontos . ", votos=" . $votos . ", confiabilidade=" . $confiabilidade . " WHERE id=" . $pessoa;
        return $bd->executarSQL($sql);
    }

    public static function buscarNotificacaoPessoa($pessoa) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "SELECT count(e.id) as id FROM pessoas p, livros l, emprestimos e WHERE p.id=l.pessoa AND e.livro=l.id AND e.pessoa_emprestou=$pessoa AND e.data_devolucao is null AND (SELECT DATEDIFF(e.data_prevista,(SELECT CURRENT_DATE))<=2)";
        return $bd->executarSQL($sql, 'Pessoas');
    }

    function getData() {
        return $this->data;
    }

    function setData($data) {
        $this->data = $data;
    }

    function getImagem() {
        return $this->imagem;
    }

    function setImagem($imagem) {
        $this->imagem = $imagem;
    }

    function getDistancia() {
        return $this->distancia;
    }

    function setDistancia($distancia) {
        $this->distancia = $distancia;
    }

    function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
    }

    function getLogin() {
        return $this->login;
    }

    function getSenha() {
        return $this->senha;
    }

    function setLogin($login) {
        $this->login = $login;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }

    function getNome() {
        return $this->nome;
    }

    function getEmail() {
        return $this->email;
    }

    function getFacebook() {
        return $this->facebook;
    }

    function getWhatsapp() {
        return $this->whatsapp;
    }

    function getCidade() {
        return $this->cidade;
    }

    function getEstado() {
        return $this->estado;
    }

    function getPais() {
        return $this->pais;
    }

    function getConfiabilidade() {
        return $this->confiabilidade;
    }

    function getLatitude() {
        return $this->latitude;
    }

    function getLongitude() {
        return $this->longitude;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setFacebook($facebook) {
        $this->facebook = $facebook;
    }

    function setWhatsapp($whatsapp) {
        $this->whatsapp = $whatsapp;
    }

    function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setPais($pais) {
        $this->pais = $pais;
    }

    function setConfiabilidade($confiabilidade) {
        $this->confiabilidade = $confiabilidade;
    }

    function setLatitude($latitude) {
        $this->latitude = $latitude;
    }

    function setLongitude($longitude) {
        $this->longitude = $longitude;
    }

    function getPontos() {
        return $this->pontos;
    }

    function getNao_devolvidos() {
        return $this->nao_devolvidos;
    }

    function setPontos($pontos) {
        $this->pontos = $pontos;
    }

    function setNao_devolvidos($nao_devolvidos) {
        $this->nao_devolvidos = $nao_devolvidos;
    }

    function getVotos() {
        return $this->votos;
    }

    function setVotos($votos) {
        $this->votos = $votos;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

}
