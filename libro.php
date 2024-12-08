<?php


        class libro{
            private $id;
            private $titulo;
            private $autor;
            private $categoria;
            private $estado;

            function __construct($idParam, $tituloParam, $autorParam, $categoriaParam, $estadoParam)
            {
                $this -> id = $idParam;
                $this -> titulo = $tituloParam;
                $this -> autor = $autorParam;
                $this -> categoria = $categoriaParam;
                $this -> estado = $estadoParam;
            }
            
            //Metodo gettrs
            public function getId() {
                return $this -> id;
            }  
            public function getTitulo(){
                return $this -> titulo;
            }
            public function getAutor(){
                return $this -> autor;
            }
            public function getCategoria(){
                return $this -> categoria;
            }
            public function getEstado (){
                return $this -> estado;
            }
            //Metodos settrs
            public function setId($id){
                $this -> id = $id;
                return $this -> id;
            }
            public function setTitulo($titulo){
                $this -> titulo = $titulo;
                return $this -> titulo;
            }

            public function setAutor($autor)
            {
                $this->autor = $autor;
                return $this -> autor;
            }

            public function setCategoria($categoria)
            {
                $this->categoria = $categoria;
                return $this -> categoria;
            }

            public function setEstado($estado)
            {
                $this->estado = $estado;
                return $this -> estado;
            }
        }
?>