<template>
    <div>
        <h2>{{ text.title }}</h2>

        <button class="btn btn-success" data-toggle="modal" data-target="#stitchModal">
            {{ text.addStitch }}
        </button>

        <div v-if="stitches.length">
            <ul class="list-group"  v-for="stitch in stitches" v-bind:key="stitch.id">
                <li class="list-group-item">{{ stitch.name }}
                    <button class="btn btn-primary btn-xs" data-toggle="modal" :data-target="`#editStitch-${stitch.id}`">
                        {{ text.buttons.edit }}
                    </button>
                    <button v-on:click="deleteStitch(stitch.id)" class="btn btn-danger btn-xs">
                        {{ text.buttons.delete }}
                    </button>
                </li>

                <edit-stitch-modal :stitchObject="stitch"></edit-stitch-modal>
            </ul>
        </div>
        <add-stitch-modal></add-stitch-modal>
    </div>
</template>

<script>
    import AddStitchModal from './modals/AddStitch';
    import EditStitchModal from './modals/EditStitch';
    import EventBus from '../../helpers/eventBus';

    export default {
        data: function () {
            return {
                text: {
                    title: 'Шевове',
                    addStitch: 'Добавяне на шев',
                    buttons: {
                        edit: 'Редактиране',
                        delete: 'Изтриване'
                    }
                }
            }
        },
        methods: {
            deleteStitch(stitchId) {
                const csrfToken = $('meta[name="csrf-token"]').attr('content');

                fetch(`/stitches/${stitchId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                    },
                }).then(() => {
                    EventBus.$emit('stitches:update');
                });
            }
        },
        components: {
            AddStitchModal,
            EditStitchModal
        },
        props: {
            stitches: Array
        }
    }
</script>
