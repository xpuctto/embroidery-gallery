<template>
    <div>
        <h2>{{ text.title }}</h2>

        <button class="btn btn-success" data-toggle="modal" data-target="#locationModal">
            {{ text.addLocation }}
        </button>

        <div v-if="locations.length">
            <ul class="list-group"  v-for="location in locations" v-bind:key="location.id">
                <li class="list-group-item">{{ location.name }}
                    <button class="btn btn-primary btn-xs" data-toggle="modal" :data-target="`#editLocation-${location.id}`">
                        {{ text.buttons.edit }}
                    </button>
                    <button v-on:click="deleteLocation(location.id)" class="btn btn-danger btn-xs">
                        {{ text.buttons.delete }}
                    </button>
                </li>

                <edit-location-modal :locationObject="location"></edit-location-modal>
            </ul>
        </div>
        <add-location-modal></add-location-modal>
    </div>
</template>

<script>
    import AddLocationModal from './modals/AddLocation';
    import EditLocationModal from './modals/EditLocation';
    import EventBus from '../../helpers/eventBus';

    export default {
        data: function () {
            return {
                text: {
                    title: 'Местоположения на шевица',
                    addLocation: 'Добавяне на местоположение',
                    buttons: {
                        edit: 'Редактиране',
                        delete: 'Изтриване'
                    }
                }
            }
        },
        methods: {
            deleteLocation(locationId) {
                const csrfToken = $('meta[name="csrf-token"]').attr('content');

                fetch(`/locations/${locationId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                    },
                }).then(() => {
                    EventBus.$emit('locations:update');
                });
            }
        },
        components: {
            AddLocationModal,
            EditLocationModal
        },
        props: {
            locations: Array
        }
    }
</script>
