<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Nurse\BulkDestroyNurse;
use App\Http\Requests\Admin\Nurse\DestroyNurse;
use App\Http\Requests\Admin\Nurse\IndexNurse;
use App\Http\Requests\Admin\Nurse\StoreNurse;
use App\Http\Requests\Admin\Nurse\UpdateNurse;
use App\Models\Nurse;
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

class NursesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexNurse $request
     * @return array|Factory|View
     */
    public function index(IndexNurse $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Nurse::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'name', 'email'],

            // set columns to searchIn
            ['id', 'name', 'email']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.nurse.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.nurse.create');

        return view('admin.nurse.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreNurse $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreNurse $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Nurse
        $nurse = Nurse::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/nurses'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/nurses');
    }

    /**
     * Display the specified resource.
     *
     * @param Nurse $nurse
     * @throws AuthorizationException
     * @return void
     */
    public function show(Nurse $nurse)
    {
        $this->authorize('admin.nurse.show', $nurse);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Nurse $nurse
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Nurse $nurse)
    {
        $this->authorize('admin.nurse.edit', $nurse);


        return view('admin.nurse.edit', [
            'nurse' => $nurse,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateNurse $request
     * @param Nurse $nurse
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateNurse $request, Nurse $nurse)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Nurse
        $nurse->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/nurses'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/nurses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyNurse $request
     * @param Nurse $nurse
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyNurse $request, Nurse $nurse)
    {
        $nurse->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyNurse $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyNurse $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Nurse::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
