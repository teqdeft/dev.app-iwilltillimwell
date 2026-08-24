<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Modules\VJ\Models\Cbt;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Models\VJ;
use App\Mail\ShareVjLink;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\VjLinkUsers;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

class VJController extends Controller
{

    function index(Request $request) {
        $user = Auth::user();
        $data = VJ::where(['user_id' => $user->id, 'status' => 1, 'link_visitor' => null])->OrderBy("id", 'DESC')->get();
        $data = ($data) ? $data->toArray() : []; 
        if(isMobile()){
            return view("mobile.services.vj.recorder",compact('data'));
        }
        return view("services.vj.recorder",compact('data'));
        //return view('VJ::recorder', compact('data'));
        //   return view('VJ::index');
    }
    
    function requestedAffirmation(Request $request){
        $user = Auth::user();
        $data = VJ::where(['user_id' => $user->id, 'status' => 1])->whereNotNull('link_visitor')->OrderBy("id", 'DESC')->get();
        $data = ($data) ? $data->toArray() : []; 
        if(isMobile()){
            return view("mobile.services.vj.req-affirmation",compact('data'));
        }
        return view('services.vj.req-affirmation', compact('data'));
        //   return view('VJ::index');
    }

    function store(Request $request) {
        $user = Auth::user();
        $input = $request->all();
        unset($input['_token']);
        if( !empty($input['thought_details']) ){
            $input['thought_details'] = json_encode($input['thought_details']);
        }
        $cbt = ( new Cbt());
        $msg = 'save';
        if( isset($input['id']) ){
            $id = $input['id'];
            unset($input['id']);
            $cbt->where(['user_id' => $user->id,'id' => $id  ])->update($input);
            $msg = 'update';
        }else{
            $input['user_id'] = $user->id;
            $cbt->insert($input);
        }

        $request->session()->flash('success', "Cognitive behavioural successfully {$msg}");
        return redirect('cbt/list');
    }

    function list(Request $request) {
        $user = Auth::user();
        $dataArray = [];
        $data = Cbt::where('user_id',$user->id)->orderBy('created_at','desc')->get();
        if( $data ){
            foreach($data as $key => $value){
                $label = date("D M d Y",strtotime($value->created_at));
                if( date('Y-m-d',strtotime($value->created_at)) == date('Y-m-d') ){
                    $label = "Today";
                }
                $dataArray[date('Y-m-d',strtotime($value->created_at))]['header'] = $label;
                $dataArray[date('Y-m-d',strtotime($value->created_at))]['list'][] = $value;
            }
        }
        return view('CBT::list',compact('dataArray'));
    }

    function edit(Request $request, $id) {
        $user = Auth::user();
        $data = Cbt::where(['user_id' => $user->id,'id' => $id ])->first();
        return view('CBT::edit',compact('data'));
    }

    function delete(Request $request) {
        $user = Auth::user();
        $input = $request->all();
        Cbt::where(['user_id' => $user->id,'id' => $input['id'] ])->delete();
    }

    function cbtView(Request $request) {
        $user = Auth::user();
        $input = $request->all();
        $data = Cbt::where(['user_id' => $user->id,'id' => $input['id'] ])->first();
        $html = View::make('CBT::view', compact('data'))->render();
		return response()->json(['data' => $html]);
    }
    
    public function uploadAudio(Request $request) {
		
        $user = Auth::user();		
        $input = $request->all();
        try {
            if ($request->hasFile('audio_data')) {
				
                $audioFile = $request->file('audio_data');
                $filename = 'voice-journal-'.strtotime($audioFile->getClientOriginalName());
                				
                $fileExtension = 'wav';
                
                $publicPath = public_path();
                
               
                $fullFilename = $filename . '.' . $fileExtension;
        
              
                $audioFile->move($publicPath . '/audio', $fullFilename);
				
				
                $data = [];
                if ($user) {
                    $data['user_id'] = $user->id;
                }
                $data['voice_text'] = $input['audio_text'];
                $data['file_name'] = $fullFilename;
                
                $visitorToken = isset($input['visitor_token']) ? $input['visitor_token'] : '';
				
				
                if(!empty($visitorToken)) {
                    $sharedData = VjLinkUsers::where('token', $visitorToken)->first();
					if($sharedData) {
						$data['user_id'] = $sharedData['user_id'];
						$data['link_visitor'] = isset($input['link_visitor']) ? $input['link_visitor'] : null;
						$data['link_visitor_email'] = isset($input['link_visitor_email']) ? $input['link_visitor_email'] : null;
						VjLinkUsers::where('token', $visitorToken)->delete();
					}
                }
               
				/* echo "<pre>";
				print_r($data);
				echo "</pre>"; */
                $saveRes = VJ::create($data);
                $this->uploadFileToFtp($fullFilename);
				return response()->json(['success' => true, 'filename' => $fullFilename, 'saved_id' => $saveRes->id]);
				
				 
            }
            
            return response()->json(['success' => false, 'message' => 'File not found.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
		
    }
    
    public function deleteRecording($id) {
        if ($id) {
        // Implement logic to delete the recording with the given $id
        // For example, assuming you have a model named Recording:
        VJ::where('id', $id)->delete();

        // Return a response indicating success or failure
        return response()->json(['success' => true, 'message' => 'Recording deleted successfully']);
        }
        return response()->json(['success' => false, 'message' => 'error']);
    }
    
    // Voice journal page for visitor
    public function vjShare($token) {
        
		
        Config::set('app.debug', true);
        $user = Auth::user();
        $data = VjLinkUsers::where(['token' => $token, 'status' => 1])->first();
        if (!$token || !$data) {
            return redirect('/');
        }
        $owner = $user;
        if (!$user) {
            $owner = User::where(['id' => $data['user_id']])->first();
        }
   
        if(isMobile()) {
            return view("mobile.services.vj.vj-share", compact('data', 'user', 'owner'));
        }
		return view("services.vj.vj-share",compact('data', 'user', 'owner'));
		/*
        return view('VJ::vj-share', compact('data', 'user', 'owner')); 
		*/
    }
    
    // store link with sending email to visitor
    public function shareLinkViaProvider(Request $request) {

        $input = $request->all();
        $user = Auth::user();
        
        
        if ($input) {
            
            $checkExisting = VjLinkUsers::where(['shared_on_email' => $input['email']])->first();
            if ($checkExisting) {
                return response()->json(['success' => false, 'message' => 'Link already shared with this email.']);        
            }
           
			/* echo "<pre>";
			print_r($input);
			echo "</pre>"; */
            $data = [];
            $data['user_id'] = $user->id;
            $data['shared_on_email'] = $input['email'];
            $data['shared_on_name'] = $input['name'];
            $data['token'] = $input['share_token'];
            $res = VjLinkUsers::insert($data);
            if ($res) {

                
                $linkEcrypt = url('voice-journal') . "/" . $data['token'];
                $html = "<h4><a style='color: blue;' href='{$linkEcrypt}'>{$linkEcrypt}</a></h4>";
                if (isset($input['message'])) {
                    $html .= "<h4><b>Message: {$input['message']}</b></h4>";
                }
                
                $title = "<h4>Hi, {$input['name']}</h4>";
                $title .= "<h4> {$user->name} is inviting you to record an uplifting positive affirmation to be stored in their personal journal to remind them of how important they are or how they add value to the lives of others.</h4>";
                $title .= "<h4>Please check link below.</h4>";
                
				$shared_on_name = $input['name'];
				$message = $input['message'];
                $bodyHtml = ['body' => $html,'title' => $title,'linkEcrypt' => $linkEcrypt,'message' => $message,'shared_on_name' => $shared_on_name ];
                
                $mailRes = Mail::to($input['email'])->send(new ShareVjLink($input['email'], $bodyHtml, $user->name));
				
                return response()->json(['success' => true, 'message' => 'link shared successfully']);        
            
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong here.']);
        
    }

    public function uploadFileToFtp($name=null)
    {
        if(env('upload_audio')=="imwell_app") {
            $localFilePath = public_path("audio/$name");
            Storage::disk('ftp')->put($name, file_get_contents($localFilePath));
            unlink(public_path("audio/$name"));
            return true;
        }
    }
}
