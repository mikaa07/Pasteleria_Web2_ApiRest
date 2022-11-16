<?php

class ProductModel {

    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_pasteleria;charset=utf8', 'root', '');
    }

    /**
     * Devuelve la lista de productos
     */
    public function getAll() {
        $query = $this->db->prepare("SELECT * FROM producto");
        $query->execute();

        
        $products = $query->fetchAll(PDO::FETCH_OBJ); // devuelve un arreglo de objetos
        
        return $products;
    }

    //ver id pasado por parametro
    public function get($id) {
        $query = $this->db->prepare("SELECT * FROM producto WHERE id_producto = ?");
        $query->execute([$id]);
        $product = $query->fetch(PDO::FETCH_OBJ);
        
        return $product;
    }

    /**
     * Inserta un producto en la base de datos.
     */
    public function insert($nombre_producto, $precio,$id_variedad) {
        $query = $this->db->prepare("INSERT INTO producto (nombre_producto, precio, id_variedad) VALUES (?,?,?)");
        $query->execute([$nombre_producto, $precio, $id_variedad]);

        return $this->db->lastInsertId();
    }


    /**
     * Elimina un producto dado su id.
     */
    function delete($id) {
        $query = $this->db->prepare('DELETE FROM producto WHERE id_producto = ?');
        $query->execute([$id]);
    }

    
}
