<template>
    <div>
        <div class="modal fade" :id="`previewEmbroidery-${embroidery.id}`" tabindex="-1" role="dialog" aria-labelledby="previewEmbroideryLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="previewEmbroideryLabel">
                            {{ embroidery.name }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="row" v-if="embroidery.embroidery_images.length">
                            <div class="col" v-for="image in embroidery.embroidery_images" v-bind:key="image.id">
                                <img :src="`../storage/${image.path}`" class="mw-100" />
                            </div>

                            <div class="col-12 py-2">
                                <p class="mb-1" v-if="embroidery.image_authors"><b>Автор на снимки:</b> {{ embroidery.image_authors }}</p>
                                <p class="mb-1" v-if="embroidery.owner"><b>Собственик на шевицата:</b> {{ embroidery.owner }}</p>
                            </div>

                            <div class="col-12 py-2">
                                <p class="mb-1"><b>Регион:</b> {{ embroidery.region.name }}</p>
                                <p class="mb-1"><b>Град:</b> {{ embroidery.city.name }}</p>
                                <p class="mb-1" v-if="embroidery.village"><b>Село:</b> {{ embroidery.village }}</p>
                                <p class="mb-1"><b>Описание:</b> {{ embroidery.description }}</p>
                                <p class="mb-1"><b>Символи:</b>
                                    <ul v-for="symbol in embroidery.symbols" v-bind:key="symbol.id">
                                        <li> {{ symbol.name }}</li>
                                    </ul>
                                </p>
                                <p class="mb-1"><b>Шевове:</b>
                                    <ul v-for="stitch in embroidery.stitches" v-bind:key="stitch.id">
                                        <li> {{ stitch.name }}</li>
                                    </ul>
                                </p>
                                <p class="mb-1"><b>Местоположение на шевицата:</b>
                                    <ul v-for="location in embroidery.locations" v-bind:key="location.id">
                                        <li> {{ location.name }}</li>
                                    </ul>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-dismiss="modal">Затвори</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            embroidery: Object
        }
    }
</script>
