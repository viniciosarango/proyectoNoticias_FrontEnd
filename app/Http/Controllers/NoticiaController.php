<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class NoticiaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    //

    public function principal(){
        
        $client = new \GuzzleHttp\Client();
    
        try{
    
            $response = $client->request('GET', $this->URL."/admin/noticias", );    
            $data = json_decode($response -> getBody());
            return view ('fragmentos/principal', ['mensaje' => "", 'base_url' => $this -> BASE_URL, 'noticias'=>$data->data]);
    
            
    
        } 
        catch(\GuzzleHttp\Exception\ClientException $th){
            return view ('fragmentos/principal', ['mensaje' => "", 'base_url' => $this -> BASE_URL, 'noticias'=>[]]);
        }
    }

    public function noticias(Request $request){        
        $client = new \GuzzleHttp\Client();
        $sesion = $_SESSION ["user"];    
        try{
            $response = $client->request('GET', $this->URL."/admin/noticias/user/".$sesion->external, ['headers'=>['api-token'=>$sesion->token]] );    
            $data = json_decode($response -> getBody());
            return view ('fragmentos/noticias', ['mensaje' => "", 'base_url' => $this -> BASE_URL, 'noticias'=>$data->data]);

        } 
        catch(\GuzzleHttp\Exception\ClientException $th){
            return view ('fragmentos/noticias', ['mensaje' => "", 'base_url' => $this -> BASE_URL, 'noticias'=>[]]);
        }
    }

    public function view_guardar(Request $request){                
            return view ('fragmentos/regNoticia', ['mensaje' => "", 'base_url' => $this -> BASE_URL]);        
    }

    public function guardar(Request $request){
        $titulo = $request->input('titulo');
        $cuerpo = $request->input('cuerpo');

        $client = new \GuzzleHttp\Client();

        try{

            $sesion = $_SESSION["user"];

            $response = $client->request('POST', $this->URL."/admin/noticias/guardar", [
                "json" => [
                    "titulo" => $titulo,
                    "cuerpo" => $cuerpo,
                    "fecha" => date("Y-m-d"),
                    "external_usuario" => $sesion->external
                ], 'headers'=>['api-token'=>$sesion->token]
            ]);

            $data = json_decode($response -> getBody());

            if($response -> getStatusCode() == 200){                
                return redirect('/admin/noticias');                
            }             

        } catch(\GuzzleHttp\Exception\ClientException $th){
            if($th -> hasResponse()){
                $dataE = $th->getResponse();
                $dataError = json_decode($dataE -> getBody());
                if(is_string($dataError->data)){
                    return view('fragmentos/regNoticia', ['mensaje' => $dataError->data, 'base_url' => $this -> BASE_URL]);
                } else{
                    $data = $dataError->data->errors;
                    $aux="";
                    foreach($data as $e){
                        $aux = $aux.$e->msg."\n";
                    }
                    return view('fragmentos/regNoticia', ['mensaje' => $aux, 'base_url' => $this -> BASE_URL]);
                }
            } else {
                return view('fragmentos/regNoticia', ['mensaje' => $dataError->data, 'base_url' => $this -> BASE_URL]);
            }
        }

        
    }
}


