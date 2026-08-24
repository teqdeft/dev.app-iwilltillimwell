<?php

namespace App\Http\Controllers;

use App\Models\Journal;
use Illuminate\Http\Request;
use App\Validators\JournalValidator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Validators\CorporateJournalValidator;

class JournalController extends Controller
{
    public function index(){
        $journal = Journal::where('created_by','admin')->get();
        return view('services.journal.journal',compact('journal'));
    }

     public function store1(Request $request)
    {
		
     $journalValidator = new CorporateJournalValidator();
        try {
            $input = $request->all();
            if (!$journalValidator->with($input)->passes()) {
              $request->session()->flash('error', $journalValidator->getErrors()[0]);
              return back()
              ->withErrors($journalValidator->getValidator())
              ->withInput();
            }

            $journal = new Journal();
            $journal->user_id = Auth::user()->id;
            $journal->title = $request->title;
            $journal->description = $request->description;
            $journal->created_by = 'user';
            $journal->save();
            Session::flash('success','Journal successfully added');
            return redirect(route('corporate.journal-logs'));
          } catch (\Exception $e) {
              $request->session()->flash('error', $e->getMessage());
              return back()->withInput();
          } 
    }

    function journalLogs(Request $request){
        $data = Journal::where('user_id',Auth::user()->id)->get();

        if ($request->wantsJson() || $request->ajax()) {
          $jsonCollection = collect();
          $data->each(function ($item, $key) use ($jsonCollection) {
                $url = url('corporate/destroy');

                $title = "<div class='title'>{$item->title}<span class='readMoreJournal'><i class='fa fa-plus' aria-hidden='true'></i></div>
                            <div class='journalDescription' style='display:none;'>
                                <p>{$item->description}</p></div>";
                $jsonCollection->push([
                    'id'    => $item->id,
                    'title' => $title,
                    'date'  => date('l  h:i A',strtotime($item->created_at)),
                    'delete' => "<a href='javascript:;' number='{$item->id}' class='mood-view-icon deleteByAjax' data-url='{$url}'><i class='fa fa-trash' aria-hidden='true'></i></a>"
                ]);
            });
            return response()->json(['data' => $jsonCollection]);
        }

        return view('services.journal.journalLogs',compact('data'));
    }

    public function destroy(Request $request)
    {
        Journal::destroy($request->id);
        Session::flash('success', 'Journal successfully deleted.');
    }

}
