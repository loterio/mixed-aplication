<?php
    // Get the posted data.
    $postdata = file_get_contents("php://input");
    
    if(isset($postdata) && !empty($postdata))
    {
   
    // Extract the data.
        $request = json_decode($postdata);
        

        // Validate.
        if(trim($request->data->model) === '' || (int)$request->data->price < 1)
        {
            return http_response_code(400);
        }
        $id = $request->data->id;
        $model = $request->data->model;
        $price = $request->data->price;

        try{
            $fp = fopen("arquivo.txt", "a");
            $escreve = fwrite($fp, "$id, $model, $price\n");
            fclose($fp);
            $carro = [
                'model' => $model, 'price' => $price, 'id'=> $id
            ];
            echo json_encode(['data'=>$carro]);
        } catch (Exception $e){
            http_response_code(422);
        }
    }
?>