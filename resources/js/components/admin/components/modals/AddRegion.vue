<template>
    <div>
        <div class="modal fade" id="regionModal" tabindex="-1" role="dialog" aria-labelledby="regionModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form v-on:submit.prevent="addRegion">
                        <div class="modal-header">
                            <h5 class="modal-title" id="regionModalLabel">
                                {{ text.title }}
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="text" v-model.trim="regionName" name="regionName" id="regionName" placeholder="Име на регион">
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
                regionName: null,
                text: {
                    title: 'Нов регион',
                    buttons: {
                        close: 'Затвори',
                        add: 'Добави'
                    }
                }
            }
        },
        methods: {
            async addRegion () {
                const $regionModal = $('#regionModal');
                const csrfToken = $('meta[name="csrf-token"]').attr('content');
                const regionName = this.regionName;
                const payload = { regionName };

                await fetch('/regions', {
                    method: 'POST',
                    body: JSON.stringify(payload),
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json',
                    }
                });

                $regionModal.modal('hide');
                EventBus.$emit('regions:update');
            }
        }
    }
</script>
