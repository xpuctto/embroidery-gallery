<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="/">Navbar</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <router-link :to="`/region/${region.id}`" class="nav-item nav-link" v-for="region in regions" v-bind:key="region.id">{{ region.name }}</router-link>
                    <router-link :to="`/search`" class="nav-item nav-link">Търсене</router-link>
                </div>
            </div>
        </nav>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                regions: null,
            }
        },
        methods: {
            async fetchRegions () {
                const res = await fetch('/regions');
                const regions = await res.json();

                this.regions = regions;
            },
        },
        mounted: function () {
            this.fetchRegions();
        }
    }
</script>

<style lang="scss" scoped>

</style>
