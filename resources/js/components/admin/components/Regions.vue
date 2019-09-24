<template>
    <div>
        <h2>{{ text.title }}</h2>

        <button class="btn btn-success" data-toggle="modal" data-target="#regionModal">
            {{ text.addRegion }}
        </button>

        <ul class="list-group" v-for="region in regions" v-bind:key="region.id">
            <li class="list-group-item">
                <span>{{ region.name }}</span>
                <button class="btn btn-primary btn-xs" data-toggle="modal" :data-target="`#editRegion-${region.id}`">
                    {{ text.buttons.edit }}
                </button>
                <button v-on:click="deleteRegion(region.id)" class="btn btn-danger btn-xs">
                    {{ text.buttons.delete }}
                </button>

                <cities :region="region"></cities>
            </li>
            <edit-region-modal :regionName="region.name" :regionId="region.id"></edit-region-modal>
        </ul>
        <add-region-modal></add-region-modal>
    </div>
</template>

<script>
    import AddRegionModal from './modals/AddRegion';
    import EditRegionModal from './modals/EditRegion';
    import EventBus from '../../helpers/eventBus';

    import Cities from './Cities';

    export default {
        data: function () {
            return {
                text: {
                    title: 'Региони',
                    addRegion: 'Добавяне на регион',
                    buttons: {
                        edit: 'Редактиране',
                        delete: 'Изтриване'
                    }
                }
            }
        },
        methods: {
            async deleteRegion(regionId) {
                const csrfToken = $('meta[name="csrf-token"]').attr('content');

                const res = await fetch(`/regions/${regionId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                    },
                });

                EventBus.$emit('regions:update');
            }
        },
        props: {
            regions: [Promise, Array]
        },
        components: {
            AddRegionModal,
            EditRegionModal,
            Cities
        }
    }
</script>
