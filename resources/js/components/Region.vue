<template>
    <div>
        <Header></Header>
            <div class="container">
                <div class="row" v-if="region !== null">
                    <div class="col-3" v-for="embroidery in region.embroideries" v-bind:key="embroidery.id">
                        <Embroidery :embroidery="embroidery"></Embroidery>
                    </div>
                </div>
            </div>
        <Footer></Footer>
    </div>
</template>

<script>
    import Header from './common/Header';
    import Footer from './common/Footer';
    import Embroidery from './Embroidery';

    export default {
        data: function () {
            return {
                regionId: this.$route.params.regionId,
                region: null
            }
        },
        methods: {
            async fetchRegion() {
                const region = await fetch(`/regions/${this.regionId}`);

                const reg = await region.json();
                this.region = reg;
            }
        },
        mounted: function () {
            this.fetchRegion();
        },
        components: {
            Header,
            Footer,
            Embroidery
        }
    }
</script>
