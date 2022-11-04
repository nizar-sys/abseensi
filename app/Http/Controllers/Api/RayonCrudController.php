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

        if (isset($order['id'])) {
            $rayonQuery->orderBy('id', $order['id']);
        }

        if (isset($order['created_at'])) {
            $rayonQuery->orderBy('created_at', $order['created_at']);
        }

        if (isset($filter['nama_rayon'])) {
            $rayonQuery->where('nama_rayon', 'LIKE', '%' . $filter['nama_rayon'] . '%');
        }

        if (isset($filter['id'])) {
            $rayonQuery->where('id', $filter['id']);
        }


        $rayons = $rayonQuery->paginate($filter['per_page'] ?? 20, ['id', 'nama_rayon', 'created_at']);

        return response()->json([
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
