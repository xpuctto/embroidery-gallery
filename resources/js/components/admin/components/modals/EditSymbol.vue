<template>
    <div>
        <div class="modal fade" :id="`editSymbol-${symbol.id}`" tabindex="-1" role="dialog" aria-labelledby="editSymbolModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form v-on:submit.prevent="editSymbol">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editSymbolModalLabel">
                                {{ text.title }}
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="text" v-model="newSymbolName" name="symbolName" id="symbolName" placeholder="Име на символ">
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
                symbol: this.symbolObject,
                newSymbolName: this.symbolObject.name,
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
            async editSymbol () {
                const $editSymbolModal = $(`#editSymbol-${this.symbol.id}`);
                const csrfToken = $('meta[name="csrf-token"]').attr('content');
                const symbolName = this.newSymbolName;
                const payload = { symbolName };

                await fetch(`/symbols/${this.symbol.id}`, {
                    method: 'PUT',
                    body: JSON.stringify(payload),
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json',
                    }
                });

                $editSymbolModal.modal('hide');
                EventBus.$emit('symbols:update');
            }
        },
        props: {
            symbolObject: Object
        }
    }
</script>
