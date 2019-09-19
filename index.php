<?php
	use \Psr\Http\Message\ServerRequestInterface as Request;
	use \Psr\Http\Message\ResponseInterface as Response;

	require_once "vendor/autoload.php";
	require_once "db/PDOFactory.php";
	require_once "class/Produto.php";
	require_once "dao/ProdutoDAO.php";
	require_once "controllers/ProdutoController.php";

	$config = [ //
		'settings' => [
			//'displayErrorDetails' => true,
			//'addContentLengthHeader' => false,  //usar em caso de erro desconhecido
		]
	
	];

	$app = new \Slim\App($config);

	$app->get("/produtos",  "ProdutoController::listar");

  	$app->get('/produtos/{id}', "ProdutoController::buscarPorId");

  	$app->post('/produtos', "ProdutoController::inserir");

  	$app->put('/produtos/{id}', "ProdutoController::atualizar");

	$app->delete('/produtos/{id}', "ProdutoController::deletar");

	$app->run();
?>