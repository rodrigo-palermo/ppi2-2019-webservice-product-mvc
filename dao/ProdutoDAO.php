<?php
	//require_once "../class/Produto.php";
	//require_once "../db/PDOFactory.php";

	class ProdutoDAO {

		public function listar() {
			$query = "SELECT * FROM produtos";
			$pdo = PDOFactory::getConexao();
			$comando = $pdo->prepare($query);
			$comando->execute();
			$produtos = array();	
			while($row = $comando->fetch(PDO::FETCH_OBJ)) {
				$produtos[] = new Produto($row->id,$row->nome,$row->preco);
			}
			return $produtos;
		}

		public function buscarPorId($id) {
			$query = "SELECT * FROM produtos WHERE id = :id";		
			$pdo = PDOFactory::getConexao(); 
			$comando = $pdo->prepare($query);
			$comando->bindParam ("id", $id);
			$comando->execute();
			$resultado = $comando->fetch(PDO::FETCH_OBJ);
			return new Produto($resultado->id, $resultado->nome, $resultado->preco);           
		}

		public function inserir(Produto $produto) {
			$query = "INSERT INTO produtos(nome, preco) VALUES (:nome, :preco)";            
			$pdo = PDOFactory::getConexao();
			$comando = $pdo->prepare($query);
			$comando->bindParam(":nome", $produto->nome);
			$comando->bindParam(":preco", $produto->preco);
			$comando->execute();
			$produto->id = $pdo->lastInsertId();
			return $produto;
		}

		public function atualizar(Produto $produto) {
			$query = "UPDATE produtos SET nome = :nome, preco = :preco WHERE id = :id";            
			$pdo = PDOFactory::getConexao();
			$comando = $pdo->prepare($query);
			$comando->bindParam(":nome", $produto->nome);
			$comando->bindParam(":preco", $produto->preco);
			$comando->bindParam(":id", $produto->id);
			$comando->execute(); 
		}

		public function deletar($id) {
			$query = "DELETE from produtos WHERE id = :id";            
			$pdo = PDOFactory::getConexao();
			$comando = $pdo->prepare($query);
			$comando->bindParam(":id", $id);
			$comando->execute();
		}
	}
?>