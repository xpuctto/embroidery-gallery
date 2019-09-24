<template>
    <div>
        <div class="modal fade" :id="`cityModal-${regionId}`" tabindex="-1" role="dialog" aria-labelledby="cityModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form v-on:submit.prevent="addCity">
                        <div class="modal-header">
                            <h5 class="modal-title" id="cityModalLabel">
                                {{ text.title }}
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="text" v-model.trim="cityName" name="cityName" id="cityName" placeholder="Име на град">
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
                cityName: null,
                text: {
                    title: 'Нов град',
                    buttons: {
                        close: 'Затвори',
                        add: 'Добави'
                    }
                }
            }
        },
        methods: {
            addCity () {
                const $cityModal = $(`#cityModal-${this.regionId}`);
                const csrfToken = $('meta[name="csrf-token"]').attr('content');
                const cityName = this.cityName;
                const regionId = this.regionId;

                const payload = { cityName, regionId };

                fetch('/cities', {
                    method: 'POST',
                    body: JSON.stringify(payload),
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json',
                    }
                }).then(() => {
                    $cityModal.modal('hide');
                    EventBus.$emit('regions:update');
                });
            }
        },
        props: {
            regionId: Number
        }
    }
</script>
