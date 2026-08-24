<?php



namespace App\Http\Controllers;



use App\Models\UserMood;

use App\Models\visitor;

use Exception;

use Illuminate\Http\Request;

use Illuminate\Support\Arr;

use Illuminate\Support\Facades\Auth;



class GraphController extends Controller

{

    

    public function feelingHistoryGraph() {

		

        $endDate = date('Y-m-d 23:59:00');

        $startDate = date('Y-m-d 23:59:00', strtotime("-3 months", strtotime($endDate)));

        if( isset($_GET['startDate']) && isset($_GET['endDate']) ){

            $startDate = date('Y-m-d 00:00',strtotime($_GET['startDate']));

            $endDate = $_GET['endDate'] . " 23:59";

        }

        

        $screenHead = formatScreeningHistory($startDate,$endDate);

        $userMood = UserMood::where("user_id",auth()->user()->id)->orderBy('created_at','asc')->whereBetween('created_at',[$startDate,$endDate])->get()->toArray();

        $data = [];

        $s_number = $d_number = $h_number = $sd_number = $ang_number = $fear_number = 0;

        if( $userMood ){

			

            foreach($userMood as $key => $value){

				

				

					/* echo "<pre>";

					print_r($value);

					echo "</pre>"; :SURPRISE:*/

                    if($value['mood']==":SURPRISE:") {

						

                        $s_number += $value['mood_number']; 

                        $data['mood']['surprised'] = $s_number;

                    } else if($value['mood']==":DISGUSTED:") {

                        $d_number += $value['mood_number']; 

                        $data['mood']['disgusted'] = $d_number;

                    } else if($value['mood']==":HAPPY:") {

						

                        $h_number += $value['mood_number']; 

                        $data['mood']['happy'] = $h_number;

                    } else if($value['mood']==":SAD:") {

                        $sd_number += $value['mood_number']; 

                        $data['mood']['sad'] = $sd_number;

                    } else if($value['mood']==":ANGER:") {

                        $ang_number += $value['mood_number']; 

                        $data['mood']['angry'] = $ang_number;

                    } else if($value['mood']==":FEARFUL:") {

                        $fear_number += $value['mood_number']; 

                        $data['mood']['fear'] = $fear_number;

                    }

            }

        }

		/* echo $h_number;

		echo "---"; */

        if(isMobile()) {

            return view("mobile.services.moods.feeling-history-graph-2",compact('data','screenHead'));

        }

        return view("services.moods.feeling-history-graph",compact('data','screenHead'));

        

    }



    public function feelingHistoryGraph2() {



        $endDate = date('Y-m-d 23:59:00');

        $startDate = date('Y-m-d 23:59:00', strtotime("-12 months", strtotime($endDate)));

        if( isset($_GET['startDate']) && isset($_GET['endDate']) ){

            $startDate = date('Y-m-d 00:00',strtotime($_GET['startDate']));

            $endDate = $_GET['endDate'] . " 23:59";

        }



        $screenHead = graphDataBydate($startDate,$endDate);

        $userMood = UserMood::orderBy('created_at','asc')->whereBetween('created_at',[$startDate,$endDate])->get()->toArray();

        $data = [];

        $s_number = $d_number = $h_number = $sd_number = $ang_number = $fear_number = 0;

        if( $userMood ){

            foreach($userMood as $key => $value){



                    if($value['mood']==":SURPRISED:") {

                        $s_number += $value['mood_number']; 

                        $data['mood']['surprised'] = $s_number;

                    } else if($value['mood']==":DISGUSTED:") {

                        $d_number += $value['mood_number']; 

                        $data['mood']['disgusted'] = $d_number;

                    } else if($value['mood']==":HAPPY:") {

                        $h_number += $value['mood_number']; 

                        $data['mood']['happy'] = $h_number;

                    } else if($value['mood']==":SAD:") {

                        $sd_number += $value['mood_number']; 

                        $data['mood']['sad'] = $sd_number;

                    } else if($value['mood']==":ANGRY:") {

                        $ang_number += $value['mood_number']; 

                        $data['mood']['angry'] = $ang_number;

                    } else if($value['mood']==":FEARFUL:") {

                        $fear_number += $value['mood_number']; 

                        $data['mood']['fear'] = $fear_number;

                    }

            }

        }

		

        return view("mobile.services.moods.feeling-history-graph-2");



    }

    public function screeningHistoryGraph() {



        try {

			

			$startDate = date('Y-m-d 00:00:00');

            $endDate = date('Y-m-d 23:59:00');

            

            //$startDate = date('Y-m-d 23:59:00', strtotime("-3 months", strtotime($endDate)));

            

            if( isset($_GET['startDate']) && isset($_GET['endDate']) ){

                $startDate = date('Y-m-d 00:00:00',strtotime($_GET['startDate']));

                $endDate = $_GET['endDate'] . " 23:59:00";

            }

			/* echo "Start Date ".$startDate."<br/>";

			echo "End Date ".$endDate; */

    

            $screenHead = formatScreeningHistory($startDate,$endDate);

            $userAnswer  = visitor::with('quizAnswer')

                        //->whereBetween('created_at',[$startDate,$endDate])

                        ->whereHas('quizAnswer', function($query) use($startDate,$endDate) {

                            $query->where('created_at', '>=', $startDate )->where('created_at', '<=', $endDate );

                           

                        })->where('user_id',Auth::user()->id)->orderBy('id','asc')->get()->toArray();

            $quizChartJs = $quizDataBind = $dataByTitle = $screeningData = $screening = $color = $quiz = [];

            /*

			echo "<pre>";

			print_r($userAnswer);

			echo "</pre>";

			die("==========="); 

			*/

			  

            if( $userAnswer ) {

                $i = 0;

                foreach($userAnswer as $key => $value) {

                    if($value['quiz_answer']) {

                        $sum = 0;

                        foreach( $value['quiz_answer'] as $quizKey => $quizValue ) {

							

							$created_at = date('Y-m-d 00:00:00',strtotime($quizValue['created_at'])); 

							

							if( $startDate <= $created_at && $endDate >=$created_at) {

								

								

								

						

								

							

							

                            /* if( $startDate <= date('Y-m-d 00:00:00',strtotime($quizValue['created_at'])) && $endDate >= date('Y-m-d 23:59:00',strtotime($quizValue['created_at'])) ){} 

							*/	

                                $quiz['label']['date'] = 'Date';

                                $sum += $quizValue['value'];

                                $quiz['label'][$value['test_type']] = ucfirst($value['test_type']);

                                $quiz['data'][date('d-m-y',strtotime($quizValue['created_at']))][$value['test_type']][] = $quizValue['value'];

                                $quiz['data'][date('d-m-y',strtotime($quizValue['created_at']))]['date'] = date('d M y',strtotime($quizValue['created_at']));

                                $screening[$value['test_type']][$i]['x'] = date('d M',strtotime($quizValue['created_at']));

                                $screening[$value['test_type']][$i]['y'] = $sum;

                                $color[$value['test_type']] = rand_color();

								}	

                            

                        }

                        $i++;

                    }

                }

            }

			

			

           

            if( $screening ) {

                foreach($screening as $key => $value) {

                    foreach($value as $childKey => $childValue) {

                        $max = $min = $entry = $title = "";

                        if( $key == 'anxiety' ) {

                            $keyName = "GAD - 7 Anxiety Severity";

                            if( $childValue['y'] >= 0 && $childValue['y'] < 5 ) {

                                $entry = 'Minimal Anxiety 0 - 4';

                                $newKey = 3;

                                $quizChartJs[$key][$childValue['x']] = $childValue['y'];

                            }elseif( $childValue['y'] > 4 && $childValue['y'] < 10 ) {

                                $entry = 'Mild Anxiety 5 - 9';

                                $newKey = 2;

                                $quizChartJs[$key][$childValue['x']] = $childValue['y'];

                            }elseif( $childValue['y'] > 9 && $childValue['y'] < 15 ) {

                                $entry = 'Moderate Anxiety 10 - 14';

                                $newKey = 1;

                                $quizChartJs[$key][$childValue['x']] = $childValue['y'];

                            }elseif( $childValue['y'] > 14 ) {

                                $entry = 'Severe Anxiety Greater than 14';

                                $newKey = 0;

                                $quizChartJs[$key][$childValue['x']] = $childValue['y'];

                            }

    

                        }elseif( $key == 'depression' ) {

							

                            $keyName = "PHQ - 9 Depression Severity";

    

                            if( $childValue['y'] >= 0 && $childValue['y'] < 6 ) {

                                $entry = 'Minimal Depression 0 - 5';

                                $newKey = 3;

                                $quizChartJs[$key][$childValue['x']] = $childValue['y'];

                            } elseif( $childValue['y'] > 5 && $childValue['y'] < 11 ) {

                                $entry = 'Moderate Depression 6 - 10';

                                $newKey = 2;

                                $quizChartJs[$key][$childValue['x']] = $childValue['y'];

                            } elseif( $childValue['y'] > 10 && $childValue['y'] < 16 ) {

                                $entry = 'Moderately Severe Depression 11 - 15';

                                $newKey = 1;

                                $quizChartJs[$key][$childValue['x']] = $childValue['y'];

                            } elseif( $childValue['y'] > 15 ) {

                                $entry = 'Severe Depression Greater than 16';

                                $newKey = 0;

                                $quizChartJs[$key][$childValue['x']] = $childValue['y'];

                            }

							

                        } elseif( $key == 'alcohol' ) {

                            $keyName = "Alcohol & Substance Abuse";

                            if( $childValue['y'] >= 0 && $childValue['y'] < 2 ) {

                                $entry = 'No Risk and Possible Dependence indicated';

                                $newKey = 1;

                                $quizChartJs[$key][$childValue['x']] = $childValue['y'];

                            }else {

                                $entry = 'Risk and Possible Dependence indicated';

                                $newKey = 0;

                                $quizChartJs[$key][$childValue['x']] = $childValue['y'];

                            }

                        }

                        $quizDataBind[$keyName]['date'][] = $childValue['x'];

                        $quizDataBind[$keyName]['quizResult'][$newKey][$entry][$childValue['x']] = $childValue;

                    }

                }

            }

			

			

			

            $headSetByName = ['GAD - 7 Anxiety Severity','PHQ - 9 Depression Severity','Alcohol & Substance Abuse'];

            $dataByTitle = [];

            foreach($quizDataBind as $firstKey => $firstValue){

                $dataByTitle[$firstKey]['date'] = $firstValue['date'];

                $dataByTitle[$firstKey]['quizResult'] = array_values(Arr::sort($firstValue['quizResult'],function($values,$keys){

                    return $keys;

                }));

            }

			

			/*

			echo "==========";

			echo "<pre>";

			print_r($quizChartJs);

			echo "</pre>";

			die("Here"); 

			

			*/

            $screeningData = json_encode($quizChartJs);

			

			

            $color = json_encode($color);

            $dataType = [  'anxiety'    => 'ANXIETY SCREENINGS',

                        'depression' => 'DEPRESSION SCREENINGS',

                        'abuse'      => 'Alcohol & Substance Abuse'];

            //return view("Dashboard::myscreening", compact(["screeningData","quiz","color","screening","dataType","screenHead","dataByTitle","headSetByName"]));

            if(isMobile()) {

                return view("mobile.services.moods.screening-history-graph", compact(["screeningData","quiz","color","screening","dataType","screenHead","dataByTitle","headSetByName","userAnswer"]));



            }

          


            return view("services.moods.screening-history-graph", compact(["screeningData","quiz","color","screening","dataType","screenHead","dataByTitle","headSetByName","userAnswer"]));



            } catch(Exception $e) {

                

                abort('404');

            }





        //return view("mobile.services.moods.screening-history-graph");

    }

}

