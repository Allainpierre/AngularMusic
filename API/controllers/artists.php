<?php

class artists extends controller
{
    
    function index()
    {
        $this->loadModel("request");
        $artists = $this->request->getAllArtists();

        echo json_encode($artists);
    }
    
    function name($artist = null)
    {
        $this->loadModel("request");
        if($artist == null)
        {
            $artists = $this->request->getAllArtists();
            echo json_encode($artists);
            return;
        }

        $artist = $this->request->getArtists($artist);

        echo json_encode($artist);
    }

    function details($id = null)
    {
        $this->loadModel("request");
        if($id == null)
        {
            $artists = $this->request->getAllArtists();
            echo json_encode($artists);
            return;
        }

        $details = $this->request->getDetails($id);

        echo json_encode($details);
    }
}