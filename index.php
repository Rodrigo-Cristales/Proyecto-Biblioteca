<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles.css/index.css">
    <title>BIBLIOTECA SV</title>
</head>
<body>    
        <?php
                
                require_once('./libro.php');
                require_once ('./acciones.php');
   
                $acciones = new acciones();
                        
                if (isset($_GET['eliminar'])) {
                    $idEliminar = $_GET['eliminar'];
                    $acciones->EliminarLibro($idEliminar); 
                }

                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['libro'])) {
                    $id = uniqid();
                    $titulo = $_POST['libro'];
                    $autor = $_POST['autor'];
                    $categoria = $_POST['categoria'];
                    $estado = 'Disponible';
                    $agregarLibro = new libro($id, $titulo, $autor, $categoria, $estado);
                    $acciones->RegistrarLibro($agregarLibro);
            
                    $libros = $acciones->obtenerDatos();
                }
                else {
                    $libros = $acciones->obtenerDatos();
                }
        ?>

        <h1>BIBLIOTECA SV</h1>
        <main>
            <form class="form-1" method="POST">
                <label>Nombre Libro</label>
                <input placeholder="Agregar libro" name="libro" require>
                <label>Nombre autor</label>
                <input type="text" placeholder="Agregar nombre autor" name="autor" require>
                <label>Categoria</label>
                <select name="categoria" require>
                    <option value="Romance">Romance</option>
                    <option value="Aventura">Aventura</option>
                    <option value="Fantacia">Fantasia</option>
                    <option value="Historia">Historia</option>
                </select>
                <button type="submit">Agregar libro</button>
            </form>
            <section>
                <table class="table">
                    <thead>
                        <th>Nombre autor</th>
                        <th>Nombre libro</th>
                        <th>Categoria libro</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                        <th>Prestamo</th>
                        <th>Estado</th>
                    </thead>
                    <tbody id="table-body">                  
                    <?php foreach($libros as $libro): ?>
                        <tr>
                            <td><?php echo $libro->getAutor(); ?></td>
                            <td><?php echo $libro->getTitulo(); ?></td>
                            <td><?php echo $libro->getCategoria(); ?></td>
                            <td>
                            <a href="?editar=<?php echo $libro->getId(); ?>">Editar</a>
                            </td>
                            <td>
                            <a class="eliminar" href="?eliminar=<?php echo $libro->getId(); ?>">Eliminar</a>
                            </td>
                            <td>
                                <a href="#">Prestar</a>
                            </td>
                            <td>
                                <?php echo $libro->getEstado(); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </section>

            <section>
                <form action="" class="form-2">
                    <label for="">Buscar libro</label>
                    <input type="text" placeholder="Ingrese nombre libro">
                    <button>buscar libro</button>
                </form>
            </section>
        </main>
</body>
</html>


