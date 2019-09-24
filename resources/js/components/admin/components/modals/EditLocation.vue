<template>
    <div>
        <div class="modal fade" :id="`editLocation-${location.id}`" tabindex="-1" role="dialog" aria-labelledby="editLocationModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form v-on:submit.prevent="editLocation">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editLocationModalLabel">
                                {{ text.title }}
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="text" v-model="newLocationName" name="locationName" id="locationName" placeholder="Име на местоположение">
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-dismiss="modal"> {{ text.buttons.close }}</button>
                            <button type="submit" class="btn btn-primary"> {{ text.buttons.add }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import EventBus from '../../../helpers/eventBus';

    export default {
        data: function () {
            return {
                location: this.locationObject,
                newLocationName: this.locationObject.name,
                text: {
                    title: 'Редактиране на местоположение',
                    buttons: {
                        close: 'Затвори',
                        add: 'Запази'
                    }
                }
            }
        },
        methods: {
            async editLocation () {
                const $editLocationModal = $(`#editLocation-${this.location.id}`);
                const csrfToken = $('meta[name="csrf-token"]').attr('content');
                const locationName = this.newLocationName;
                const payload = { locationName };

                await fetch(`/locations/${this.location.id}`, {
                    method: 'PUT',
                    body: JSON.stringify(payload),
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json',
                    }
                });

                $editLocationModal.modal('hide');
                EventBus.$emit('locations:update');
            }
        },
        props: {
            locationObject: Object
        }
    }
</script>
