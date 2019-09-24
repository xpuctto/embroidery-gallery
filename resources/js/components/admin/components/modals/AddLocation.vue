<template>
    <div>
        <div class="modal fade" id="locationModal" tabindex="-1" role="dialog" aria-labelledby="locationModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form v-on:submit.prevent="addLocation">
                        <div class="modal-header">
                            <h5 class="modal-title" id="locationModalLabel">
                                {{ text.title }}
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="text" v-model.trim="locationName" name="locationName" id="locationName" placeholder="Име на местоположение">
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
                locationName: null,
                text: {
                    title: 'Ново местоположение',
                    buttons: {
                        close: 'Затвори',
                        add: 'Добави'
                    }
                }
            }
        },
        methods: {
            addLocation () {
                const $locationModal = $('#locationModal');
                const csrfToken = $('meta[name="csrf-token"]').attr('content');
                const locationName = this.locationName;

                const payload = { locationName};

                fetch('/locations', {
                    method: 'POST',
                    body: JSON.stringify(payload),
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json',
                    }
                }).then(() => {
                    $locationModal.modal('hide');
                    EventBus.$emit('locations:update');
                });
            }
        },
        props: {
            regionId: Number
        }
    }
</script>
