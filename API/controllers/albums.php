<?php

class albums extends controller
{
    function index()
    {
        $this->loadModel("request");
        $albums = $this->request->getAllAlbums();
        
        echo json_encode($albums);
    }

    function name($albums = null)
    {
        $this->loadModel("request");
        if($albums == null)
        {
            $albums = $this->request->getAllAlbums();
            echo json_encode($albums);
            return;
        }

        $albums = $this->request->getArtists($albums);

        echo json_encode($albums);
    }

    function details($id = null)
    {
        $this->loadModel("request");
        if($id == null)
        {
            $id = $this->request->getAllAlbums();
            echo json_encode($id);
            return;
        }

        $details = $this->request->getAlbumsDetails($id);
        foreach ($details as $key => $value)
        {
            $details[$key]['duration'] =
                round(intval($details[$key]['duration'])/60, 2);
        }

        echo json_encode($details);
    }   
    
    function random()
    {
        $this->loadModel("request");
        
        $albums = $this->request->getAlbumsRandom();
        echo json_encode($albums);
        
    }
    
}