@extends('oxygencms::admin.layout')

@section('title', 'Blocks')

@section('content')

    <div class="row">
        <div class="col-12 d-flex align-items-center mb-3">
            <h1>Blocks</h1>

            <div class="ml-auto d-flex justify-content-end">
                <div>
                    <a href="{{ route('block.create') }}" class="btn">
                        Create <i class="far fa-edit"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <vue-good-table
        :columns="[
            {label: 'Name', field: 'name'},
            {label: 'Actions', field: 'actions', width: '100px', globalSearchDisabled: false, sortable: false},
        ]"
        :rows="models"
        :search-options="{enabled: true}"
        :pagination-options="{enabled: true}"
    >
        <template slot="table-row" slot-scope="props">
            <span v-if="props.column.label === 'Actions'" class="action-links">
                <a :href="props.row.edit_url" title="Edit">edit</a>

                <a @click.prevent="confirmAndDestroy(props.row)" href="#" title="Delete">
                    delete
                </a>
            </span>

            <span v-else v-text="props.formattedRow[props.column.field]"></span>
        </template>
    </vue-good-table>

@endsection