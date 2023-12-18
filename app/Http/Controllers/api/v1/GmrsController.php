<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\GmrsHd;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class GmrsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index() // This endpoint is required for checking if API is up before performing WP plugin actions.
    {
        return [
            "status" => ResponseAlias::HTTP_OK,
            "data" => "FCC Validator API v1, we do not allow bulk view. You must use the API to pull records per FRN lookup."
        ];
    }

    public function show($request)
    {
        $gmrs_license = GmrsHd::select('gmrs_hd.usid', 'gmrs_hd.callsign', 'gmrs_hd.status', 'gmrs_hd.expiration', 'gmrs_en.frn', 'gmrs_en.city', 'gmrs_en.state')
            ->join('gmrs_en', 'gmrs_en.usid', '=', 'gmrs_hd.usid')
            ->where('gmrs_en.frn', $request)
            ->where('gmrs_hd.status', "A")
            ->get();

            return [
                "status" => ResponseAlias::HTTP_OK,
                "gmrs_license" =>$gmrs_license
            ];
    }
}
