<template>
    <div>
        <div class="card">
            <img v-if="embroidery.embroidery_images.length" :src="`../storage${embroidery.embroidery_images[0].path}`" class="card-img-top">
            <div class="card-body">
                <h5 class="card-title">{{ embroidery.name }}</h5>
                <p class="card-text" v-if="embroidery.city">{{ embroidery.city.name }}</p>
                <button class="btn btn-info" data-toggle="modal" :data-target="`#previewEmbroidery-${embroidery.id}`">Виж още</button>
            </div>
        </div>
        <PreviewEmbroidery :embroidery="embroidery"></PreviewEmbroidery>
    </div>
</template>

<script>
    import PreviewEmbroidery from './PreviewEmbroidery';

    export default {
        props: {
            embroidery: Object
        },
        components: {
            PreviewEmbroidery
        }
    }
</script>
