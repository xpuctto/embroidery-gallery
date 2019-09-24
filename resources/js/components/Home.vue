<template>
    <div>
        <Header></Header>
        <router-link></router-link>
        <Footer></Footer>
    </div>
</template>

<script>
    import Header from './common/Header';
    import Footer from './common/Footer';

    export default {
        components: {
            Header,
            Footer
        }
    }
</script>
