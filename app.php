    <?php
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');  
        require_once "connection.php";
        if($_SERVER['REQUEST_METHOD']=="GET"){
            $sql = 'SELECT * FROM students';
            $stmt=$pdo->prepare($sql);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($rows);
            http_response_code(200);
        }
        elseif($_SERVER['REQUEST_METHOD']=="POST"){
            $entityBody = file_get_contents('php://input');
            $decodeBody = json_decode($entityBody);
            var_dump($decodeBody);
            $progress = ($decodeBody->math + $decodeBody->phis + $decodeBody->prog + $decodeBody->physical)/(count((array)$decodeBody) - 1); 
            echo $response = json_encode("Student:$decodeBody->name created");
            $sql = "INSERT INTO students(student_name,math,phis,prog,physical,progress) 
            VALUES (:sname,:math,:phis,:prog,:physical,:progress)";
            $stmt=$pdo->prepare($sql);
            $lol = 43;
            $stmt->execute([
                'sname' => $decodeBody->name,
                'math' => $decodeBody->math,
                'phis' => $decodeBody->phis,
                'prog' => $decodeBody->prog,
                'physical' => $decodeBody->physical,
                'progress' => $progress,
            ]);
        }