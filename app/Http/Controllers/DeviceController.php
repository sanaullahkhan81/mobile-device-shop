<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Device[]|Collection
     */
    public function index(): Collection
    {
        return Device::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create(): void
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
         $request->validate([
            'model' => 'required',
            'brand' => 'required',
            'release_date' => 'required|date_format:Y/d'
        ]);

        Device::create($request->toArray());

        return response()->json([
            'status' => 200,
            'message' => 'Record Added successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param string $id
     * @return void
     */
    public function show(string $id): void
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $id
     * @return void
     */
    public function edit(string $id): void
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param string $id
     * @return JsonResponse
     */
    public function update(Request $request, string $id): JsonResponse
    {
        Device::whereId($id)->update($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Record Updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $id
     * @return JsonResponse
     */
    public function destroy(string $id): JsonResponse
    {
        Device::destroy($id);

        return response()->json([
            'status' => 200,
            'message' => 'Record Deleted successfully']);
    }
}
