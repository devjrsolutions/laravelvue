<?php
/**
 * Created by PhpStorm.
 * User: darryl
 * Date: 10/6/2017
 * Time: 6:15 AM
 */

namespace App\Http\Controllers\Src\Master;

use App\Components\Core\Utilities\Helpers;
use App\Components\Master\Models\MemberCard;
use App\Components\Master\Repositories\MemberCardRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberCardController extends Controller
{
    /**
     * @var UserRepository
     */
    private $membercardRepository;

    /**
     * UserController constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(MemberCardRepository $membercardRepository)
    {
        $this->membercardRepository = $membercardRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->membercardRepository->listMemberCard(request()->all());

        return $this->sendResponseOk($data,"list membercards ok.");
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
            'code' => 'required',
            'company_code' => 'required',
            'name' => 'required',
            'member_fiture_code' => 'required',
        ]);

        if($validate->fails()) return $this->sendResponseBadRequest($validate->errors()->first());

        // /** @var User $user */
        $membercard = $this->membercardRepository->create($request->all());

        // if(!$user) return $this->sendResponseBadRequest("Failed create.");

        // // attach to group
        // if($groups = $request->get('groups',[]))
        // {
        //     foreach ($groups as $groupId => $shouldAttach)
        //     {
        //         if($shouldAttach) $user->groups()->attach($groupId);
        //     }
        // }

        return $this->sendResponseCreated($membercard);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $membercard = $this->membercardRepository->find($id);

        if(!$membercard) return $this->sendResponseNotFound();

        return $this->sendResponseOk($membercard);
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
            'code' => 'required',
            'company_code' => 'required',
            'name' => 'required',
            'member_fiture_code' => 'required',
        ]);

        if($validate->fails()) return $this->sendResponseBadRequest($validate->errors()->first());

        $payload = $request->all();

        // if password field is present but has empty value or null value
        // we will remove it to avoid updating password with unexpected value
        // if(!Helpers::hasValue($payload['password'])) unset($payload['password']);

        $updated = $this->membercardRepository->update($id,$payload);

        if(!$updated) return $this->sendResponseBadRequest("Failed update");

        // // re-sync groups

        // /** @var User $user */
        $membercard = $this->membercardRepository->find($id);

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
            $this->membercardRepository->delete($id);
        } catch (\Exception $e) {
            return $this->sendResponseBadRequest("Failed to delete");
        }

        return $this->sendResponseDeleted();
    }
}