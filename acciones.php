<?php

    require_once('./libro.php');

    class acciones{
        private $datos;
        
        function __construct($datos = 'libros.json') {
            $this->datos = $datos;
            if (!file_exists($this->datos)) {
                file_put_contents($this->datos, json_encode([], JSON_PRETTY_PRINT));
            }
        }        
        public function obtenerDatos(){
            if (!file_exists($this->datos)) {
                return []; 
            }
        
            $contenedor = file_get_contents($this->datos);
        
            $array = json_decode($contenedor, true);
        
            if (!$array) {
                return [];
            }
        
            $libros = [];
            foreach ($array as $data) {
                $libros[] = new libro(
                    $data['id'] ?? uniqid(),              
                    $data['titulo'] ?? 'Sin título',       
                    $data['autor'] ?? 'Desconocido',       
                    $data['categoria'] ?? 'General',       
                    $data['estado'] ?? 'Disponible'        
                );
            }
        
            return $libros;
        }
        
        
        public function RegistrarLibro(libro $libro) {
            $libros = $this->obtenerDatos();
        
            $librosArray = array_map(fn($libro) => [
                'id' => $libro->getId(),
                'titulo' => $libro->getTitulo(),
                'autor' => $libro->getAutor(),
                'categoria' => $libro->getCategoria(),
                'estado' => $libro->getEstado()
            ], $libros);
        
            $nuevoLibro = [
                'id' => $libro->getId(),
                'titulo' => $libro->getTitulo(),
                'autor' => $libro->getAutor(),
                'categoria' => $libro->getCategoria(),
                'estado' => $libro->getEstado() ?? 'Disponible'
            ];
            $librosArray[] = $nuevoLibro;
            file_put_contents($this->datos, json_encode($librosArray, JSON_PRETTY_PRINT));
        }
        
        private function GuardarCambios($libros){
            $array = array_map(fn($libro) => [
                'id' => $libro -> getId(),
                'titulo' => $libro -> getTitulo(),
                'autor' => $libro -> getAutor(),
                'categoria' => $libro -> getCategoria(),
                'estado' => $libro -> getEstado()
            ], $libros);
            file_put_contents($this -> datos, json_encode($array));
        }

        public function EliminarLibro($id){
            $libros = $this -> obtenerDatos();
            $libros = array_filter($libros, fn($libro) => $libro -> getId() !== $id);
            $this ->GuardarCambios($libros);
        }
    }
    

?>