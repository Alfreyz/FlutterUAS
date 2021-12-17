<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

return function (App $app) {
    $container = $app->getContainer();

    $app->get("/api/notice/news", function (Request $request, Response $response, $args){
        $sql = "SELECT id,tittle,descriptio,url_img,origin,category,date FROM news";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([":sql" => $sql]);
        $result = $stmt->fetchAll();
        return $response->withJson($result, 200);
    });
    $app->get("/api/notice/news/{category}", function (Request $request, Response $response, $args){
        $category = $args["category"];
        $sql = "SELECT id,tittle,descriptio,url_img,origin,category,date FROM news WHERE category = :category";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([":category" => $category]);
        $result = $stmt->fetchAll();
        return $response->withJson($result, 200);
    });
    
    
    /*
    $app->get("/api/progmob/mhs/{nim_progmob}/{nim_krs}", function (Request $request, Response $response, $args){
        $nim_progmob = $args["nim_progmob"];
        $nim_krs = $args["nim_krs"];
        $sql = "SELECT id,nama,nim,alamat,email,foto FROM progmob_mhs WHERE nim_progmob = :nim_progmob AND nim = :nim_krs";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([":nim_progmob" => $nim_progmob, "nim" => $nim_krs]);
        $result = $stmt->fetchAll();
        return $response->withJson($result, 200);
    });*/
};
