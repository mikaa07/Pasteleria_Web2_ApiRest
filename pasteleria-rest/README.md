ENDPOINTS que utilice en el trabajo

GET -> /api/products (me devuelve todos los productos)
       /api/comentarios (me devuelve todos los comentarios)
por ejemplo http://localhost/pasteleria-rest/api/products con GET me devuelve todos los productos

GET:ID-> /api/products/:ID (me devuelve un producto con cierto id)
por ejemplo http://localhost/pasteleria-rest/api/products/1 con GET/:1 me devuelve el producto con id=1
            http://localhost/pasteleria-rest/api/products/1 con GET/:1 me devuelve el comentario con id=1

POST-> /api/products (me agrega un nuevo producto)
por ejemplo http://localhost/pasteleria-rest/api/products con POST me agrega un nuevo producto
            http://localhost/pasteleria-rest/api/comentarios con POST me agrega un nuevo comentario

DELETE:ID-> /api/products/:id
por ejemplo http://localhost/pasteleria-rest/api/products/1 con DELETE me elimina el producto con id=1
            http://localhost/pasteleria-rest/api/comentarios/1 con DELETE me elimina el comentario con id=1

