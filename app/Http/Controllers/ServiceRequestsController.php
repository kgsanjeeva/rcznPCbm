<?php

namespace App\Http\Controllers;

use App\Models\VehicleMake;
use App\Models\VehicleModel;
use Illuminate\Http\Request;
use App\Models\ServiceRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\ServiceRequests\StoreServiceRequest;
use App\Http\Requests\ServiceRequests\UpdateServiceRequest;

class ServiceRequestsController extends Controller
{
    /**
     * [Display a paginated list of Service Requests in the system]
     * @return view
     */
    public function index(Request $request)
    {
        $requests = ServiceRequest::whereFilters($request->only(['search']))
                                    ->orderBy('updated_at', 'desc')->paginate(20);

        return view('service_requests.index', compact('requests'));
    }

    /**
     * [This is the method you should use to create the new service request]
     * @param
     * @return ...
     */
    public function create()
    {
        $vehicleMakes = VehicleMake::pluck('title', 'id')->prepend('Select', '');

        return view('service_requests.create', compact('vehicleMakes'));
    }

    /**
     * [This is the method you should use to store the new service request]
     * @param
     * @return ...
     */
    public function store(StoreServiceRequest $request)
    {
        try {
            ServiceRequest::create($request->all());

            return redirect()->route('service-requests.index')->with('success', 'New ServiceRequest Created successfully');
        } catch (\Exception $ex) {
            logger($ex->getMessage());
            return redirect()->route('service-requests.index')->with('error', $ex->getMessage());
        }
    }

    /**
     * [This is the method you should use to show the edit screen]
     * @param  ServiceRequests $serviceRequest [get the object you are planning on editing]
     * @return ...
     */
    public function edit(ServiceRequest $serviceRequest)
    {
        $vehicleMakes  = VehicleMake::pluck('title', 'id')->prepend('Select', '');
        $vehicleModels = VehicleModel::pluck('title', 'id')->prepend('Select', '');

        $serviceRequest->load('vehicleModel');

        return view('service_requests.edit', compact('serviceRequest', 'vehicleMakes', 'vehicleModels'));
    }

    /**
     * Update the specified service request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateServiceRequest $request, ServiceRequest $serviceRequest)
    {
        try {
            $serviceRequest->update($request->all());

            return redirect()->route('service-requests.index')->with('success', 'ServiceRequest Updated successfully');
        } catch (\Exception $ex) {
            logger($ex->getMessage());
            return redirect()->route('service-requests.index')->with('error', $ex->getMessage());
        }
    }

    /**
     * [Ajax method for getting the vehicle model for vehicle make]
     * @param vehicle_make_id
     * @return json
     */
    public function get_model_by_make()
    {
        if (request()->ajax()) {
            $vehicleModels = VehicleModel::where('vehicle_make_id', request()->vehicle_make_id)->pluck('title', 'id');
            $renderModels  = view('service_requests.includes._partial', compact('vehicleModels'));

            return response()->json([
                'response'      => true,
                'vehicleModels' => $renderModels->render(),
            ]);
        }
    }

    /**
     * [This is the method you should use to delete the specific service request]
     * @param  ServiceRequests $serviceRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServiceRequest $serviceRequest)
    {
        try {
            $serviceRequest->delete();

            return redirect()->route('service-requests.index')->with('success', 'ServiceRequest Deleted successfully');
        } catch (ModelNotFoundException $ex) {
            logger($ex->getMessage());
            return redirect()->route('service-requests.index')->with('success', $ex->getMessage());
        }
    }
}
