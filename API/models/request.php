<?php

class request extends model
{
    public $table = 'request';

    function getAllArtists()
    {
        if ($this->database == null)
        {
            return null;
        }
        $sql = "SELECT DISTINCT artists.id, artists.name, artists.photo 
        FROM artists INNER JOIN albums ON albums.artist_id = artists.id";
        $req = $this->database->prepare($sql);
        $req->execute();
        $data = $req->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    function getArtists($artist)
    {
        if ($this->database == null)
        {
            return null;
        }
        $sql = "SELECT artists.name, artists.description, artists.bio, 
                albums.name AS 'album_name', artists.photo 
                FROM albums JOIN artists 
                WHERE artists.name LIKE '" . $artist ."%' 
                AND albums.artist_id = artists.id GROUP BY albums.name ";
        $req = $this->database->prepare($sql);
        $req->execute();
        $data = $req->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }

    function getAllAlbums()
    {
        if ($this->database == null)
        {
            return null;
        }
        $sql = "SELECT DISTINCT albums.id, albums.name, albums.cover_small, 
                artists.name AS 'artiste', albums.popularity 
                FROM albums
                INNER JOIN artists ON albums.artist_id = artists.id 
                ORDER BY albums.popularity DESC";
        $req = $this->database->prepare($sql);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    function getAlbumsDetails($id)
    {
        if ($this->database == null)
        {
            return null;
        }
        $sql = "SELECT albums.name, tracks.name AS 'music_name', albums.cover, 
               albums.popularity, albums.release_date, tracks.mp3, 
               tracks.duration, albums.description, albums.release_date 
               FROM albums 
               INNER JOIN tracks INNER JOIN genres
               INNER JOIN genres_albums WHERE tracks.album_id = albums.id 
               AND tracks.album_id = genres_albums.album_id 
               AND genres.id = genres_albums.genre_id AND albums.id = :id";
        $req = $this->database->prepare($sql);
        $req->execute(array('id' => $id));
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    function getAlbumsDetailsTracks($id)
    {
        if ($this->database == null)
        {
            return null;
        }
        $sql = "SELECT albums.name, tracks.name AS 'music_name', tracks.mp3,
                albums.cover,albums.popularity, albums.release_date, 
                tracks.duration FROM albums 
               INNER JOIN tracks INNER JOIN genres 
               INNER JOIN genres_albums WHERE tracks.album_id = albums.id 
               AND tracks.album_id = genres_albums.album_id 
               AND genres.id = genres_albums.genre_id";
        $req = $this->database->prepare($sql);
        $req->execute(array('id' => $id));
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    function getDetails($id)
    {
        if ($this->database == null)
        {
            return null;
        }
        $sql = "SELECT artists.id, artists.name, artists.photo, 
        artists.bio, artists.description, albums.id AS 'album_id', 
        albums.name AS 'albums_name', 
        albums.cover_small FROM artists 
        INNER JOIN albums ON albums.artist_id = artists.id 
        WHERE artists.id = :id";

        $req = $this->database->prepare($sql);

        $req->execute(array('id' => $id));
        return $req->fetchAll(PDO::FETCH_ASSOC);

    }

    function getAllDetails()
    {
        if ($this->database == null)
        {
            return null;
        }
        $sql = "SELECT DISTINCT artists.id, artists.name, artists.photo, 
        artists.bio, artists.description, albums.id AS 'album_id', 
        albums.name AS 'albums_name',
        albums.cover_small FROM artists 
        INNER JOIN albums ON albums.artist_id = artists.id";

        $req = $this->database->prepare($sql);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);

    }

    function getAllTracks()
    {
        if ($this->database == null)
        {
            return null;
        }

        $sql = "SELECT tracks.id, tracks.name AS 'music_name', 
                albums.name, albums.cover_small AS 'album_name', 
                tracks.duration, tracks.mp3, tracks.track_no FROM albums 
               INNER JOIN tracks WHERE tracks.album_id = albums.id";

        $req = $this->database->prepare($sql);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);

    }

    function getAllType()
    {
        if ($this->database == null)
        {
            return null;
        }

        $sql = "SELECT id, name FROM genres";

        $req = $this->database->prepare($sql);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    function getTypeById($id)
    {
        if ($this->database == null)
        {
            return null;
        }

        $sql = "SELECT DISTINCT genres.id AS 'genre_id', 
                albums.id AS 'album_id',
                genres.name, albums.name, albums.cover_small, albums.popularity
                FROM albums 
                INNER JOIN genres 
                INNER JOIN genres_albums 
                WHERE albums.id = genres_albums.album_id 
                AND genres_albums.genre_id = genres.id AND genres.id = :id";

        $req = $this->database->prepare($sql);
        $req->execute(array('id' => $id));
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    function getAlbumsRandom()
    {
        if ($this->database == null)
        {
            return null;
        }

        $sql = "SELECT DISTINCT albums.id, albums.name, albums.cover_small, 
                artists.name AS 'artiste', albums.popularity 
                FROM albums
                INNER JOIN artists ON albums.artist_id = artists.id 
                ORDER BY RAND()";
        $req = $this->database->prepare($sql);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }
}