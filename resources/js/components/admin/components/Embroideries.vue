<template>
    <div>
        <h2>{{ text.title }}</h2>
        <button class="btn btn-success" data-toggle="modal" data-target="#embroideryModal">
            {{ text.addEmbroidery }}
        </button>

        <add-embroidery-modal
            :symbols="symbols"
            :locations="locations"
            :stitches="stitches"
            :regions="regions">
        </add-embroidery-modal>
    </div>
</template>

<script>
    import AddEmbroideryModal from './modals/AddEmbroidery';

    export default {
        data: function () {
            return {
                text: {
                    title: 'Всички шевици',
                    addEmbroidery: 'Добави шевица'
                }
            }
        },
        props: {
            stitches: Array,
            symbols: Array,
            regions: Array,
            embroideries: Array,
            locations: Array
        },
        components: {
            AddEmbroideryModal
        }
    }
</script>
