<template>
    <div>
        <div class="modal fade" id="embroideryModal" tabindex="-1" role="dialog" aria-labelledby="embroideryModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form v-on:submit.prevent="addEmbroidery">
                        <div class="modal-header">
                            <h5 class="modal-title" id="embroideryModalLabel">
                                <p>{{ text.title }}</p>
                                <small>{{ text.subtitle }}</small>
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="form-group">
                                <input class="form-control" type="text" v-model="embroideryName" placeholder="Име"></input>
                            </div>

                            <div class="form-group">
                                <label for="regions">Регион: </label>
                                <select name="regions" id="regions" class="form-control" v-model="selectedRegion" v-on:change="toggleCities">
                                    <option selected>Избери регион</option>
                                    <option v-for="region in regions" v-bind:key="region.id" :value="region.id">
                                        {{ region.name }}
                                    </option>
                                </select>
                            </div>

                            <div class="form-group" v-if="showCities">
                                <label for="cities">Град: </label>
                                <select name="cities" id="cities" v-model="selectedCity" class="form-control">
                                    <option v-for="city in availableCities" v-bind:key="city.id" :value="city.id">
                                        {{ city.name }}
                                    </option>
                                </select>
                            </div>

                            <div class="form-group">
                                <textarea class="form-control" type="text" v-model="description" placeholder="Описание"></textarea>
                            </div>

                            <label for="locations">Местоположение: </label>
                            <div class="form-group">
                                <select name="locations" id="locations" v-model="selectedLocations" class="form-control custom-select" multiple="true">
                                    <option v-for="location in locations" v-bind:key="location.id" :value="location.id">
                                        {{ location.name }}
                                    </option>
                                </select>
                            </div>

                            <label for="stitches">Шевове:</label>
                            <div class="form-group">
                                <select name="stitches" id="stitches" v-model="selectedStitches" class="form-control custom-select" multiple="true">
                                    <option v-for="stitch in stitches" v-bind:key="stitch.id" :value="stitch.id">
                                        {{ stitch.name }}
                                    </option>
                                </select>
                            </div>

                            <label for="stitches">Символи:</label>
                            <div class="form-group">
                                <select name="symbols" id="symbols" v-model="selectedSymbols" class="form-control custom-select" multiple="true">
                                    <option v-for="symbol in symbols" v-bind:key="symbol.id" :value="symbol.id">
                                        {{ symbol.name }}
                                    </option>
                                </select>
                            </div>

                            <div class="form-group">
                                <el-upload action="/" list-type="picture-card"
                                    :on-change="updateImageList"
                                    :auto-upload="false">
                                    <i class="el-icon-plus"></i>
                                </el-upload>
                            </div>

                            <div class="form-group">
                                <textarea class="form-control" type="text" v-model="imageAuthors" placeholder="Автор/и на снимките"></textarea>
                            </div>

                            <div class="form-group">
                                <textarea class="form-control" type="text" v-model="embroideryOwner" placeholder="Собственик на шевицата"></textarea>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-dismiss="modal">{{ text.buttons.close }}</button>
                            <button type="submit" class="btn btn-primary">{{ text.buttons.add }}</button>
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
                selectedSymbols: null,
                selectedStitches: null,
                selectedRegion: null,
                selectedCity: null,
                selectedLocations: null,
                selectedImages: [],
                description: null,
                imageAuthors: null,
                embroideryOwner: null,
                showCities: false,
                embroideryName: null,
                availableCities: [],
                text: {
                    title: 'Нова шевица',
                    subtitle: 'За Местоположение, Шевове и Символи задръжте ctrl / cmd за повече от 1 избор',
                    buttons: {
                        close: 'Затвори',
                        add: 'Добави'
                    }
                }
            }
        },
        methods: {
            addEmbroidery () {
                const $embroideryModal = $('#embroideryModal');
                const csrfToken = $('meta[name="csrf-token"]').attr('content');
                const selectedSymbols = this.selectedSymbols;
                const selectedStitches = this.selectedStitches;
                const selectedRegion = this.selectedRegion;
                const selectedCity = this.selectedCity;
                const selectedLocations = this.selectedLocations;
                const description = this.description;
                const imageAuthors = this.imageAuthors;
                const embroideryOwner = this.embroideryOwner;
                const embroideryName = this.embroideryName;
                const selectedImages = this.selectedImages;

                const formData = new FormData();

                formData.set('selectedSymbols', selectedSymbols);
                formData.set('selectedStitches', selectedStitches);
                formData.set('selectedRegion', selectedRegion);
                formData.set('selectedCity', selectedCity);
                formData.set('selectedLocations', selectedLocations);
                formData.set('description', description);
                formData.set('imageAuthors', imageAuthors);
                formData.set('embroideryOwner', embroideryOwner);
                formData.set('embroideryName', embroideryName);

                selectedImages.forEach((img, idx) => {
                    formData.append(`images[${idx}]`, img);
                });


                axios({
                    method: 'post',
                    url: '/embroideries',
                    data: formData,
                    config: { headers: { 'X-CSRF-TOKEN': csrfToken, 'Content-Type': 'multipart/form-data' }}
                })
                .then(function (response) {
                    $embroideryModal.modal('hide');
                    EventBus.$emit('embroideries:update');
                })
                .catch(function (response) {
                    //handle error
                    console.log(response);
                });
            },
            toggleCities (e) {
                const selectedRegionId = parseInt(e.target.value);
                const searchResult = this.regions.find(region => region.id === selectedRegionId);

                if (searchResult && 'cities' in searchResult && searchResult.cities.length) {
                    this.availableCities = searchResult.cities;
                    this.showCities = true;
                } else {
                    this.showCities = false;
                }

            },
            updateImageList (file) {
                this.selectedImages.push(file.raw);
            }
        },
        props: {
            stitches: Array,
            symbols: Array,
            regions: Array,
            locations: Array
        },
    }
</script>
