<?php

class genres extends controller
{

    function index()
    {
        $this->loadModel("request");

        $genres = $this->request->getAllType();
        echo json_encode($genres);
        return;
    }

    function id($id = null)
    {
        $this->loadModel("request");
        if($id == null)
        {
            $genres = $this->request->getAllType();
            echo json_encode($genres);
            return;
        }

        $genres = $this->request->getTypeById($id);
        echo json_encode($genres);
        return;
    }

}