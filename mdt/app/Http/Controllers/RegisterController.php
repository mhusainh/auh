    <?php

    namespace App\Http\Controllers;

    use App\Models\User;
    use Illuminate\Support\Facades\Validator;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;

    class RegisterController extends Controller
    {
        public function index(Request $request)
        {
            // Validate the input data
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|unique:users',
                'nik' => 'required|unique:users',
                'nomorhp' => 'required|unique:users',
                'password' => 'required|confirmed|min:8', // Ensure password has minimum 8 characters
            ]);

            // Check if validation pass
            if ($validator->passes()) {
                $user = new User();
                $user->name = $request->name;
                $user->nik = $request->nik;
                $user->email = $request->email;
                $user->nomorhp = $request->nomorhp;
                $user->password = Hash::make($request->password);
                $user->save();
                return redirect()->route('account.login');
            } else {
                return redirect()->route('account.login')
                    ->withInput()
                    ->withErrors($validator);
            }
        }
    }
