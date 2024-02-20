<?php

class Routes
{
    protected $urlBase = "http://localhost/servicios-web-php";
    
    public function __construct()
    {
        
    }
    
    public function getUrlBase()
    {
        return $this->urlBase;
    }
    
    public function getHomeMenu()
    {
        return '<a href="'.$this->urlBase.'/client/index.php">Inicio</a>';
    }
    
    public function getNewMenu()
    {
        return '<a href="'.$this->urlBase.'/client/create.php">Nuevo</a>';
    }
    
    public function getUpdateMenu($id)
    {
        return '<a href="'.$this->urlBase.'/client/update.php?id='.$id.'">Actualizar</a>';
    }
    
    public function getDeleteMenu($id)
    {
        return '<a href="'.$this->urlBase.'/client/delete.php?id='.$id.'">Eliminar</a>';
    }
}

?>