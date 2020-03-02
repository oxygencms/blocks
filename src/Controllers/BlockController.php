<?php

namespace Oxygencms\Blocks\Controllers;

use JavaScript;
use Oxygencms\Blocks\Models\Block;
use Oxygencms\Core\Controllers\Controller;
use Oxygencms\Blocks\Requests\BlockRequest;

class BlockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $this->authorize('index', Block::class);

        $models = Block::allWithAccessors(['edit_url', 'model_name']);

        JavaScript::put(compact('models'));

        return view('oxygencms::admin.blocks.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('create', Block::class);

        return view('oxygencms::admin.blocks.create', ['block' => null]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BlockRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(BlockRequest $request)
    {
        $this->authorize('create', Block::class);

        $block = Block::create($request->validated());

        notification("$block->model_name successfully created.");

        return redirect()->route('admin.block.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Block $block
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Block $block)
    {
        $this->authorize('update', Block::class);

        $block->mapMediaUrls();

        return view('oxygencms::admin.blocks.edit', compact('block'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BlockRequest $request
     * @param Block $block
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(BlockRequest $request, Block $block)
    {
        $this->authorize('update', Block::class);

        $block->update($request->validated());

        notification("$block->model_name successfully updated.");

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Block $block
     * @return void
     */
    public function destroy(Block $block)
    {
        //
    }
}
