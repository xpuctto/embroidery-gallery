<template>
    <div class="container">
        <nav class="navbar navbar-light bg-light border">
            <a class="navbar-brand" href="#">
                {{ text.header }}
            </a>

            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a href="#" class="nav-link" @click.prevent="$auth.logout()">{{ text.logout }}</a>
                </li>
            </ul>
        </nav>

        <div class="row">
            <div class="col-12">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-embroideries-tab" data-toggle="pill" href="#pills-embroideries" role="tab" aria-controls="pills-embroideries" aria-selected="false">Шевици</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-stitches-tab" data-toggle="pill" href="#pills-stitches" role="tab" aria-controls="pills-stitches" aria-selected="false">Шевове</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-locations-tab" data-toggle="pill" href="#pills-locations" role="tab" aria-controls="pills-locations" aria-selected="false">Местоположения</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-symbols-tab" data-toggle="pill" href="#pills-symbols" role="tab" aria-controls="pills-symbols" aria-selected="false">Символи</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-regions-tab" data-toggle="pill" href="#pills-regions" role="tab" aria-controls="pills-regions" aria-selected="true">Региони</a>
                    </li>
                </ul>

                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-embroideries" role="tabpanel" aria-labelledby="pills-embroideries-tab">
                        <embroideries
                            :embroideries="embroideries"
                            :symbols="symbols"
                            :locations="locations"
                            :stitches="stitches"
                            :regions="regions">
                        </embroideries>
                    </div>
                    <div class="tab-pane fade" id="pills-stitches" role="tabpanel" aria-labelledby="pills-stitches-tab">
                        <stitches :stitches="stitches"></stitches>
                    </div>
                    <div class="tab-pane fade" id="pills-locations" role="tabpanel" aria-labelledby="pills-locations-tab">
                        <locations :locations="locations"></locations>
                    </div>
                    <div class="tab-pane fade" id="pills-symbols" role="tabpanel" aria-labelledby="pills-symbols-tab">
                        <symbols :symbols="symbols"></symbols>
                    </div>
                    <div class="tab-pane fade" id="pills-regions" role="tabpanel" aria-labelledby="pills-regions-tab">
                        <regions :regions="regions"></regions>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import EventBus from '../helpers/eventBus';
    import Regions from './components/Regions';
    import Stitches from './components/Stitches';
    import Locations from './components/Locations';
    import Symbols from './components/Symbols';
    import Embroideries from './components/Embroideries';

    export default {
        data: function () {
            return {
                regions: null,
                stitches: null,
                locations: null,
                symbols: null,
                embroideries: null,
                text: {
                    header: 'Контролен панел',
                    logout: 'Излез'
                }
            }
        },
        components: {
            Regions,
            Stitches,
            Locations,
            Symbols,
            Embroideries
        },
        methods: {
            async fetchRegions () {
                const res = await fetch('/regions');
                const regions = await res.json();

                this.regions = regions;
            },
            async fetchStitches () {
                const res = await fetch('/stitches');
                const stitches = await res.json();

                this.stitches = stitches;
            },
            async fetchLocations () {
                const res = await fetch('/locations');
                const locations = await res.json();

                this.locations = locations;
            },
            async fetchSymbols () {
                const res = await fetch('/symbols');
                const symbols = await res.json();

                this.symbols = symbols;
            },
            async fetchEmbroideries () {
                const res = await fetch('/embroideries');
                const embroideries = await res.json();

                this.embroideries = embroideries;
            }
        },
        mounted: function () {
            this.fetchRegions();
            this.fetchStitches();
            this.fetchLocations();
            this.fetchSymbols();
            this.fetchEmbroideries();

            EventBus.$on('regions:update', this.fetchRegions);
            EventBus.$on('stitches:update', this.fetchStitches);
            EventBus.$on('locations:update', this.fetchLocations);
            EventBus.$on('symbols:update', this.fetchSymbols);
            EventBus.$on('symbols:update', this.fetchEmbroideries);
        }
    }
</script>
