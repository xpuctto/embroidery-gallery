<template>
    <div>
        <div class="modal fade" id="stitchModal" tabindex="-1" role="dialog" aria-labelledby="stitchModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form v-on:submit.prevent="addStitch">
                        <div class="modal-header">
                            <h5 class="modal-title" id="stitchModalLabel">
                                {{ text.title }}
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="text" v-model.trim="stitchName" name="stitchName" id="stitchName" placeholder="Име на шев">
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
                stitchName: null,
                text: {
                    title: 'Нов шев',
                    buttons: {
                        close: 'Затвори',
                        add: 'Добави'
                    }
                }
            }
        },
        methods: {
            addStitch () {
                const $stitchModal = $('#stitchModal');
                const csrfToken = $('meta[name="csrf-token"]').attr('content');
                const stitchName = this.stitchName;

                const payload = { stitchName};

                fetch('/stitches', {
                    method: 'POST',
                    body: JSON.stringify(payload),
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json',
                    }
                }).then(() => {
                    $stitchModal.modal('hide');
                    EventBus.$emit('stitches:update');
                });
            }
        },
        props: {
            regionId: Number
        }
    }
</script>
