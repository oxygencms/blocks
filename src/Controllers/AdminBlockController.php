<?php

namespace Oxygencms\Blocks\Controllers;

use JavaScript;
use Oxygencms\Blocks\Models\Block;
use App\Http\Controllers\Controller;
use Oxygencms\Blocks\Requests\AdminBlockRequest as BlockRequest;

class AdminBlockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(BlockRequest $request)
    {
        $this->authorize('create', Block::class);

        $block = Block::create($request->validated());

        notification("$block->model_name successfully created.");

        return redirect()->route('block.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Block $block
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Block $block)
    {
        $this->authorize('update', Block::class);

        return view('oxygencms::admin.blocks.edit', compact('block'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BlockRequest $request
     * @param Block $block
     *
     * @return \Illuminate\Http\Response
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
