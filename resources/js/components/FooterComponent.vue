<template>
    <footer class="bg-gray-800 text-center text-white">
        <!-- Grid container -->

        <!-- Grid container -->

        <!-- Copyright -->
        <div
            class="text-center p-3"
            style="background-color: rgba(0, 0, 0, 0.2)"
        >
            © 2023 Copyright:
            <a class="text-white" href="https://mdbootstrap.com/"
                >Jorge Andre</a
            >
        </div>
        <!-- Copyright -->
    </footer>
</template>

<script>
export default {
    name: "FooterComponent",
    computed: {
        estConnecter() {
            // console.log(this.$store.state.session.utilisateur_id);
            // return this.$store.state.session.utilisateur_id !== undefined;
            return true;
        },
    },
};
</script>

<style scoped>
/* Add any necessary styles here */
</style>
