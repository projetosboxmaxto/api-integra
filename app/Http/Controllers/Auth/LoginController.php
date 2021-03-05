<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\User; 
use Illuminate\Support\Facades\DB;



class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    
    
        public function defaultMessage(Request $request){

      
        Artisan::call('config:clear');
        Artisan::call('cache:clear');
        //Artisan::call('config:cache');
        Artisan::call('view:clear');
        Artisan::call('route:clear');
        
        /*
         * php artisan config:clear
            php artisan cache:clear
            php artisan view:clear
            php artisan route:clear
            composer dump-autoload
         */
        
          //session_destroy();
         //$request->session()->flush();
         return $this->jsonResponse(env("DB_HOST"),"Use o método POST - ". env("APP_ENV")." - ".  env("PATH_ANEXO") ." - ". date("Y-m-d H:i:s"));
    }
    

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
       public function login(Request $request)
        {

            $validator = Validator::make($request->all(), [
                'email' => 'required',
                'password' => 'required'
            ]);

            if($validator->fails()){
                return response($validator->errors());
            }


            $credentials = $request->only('email', 'password');


            return $this->loginSenha($credentials["email"], $credentials["password"], $request);        

            // $user->setAttribute('refresh', $refresh_token);

        }
        
     public function getUserByUsuario($usuario){
         
         $user = User::where("id_usuario", $usuario->id)->first();
         if ( ! $user ){
             $user = new User();
             $user->id_usuario = $usuario->id;
             $user->email = $usuario->login;
             $user->password = \Illuminate\Support\Facades\Hash::make(  "user".$usuario->id );
             $user->name =$usuario->nome;
             $user->save();
         }
         
          if ( is_null($user->api_token) || $user->api_token == ""){
                     $token = $user->createToken('access_token')->accessToken;


                     $user->setAttribute('access_token', $token);
                     $user->setAttribute('api_token', $token);
	             $user->save();
         }
         return $user;
     }   

     public function loginSenha($email, $password, $request){
        
        $email = str_replace("'", "''", $email);
        $user = null;
         
        $sql = "select * from usuario where lower(login)=lower('".$email."') and lower(senha)=lower('".md5(trim($password))."') " ;
        $ls = DB::select($sql);
        
        if ( count($ls) > 0 ){
            $user = $this->getUserByUsuario($ls[0]);
        }else{
            
                        return $this->sendError('Usuário ou senha inválido');
        }
        if (!$user) {
             $user = User::where("email", trim($email) )->first();
        }
     
        
        if (!$user) {
            return $this->sendError('Usuário não existente na base de dados');
        }

        if(empty($user->email)){
            return $this->sendError('Email inválido');
        }
        $credentials = array();

        $credentials['email'] = $user->email;
        $credentials['password'] = $password;
        
        //if (!Auth::attempt($credentials)) {
        //                return $this->sendError('Senha inválida');
       // }
        
        
        // $user = Auth::user();
         
         
         if ( is_null($user->api_token) || $user->api_token == ""){
                     $token = $user->createToken('access_token')->accessToken;


                     $user->setAttribute('access_token', $token);
                     $user->setAttribute('api_token', $token);
	             $user->save();
         }
         
          $saida = array("id"=>$user->id, "nome"=>$user->name,"email"=>$user->email,
                "token"=>$user->api_token, "perfil_id"=>1);

            return $this->sendResponse(  $saida );
       
    }
}
