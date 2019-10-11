    <?php
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');  
        require_once "connection.php";
        if($_SERVER['REQUEST_METHOD']=="GET"){
            $sql = 'SELECT * FROM studentsv1';
            $stmt=$pdo->prepare($sql);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // $sortStudent = 'SELECT * FROM studentsv1 WHERE '
            
            // foreach( $rows as $key){
            //     foreach($key as $value){
            //         if(){
                        
            //         }
            //     }
            // }
            // var_dump($rows);
            //var_dump($rows);
            // function callSortTop($re){
            //     if(is_string($re)||$re<89){
            //         return false;
            //     }
            //     else{
            //         return true;
            //     }
            //     // foreach($re as $key){
            //     //     if(is_string($key) || $key<89 ){
            //     //         return false;
            //     //     }
            //     //     else{
            //     //         return true;
            //     //     }
            //     // }
            // }
            // function sortStudentSuccess($students){
            //     foreach((array)$students as $key => $value ){
            //         //var_dump($value);
            //         $result = array_filter($value,"callSortTop");
            //         var_dump($result);
            //     }
            // }
            // sortStudentSuccess($rows);

            echo json_encode($rows);
            http_response_code(200);
        }
        elseif($_SERVER['REQUEST_METHOD']=="POST"){
            $entityBody = file_get_contents('php://input');
            $decodeBody = json_decode($entityBody);
            // var_dump($decodeBody);
            $progress = ($decodeBody->math + $decodeBody->phis + $decodeBody->prog + $decodeBody->phisical)/(count((array)$decodeBody) - 1);
            $response =  "Student:$decodeBody->name created";
            echo $response = json_encode($response);
            $sql = "INSERT INTO studentsv1(student_name,math,phis,prog,phisical,progress) 
            VALUES (:sname,:math,:phis,:prog,:physical,:progress)";
            $stmt=$pdo->prepare($sql);
            $lol = 43;
            $stmt->execute([
                'sname' => $decodeBody->name,
                'math' => $decodeBody->math,
                'phis' => $decodeBody->phis,
                'prog' => $decodeBody->prog,
                'physical' => $decodeBody->phisical,
                'progress' => $progress,
            ]);
        }