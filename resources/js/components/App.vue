<template>
<div class="d-flex flex-column vh-100 overflow-hidden">
<Nav></Nav>
<router-view></router-view>
</div>
</template>
<script>
import Nav from './Nav';
export default {
    name: "App",

    components: {
        Nav
    }
}
</script>
<style scoped>

</style>
