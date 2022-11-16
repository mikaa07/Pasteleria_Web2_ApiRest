<?php
require_once './app/models/product.model.php';
require_once './app/views/api.view.php';
require_once './app/helpers/auth-api.helper.php';

class ProductApiController {
    private $model;
    private $view;
    private $authHelper;

    private $data;

    public function __construct() {
        $this->model = new ProductModel();
        $this->view = new ApiView();
        $this->authHelper = new AuthApiHelper();
        
        // lee el body del request
        $this->data = file_get_contents("php://input");
    }

    private function getData() {
        return json_decode($this->data);
    }

    public function getProducts($params = null) {
        $products = $this->model->getAll();
        $this->view->response($products);
    }

    public function getProduct($params = null) {
        // obtengo el id del arreglo de params
        $id = $params[':ID'];
        $product = $this->model->get($id);

        // si no existe devuelvo 404
        if ($product)
            $this->view->response($product);
        else 
            $this->view->response("El producto con el id=$id no existe", 404);
    }

    public function deleteProduct($params = null) {
        $id = $params[':ID'];

        if(!$this->authHelper->isLoggedIn()){
            $this->view->response("No estas logueado", 401);
            return;
        }

        $product = $this->model->get($id);
        if ($product) {
            $this->model->delete($id);
            $this->view->response($product);
        } else 
            $this->view->response("El producto con el id=$id no existe", 404);
    }
    

    public function insertProduct($params = null) {
        if(!$this->authHelper->isLoggedIn()){
            $this->view->response("No estas logueado", 401);
            return;
        }
        
        $product = $this->getData();

        if (empty($product->nombre_producto) || empty($product->precio) || empty($product->id_variedad)) {
            $this->view->response("Complete los datos", 400);
        } else {
            $id = $this->model->insert($product->nombre_producto, $product->precio, $product->id_variedad);
            $product = $this->model->get($id);
            $this->view->response($product, 201);
        }
    }

}