<template>
    <div>
        <div class="modal fade" id="symbolModal" tabindex="-1" role="dialog" aria-labelledby="symbolModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form v-on:submit.prevent="addSymbol">
                        <div class="modal-header">
                            <h5 class="modal-title" id="symbolModalLabel">
                                {{ text.title }}
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="text" v-model.trim="symbolName" name="symbolName" id="symbolName" placeholder="Име на символ">
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
                symbolName: null,
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
            addSymbol () {
                const $symbolModal = $('#symbolModal');
                const csrfToken = $('meta[name="csrf-token"]').attr('content');
                const symbolName = this.symbolName;

                const payload = { symbolName};

                fetch('/symbols', {
                    method: 'POST',
                    body: JSON.stringify(payload),
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json',
                    }
                }).then(() => {
                    $symbolModal.modal('hide');
                    EventBus.$emit('symbols:update');
                });
            }
        }
    }
</script>
