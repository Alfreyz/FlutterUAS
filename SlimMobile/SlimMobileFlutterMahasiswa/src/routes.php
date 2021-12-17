<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

return function (App $app) {
    $container = $app->getContainer();

    $app->get("/api/{nim_progmob}", function (Request $request, Response $response, $args){
        $nim_progmob = $args["nim_progmob"];
        $sql = "SELECT id,nama,nim,alamat,email,foto FROM progmob_mhs WHERE nim_progmob = :nim_progmob";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([":nim_progmob" => $nim_progmob]);
        $result = $stmt->fetchAll();
        return $response->withJson($result, 200);
    });
    
    $app->get("/api/progmob/mhs/{nim_progmob}/{nim_krs}", function (Request $request, Response $response, $args){
        $nim_progmob = $args["nim_progmob"];
        $nim_krs = $args["nim_krs"];
        $sql = "SELECT id,nama,nim,alamat,email,foto FROM progmob_mhs WHERE nim_progmob = :nim_progmob AND nim = :nim_krs";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([":nim_progmob" => $nim_progmob, "nim" => $nim_krs]);
        $result = $stmt->fetchAll();
        return $response->withJson($result, 200);
    });
    
    $app->post("/api/progmob/mhs/create", function (Request $request, Response $response){
    
        $new_mhs = $request->getParsedBody();
    
        $sql = "INSERT INTO progmob_mhs (nama,nim,alamat,email,foto,nim_progmob) VALUES (:nama, :nim, :alamat, :email, :foto, :nim_progmob)";
        $stmt = $this->db->prepare($sql);
    
        $data = [
            ":nama" => $new_mhs["nama"],
            ":nim" => $new_mhs["nim"],
            ":alamat" => $new_mhs["alamat"],
            ":email" => $new_mhs["email"],
            ":foto" => "https://images.unsplash.com/photo-1508138221679-760a23a2285b?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1567&q=80",
            ":nim_progmob" => $new_mhs["nim_progmob"],
        ];
    
        if($stmt->execute($data))
            return $response->withJson(["status" => "success"], 200);
        
        return $response->withJson(["status" => "failed"], 200);
    });
    
    $app->post("/api/progmob/mhs/createwithfoto", function (Request $request, Response $response){
    
        $new_mhs = $request->getParsedBody();
    
        $uploadedFiles = $request->getUploadedFiles();
        $uploadedFile = $uploadedFiles['foto'];
    
        if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
        
            $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
            
            // ubah nama file dengan id unik
            $filename = md5(uniqid().mt_rand()).".".$extension;
            
            $directory = $this->get('settings')['upload_directory'];
            $uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $filename);
    
            // simpan nama file ke database
            $sql = "INSERT INTO progmob_mhs (nama,nim,alamat,email,foto,nim_progmob) VALUES (:nama, :nim, :alamat, :email, :foto, :nim_progmob)";
            $stmt = $this->db->prepare($sql);
        
            $data = [
                ":nama" => $new_mhs["nama"],
                ":nim" => $new_mhs["nim"],
                ":alamat" => $new_mhs["alamat"],
                ":email" => $new_mhs["email"],
                ":foto" => $request->getUri()->getBaseUrl()."/uploads/".$filename,
                ":nim_progmob" => $new_mhs["nim_progmob"],
            ];
    
            if($stmt->execute($data))
                return $response->withJson(["status" => "success"], 200);
            else
                return $response->withJson(["status" => "failed"], 200);
        }
    });
    
    $app->post("/api/progmob/mhs/update", function (Request $request, Response $response){
    
        $new_mhs = $request->getParsedBody();
    
        $sql = "UPDATE progmob_mhs SET nama = :nama, nim = :nim, alamat = :alamat, email = :email, foto = :foto
                WHERE nim = :nim_cari AND nim_progmob = :nim_progmob";
        $stmt = $this->db->prepare($sql);
    
        $data = [
            ":nama" => $new_mhs["nama"],
            ":nim" => $new_mhs["nim"],
            ":alamat" => $new_mhs["alamat"],
            ":email" => $new_mhs["email"],
            ":foto" => "https://images.unsplash.com/photo-1508138221679-760a23a2285b?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1567&q=80",
            ":nim_progmob" => $new_mhs["nim_progmob"],
            ":nim_cari" => $new_mhs["nim_cari"]
        ];
    
        if($stmt->execute($data))
            return $response->withJson(["status" => "success"], 200);
        
        return $response->withJson(["status" => "failed"], 200);
    });
    
    $app->post("/api/progmob/mhs/updatewithfoto", function (Request $request, Response $response){
    
        $new_mhs = $request->getParsedBody();
    
        //cek kalau tidak upload foto
        if($new_mhs["is_foto_update"] == '0'){
            // simpan nama file ke database
            $new_mhs = $request->getParsedBody();
        
            $sql = "UPDATE progmob_mhs SET nama = :nama, nim = :nim, alamat = :alamat, email = :email
                    WHERE nim = :nim_cari AND nim_progmob = :nim_progmob";
            $stmt = $this->db->prepare($sql);
        
            $data = [
                ":nama" => $new_mhs["nama"],
                ":nim" => $new_mhs["nim"],
                ":alamat" => $new_mhs["alamat"],
                ":email" => $new_mhs["email"],
                ":nim_progmob" => $new_mhs["nim_progmob"],
                ":nim_cari" => $new_mhs["nim_cari"]
            ];
    
            if($stmt->execute($data))
                return $response->withJson(["status" => "success"], 200);
            else
                return $response->withJson(["status" => "failed"], 200);
        }else{
            $uploadedFiles = $request->getUploadedFiles();
            $uploadedFile = $uploadedFiles['foto'];
    
            if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
            
                $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
                
                // ubah nama file dengan id unik
                $filename = md5(uniqid().mt_rand()).".".$extension;
                
                $directory = $this->get('settings')['upload_directory'];
                $uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $filename);
        
                // simpan nama file ke database
                $new_mhs = $request->getParsedBody();
        
                $sql = "UPDATE progmob_mhs SET nama = :nama, nim = :nim, alamat = :alamat, email = :email, foto = :foto
                        WHERE nim = :nim_cari AND nim_progmob = :nim_progmob";
                $stmt = $this->db->prepare($sql);
            
                $data = [
                    ":nama" => $new_mhs["nama"],
                    ":nim" => $new_mhs["nim"],
                    ":alamat" => $new_mhs["alamat"],
                    ":email" => $new_mhs["email"],
                    ":foto" => $request->getUri()->getBaseUrl()."/uploads/".$filename,
                    ":nim_progmob" => $new_mhs["nim_progmob"],
                    ":nim_cari" => $new_mhs["nim_cari"]
                ];
    
                if($stmt->execute($data))
                    return $response->withJson(["status" => "success"], 200);
                else
                    return $response->withJson(["status" => "failed"], 200);
            }
        }
    });
    
    $app->post("/api/progmob/mhs/delete", function (Request $request, Response $response){
    
        $new_mhs = $request->getParsedBody();
    
        $sql = "DELETE FROM progmob_mhs WHERE nim = :nim AND nim_progmob = :nim_progmob";
        $stmt = $this->db->prepare($sql);
    
        $data = [
            ":nim" => $new_mhs["nim"],
            ":nim_progmob" => $new_mhs["nim_progmob"]
        ];
    
        if($stmt->execute($data))
            return $response->withJson(["status" => "success"], 200);
        
        return $response->withJson(["status" => "failed"], 200);
    });
    $app->get("/api/progmob/dosen/{nim_progmob}", function (Request $request, Response $response, $args){
        $nim_progmob = $args["nim_progmob"];
        $sql = "SELECT id,nama,nidn,alamat,email,gelar,foto FROM progmob_dosens WHERE nim_progmob = :nim_progmob";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([":nim_progmob" => $nim_progmob]);
        $result = $stmt->fetchAll();
        return $response->withJson($result, 200);
    });
    
    $app->get("/api/progmob/dosen/{nim_progmob}/{nidn}", function (Request $request, Response $response, $args){
        $nim_progmob = $args["nim_progmob"];
        $nidn = $args["nidn"];
        $sql = "SELECT id,nama,nidn,alamat,email,gelar,foto FROM progmob_dosens WHERE nim_progmob = :nim_progmob AND nidn = :nidn";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([":nim_progmob" => $nim_progmob, "nidn" => $nidn]);
        $result = $stmt->fetchAll();
        return $response->withJson($result, 200);
    });
    
    $app->post("/api/progmob/dosen/create", function (Request $request, Response $response){
    
        $new_dosen = $request->getParsedBody();
    
        $sql = "INSERT INTO progmob_dosens (nama,nidn,alamat,email,gelar,foto,nim_progmob) VALUES (:nama, :nidn, :alamat, :email, :gelar, :foto, :nim_progmob)";
        $stmt = $this->db->prepare($sql);
    
        $data = [
            ":nama" => $new_dosen["nama"],
            ":nidn" => $new_dosen["nidn"],
            ":alamat" => $new_dosen["alamat"],
            ":email" => $new_dosen["email"],
            ":gelar" => $new_dosen["gelar"],
            ":foto" => "https://images.unsplash.com/photo-1508138221679-760a23a2285b?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1567&q=80",
            ":nim_progmob" => $new_dosen["nim_progmob"],
        ];
    
        if($stmt->execute($data))
            return $response->withJson(["status" => "success"], 200);
        
        return $response->withJson(["status" => "failed"], 200);
    });
    
    $app->post("/api/progmob/dosen/update", function (Request $request, Response $response){
    
        $new_dosen = $request->getParsedBody();
    
        $sql = "UPDATE progmob_dosens SET nama = :nama, nidn = :nidn, alamat = :alamat, email = :email, gelar = :gelar, foto = :foto
                WHERE nidn = :nidn_cari AND nim_progmob = :nim_progmob";
        $stmt = $this->db->prepare($sql);
    
        $data = [
            ":nama" => $new_dosen["nama"],
            ":nidn" => $new_dosen["nidn"],
            ":alamat" => $new_dosen["alamat"],
            ":email" => $new_dosen["email"],
            ":gelar" => $new_dosen["gelar"],
            ":foto" => "https://images.unsplash.com/photo-1508138221679-760a23a2285b?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1567&q=80",
            ":nim_progmob" => $new_dosen["nim_progmob"],
            ":nidn_cari" => $new_dosen["nidn_cari"],
        ];
    
        if($stmt->execute($data))
            return $response->withJson(["status" => "success"], 200);
        
        return $response->withJson(["status" => "failed"], 200);
    });
    
    $app->post("/api/progmob/dosen/createwithfoto", function (Request $request, Response $response){
    
        $new_dosen = $request->getParsedBody();
        $uploadedFiles = $request->getUploadedFiles();
        $uploadedFile = $uploadedFiles['foto'];
    
        if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
        
            $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
            
            // ubah nama file dengan id unik
            $filename = md5(uniqid().mt_rand()).".".$extension;
            
            $directory = $this->get('settings')['upload_directory'];
            $uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $filename);
    
            // simpan nama file ke database
            $sql = "INSERT INTO progmob_dosens (nama,nidn,alamat,email,gelar,foto,nim_progmob) VALUES (:nama, :nidn, :alamat, :email, :gelar, :foto, :nim_progmob)";
            $stmt = $this->db->prepare($sql);
        
            $data = [
                ":nama" => $new_dosen["nama"],
                ":nidn" => $new_dosen["nidn"],
                ":alamat" => $new_dosen["alamat"],
                ":email" => $new_dosen["email"],
                ":gelar" => $new_dosen["gelar"],
                ":foto" => $request->getUri()->getBaseUrl()."/uploads/".$filename,
                ":nim_progmob" => $new_dosen["nim_progmob"],
            ];
    
            if($stmt->execute($data))
                return $response->withJson(["status" => "success"], 200);
            else
                return $response->withJson(["status" => "failed"], 200);
        }
    });
    
    $app->post("/api/progmob/dosen/updatewithfoto", function (Request $request, Response $response){
        $new_dosen = $request->getParsedBody();
        if($new_dosen["is_foto_update"] == '0'){
            // simpan nama file ke database
            $sql = "UPDATE progmob_dosens SET nama = :nama, nidn = :nidn, alamat = :alamat, email = :email, gelar = :gelar
            WHERE nidn = :nidn_cari AND nim_progmob = :nim_progmob";
            
            $stmt = $this->db->prepare($sql);
            $data = [
                ":nama" => $new_dosen["nama"],
                ":nidn" => $new_dosen["nidn"],
                ":alamat" => $new_dosen["alamat"],
                ":email" => $new_dosen["email"],
                ":gelar" => $new_dosen["gelar"],
                ":nim_progmob" => $new_dosen["nim_progmob"],
                ":nidn_cari" => $new_dosen["nidn_cari"],
            ];
    
            if($stmt->execute($data))
                return $response->withJson(["status" => "success"], 200);
            else
                return $response->withJson(["status" => "failed"], 200);
        }else{
            $uploadedFiles = $request->getUploadedFiles();
            $uploadedFile = $uploadedFiles['foto'];
            
            if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
        
                $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
                
                // ubah nama file dengan id unik
                $filename = md5(uniqid().mt_rand()).".".$extension;
                
                $directory = $this->get('settings')['upload_directory'];
                $uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $filename);
        
                // simpan nama file ke database
                $sql = "UPDATE progmob_dosens SET nama = :nama, nidn = :nidn, alamat = :alamat, email = :email, gelar = :gelar, foto = :foto
                    WHERE nidn = :nidn_cari AND nim_progmob = :nim_progmob";
                $stmt = $this->db->prepare($sql);
            
                $data = [
                    ":nama" => $new_dosen["nama"],
                    ":nidn" => $new_dosen["nidn"],
                    ":alamat" => $new_dosen["alamat"],
                    ":email" => $new_dosen["email"],
                    ":gelar" => $new_dosen["gelar"],
                    ":foto" => $request->getUri()->getBaseUrl()."/uploads/".$filename,
                    ":nim_progmob" => $new_dosen["nim_progmob"],
                    ":nidn_cari" => $new_dosen["nidn_cari"],
                ];
    
                if($stmt->execute($data))
                    return $response->withJson(["status" => "success"], 200);
                else
                    return $response->withJson(["status" => "failed"], 200);
            }
        }
    });
    
    $app->post("/api/progmob/dosen/delete", function (Request $request, Response $response){
    
        $new_dosen = $request->getParsedBody();
    
        $sql = "DELETE FROM progmob_dosens WHERE nidn = :nidn AND nim_progmob = :nim_progmob";
        $stmt = $this->db->prepare($sql);
    
        $data = [
            ":nidn" => $new_dosen["nidn"],
            ":nim_progmob" => $new_dosen["nim_progmob"]
        ];
    
        if($stmt->execute($data))
            return $response->withJson(["status" => "success"], 200);
        
        return $response->withJson(["status" => "failed"], 200);
    });
};
