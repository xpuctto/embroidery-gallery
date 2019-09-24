<template>
    <div>
        <div class="modal fade" :id="`editStitch-${stitch.id}`" tabindex="-1" role="dialog" aria-labelledby="editStitchModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form v-on:submit.prevent="editStitch">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editStitchModalLabel">
                                {{ text.title }}
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="text" v-model="newStitchName" name="stitchName" id="stitchName" placeholder="Име на шев">
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
                stitch: this.stitchObject,
                newStitchName: this.stitchObject.name,
                text: {
                    title: 'Редактиране на регион',
                    buttons: {
                        close: 'Затвори',
                        add: 'Запази'
                    }
                }
            }
        },
        methods: {
            async editStitch () {
                const $editStitchModal = $(`#editStitch-${this.stitch.id}`);
                const csrfToken = $('meta[name="csrf-token"]').attr('content');
                const stitchName = this.newStitchName;
                const payload = { stitchName };

                await fetch(`/stitches/${this.stitch.id}`, {
                    method: 'PUT',
                    body: JSON.stringify(payload),
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json',
                    }
                });

                $editStitchModal.modal('hide');
                EventBus.$emit('stitches:update');
            }
        },
        props: {
            stitchObject: Object
        }
    }
</script>
