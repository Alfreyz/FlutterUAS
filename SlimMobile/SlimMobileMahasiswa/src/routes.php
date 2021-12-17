<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

return function (App $app) {
    $container = $app->getContainer();

    $app->get("/api/progmob/matkul/{nim_progmob}", function (Request $request, Response $response, $args){
        $nim_progmob = $args["nim_progmob"];
        $sql = "SELECT id,kode,nama,hari,sesi,sks FROM progmob_matkuls WHERE nim_progmob = :nim_progmob";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([":nim_progmob" => $nim_progmob]);
        $result = $stmt->fetchAll();
        return $response->withJson($result, 200);
    });
    
    $app->get("/api/progmob/matkul/{nim_progmob}/{kode}", function (Request $request, Response $response, $args){
        $nim_progmob = $args["nim_progmob"];
        $kode = $args["kode"];
        $sql = "SELECT id,kode,nama,hari,sesi,sks FROM progmob_matkuls WHERE nim_progmob = :nim_progmob AND kode = :kode";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([":nim_progmob" => $nim_progmob, "kode" => $kode]);
        $result = $stmt->fetchAll();
        return $response->withJson($result, 200);
    });
    
    $app->post("/api/progmob/matkul/create", function (Request $request, Response $response){
    
        $new_dosen = $request->getParsedBody();
    
        $sql = "INSERT INTO progmob_matkuls (kode,nama,hari,sesi,sks,nim_progmob) VALUES (:kode, :nama, :hari, :sesi, :sks, :nim_progmob)";
        $stmt = $this->db->prepare($sql);
    
        $data = [
            ":kode" => $new_dosen["kode"],
            ":nama" => $new_dosen["nama"],
            ":hari" => $new_dosen["hari"],
            ":sesi" => $new_dosen["sesi"],
            ":sks" => $new_dosen["sks"],
            ":nim_progmob" => $new_dosen["nim_progmob"],
        ];
    
        if($stmt->execute($data))
            return $response->withJson(["status" => "success"], 200);
        
        return $response->withJson(["status" => "failed"], 200);
    });
    
    $app->put("/api/progmob/matkul/update", function (Request $request, Response $response){
    
        $new_dosen = $request->getParsedBody();
    
        $sql = "UPDATE progmob_matkuls SET kode = :kode, nama = :nama, hari = :hari, sesi = :sesi, sks = :sks
                WHERE kode = :kode_cari AND nim_progmob = :nim_progmob";
        $stmt = $this->db->prepare($sql);
        
        $data = [
            ":kode" => $new_dosen["kode"],
            ":nama" => $new_dosen["nama"],
            ":hari" => $new_dosen["hari"],
            ":sesi" => $new_dosen["sesi"],
            ":sks" => $new_dosen["sks"],
            ":nim_progmob" => $new_dosen["nim_progmob"],
            ":kode_cari" => $new_dosen["kode"],
        ];
    
        if($stmt->execute($data))
            return $response->withJson(["status" => "success"], 200);
        
        return $response->withJson(["status" => "failed"], 200);
    });
    
    $app->delete("/api/progmob/matkul/delete", function (Request $request, Response $response){
    
        $new_dosen = $request->getParsedBody();
    
        $sql = "DELETE FROM progmob_matkuls WHERE kode = :kode AND nim_progmob = :nim_progmob";
        $stmt = $this->db->prepare($sql);
    
        $data = [
            ":kode" => $new_dosen["kode"],
            ":nim_progmob" => $new_dosen["nim_progmob"]
        ];
    
        if($stmt->execute($data))
            return $response->withJson(["status" => "success"], 200);
        
        return $response->withJson(["status" => "failed"], 200);
    });
};
