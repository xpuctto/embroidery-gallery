<template>
    <div>
        <h2>{{ text.title }}</h2>
        <button class="btn btn-success" data-toggle="modal" :data-target="`#cityModal-${region.id}`">
            {{ text.addCity }}
        </button>

        <div v-if="region.cities.length">
            <ul class="list-group"  v-for="city in region.cities" v-bind:key="city.id">
                <li class="list-group-item">{{ city.name }}
                    <button class="btn btn-primary btn-xs" data-toggle="modal" :data-target="`#editCity-${city.id}`">
                        {{ text.buttons.edit }}
                    </button>
                    <button v-on:click="deleteCity(city.id)" class="btn btn-danger btn-xs">
                        {{ text.buttons.delete }}
                    </button>
                </li>

                <edit-city-modal :cityObject="city"></edit-city-modal>
            </ul>
        </div>

        <add-city-modal :regionId="region.id"></add-city-modal>
    </div>
</template>

<script>
    import AddCityModal from './modals/AddCity';
    import EditCityModal from './modals/EditCity';
    import EventBus from '../../helpers/eventBus';

    export default {
        data: function () {
            return {
                text: {
                    title: 'Градове',
                    addCity: 'Добави град',
                    buttons: {
                        edit: 'Редактиране',
                        delete: 'Изтриване'
                    }
                }
            }
        },
        methods: {
            async deleteCity(cityId) {
                const csrfToken = $('meta[name="csrf-token"]').attr('content');

                const res = await fetch(`/cities/${cityId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                    },
                });

                EventBus.$emit('regions:update');
            }
        },
        props: {
            region: Object
        },
        components: {
            AddCityModal,
            EditCityModal
        }
    }
</script>
