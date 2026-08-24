<?php



namespace App\Http\Controllers;

use App\Models\Pet;

use App\Models\PetConsultation;

use App\Models\PetConsultateImage;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Session;



use DB;



use App\Validators\PetsValidator;

use App\Interfaces\CommonConstants;

use Illuminate\Support\Facades\Config;





use App\Http\Controllers\ConsultationController;

use Illuminate\Support\Arr;

use Illuminate\Support\Facades\Validator;




class PetController extends Controller implements CommonConstants

{

    

    public $species;

    public $gender;

    public $petImage;



    function __construct(){

        $pet_species = collect([['name' => 'Select Species', 'value' => ''],

            ['name' => 'Dog', 'value' => 'Dog'],

            ['name' => 'Cat', 'value' => 'Cat'],

            ['name' => 'Gerbil', 'value' => 'Gerbil'],

            ['name' => 'Guinea Pig', 'value' => 'Guinea Pig'],

            ['name' => 'Ferret', 'value' => 'Ferret'],

            ['name' => 'Hamster', 'value' => 'Hamster'],

        ]);

        $this->species = $pet_species->pluck('name', 'value');

        $pet_gender = collect([['name' => 'Select Gender', 'value' => ''],

            ['name' => 'M', 'value' => 'm'],

            ['name' => 'F', 'value' => 'f'],

        ]);

        $this->gender = $pet_gender->pluck('name','value');



        $pet_images = collect([

            ['type' => 'Dog', 'image' => 'assets/images/pet-types/pet-dog.svg'],

            ['type' => 'Cat', 'image' => 'assets/images/pet-types/pet-cat.svg'],

            ['type' => 'Gerbil','image' => 'assets/images/pet-types/pet-gerbil.svg'],

            ['type' => 'Guinea Pig','image' => 'assets/images/pet-types/pet-dog.svg'],

            ['type' => 'Ferret','image' => 'assets/images/pet-types/pet-guineapig.svg'],

            ['type' => 'Hamster','image' => 'assets/images/pet-types/pet-dog.svg'],

        ]);



        $this->petImage = $pet_images;

    }



    public function petConsultations($status = "all")

	{

		if (empty(Session::get('authorization'))) {

			(new ConsultationController)->apiAuthentication();

		}

		//  get all consultations

		$input['start'] = Config::get('constants.start');

		$input['length'] = Config::get('constants.length');

		$input['status'] = $status;

		$post_url = Config::get('constants.tel_api_url') . 'petConsultationHistory/getPetConsultations';

		$response = (new ConsultationController)->postToteleMedicine($input, $post_url);

		$consultations = @$response['data'];

        if(isMobile()){

            return view('mobile.pets.pet-consultations',compact('consultations'))->with('no', 1);

        }



		return view('consultation.pets.pet-consultations', compact("consultations"))->with('no', 1);

	}



    public function pets(Request $request){

        try {

           

            $pets = Pet::where(['user_id' => Auth::user()->id ])->get();

            $species = $this->species;

            $gender = $this->gender;



            $post_url = Config::get('constants.tel_api_url') . 'pet';

            $response = (new ConsultationController)->postToteleMedicine([], $post_url);

            $petProblem = [];



            //$petProblem[] = array("petproblem_id"=>"1","name"=>"Ear Issue");

            //$petProblem[] = array("petproblem_id"=>"2","name"=>"Ear Issue 2");



            if(isset($response['success'])){

                if( isset($response['problems']) && !empty($response['problems']) ){

                    $petProblem = $response['problems'];

                }

            }

            $petImage = $this->petImage;



            if(isMobile()){

                return view('mobile.pets.index',compact('pets','species','gender','petProblem','petImage'));

            }

            return view('pets.index',compact('pets','species','gender','petProblem','petImage'));

            

        } catch (\Exception $e) {

            echo json_encode($this->failResponse([

                "message" => $e->getMessage(),

            ], 500));

            die;

        }

    }



    public function petsAdd() {

        $dataheading['title'] = "Add your pet profile";

        $species = $this->species;

        $gender = $this->gender;

        return view('mobile.pets.add-pet',compact('dataheading','species','gender'));

    }



    public function petsEdit(Request $request) {

        $dataheading['title'] = "Edit your pet profile";

        $data = Pet::where('id', $request->id)->first();

        $species = $this->species;

        $gender = $this->gender;

        $edit = $request->id;

        return view('mobile.pets.add-pet',compact('dataheading','data','species','gender','edit'));

    }



    function schedule(Request $request){

        $input = $request->all();

    

        try{

            $data = [ 'phoneNumber'  => $input['phone'],

                      'modality'     => $input['modality'],

                      'problemId'    => $input['problemId'],

                      'description' => $input['description'],

                      'optIn'      => $input['optIn'] ];

                      

            $petId = Pet::where('id',$input['my-pet-id'])->pluck('pet_id');

            if( isset($petId[0]) && !empty($petId[0]) ){

                $post_url = Config::get('constants.tel_api_url') . "pet/{$petId[0]}/consult";

                $response = (new ConsultationController)->postToteleMedicine($data, $post_url, true, false);

                if( !empty($response) ){

                    $data = $data + [ 'iwill_pet_id' => $input['my-pet-id'] ] + $response;

                    $insert = PetConsultation::create($data);

                    $id = $insert->value('id');

                    $images = [];

                    if ($request->file('file')) {

                        foreach ($request->file('file') as $key => $file) {

                            $name = time() . '.' . $file->getClientOriginalExtension();

                            $destinationPath = public_path('/uploads/pet-images');

                            $file->move($destinationPath, $name);

                            $images[$key]['myPetConslutId'] = $id;

                            $images[$key]['images'] = '/uploads/pet-images/'.$name;

                        }

                    }

                    PetConsultateImage::insert($images);

                    /* if(isMobile()) {

                        return response()->json(['success' => true,'message' =>"Success! Consultation has been scheduled. A veterinarian should be calling you within the next hour."]);

                    } */



					return response()->json(['success' => true,'message' =>"Success! Consultation has been scheduled. A veterinarian should be calling you within the next hour."]);

                    //return true;

                }

            }

            if(isMobile()) {

                //return response()->json(['success' => true,'message' =>"Something went wrong"]);

            }

			return response()->json(['success' => false,'message' =>"Something went wrong"]);

            //return false;

        }catch (\Exception $e) {



			return response()->json(['success' => false,'message' =>$e->getMessage()]);

            /* if(isMobile()) {

                return response()->json(['success' => false,'message' =>$e->getMessage()]);

            } else {

                $request->session()->flash('error', $e->getMessage());

              return back()->withInput();

            } */

            

        } 

    }



    public function scheduleCancel(Request $request){

        try{

            $input = $request->all();

            $post_url = Config::get('constants.tel_api_url') . "pet/{$input['pet_id']}/consult/{$input['petConsultId']}/cancel";

            $response = (new ConsultationController)->postToteleMedicine(['cancellationExplanation' => $input['cancellationExplanation'] ], $post_url, true, false);

            if( $response ){

				

				/* echo "<pre>";

				print_r($input);

				print_r($response);

				echo "</pre>";

				die(); */

                $request->session()->flash('success', 'Your consultation successfuly cancel');

                return redirect('pet-consultations');

            }

        }catch (\Exception $e) {

            $request->session()->flash('error', $e->getMessage());

            return back()->withInput();

        }

    }



    public function store(Request $request) {

        try {

            

			$user=Auth::user();

			$input = $request->all();

			$id = $input['id'];

			

			$rules = [

				'name'    => 'required|string|max:255',

				'species' => 'required|string',

				'breed'   => 'required|string|max:255',

				'years'   => 'required|numeric',

				'months'  => 'required|numeric',

				'gender'  => 'required|string',

			];

			 $messages = [
                    'petBioImage.required' => 'The pet image is mandatory.',
                    'petBioImage.image'    => 'Please upload a valid image file.'
                ];

			if (empty($id)) {

				$rules['petBioImage'] = 'required|image|mimes:jpg,png,jpeg|max:2048';

			} else {

				$rules['petBioImage'] = 'nullable|image|mimes:jpg,png,jpeg|max:2048';
               

			}



            $validated = $request->validate($rules, $messages);

            
			

			

			

            $sterilization = isset($_POST['sterilization']) ? 1 : 0;

            $data = array(

                'name'         => $input['name'],

                'breed'        => $input['breed'],

                'species'      => $input['species'],

                'years'        => (int) $input['years'],

                'months'       => (int) $input['months'],

                'gender'       => $input['gender'],

                'sterilization'=> $sterilization

            );

			

			$post_url = Config::get('constants.tel_api_url').'pet';

			if(empty($id)){

                $response = (new ConsultationController)->postToteleMedicine($data, $post_url, true, false);

                if($response['success']){

                    $data = $data + [ 'pet_id' => $response['pet'][0]['pet_id'],

                              'user_primary_id' => $response['pet'][0]['user_id'],

                              'user_id' => Auth::user()->id,

                              'sterilization'=> $sterilization ];

                    $data_response = Pet::create($data);										

					$this->profileUpload($request,$data_response->id);	

                }

				$message = 'Pet Added successfully.';

                

            } else {

				

                $post_url = "{$post_url}/{$input['pet_id']}";

                $response = (new ConsultationController)->postToteleMedicine($data, $post_url, true, false);

                if($response['success'] ){

                    Pet::where('id', $id)->update($data);					

					$this->profileUpload($request,$id);

					$message = 'Pet Updated successfully.';						

                }

            }

			

			if(isMobile()){

				

				return redirect()

						->route('pet-health')

						->with('success', $message);

			}

            return response()->json([

                'status' => true,

                'message' =>$message,

                'data' => [],

            ]);



        } catch (\Illuminate\Validation\ValidationException $e) {

            

			if (isMobile()) {

					return redirect()

						->back()

						->withErrors($e->errors())

						->withInput();

			}

			

            return response()->json([

                'status' => false,

                'message' => 'Validation failed.',

                'errors' => $e->errors(),

            ], 422);



        } catch (Exception $e) {

            

			if(isMobile()) {

					return redirect()

						->back()

						->with('error', $e->getMessage())

						->withInput();

			}

			

            return response()->json([

                'status' => false,

                'message' =>$e->getMessage(),

                'error' => $e->getMessage(),

            ], 500);

        }

		

		

        /* $PetsValidator = new PetsValidator();

        try {

            $input = $request->all();

            if (!$PetsValidator->with($input)->passes()) {

                $request->session()->flash('error', $PetsValidator->getErrors()[0]);

                return back()

                    ->withErrors($PetsValidator->getValidator())

                    ->withInput();

            }

            $user=Auth::user();

            $sterilization = isset($_POST['sterilization']) ? 1 : 0;

            $data = array(

                'name'         => $input['name'],

                'breed'        => $input['breed'],

                'species'      => $input['species'],

                'years'        => (int) $input['years'],

                'months'       => (int) $input['months'],

                'gender'       => $input['gender'],

                'sterilization'=> $sterilization

            );



              



            $id = $input['id'];

            $post_url = Config::get('constants.tel_api_url').'pet';

            if( empty($id)  ){

                $response = (new ConsultationController)->postToteleMedicine($data, $post_url, true, false);

                if($response['success']){

                    $data = $data + [ 'pet_id' => $response['pet'][0]['pet_id'],

                              'user_primary_id' => $response['pet'][0]['user_id'],

                              'user_id' => Auth::user()->id,

                              'sterilization'=> $sterilization ];

                    $data_response = Pet::create($data);										$this->profileUpload($request,$data_response->id);	

                }

                $request->session()->flash('success', 'Pet Added successfully.');

            }else{				

                $post_url = "{$post_url}/{$input['pet_id']}";

                $response = (new ConsultationController)->postToteleMedicine($data, $post_url, true, false);

                if($response['success'] ){

                    Pet::where('id', $id)->update($data);					$this->profileUpload($request,$id);	

                    $request->session()->flash('success', 'Pet Updated successfully.');					

                }

            }

            return redirect('pets');

        } catch (\Exception $e) {

            $request->session()->flash('error', $e->getMessage());

            return back()->withInput();

        } */

    }



    public function edit($id)

    {

        $data = Pet::where('id', $id)->first();

        $species = $this->species;

        $gender = $this->gender;

        $edit = $id;

        return view('pets.add-pet', compact('data','species','gender','edit'));

    }

    

    public function petName($id)

    {

        $data = Pet::where('id', $id)->first();

        if($data['profile'] == '' || $data['profile'] == null ){

            foreach($this->petImage as $value){

                if( $data['species'] == $value['type'] ){

                    $data['profile'] = $value['image'];

                }

            }

        }

        return json_encode($data);

    }



    public function profileUpload($request,$id){

        $input = $request->all();

        if ($request->hasfile('petBioImage')) {

            $image = $request->file('petBioImage');

            $name = time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('/uploads/pet-images');

            $image->move($destinationPath, $name);

            Pet::where('id',$id)->update(['profile' => "uploads/pet-images/{$name}"]);

            //$request->session()->flash('success', 'Pet Profile Image Updated successfully.');

            //return redirect('pets');

        }

    }

}

