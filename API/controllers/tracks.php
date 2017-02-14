<?php

class tracks extends controller
{

    function index()
    {
        $this->loadModel("request");
        $tracks = $this->request->getAllTracks();

        echo json_encode($tracks);
    }
}