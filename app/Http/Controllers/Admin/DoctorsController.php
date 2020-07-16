<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Doctor\BulkDestroyDoctor;
use App\Http\Requests\Admin\Doctor\DestroyDoctor;
use App\Http\Requests\Admin\Doctor\IndexDoctor;
use App\Http\Requests\Admin\Doctor\StoreDoctor;
use App\Http\Requests\Admin\Doctor\UpdateDoctor;
use App\Models\Doctor;
use Brackets\AdminListing\Facades\AdminListing;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DoctorsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexDoctor $request
     * @return array|Factory|View
     */
    public function index(IndexDoctor $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Doctor::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            [''],

            // set columns to searchIn
            ['']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.doctor.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.doctor.create');

        return view('admin.doctor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreDoctor $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreDoctor $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Doctor
        $doctor = Doctor::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/doctors'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/doctors');
    }

    /**
     * Display the specified resource.
     *
     * @param Doctor $doctor
     * @throws AuthorizationException
     * @return void
     */
    public function show(Doctor $doctor)
    {
        $this->authorize('admin.doctor.show', $doctor);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Doctor $doctor
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Doctor $doctor)
    {
        $this->authorize('admin.doctor.edit', $doctor);


        return view('admin.doctor.edit', [
            'doctor' => $doctor,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateDoctor $request
     * @param Doctor $doctor
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateDoctor $request, Doctor $doctor)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Doctor
        $doctor->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/doctors'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/doctors');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyDoctor $request
     * @param Doctor $doctor
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyDoctor $request, Doctor $doctor)
    {
        $doctor->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyDoctor $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyDoctor $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Doctor::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
