<template>
    <div>
        <h2>{{ text.title }}</h2>

        <button class="btn btn-success" data-toggle="modal" data-target="#symbolModal">
            {{ text.addSymbol }}
        </button>

        <div v-if="symbols.length">
            <ul class="list-group"  v-for="symbol in symbols" v-bind:key="symbol.id">
                <li class="list-group-item">{{ symbol.name }}
                    <button class="btn btn-primary btn-xs" data-toggle="modal" :data-target="`#editSymbol-${symbol.id}`">
                        {{ text.buttons.edit }}
                    </button>
                    <button v-on:click="deleteSymbol(symbol.id)" class="btn btn-danger btn-xs">
                        {{ text.buttons.delete }}
                    </button>
                </li>

                <edit-symbol-modal :symbolObject="symbol"></edit-symbol-modal>
            </ul>
        </div>
        <add-symbol-modal></add-symbol-modal>
    </div>
</template>

<script>
    import AddSymbolModal from './modals/AddSymbol';
    import EditSymbolModal from './modals/EditSymbol';
    import EventBus from '../../helpers/eventBus';

    export default {
        data: function () {
            return {
                text: {
                    title: 'Символ',
                    addSymbol: 'Добавяне на символ',
                    buttons: {
                        edit: 'Редактиране',
                        delete: 'Изтриване'
                    }
                }
            }
        },
        methods: {
            deleteSymbol(symbolId) {
                const csrfToken = $('meta[name="csrf-token"]').attr('content');

                fetch(`/symbols/${symbolId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                    },
                }).then(() => {
                    EventBus.$emit('symbols:update');
                });
            }
        },
        components: {
            AddSymbolModal,
            EditSymbolModal
        },
        props: {
            symbols: Array
        }
    }
</script>
