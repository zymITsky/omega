<?php

namespace Omega\Http\Controllers;

use Illuminate\Http\Request;
use Omega\Http\Requests;
use Omega\Repositories\TrimesterRepositoryInterface;

class TrimesterController extends Controller
{
    /**
     * @var TrimesterRepositoryInterface
     */
    private $trimesterRepository;

    /**
     * UserController constructor.
     * @param TrimesterRepositoryInterface $trimesterRepository
     */
    public function __construct(TrimesterRepositoryInterface $trimesterRepository)
    {
        $this->middleware('permission:create.trimesters|delete.trimesters', ['only' => ['index', 'show']]);
        $this->middleware('permission:create.trimesters', ['only' => ['create', 'store', 'edit', 'update']]);
        $this->middleware('permission:delete.trimesters', ['only' => 'destroy']);

        $this->trimesterRepository = $trimesterRepository;
    }

    public function index()
    {
        $trimesters = $this->trimesterRepository->paginate();
        $presenter = app('PaginationPresenter', [$trimesters]);
        return view('dashboard.trimesters.index', compact('trimesters', 'presenter'));
    }

    public function create()
    {
        $trimester = $this->trimesterRepository->newInstance();
        return view('dashboard.trimesters.create', compact('trimester'));
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->rules());
        $this->trimesterRepository->create($request->input());
        return redirect()->route('dashboard.trimesters.index');
    }

    /**
     * @return array
     */
    protected function rules()
    {
        return [
            'year' => 'required|digits:4',
            'sequence' => 'required|numeric',
            'trimester_name' => 'required|max:20',
        ];
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $trimester = $this->trimesterRepository->getById($id);
        return view('dashboard.trimesters.edit', compact('trimester'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, $this->rules());
        $trimester = $this->trimesterRepository->getById($id);
        $trimester->update($request->input());
        return redirect()->back();
    }

    public function destroy($id)
    {
        $this->trimesterRepository->getById($id)->delete();
        return redirect()->route('dashboard.trimesters.index');
    }
}
