<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

return function (App $app) {
    $container = $app->getContainer();

    $app->get("/petani/", function (Request $request, Response $response){
        $sql = "SELECT * FROM master_petani";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $response->withJson(["status" => "success", "data" => $result], 200);
    });
    
    $app->get("/petani/{id}", function (Request $request, Response $response, $args){
        $id = $args["id"];
        $sql = "SELECT * FROM master_petani WHERE id=:id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([":id" => $id]);
        $result = $stmt->fetch();
        return $response->withJson(["status" => "success", "data" => $result], 200);
    });
    
    $app->get("/petani/search/", function (Request $request, Response $response, $args){
        $keyword = $request->getQueryParam("keyword");
        $sql = "SELECT * FROM master_petani WHERE nama LIKE '%$keyword%'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $response->withJson(["status" => "success", "data" => $result], 200);
    });
    
    $app->post("/petani/", function (Request $request, Response $response){
    
        $petani = $request->getParsedBody();
    
        $sql = "INSERT INTO master_petani (nama, alamat, provinsi, kabupaten, kecamatan, kelurahan, 
        nama_istri, jumlah_lahan, foto) VALUE (:nama, :alamat, :provinsi, :kabupaten, :kecamatan, :kelurahan,
        :nama_istri, :jumlah_lahan, :foto)";
        $stmt = $this->db->prepare($sql);
    
        $data = [
            ":nama" => $petani["nama"],
            ":alamat" => $petani["alamat"],
            ":provinsi" => $petani["provinsi"],
            ":kabupaten" => $petani["kabupaten"],
            ":kecamatan" => $petani["kecamatan"],
            ":kelurahan" => $petani["kelurahan"],
            ":nama_istri" => $petani["nama_istri"],
            ":jumlah_lahan" => $petani["jumlah_lahan"],
            ":foto" => $petani["foto"],
        ];
    
        if($stmt->execute($data))
            return $response->withJson(["status" => "success", "data" => "1"], 200);
        
        return $response->withJson(["status" => "failed", "data" => "0"], 200);
    });
    
    
    $app->put("/petani/{id}", function (Request $request, Response $response, $args){
        $id = $args["id"];
        $petani = $request->getParsedBody();
        $sql = "UPDATE master_petani SET nama=:nama, alamat=:alamat, provinsi=:provinsi, kabupaten=:kabupaten, 
        kecamatan=:kecamatan, kelurahan=:kelurahan, nama_istri=:nama_istri, jumlah_lahan=:jumlah_lahan, 
        foto=:foto WHERE id=:id";
        $stmt = $this->db->prepare($sql);
        
        $data = [
            ":id" => $id,
            ":nama" => $petani["nama"],
            ":alamat" => $petani["alamat"],
            ":provinsi" => $petani["provinsi"],
            ":kabupaten" => $petani["kabupaten"],
            ":kecamatan" => $petani["kecamatan"],
            ":kelurahan" => $petani["kelurahan"],
            ":nama_istri" => $petani["nama_istri"],
            ":jumlah_lahan" => $petani["jumlah_lahan"],
            ":foto" => $petani["foto"],
        ];
    
        if($stmt->execute($data))
            return $response->withJson(["status" => "success", "data" => "1"], 200);
        
        return $response->withJson(["status" => "failed", "data" => "0"], 200);
    });
    
    
    $app->delete("/petani/{id}", function (Request $request, Response $response, $args){
        $id = $args["id"];
        $sql = "DELETE FROM master_petani WHERE id=:id";
        $stmt = $this->db->prepare($sql);
        
        $data = [
            ":id" => $id
        ];
    
        if($stmt->execute($data))
            return $response->withJson(["status" => "success", "data" => "1"], 200);
        
        return $response->withJson(["status" => "failed", "data" => "0"], 200);
    });
};
