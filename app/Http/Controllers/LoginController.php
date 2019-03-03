<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class LoginController extends Controller
{

     // chuc nang login
     public function authenticate(Request $request)
     {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
         // du lieu nhap vao
         $email = $request->email;
         $password = $request->password;
         $date_now = date('Y-m-d h:i:s');
         
         $getUser = User::where('email', '=' , $email)->first();
         if(isset($getUser))
         {
            $attampt = $getUser->attempt;
            $last_access = $getUser->last_access;
         }
    
            if (Auth::attempt(['email' => $email, 'password' => $password])) { // dang nhap dung                            
                if($attampt > 2){ // dung nhung attempt qua 3 lan
                    if(strtotime($last_access) < strtotime($date_now) &&  strtotime($date_now) < (strtotime($last_access) + 1800)){
                        $messa = "Tài khoản của bạn bị khóa trong 30 phút ";
                        echo "<script type='text/javascript'>alert('$messa');</script>";
                    }
                    else { // het thoi gian khoa
                        User::where('email' , '=', $email)->update(['attempt' => 0, 'last_access' => $date_now]);
                        return redirect()->route('/');
                    }
                }
                else { // attempt chua toi 3 lan
                    User::where('email' , '=', $email)->update(['attempt' => 0, 'last_access' => $date_now]);
                    return redirect()->route('/');
                }
            }
            else { // dang nhap sai
                if($attampt > 2){
                    $messa = "Tài khoản của bạn bị khóa trong 30 phút ";
                    echo "<script type='text/javascript'>alert('$messa');</script>";
                } 
                    echo "Bạn đã nhập sai mật khẩu!";                   
                    $attampt = $attampt + 1;
                    User::where('email' , '=', $email)->update(['attempt' => $attampt, 'last_access' => $date_now]);
                    return redirect()->back();
                
            }
        
         
        
     }
}



//  echo "thanh cong roi" . $date_now;
//  var_dump($user);

//  else {
//     echo "dang nhap that bai";
// }