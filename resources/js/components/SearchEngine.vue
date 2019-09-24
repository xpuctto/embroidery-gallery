<template>
    <div>
        <Header></Header>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" v-model="searchQuery" placeholder="Търсене">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" v-on:click="fetchResults" type="button">Търси</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-12" v-if="searchResults.length">
                        <div class="row text-center">
                            <div class="col-3" v-for="embroidery in searchResults" v-bind:key="embroidery.id">
                                <Embroidery :embroidery="embroidery"></Embroidery>
                            </div>
                        </div>
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
                searchResults: [],
                searchQuery: null,
            }
        },
        methods: {
            async fetchResults (e) {
                const searchQuery = this.searchQuery;
                const response = await fetch(`/embroideries/search?query=${searchQuery}`);

                const results = await response.json();
                console.log(results);
            },
        },
        components: {
            Embroidery,
            Header,
            Footer
        }
    }
</script>
