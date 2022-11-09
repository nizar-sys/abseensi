<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestStoreOrUpdateRayon;
use App\Http\Resources\RayonCollection;
use App\Models\Rayon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RayonCrudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $rayonQuery = Rayon::query();
        $filter = $request->filter;
        $order = $request->order;

        if (isset($filter['nama_rayon'])) {
            $rayonQuery->where('nama_rayon', 'LIKE', '%' . $filter['nama_rayon'] . '%');
        }

        if (isset($filter['id'])) {
            $rayonQuery->where('uuid', $filter['id']);
        }


        $rayons = $rayonQuery->orderBy('created_at', $order['created_at'] ?? 'desc')->paginate($filter['per_page'] ?? 20, ['uuid', 'nama_rayon', 'created_at']);

        return response()->json([
            'status' => 'ok',
            'response' => $rayons,
            'params' => $request->all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestStoreOrUpdateRayon $request)
    {
        $newRayon = Rayon::create($request->all());
        return response()->json([
            'status' => 'ok',
            'response' => $newRayon,
            'params' => $request->all(),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rayon = Rayon::whereUuid($id)->firstOrFail();

        return response()->json([
            'status' => 'ok',
            'response' => $rayon,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestStoreOrUpdateRayon $request, $id)
    {
        $rayon = Rayon::whereUuid($id)->firstOrFail();
        $rayon->update($request->validated());
        
        return response()->json([
            'status' => 'ok',
            'response' => $rayon,
            'params' => $request->all(),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Rayon::whereUuid($id)->firstOrFail()->delete();

        return response()->json([
            'status' => 'ok',
            'response' => [],
            'params' => [],
        ]);
    }
}
