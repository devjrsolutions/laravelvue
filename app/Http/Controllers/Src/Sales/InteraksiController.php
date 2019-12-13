<?php
/**
 * Created by PhpStorm.
 * User: darryl
 * Date: 10/6/2017
 * Time: 6:15 AM
 */

namespace App\Http\Controllers\Src\Sales;

use App\Components\Core\Utilities\Helpers;
use App\Components\Sales\Models\Interaksi;
use App\Components\Sales\Repositories\InteraksiRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InteraksiController extends Controller
{
    /**
     * @var UserRepository
     */
    private $interaksiRepository;

    /**
     * UserController constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(InteraksiRepository $interaksiRepository)
    {
        $this->interaksiRepository = $interaksiRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->interaksiRepository->listInteraksi(request()->all());

        return $this->sendResponseOk($data,"list interaksis ok.");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = validator($request->all(),[
            'name' => 'required',
            'company_id' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'phone_wa' => 'required',
            'advertise_id' => 'required',
            'gender_code' => 'required',
            'address' => 'required',
            'status' => 'required',
            'complain' => 'required',
            'remark' => 'required',
            'pasien_status_id' => 'required',
        ]);

        if($validate->fails()) return $this->sendResponseBadRequest($validate->errors()->first());

        // /** @var User $user */
        $interaksi = $this->interaksiRepository->create($request->all());

        // if(!$user) return $this->sendResponseBadRequest("Failed create.");

        // // attach to group
        // if($groups = $request->get('groups',[]))
        // {
        //     foreach ($groups as $groupId => $shouldAttach)
        //     {
        //         if($shouldAttach) $user->groups()->attach($groupId);
        //     }
        // }

        return $this->sendResponseCreated($interaksi);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $interaksi = $this->interaksiRepository->find($id);

        if(!$interaksi) return $this->sendResponseNotFound();

        return $this->sendResponseOk($interaksi);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = validator($request->all(),[
            'name' => 'required',
            'company_id' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'phone_wa' => 'required',
            'advertise_id' => 'required',
            'gender_code' => 'required',
            'address' => 'required',
            'status' => 'required',
            'complain' => 'required',
            'remark' => 'required',
            'pasien_status_id' => 'required',

        ]);

        if($validate->fails()) return $this->sendResponseBadRequest($validate->errors()->first());

        $payload = $request->all();

        // if password field is present but has empty value or null value
        // we will remove it to avoid updating password with unexpected value
        // if(!Helpers::hasValue($payload['password'])) unset($payload['password']);

        $updated = $this->interaksiRepository->update($id,$payload);

        if(!$updated) return $this->sendResponseBadRequest("Failed update");

        // // re-sync groups

        // /** @var User $user */
        $interaksi = $this->interaksiRepository->find($id);

        // $groupIds = [];

        // if($groups = $request->get('groups',[]))
        // {
        //     foreach ($groups as $groupId => $shouldAttach)
        //     {
        //         if($shouldAttach) $groupIds[] = $groupId;
        //     }
        // }

        // $user->groups()->sync($groupIds);

        return $this->sendResponseUpdated();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // do not delete self
        // if($id == auth()->user()->id) return $this->sendResponseForbidden();

        try {
            $this->interaksiRepository->delete($id);
        } catch (\Exception $e) {
            return $this->sendResponseBadRequest("Failed to delete");
        }

        return $this->sendResponseDeleted();
    }
}