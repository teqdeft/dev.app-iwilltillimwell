<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Country;
use App\Sector;
use App\Currency;
use App\IdentificationType;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Lang;
use Cache;
use DB;
use Validator;

class ContentManagementController extends Controller
{
    /**
     * Show the listing of countries.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function countries(Request $request)
    {
        $countries = Cache::get('countries');
        return view('admin.content-management.countries', compact('countries'));
    }

    /**
     * Update the specified country resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function updateCountry(Request $request, Country $country)
    {
        $user = $request->user();
        $lang = app()->getLocale();

        try {
            if ($request->isMethod('put')) {
                DB::beginTransaction();
                $input = $request->all();

                $validator = Validator::make($input, [
                    'en_name' => 'required|string|min:3|max:255',
                    'es_name' => 'required|string|min:3|max:255'
                ]);

                if ($validator->fails()) {
                    return back()
                        ->withErrors($validator)
                        ->with([
                            'message'   => $validator->errors()->all()[0],
                            'alert-type' => 'error'
                        ])
                        ->withInput();
                }

                $data = $input;

                $country->setTranslation('name', 'en', $data['en_name'])
                   ->setTranslation('name', 'es', $data['es_name']);

                if ($country->save()) {
                    DB::commit();
                    // remove the old cached data.
                    Cache::forget('countries');

                    Cache::rememberForever('countries', function () use ($lang) {
                        return Country::select('id', 'name', 'code')->orderBy("name->$lang")->get();
                        // return Country::select('id', 'name')->orderBy('name')->get();
                    });
                }

                $request->session()->flash('success', trans('messages.country_info_updated'));

                return redirect()->route('admin.countries');
            }
            return view('admin.content-management.edit-country', compact('country'));
        } catch (\Exception $e) {
            DB::rollback();
            $request->session()->flash('error', $e->getMessage());
            return back()->withInput();
        }
    }

    /**
     * Show the listing of countries.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sectors(Request $request)
    {
        $sectors = Cache::get('sectors');
        return view('admin.content-management.sectors', compact('sectors'));
    }

    /**
     * Update the specified sector resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function updateSector(Request $request, Sector $sector)
    {
        $user = $request->user();
        $lang = app()->getLocale();

        try {
            if ($request->isMethod('put')) {
                DB::beginTransaction();
                $input = $request->all();

                $validator = Validator::make($input, [
                    'en_name' => 'required|string|min:3|max:255',
                    'es_name' => 'required|string|min:3|max:255'
                ]);

                if ($validator->fails()) {
                    return back()
                        ->withErrors($validator)
                        ->with([
                            'message'   => $validator->errors()->all()[0],
                            'alert-type' => 'error'
                        ])
                        ->withInput();
                }

                $data = $input;

                $sector->setTranslation('name', 'en', $data['en_name'])
                   ->setTranslation('name', 'es', $data['es_name']);

                if ($sector->save()) {
                    DB::commit();
                    // remove the old cached data.
                    Cache::forget('sectors');

                    Cache::rememberForever('sectors', function () use ($lang) {
                        return Sector::orderBy("name->$lang")->get();
                    });
                }

                $request->session()->flash('success', trans('messages.country_info_updated'));

                return redirect()->route('admin.sectors');
            }
            return view('admin.content-management.edit-sector', compact('sector'));
        } catch (\Exception $e) {
            DB::rollback();
            $request->session()->flash('error', $e->getMessage());
            return back()->withInput();
        }
    }

    /**
     * Show the listing of countries.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function currencies(Request $request)
    {
        $currencies = Cache::get('currencies');
        return view('admin.content-management.currencies', compact('currencies'));
    }

    /**
     * Update the specified currency resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function updateCurrency(Request $request, Currency $currency)
    {
        $user = $request->user();
        $lang = app()->getLocale();

        try {
            if ($request->isMethod('put')) {
                DB::beginTransaction();
                $input = $request->all();

                $validator = Validator::make($input, [
                    'en_name' => 'required|string|min:3|max:255',
                    'es_name' => 'required|string|min:3|max:255',
                    'code' => 'required|string|min:3|max:3|alpha',
                    // 'symbol' => 'required|string|min:1|max:4|alpha'
                ]);

                if ($validator->fails()) {
                    return back()
                        ->withErrors($validator)
                        ->with([
                            'message'   => $validator->errors()->all()[0],
                            'alert-type' => 'error'
                        ])
                        ->withInput();
                }

                $data = $input;

                $currency->setTranslation('name', 'en', $data['en_name'])
                   ->setTranslation('name', 'es', $data['es_name']);
                $currency->code = $data['code'];

                if ($currency->save()) {
                    DB::commit();
                    // remove the old cached data.
                    Cache::forget('currencies');

                    Cache::rememberForever('currencies', function () use ($lang) {
                        return Currency::orderBy("name->$lang")->get();
                    });
                }

                $request->session()->flash('success', trans('messages.country_info_updated'));

                return redirect()->route('admin.currencies');
            }
            return view('admin.content-management.edit-currency', compact('currency'));
        } catch (\Exception $e) {
            DB::rollback();
            $request->session()->flash('error', $e->getMessage());
            return back()->withInput();
        }
    }

    /**
     * Show the listing of countries.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function identificationTypes(Request $request)
    {
        $identificationTypes = Cache::get('identification_types');
        return view('admin.content-management.identification-types', compact('identificationTypes'));
    }

    /**
     * Update the specified identificationType resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\IdentificationType  $identificationType
     * @return \Illuminate\Http\Response
     */
    public function updateIdentificationType(Request $request, IdentificationType $identificationType)
    {
        $user = $request->user();
        $lang = app()->getLocale();

        try {
            if ($request->isMethod('put')) {
                DB::beginTransaction();
                $input = $request->all();

                $validator = Validator::make($input, [
                    'en_name' => 'required|string|min:3|max:255',
                    'es_name' => 'required|string|min:3|max:255'
                ]);

                if ($validator->fails()) {
                    return back()
                        ->withErrors($validator)
                        ->with([
                            'message'   => $validator->errors()->all()[0],
                            'alert-type' => 'error'
                        ])
                        ->withInput();
                }

                $data = $input;

                $identificationType->setTranslation('name', 'en', $data['en_name'])
                   ->setTranslation('name', 'es', $data['es_name']);

                if ($identificationType->save()) {
                    DB::commit();
                    // remove the old cached data.
                    Cache::forget('identification_types');

                    Cache::rememberForever('identification_types', function () use ($lang) {
                        return IdentificationType::orderBy("name->$lang")->get();
                    });
                }

                $request->session()->flash('success', trans('messages.country_info_updated'));

                return redirect()->route('admin.identification_types');
            }
            return view('admin.content-management.edit-identification-type', compact('identificationType'));
        } catch (\Exception $e) {
            DB::rollback();
            $request->session()->flash('error', $e->getMessage());
            return back()->withInput();
        }
    }
}