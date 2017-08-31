<?php


namespace App\Http\Controllers\Backend\Api;


use App\Http\Controllers\ApiController;
use App\Http\Requests\Backend\LinkCreateRequest;
use App\Http\Requests\Backend\LinkUpdateRequest;
use App\Http\Requests\Request;
use App\Models\Link;
use App\Repositories\LinkRepository;
use App\Transformers\Backend\LinkTransformer;

class LinksController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $links = Link::byType($request->get('type_id', null))
            ->withSort()
            ->withSimpleSearch()
            ->ordered()
            ->ancient()
            ->paginate($this->perPage());
        return $this->response()->paginator($links, new LinkTransformer());
    }

    public function store(LinkCreateRequest $request, LinkRepository $linkRepository)
    {
        $linkRepository->create($request->validated());
        return $this->response()->noContent();
    }

    public function update(Link $link, LinkUpdateRequest $request, LinkRepository $linkRepository)
    {
        $linkRepository->update($request->validated(), $link);
        return $this->response()->noContent();
    }

    public function destroy(Link $link)
    {
        $link->delete();
        return $this->response()->noContent();
    }

    public function show(Link $link)
    {
        return $this->response()->item($link, new LinkTransformer());
    }

}