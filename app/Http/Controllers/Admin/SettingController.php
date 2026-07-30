namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;


class SettingController extends Controller
{

    public function index()
    {
        $settings = Setting::first();

        return view('admin.settings.index',
        compact('settings'));
    }



    public function update(Request $request)
    {

        $settings = Setting::first();

        $settings->update([

            'system_name'=>$request->system_name,

            'company_name'=>$request->company_name,

            'email'=>$request->email,

            'registration_enabled'=>$request->registration_enabled

        ]);


        return back()->with(
            'success',
            'Settings updated successfully'
        );

    }

}