<?php

namespace App\Http\Controllers\Admin;

use App\Models\Journal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SendToFriendList;
use App\Validators\JournalValidator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class JournalController extends Controller
{
    public function index(Request $request){

    $user = Auth::user();
	if(isMobile()) {
		return redirect('my-journal-written');
	}
		
      if($user->user_role=="user") {
		
        $journal = DB::table('journals')
						->where('created_by', 'admin')
						->orWhere(function($query) {
							$query->where('created_by', 'user')
								  ->where('user_id',Auth::user()->id);
						})
						->orderBy('id', 'desc')
						->get();
						
        $friendContact = SendToFriendList::orderBy('id','desc')->get();
        return view('services.journal.journal',compact('journal','friendContact'));
      }

        $journal = [];
        $journal = Journal::all()->sortByDesc("id");
        if ($request->wantsJson() || $request->ajax()) {
          $jsonCollection = collect();
          $journal->each(function ($item, $key) use ($jsonCollection) {
              $img = asset($item->thumbnail);
                $jsonCollection->push([
                    'sr_no' => $key+1,
                    'id'    => $item->id,
                    'title' => $item->title,
                ]);
            });
            return response()->json(['data' => $jsonCollection]);
        }
		
        return view('admin.journal.index');
    }

    public function mobileIndex() {
      $journal = Journal::where('created_by','admin')->get();
      return view('mobile.services.journal.create',compact('journal'));
    }

    public function ViewJournalLog() {
      if(isMobile()){
        return view('mobile.services.journal.view-log');
      }		
     	
	  $data = Journal::where('user_id', Auth::id())
               ->orderBy('created_at', 'desc')
               ->paginate(12); 
			   
      return view('services.journal.journalLogs',compact('data'));
    } 

    public function create(Request $request){
        $journal = [];
        return view('admin.journal.create',compact('journal'));
    }

    public function edit($id)
    {
      $journal = [];
      if($id){
        $journal = Journal::find($id);
      }
      return view('admin.journal.create',compact('journal'));
    }

    public function destroy($id)
    {
        Journal::destroy($id);
        Session::flash('success', 'Journal successfully deleted.');
        return redirect(route('admin.journal'));
    }

    public function destroyMobile(Request $request) {
        Journal::destroy($request->id);
        Session::flash('success', 'Journal successfully deleted.');
       // return redirect()->back();
    }

    public function store(Request $request)
    {
        $journalValidator = new JournalValidator();
        try {
           $user_role = Auth::user()->user_role; 
            $input = $request->all();
            if (!$journalValidator->with($input)->passes()) {
              $request->session()->flash('error', $journalValidator->getErrors()[0]);
              return back()
              ->withErrors($journalValidator->getValidator())
              ->withInput();
            }

            $journal = new Journal();
            $sessionMsg = 'Journal successfully created.';
            if( !empty($request->id) ){
              $journal = $journal->find($request->id);
              $sessionMsg = 'Journal successfully updated.';
            }

            $journal->user_id = Auth::user()->id;
            $journal->title = $request->title;
            $journal->mood_id = $request->mood_id??'0';
            $journal->description = $request->description;
            $journal->created_by = 'admin';
            if($user_role=="user"){
              $journal->created_by = 'user';
            }
            $journal->save();
            
            if(isMobile()){
			
              if($request->page=="mood") {
                return true;
              }
			  
			  return response()->json([
					'success' => true,
					'message' =>$sessionMsg,
				], 200);
				
			
				
            }
			
			Session::flash('success',$sessionMsg);
            if($user_role=="user") {
              return redirect()->back();
            }

            return redirect(route('admin.journal'));
          } catch (\Exception $e) {
			  
			  if(isMobile()){
				  
				return response()->json([
					'success' => false,
					'message' =>$e->getMessage(),
				], 422);
				
			  }
			  
              $request->session()->flash('error', $e->getMessage());
              return back()->withInput();
          }
    }


    function journalLogs(Request $request){
      $data = Journal::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->get();

      if ($request->wantsJson() || $request->ajax()) {
        $jsonCollection = collect();
        $data->each(function ($item, $key) use ($jsonCollection) {

              if(isMobile()) {

                $download_ico = asset('assets/dashboard/assets/images/download-icon-svg.svg'); 

                $delete_ico = asset('assets/dashboard/assets/images/delete-vector.svg');
                $watchgrayicon = asset('assets/dashboard/assets/images/watch-gray-icon.svg');
                
                $top = '<div class="title"><p>'.$item->title.'</p></div>
                      <div class="right">
                        <a href="javascript:void(0)">
                          <img src="'.$download_ico.'" alt="icon" style="display:none;">
                        </a>
                        <a href="javascript:void(0)" class="delete-journal open-modal delete-m" data-modal="CereateJournalModal" deleted_id='.$item->id.'>
                          <img src="'.$delete_ico.'" alt="icon">
                        </a>
                        </div>';

                $timmer = '<div class="wat"><img src="'.$watchgrayicon.'" alt="icon"></div><div class="time"><p>'.date('d M y h:s A',strtotime($item->created_at)).'</p></div>';
                $content = '<p>'.$item->description.'</p>';
                
                          $jsonCollection->push([
                              'id'  => $item->id,
                              'top' => $top,
                              'timmer'=>$timmer,
                              'content' => $content
                          ]);


              } else {
                $url = url('view-journal-log-post-deleted');
                $title = "<div class='title'>{$item->title}<span class='readMoreJournal'><i class='fa fa-plus' aria-hidden='true'></i></div>
                            <div class='journalDescription' style='display:none;'>
                                <p>{$item->description}</p></div>";
                $jsonCollection->push([
                    'id'    => $item->id,
                    'title' => $title,
                    'date'  => date('d M y h:s A',strtotime($item->created_at)),
                    'delete' => "<a href='javascript:;' number='{$item->id}' class='mood-view-icon deleteByAjax' data-url='{$url}'><i class='fa fa-trash' aria-hidden='true'></i></a>"
                ]);

            }

          });
          return response()->json(['data' => $jsonCollection]);
      }
      return view('Journal::journalLogs',compact('data'));
  }
  
    public function journalDeleted(Request $request) {
	  
		Journal::where('user_id', Auth::user()->id)->where('id', $request->id)->delete();
		
	}

}
