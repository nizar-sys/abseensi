<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestStoreOrUpdateRombel;
use App\Models\Rayon;
use App\Models\Rombel;
use Illuminate\Http\Request;

class RombelCrudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $rombelQuery = Rombel::query();
        $filter = $request->filter;
        $order = $request->order;

        if (isset($filter['nama_rombel'])) {
            $rombelQuery->where('nama_rombel', 'LIKE', '%' . $filter['nama_rombel'] . '%');
        }

        if (isset($filter['id'])) {
            $rombelQuery->where('uuid', $filter['id']);
        }


        $rombels = $rombelQuery->with('rayon:id,uuid,nama_rayon')->orderBy('created_at', $order['created_at'] ?? 'desc')->paginate($filter['per_page'] ?? 20, ['uuid', 'nama_rombel', 'rayon_id', 'created_at']);

        return response()->json([
            'status' => 'ok',
            'response' => $rombels,
            'params' => $request->all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestStoreOrUpdateRombel $request)
    {
        $payloadAddRombel = [
            'nama_rombel' => $request->nama_rombel,
            'rayon_id' => Rayon::whereUuid($request->rayon_id)->first()->id ?? null,
        ];
        $newRayon = Rombel::create($payloadAddRombel);
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
        $rombel = Rombel::with('rayon')->whereUuid($id)->firstOrFail();

        return response()->json([
            'status' => 'ok',
            'response' => $rombel,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestStoreOrUpdateRombel $request, $id)
    {
        $rombel = Rombel::whereUuid($id)->firstOrFail();
        $rombel->update([
            'nama_rombel' => $request->nama_rombel,
            'rayon_id' => Rayon::whereUuid($request->rayon_id)->first()->id ?? null,
        ]);
        
        return response()->json([
            'status' => 'ok',
            'response' => $rombel,
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
        Rombel::whereUuid($id)->firstOrFail()->delete();

        return response()->json([
            'status' => 'ok',
            'response' => [],
            'params' => [],
        ]);
    }
}
